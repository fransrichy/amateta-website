<?php
/**
 * Email helpers — a beautiful branded HTML template + a dependency-free
 * SMTP sender (so real mail can be delivered from XAMPP) with a mail()
 * fallback. Configure SMTP under Admin → Settings.
 */

/**
 * Wrap content in the AMATETA branded email shell.
 */
function email_template(string $heading, string $bodyHtml, string $preheader = ''): string
{
    $logo    = e(get_setting('email_logo', 'https://www.amateta.com/images/OUR%20LOGO%20WHITE.png'));
    $company = e(get_setting('company_name', COMPANY_NAME));
    $tagline = e(get_setting('tagline', 'Premium Technology & Graphics Solutions in Namibia'));
    $site    = e(get_setting('site_url', 'https://www.amateta.com'));
    $siteDisplay = e(preg_replace('#^https?://#', '', rtrim(get_setting('site_url', 'https://www.amateta.com'), '/')));
    $phone   = e(get_setting('contact_phone', '+264 85 344 1248'));
    $phoneTel = e(preg_replace('/\s+/', '', get_setting('contact_phone', '+264853441248')));
    $email   = e(get_setting('contact_email', DEFAULT_EMAIL));
    $addr    = e(get_setting('address_main', 'Eluwa Building, Shop No.2, Independence Avenue, Windhoek, Namibia'));
    $year    = date('Y');
    $heading = e($heading);
    $preheader = e($preheader);

    // Only render a social icon when the admin has actually set a real URL.
    $socials = '';
    foreach ([
        ['social_facebook', 'Facebook'],
        ['social_linkedin', 'LinkedIn'],
        ['social_instagram', 'Instagram'],
    ] as [$key, $label]) {
        $url = get_setting($key, '');
        if ($url !== '' && $url !== '#') {
            $socials .= '<a href="' . e($url) . '" style="display:inline-block;margin:0 8px;color:#9fc5e8;text-decoration:none;font-size:13px;font-weight:600;">' . $label . '</a>';
        }
    }
    if ($socials !== '') {
        $socials = '<p style="margin:0 0 14px;">' . $socials . '</p>';
    }

    return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
<title>{$heading}</title>
</head>
<body style="margin:0;padding:0;background:#eef3f8;font-family:'Segoe UI',Arial,sans-serif;color:#0a2540;">
<span style="display:none;visibility:hidden;opacity:0;color:transparent;height:0;width:0;overflow:hidden;">{$preheader}</span>
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#eef3f8;padding:32px 12px;">
  <tr><td align="center">
    <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#ffffff;border-radius:20px;overflow:hidden;box-shadow:0 12px 44px rgba(10,37,64,0.14);">
      <!-- Header -->
      <tr>
        <td style="background:linear-gradient(135deg,#03045e 0%,#0a2540 55%,#0077b6 100%);padding:38px 30px 32px;text-align:center;">
          <img src="{$logo}" alt="{$company}" width="170" style="max-width:200px;height:auto;display:inline-block;">
          <p style="margin:14px 0 0;font-size:12px;letter-spacing:.4px;color:rgba(255,255,255,.72);font-weight:600;">{$tagline}</p>
          <div style="height:4px;width:64px;margin:18px auto 0;background:linear-gradient(90deg,#f77f00,#00b4d8);border-radius:4px;"></div>
        </td>
      </tr>
      <!-- Heading band -->
      <tr>
        <td style="padding:32px 36px 6px;">
          <h1 style="margin:0;font-size:22px;font-weight:800;color:#0a2540;">{$heading}</h1>
        </td>
      </tr>
      <!-- Body -->
      <tr>
        <td style="padding:10px 36px 30px;font-size:15px;line-height:1.7;color:#3a5472;">
          {$bodyHtml}
        </td>
      </tr>
      <!-- Sign-off card -->
      <tr>
        <td style="padding:0 36px 30px;">
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f4f8fc;border:1px solid #e1ebf5;border-radius:14px;">
            <tr><td style="padding:20px 22px;">
              <p style="margin:0 0 8px;font-size:14px;color:#0a2540;font-weight:700;">With love from the {$company} family ❤️</p>
              <p style="margin:0;font-size:13px;color:#5a7a99;line-height:1.9;">
                📞 <a href="tel:{$phoneTel}" style="color:#0077b6;text-decoration:none;font-weight:600;">{$phone}</a><br>
                ✉️ <a href="mailto:{$email}" style="color:#0077b6;text-decoration:none;font-weight:600;">{$email}</a><br>
                📍 {$addr}
              </p>
            </td></tr>
          </table>
        </td>
      </tr>
      <!-- Footer -->
      <tr>
        <td style="background:#0a2540;padding:28px 30px 24px;text-align:center;">
          {$socials}
          <p style="margin:0;font-size:12px;color:rgba(255,255,255,0.55);line-height:1.8;">
            © {$year} {$company}. All rights reserved.<br>
            <a href="{$site}" style="color:#00b4d8;text-decoration:none;font-weight:600;">{$siteDisplay}</a>
          </p>
        </td>
      </tr>
    </table>
    <p style="margin:18px 0 0;font-size:11px;color:#9bb1c6;">You are receiving this email from {$company}, Windhoek, Namibia — never share your password or payment details by email.</p>
  </td></tr>
</table>
</body>
</html>
HTML;
}

/**
 * The address every automated email is sent FROM.
 *
 * It must always be a real mailbox on our own domain (order@amateta.com),
 * otherwise mail servers such as Gmail reject or spam-bin the message —
 * which is exactly why visitors never used to receive their confirmation
 * while our own inbox (a local delivery) still got the notification.
 */
function mail_from_email(): string
{
    $from = clean_email(get_setting('from_email', ''));
    if ($from === '') {
        $from = clean_email(get_setting('order_email', ORDER_EMAIL));
    }
    return $from ?: ORDER_EMAIL;
}

/** Where enquiries/orders are delivered to us. */
function mail_inbox(): string
{
    return clean_email(get_setting('order_email', ORDER_EMAIL)) ?: ORDER_EMAIL;
}

/**
 * Append a line to the private mail log so failed deliveries are never silent.
 */
function mail_log(string $line): void
{
    $dir = APP_ROOT . '/storage';
    if (!is_dir($dir)) {
        @mkdir($dir, 0775, true);
    }
    @file_put_contents($dir . '/mail.log', date('Y-m-d H:i:s') . ' ' . $line . "\n", FILE_APPEND | LOCK_EX);
}

/**
 * Send an HTML email. Uses SMTP when configured, otherwise PHP mail().
 *
 * $opts accepts: reply_to, reply_name, from_email, from_name.
 * Returns true on success; $error carries the reason on failure.
 */
function send_mail(string $to, string $subject, string $htmlBody, ?string &$error = null, array $opts = []): bool
{
    $to = clean_email($to);
    if ($to === '') {
        $error = 'No valid recipient address.';
        mail_log("FAIL (no recipient) subject=$subject");
        return false;
    }

    $fromEmail = clean_email($opts['from_email'] ?? '') ?: mail_from_email();
    $fromName  = clean($opts['from_name'] ?? get_setting('from_name', get_setting('company_name', COMPANY_NAME)));
    $replyTo   = clean_email($opts['reply_to'] ?? '') ?: $fromEmail;
    $replyName = clean($opts['reply_name'] ?? $fromName);
    $subject   = str_replace(["\r", "\n"], ' ', clean($subject));
    $smtpHost  = trim(get_setting('smtp_host', ''));

    if ($smtpHost !== '') {
        $ok = smtp_send($to, $subject, $htmlBody, $fromEmail, $fromName, $error, $replyTo, $replyName);
    } else {
        // Fallback: PHP mail(). The envelope sender (-f) must match the From
        // domain or shared hosts silently drop mail to external recipients.
        $headers  = 'From: ' . encode_header($fromName) . ' <' . $fromEmail . '>' . "\r\n";
        $headers .= 'Reply-To: ' . encode_header($replyName) . ' <' . $replyTo . '>' . "\r\n";
        $headers .= 'Return-Path: <' . $fromEmail . '>' . "\r\n";
        $headers .= 'Message-ID: <' . bin2hex(random_bytes(12)) . '@' . mail_domain($fromEmail) . '>' . "\r\n";
        $headers .= 'Date: ' . date('r') . "\r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'X-Mailer: AMATETA-Site';

        $ok = @mail($to, encode_header($subject), $htmlBody, $headers, '-f' . $fromEmail);
        if (!$ok) {
            $error = 'mail() was refused by the server — set up SMTP under Admin → Settings.';
        }
    }

    mail_log(($ok ? 'OK  ' : 'FAIL') . " to=$to from=$fromEmail subject=\"$subject\"" . ($ok ? '' : ' error=' . $error));
    return $ok;
}

/** Domain part of an email address (used for Message-ID). */
function mail_domain(string $email): string
{
    $at = strrchr($email, '@');
    return $at ? substr($at, 1) : 'amateta.com';
}

function encode_header(string $text): string
{
    return '=?UTF-8?B?' . base64_encode($text) . '?=';
}

/**
 * Minimal SMTP client supporting SSL (port 465) / STARTTLS (587) + AUTH LOGIN.
 */
function smtp_send(string $to, string $subject, string $htmlBody, string $fromEmail, string $fromName, ?string &$error = null, string $replyTo = '', string $replyName = ''): bool
{
    $host   = trim(get_setting('smtp_host', ''));
    $port   = (int) get_setting('smtp_port', '587');
    $user   = trim(get_setting('smtp_user', ''));
    $pass   = get_setting('smtp_pass', '');
    $secure = strtolower(get_setting('smtp_secure', 'tls')); // tls | ssl | none

    $transport = ($secure === 'ssl') ? 'ssl://' . $host : $host;
    // Verify the SMTP server certificate so credentials and messages cannot be intercepted.
    $ctx = stream_context_create(['ssl' => [
        'verify_peer' => true,
        'verify_peer_name' => true,
        'allow_self_signed' => false,
        'peer_name' => $host,
        'SNI_enabled' => true,
    ]]);
    $conn = @stream_socket_client($transport . ':' . $port, $errno, $errstr, 20, STREAM_CLIENT_CONNECT, $ctx);
    if (!$conn) {
        $error = "SMTP connect failed: $errstr ($errno)";
        return false;
    }
    stream_set_timeout($conn, 20);

    $read = function () use ($conn) {
        $data = '';
        while ($line = fgets($conn, 515)) {
            $data .= $line;
            if (isset($line[3]) && $line[3] === ' ') break;
        }
        return $data;
    };
    $cmd = function ($c) use ($conn, $read) { fwrite($conn, $c . "\r\n"); return $read(); };

    $expect = function ($resp, $code) use (&$error, $conn) {
        if (strpos($resp, (string) $code) !== 0) {
            $error = 'SMTP error: ' . trim($resp);
            fclose($conn);
            return false;
        }
        return true;
    };

    if (!$expect($read(), 220)) return false;
    $ehlo = 'amateta-mailer';
    if (!$expect($cmd('EHLO ' . $ehlo), 250)) return false;

    if ($secure === 'tls') {
        if (!$expect($cmd('STARTTLS'), 220)) return false;
        if (!stream_socket_enable_crypto($conn, true, STREAM_CRYPTO_METHOD_TLS_CLIENT | STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT)) {
            $error = 'STARTTLS negotiation failed.';
            fclose($conn);
            return false;
        }
        if (!$expect($cmd('EHLO ' . $ehlo), 250)) return false;
    }

    if ($user !== '') {
        if (!$expect($cmd('AUTH LOGIN'), 334)) return false;
        if (!$expect($cmd(base64_encode($user)), 334)) return false;
        if (!$expect($cmd(base64_encode($pass)), 235)) return false;
    }

    if (!$expect($cmd('MAIL FROM:<' . $fromEmail . '>'), 250)) return false;
    if (!$expect($cmd('RCPT TO:<' . $to . '>'), 250)) return false;
    if (!$expect($cmd('DATA'), 354)) return false;

    $headers  = 'From: ' . encode_header($fromName) . ' <' . $fromEmail . '>' . "\r\n";
    $headers .= 'To: <' . $to . '>' . "\r\n";
    if ($replyTo !== '') {
        $headers .= 'Reply-To: ' . encode_header($replyName ?: $fromName) . ' <' . $replyTo . '>' . "\r\n";
    }
    $headers .= 'Subject: ' . encode_header($subject) . "\r\n";
    $headers .= 'Date: ' . date('r') . "\r\n";
    $headers .= 'Message-ID: <' . bin2hex(random_bytes(12)) . '@' . mail_domain($fromEmail) . '>' . "\r\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
    $headers .= 'Content-Transfer-Encoding: base64' . "\r\n";

    $body = chunk_split(base64_encode($htmlBody));
    // dot-stuffing handled by base64 (no leading dots)
    $resp = $cmd($headers . "\r\n" . $body . "\r\n.");
    if (!$expect($resp, 250)) return false;

    $cmd('QUIT');
    fclose($conn);
    return true;
}
