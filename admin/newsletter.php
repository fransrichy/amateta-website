<?php
require_once __DIR__ . '/includes/auth.php';
require_admin();

$result = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'send') {
    if (!csrf_check()) { flash('err', 'Session expired.'); redirect('admin/newsletter.php'); }
    if (trim(get_setting('smtp_host', '')) === '' || clean_email(get_setting('smtp_user', '')) === '' || get_setting('smtp_pass', '') === '') {
        flash('err', 'Newsletter sending is disabled until complete SMTP credentials are saved and tested.');
        redirect('admin/newsletter.php');
    }

    $subject = clean($_POST['subject'] ?? '');
    $heading = clean($_POST['heading'] ?? '') ?: $subject;
    $bodyRaw = trim($_POST['body'] ?? '');

    if ($subject === '' || $bodyRaw === '') {
        flash('err', 'Please enter a subject and message.');
        redirect('admin/newsletter.php');
    }

    // Escape stored campaign text before formatting it as HTML.
    $bodyHtml = '';
    foreach (preg_split('/\n\s*\n/', $bodyRaw) as $para) {
        $bodyHtml .= '<p>' . nl2br(e($para)) . '</p>';
    }
    $bodyHtml .= '<p style="text-align:center;margin:26px 0;">
        <a href="' . e(wa_link('Hello, I saw your newsletter')) . '" style="background:linear-gradient(135deg,#25d366,#128c7e);color:#fff;text-decoration:none;padding:13px 28px;border-radius:50px;font-weight:700;display:inline-block;">💬 Chat on WhatsApp</a></p>';

    $subscribers = fetch_all("SELECT email, token FROM subscribers WHERE status='active'");
    $company = get_setting('company_name', COMPANY_NAME);
    $sent = 0; $failed = 0;
    foreach ($subscribers as $sub) {
        // Every newsletter carries a working one-click unsubscribe link —
        // required by anti-spam law and what keeps us out of spam folders.
        $unsub = url('unsubscribe.php?token=' . urlencode($sub['token']));
        $personal = $bodyHtml . '<p style="text-align:center;font-size:12px;color:#9bb1c6;margin-top:26px;">'
            . 'You receive this because you subscribed on our website. '
            . '<a href="' . e($unsub) . '" style="color:#0077b6;">Unsubscribe</a></p>';
        $html = email_template($heading, $personal, $subject);
        $ok = send_mail($sub['email'], $subject, $html, $err, [
            'reply_to'   => mail_inbox(),
            'reply_name' => $company,
        ]);
        if ($ok) { $sent++; } else { $failed++; }
    }

    db()->prepare('INSERT INTO newsletters (subject, body, sent_count, fail_count) VALUES (?,?,?,?)')
        ->execute([$subject, $bodyHtml, $sent, $failed]);

    flash($failed === 0 ? 'ok' : 'err', "Newsletter sent to $sent subscriber(s)" . ($failed ? ", $failed failed (check SMTP settings)." : '.'));
    redirect('admin/newsletter.php');
}

$activeCount = count_rows('subscribers', "status='active'");
$smtpOn = trim(get_setting('smtp_host', '')) !== ''
    && clean_email(get_setting('smtp_user', '')) !== ''
    && get_setting('smtp_pass', '') !== '';
$history = fetch_all('SELECT * FROM newsletters ORDER BY id DESC LIMIT 10');

$page = 'newsletter'; $title = 'Send Newsletter';
include __DIR__ . '/includes/head.php';
?>
<?php if (!$smtpOn): ?>
  <div class="alert alert-err"><i class="fas fa-triangle-exclamation"></i> SMTP is not configured yet, so emails may not be delivered. Add your SMTP details under <a href="settings.php" style="color:var(--err);text-decoration:underline;">Settings → Email / SMTP</a> to send real emails.</div>
<?php endif; ?>

<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-paper-plane" style="color:var(--blue)"></i> Compose Newsletter</h2><span class="badge badge-on"><?= $activeCount ?> active subscriber<?= $activeCount === 1 ? '' : 's' ?></span></div>
  <div class="panel-body">
    <form method="post" data-confirm="Send this newsletter to all <?= $activeCount ?> active subscribers now?">
      <?= csrf_field() ?><input type="hidden" name="action" value="send">
      <div class="fg"><label>Email Subject</label><input type="text" name="subject" placeholder="e.g. 20% off Website Development this month!" required></div>
      <div class="fg"><label>Heading (shown big at the top of the email)</label><input type="text" name="heading" placeholder="Leave empty to use the subject"></div>
      <div class="fg"><label>Message</label><textarea name="body" style="min-height:200px;" placeholder="Write your message here…&#10;&#10;Leave a blank line between paragraphs." required></textarea><p class="help">Your text is safely formatted in the branded template. A WhatsApp button and one-click unsubscribe link are added automatically.</p></div>
      <button class="btn btn-orange btn-lg" <?= (!$smtpOn || $activeCount === 0) ? 'disabled title="Configure SMTP and add an active subscriber first"' : '' ?>><i class="fas fa-paper-plane"></i> Send to <?= $activeCount ?> Subscriber<?= $activeCount === 1 ? '' : 's' ?></button>
    </form>
  </div>
</div>

<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-clock-rotate-left" style="color:var(--blue)"></i> Recent Sends</h2></div>
  <div class="panel-body" style="padding:0;">
    <table>
      <thead><tr><th>Subject</th><th>Sent</th><th>Failed</th><th>Date</th></tr></thead>
      <tbody>
      <?php if (!$history): ?><tr><td colspan="4" class="muted" style="text-align:center;padding:24px;">No newsletters sent yet.</td></tr><?php endif; ?>
      <?php foreach ($history as $h): ?>
        <tr><td><strong><?= e($h['subject']) ?></strong></td><td><span class="badge badge-on"><?= (int) $h['sent_count'] ?></span></td><td><?= $h['fail_count'] ? '<span class="badge badge-off">' . (int) $h['fail_count'] . '</span>' : '—' ?></td><td class="muted"><?= e(date('d M Y H:i', strtotime($h['sent_at']))) ?></td></tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/includes/foot.php'; ?>
