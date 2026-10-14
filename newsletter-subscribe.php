<?php
/** Newsletter subscription handler (AJAX, returns JSON). */
require_once __DIR__ . '/config/config.php';
header('Content-Type: application/json; charset=utf-8');

function out(bool $ok, string $msg): void
{
    echo json_encode(['success' => $ok, 'message' => $msg]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    out(false, 'Invalid request.');
}

// Honeypot (bots fill hidden field) — answer as if it worked
if (!empty($_POST['website'])) {
    out(true, 'Thank you for subscribing!');
}

$email = clean_email($_POST['email'] ?? '');
$name  = clean($_POST['name'] ?? '');

if ($email === '') {
    out(false, 'Please enter a valid email address.');
}

if (is_spam($name, $name, $_POST['email'] ?? '')) {
    out(true, 'Thank you for subscribing!');
}

// Abuse protection: a handful of sign-ups per visitor, then a cool-down.
if (!rate_limit('newsletter', 3, 900)) {
    out(false, 'Too many sign-up attempts. Please try again in a few minutes.');
}

try {
    $existing = fetch_one('SELECT id, status FROM subscribers WHERE email = ?', [$email]);
    if ($existing) {
        if ($existing['status'] === 'unsubscribed') {
            db()->prepare('UPDATE subscribers SET status = "active" WHERE id = ?')->execute([$existing['id']]);
            out(true, 'Welcome back! Your subscription has been reactivated.');
        }
        out(false, 'You are already subscribed — thank you!');
    }

    $token = bin2hex(random_bytes(16));
    db()->prepare('INSERT INTO subscribers (email, name, ip, token) VALUES (?,?,?,?)')
        ->execute([$email, $name, client_ip(), $token]);

    // Send branded welcome email (non-blocking on failure)
    $company = get_setting('company_name', COMPANY_NAME);
    $body = '<p>Hi' . ($name ? ' ' . e($name) : '') . ',</p>
             <p>Thank you for subscribing to the <strong>' . e($company) . '</strong> newsletter! 🎉</p>
             <p>You will now be the first to hear about our latest <strong>web development, hosting,
             digital marketing, printing and technology</strong> offers, tips and project launches.</p>
             <p>Need something built or printed? Tap below and chat with us directly on WhatsApp.</p>
             <p style="text-align:center;margin:26px 0;">
               <a href="' . e(wa_link('Hello, I just subscribed to your newsletter')) . '"
                  style="background:linear-gradient(135deg,#25d366,#128c7e);color:#fff;text-decoration:none;
                  padding:13px 28px;border-radius:50px;font-weight:700;display:inline-block;">💬 Chat on WhatsApp</a>
             </p>';
    $html = email_template('Welcome to the family! 🚀', $body, 'Thanks for subscribing to ' . $company);
    $err = null;
    $welcomeSent = send_mail($email, 'Welcome to ' . $company . ' Newsletter', $html, $err, [
        'reply_to'   => mail_inbox(),
        'reply_name' => $company,
    ]);

    out(true, $welcomeSent
        ? 'Subscribed! Check your inbox for a welcome email. 🎉'
        : 'You are subscribed. Email confirmation is temporarily unavailable, but your subscription is saved.');
} catch (Throwable $e) {
    out(false, 'Could not subscribe right now. Please try again later.');
}
