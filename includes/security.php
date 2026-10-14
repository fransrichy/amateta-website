<?php
/**
 * Anti-spam & abuse protection for the public forms.
 *
 * Everything here is self-hosted — no Google reCAPTCHA, no chat-bot widget and
 * no third-party script. Visitors are never tracked by an outside service.
 */

/** Real client IP (works behind Cloudflare / a reverse proxy). */
function client_ip(): string
{
    foreach (['HTTP_CF_CONNECTING_IP', 'HTTP_X_REAL_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'] as $k) {
        $v = $_SERVER[$k] ?? '';
        if ($v === '') continue;
        $ip = trim(explode(',', $v)[0]);
        if (filter_var($ip, FILTER_VALIDATE_IP)) return $ip;
    }
    return '0.0.0.0';
}

/**
 * Allow at most $max actions per $window seconds for this visitor.
 * Returns true when the action is allowed.
 */
function rate_limit(string $bucket, int $max = 3, int $window = 300): bool
{
    $key  = 'rl_' . $bucket;
    $now  = time();
    $hits = array_values(array_filter($_SESSION[$key] ?? [], fn($t) => $t > $now - $window));

    if (count($hits) >= $max) {
        $_SESSION[$key] = $hits;
        return false;
    }
    $hits[] = $now;
    $_SESSION[$key] = $hits;
    return true;
}

/** Seconds a visitor must still wait before retrying a rate-limited action. */
function rate_limit_wait(string $bucket, int $window = 300): int
{
    $hits = $_SESSION['rl_' . $bucket] ?? [];
    return $hits ? max(0, ($window - (time() - min($hits)))) : 0;
}

/**
 * Heuristic spam check for free-text form submissions.
 * Catches the usual bot payloads: link farms, BBCode, header injection.
 */
function is_spam(string $text, string $name = '', string $email = ''): bool
{
    $blob = strtolower($name . ' ' . $email . ' ' . $text);

    // Header-injection attempts in the name/email fields.
    if (preg_match('/[\r\n]|%0a|%0d|bcc:|cc:|content-type:/i', $name . ' ' . $email)) {
        return true;
    }
    // Bots love stuffing links; a genuine enquiry rarely has more than two.
    if (preg_match_all('#https?://|www\.#i', $blob) > 3) {
        return true;
    }
    // Forum-spam markup has no place in a contact form.
    if (preg_match('/\[url=|\[\/url\]|<a\s+href=/i', $text)) {
        return true;
    }
    // Classic spam vocabulary.
    $words = ['viagra', 'cialis', 'casino', 'porn', 'crypto investment', 'forex signals',
              'seo backlinks', 'buy followers', 'bitcoin doubler', 'loan offer', 'xanax'];
    foreach ($words as $w) {
        if (strpos($blob, $w) !== false) return true;
    }
    // A "message" with no spaces at all is machine-generated.
    return mb_strlen(trim($text)) > 40 && strpos(trim($text), ' ') === false;
}

/**
 * Time-trap: forms render a timestamp; humans need a couple of seconds to type.
 */
function form_timer_field(string $form): string
{
    $_SESSION['ft_' . $form] = time();
    return '<input type="hidden" name="ft" value="' . e($form) . '">';
}

function form_timer_ok(string $form, int $minSeconds = 3): bool
{
    $start = $_SESSION['ft_' . $form] ?? 0;
    return $start > 0 && (time() - $start) >= $minSeconds;
}
