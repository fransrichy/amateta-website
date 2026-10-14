<?php
/**
 * Shared helper functions.
 */

/* ----------  Output / input safety  ---------- */

/** Escape for safe HTML output. */
function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Clean a raw input string (trim + strip control chars). */
function clean(?string $value): string
{
    $value = trim((string) $value);
    return preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $value);
}

/** Validate + sanitise an email address. Returns '' if invalid. */
function clean_email(?string $email): string
{
    $email = filter_var(trim((string) $email), FILTER_SANITIZE_EMAIL);
    return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : '';
}

/* ----------  URLs / redirects  ---------- */

/** Build an absolute URL to an app asset/page. */
function url(string $path = ''): string
{
    return APP_URL . '/' . ltrim($path, '/');
}

function redirect(string $path): void
{
    header('Location: ' . (preg_match('#^https?://#', $path) ? $path : url($path)));
    exit;
}

/* ----------  Settings (key/value store)  ---------- */

function get_setting(string $key, $default = '')
{
    static $cache = null;
    if ($cache === null) {
        $cache = [];
        try {
            foreach (db()->query('SELECT skey, svalue FROM settings') as $row) {
                $cache[$row['skey']] = $row['svalue'];
            }
        } catch (Throwable $e) {
            $cache = [];
        }
    }
    return array_key_exists($key, $cache) ? $cache[$key] : $default;
}

function set_setting(string $key, string $value): void
{
    $stmt = db()->prepare(
        'INSERT INTO settings (skey, svalue) VALUES (:k, :v)
         ON DUPLICATE KEY UPDATE svalue = :v2'
    );
    $stmt->execute([':k' => $key, ':v' => $value, ':v2' => $value]);
}

/* ----------  Convenience getters used across the site  ---------- */

function wa_number(): string
{
    return preg_replace('/\D/', '', get_setting('whatsapp_number', DEFAULT_WHATSAPP));
}

/** Build a WhatsApp order link with a pre-filled message. */
function wa_link(string $message = ''): string
{
    $msg = $message !== '' ? $message
         : 'Hello ' . COMPANY_NAME . ', I would like more information about your services.';
    return 'https://wa.me/' . wa_number() . '?text=' . rawurlencode($msg);
}

/* ----------  CSRF  ---------- */

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf" value="' . e(csrf_token()) . '">';
}

function csrf_check(): bool
{
    return isset($_POST['csrf'], $_SESSION['csrf'])
        && hash_equals($_SESSION['csrf'], $_POST['csrf']);
}

/* ----------  Visitor tracking  ---------- */

function track_visitor(string $page): void
{
    // Ignore admin pages, bots-lite, and repeat hits within the same session+page.
    $ip  = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $ua  = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255);
    $ref = substr($_SERVER['HTTP_REFERER'] ?? '', 0, 255);

    $device = 'Desktop';
    if (preg_match('/mobile|android|iphone|ipad|ipod/i', $ua)) {
        $device = preg_match('/ipad|tablet/i', $ua) ? 'Tablet' : 'Mobile';
    }

    try {
        $stmt = db()->prepare(
            'INSERT INTO visitors (ip, page, referrer, user_agent, device, visited_at)
             VALUES (:ip, :page, :ref, :ua, :dev, NOW())'
        );
        $stmt->execute([
            ':ip' => $ip, ':page' => substr($page, 0, 191),
            ':ref' => $ref, ':ua' => $ua, ':dev' => $device,
        ]);
    } catch (Throwable $e) {
        // Never break the page over analytics.
    }
}

/* ----------  Small fetch helpers  ---------- */

function fetch_all(string $sql, array $params = []): array
{
    $stmt = db()->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function fetch_one(string $sql, array $params = []): ?array
{
    $stmt = db()->prepare($sql);
    $stmt->execute($params);
    $row = $stmt->fetch();
    return $row ?: null;
}

function count_rows(string $table, string $where = '1', array $params = []): int
{
    $stmt = db()->prepare("SELECT COUNT(*) FROM `$table` WHERE $where");
    $stmt->execute($params);
    return (int) $stmt->fetchColumn();
}

/* ----------  Image upload handler (admin)  ---------- */

/**
 * Handle an uploaded image, return web-relative path (e.g. uploads/slides/abc.jpg)
 * or null on no-file / error. $subdir = slides|services|team|portfolio.
 */
function handle_upload(string $field, string $subdir, ?string &$error = null): ?string
{
    if (empty($_FILES[$field]) || ($_FILES[$field]['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return null;
    }
    $f = $_FILES[$field];
    if ($f['error'] !== UPLOAD_ERR_OK) {
        $error = 'Upload failed (code ' . $f['error'] . ').';
        return null;
    }
    if ($f['size'] > 8 * 1024 * 1024) {
        $error = 'Image too large (max 8 MB).';
        return null;
    }
    $allowed = ['jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png',
                'gif' => 'image/gif', 'webp' => 'image/webp', 'avif' => 'image/avif'];
    $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
    if (!isset($allowed[$ext])) {
        $error = 'Unsupported image type.';
        return null;
    }
    // Trust the file's real content, not its name — a renamed .php must never
    // be accepted just because someone called it "logo.png".
    $mime = '';
    if (function_exists('finfo_open') && ($fi = finfo_open(FILEINFO_MIME_TYPE))) {
        $mime = (string) finfo_file($fi, $f['tmp_name']);
        finfo_close($fi);
    }
    $imageMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/avif'];
    if ($mime !== '' && !in_array($mime, $imageMimes, true)) {
        $error = 'That file is not a real image.';
        return null;
    }
    // AVIF/WEBP are not understood by older getimagesize(); only enforce it
    // for the formats it definitely supports.
    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'], true) && @getimagesize($f['tmp_name']) === false) {
        $error = 'That file is not a valid image.';
        return null;
    }

    // Only ever allow a single, known-good extension in the saved name.
    $subdir  = preg_replace('/[^a-z0-9_-]/i', '', $subdir);
    $destDir = UPLOAD_PATH . '/' . $subdir;
    if (!is_dir($destDir)) {
        @mkdir($destDir, 0775, true);
    }
    $name = $subdir . '_' . date('YmdHis') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
    $dest = $destDir . '/' . $name;
    if (!move_uploaded_file($f['tmp_name'], $dest)) {
        $error = 'Could not save uploaded file.';
        return null;
    }
    return 'uploads/' . $subdir . '/' . $name;
}

/** Resolve a stored image path to a usable src, with fallback. */
function img_src(?string $path, string $fallback = 'images/logo.jpg'): string
{
    $path = trim((string) $path);
    if ($path === '') {
        return $fallback;
    }
    if (preg_match('#^https?://#', $path)) {
        return $path;
    }
    return $path;
}

function time_ago(string $datetime): string
{
    $diff = time() - strtotime($datetime);
    if ($diff < 60)      return 'just now';
    if ($diff < 3600)    return floor($diff / 60) . 'm ago';
    if ($diff < 86400)   return floor($diff / 3600) . 'h ago';
    if ($diff < 604800)  return floor($diff / 86400) . 'd ago';
    return date('d M Y', strtotime($datetime));
}
