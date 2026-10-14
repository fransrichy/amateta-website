<?php
/** Admin authentication + session guard. */
require_once dirname(__DIR__, 2) . '/config/config.php';

function admin_user(): ?array
{
    return $_SESSION['admin'] ?? null;
}

/** Sign an idle admin out after this many seconds of inactivity. */
const ADMIN_IDLE_TIMEOUT = 7200; // 2 hours

function require_admin(): void
{
    if (empty($_SESSION['admin'])) {
        redirect('admin/login.php');
    }
    $last = $_SESSION['admin']['last'] ?? time();
    if (time() - $last > ADMIN_IDLE_TIMEOUT) {
        admin_logout();
        flash('err', 'You were signed out after a period of inactivity. Please sign in again.');
        redirect('admin/login.php');
    }
    $_SESSION['admin']['last'] = time();
}

/* ----------  Brute-force protection  ---------- */

const LOGIN_MAX_TRIES   = 5;
const LOGIN_LOCK_MINUTES = 15;

/** Created on demand so no separate migration/installer run is needed. */
function login_attempts_table(): void
{
    static $done = false;
    if ($done) return;
    $done = true;
    try {
        db()->exec("CREATE TABLE IF NOT EXISTS login_attempts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            ip VARCHAR(45) NOT NULL,
            email VARCHAR(160) DEFAULT '',
            attempted_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            INDEX idx_ip (ip),
            INDEX idx_time (attempted_at)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    } catch (Throwable $e) {
        // Throttling is best-effort; never block the login page over it.
    }
}

/** Seconds this IP must still wait, or 0 when it may try again. */
function login_lock_seconds(string $ip): int
{
    login_attempts_table();
    try {
        $row = fetch_one(
            'SELECT COUNT(*) c, MAX(attempted_at) last FROM login_attempts
             WHERE ip = ? AND attempted_at > DATE_SUB(NOW(), INTERVAL ? MINUTE)',
            [$ip, LOGIN_LOCK_MINUTES]
        );
        if ($row && (int) $row['c'] >= LOGIN_MAX_TRIES) {
            $elapsed = time() - strtotime($row['last']);
            return max(0, LOGIN_LOCK_MINUTES * 60 - $elapsed);
        }
    } catch (Throwable $e) {
    }
    return 0;
}

function attempt_login(string $email, string $password, ?string &$error = null): bool
{
    $ip = client_ip();
    if (($wait = login_lock_seconds($ip)) > 0) {
        $error = 'Too many failed sign-in attempts. Please try again in ' . ceil($wait / 60) . ' minute(s).';
        return false;
    }

    $email = clean_email($email);
    if ($email === '' || $password === '') {
        $error = 'Please enter your email and password.';
        return false;
    }

    $admin = fetch_one('SELECT * FROM admins WHERE email = ?', [$email]);
    if (!$admin || !password_verify($password, $admin['password'])) {
        login_attempts_table();
        try {
            db()->prepare('INSERT INTO login_attempts (ip, email) VALUES (?,?)')->execute([$ip, $email]);
            // Housekeeping: drop rows older than a day.
            db()->exec('DELETE FROM login_attempts WHERE attempted_at < DATE_SUB(NOW(), INTERVAL 1 DAY)');
        } catch (Throwable $e) {
        }
        $error = 'Invalid email or password.'; // deliberately vague
        return false;
    }

    try {
        db()->prepare('DELETE FROM login_attempts WHERE ip = ?')->execute([$ip]);
    } catch (Throwable $e) {
    }

    session_regenerate_id(true);
    $_SESSION['admin'] = [
        'id' => $admin['id'], 'name' => $admin['name'], 'email' => $admin['email'],
        'ip' => $ip, 'last' => time(),
    ];
    return true;
}

function admin_logout(): void
{
    unset($_SESSION['admin']);
    session_regenerate_id(true);
}

/** Flash messages between redirects. */
function flash(string $type, string $msg): void
{
    $_SESSION['flash'] = ['type' => $type, 'msg' => $msg];
}
function get_flash(): ?array
{
    $f = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $f;
}
