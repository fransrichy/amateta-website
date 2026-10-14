<?php
/** One-click newsletter unsubscribe (linked from every newsletter). */
require_once __DIR__ . '/config/config.php';

$token = clean($_GET['token'] ?? '');
$done  = false;
$sub   = null;

if ($token !== '') {
    $sub = fetch_one('SELECT id, email, status FROM subscribers WHERE token = ?', [$token]);
    if ($sub) {
        if ($sub['status'] !== 'unsubscribed') {
            db()->prepare('UPDATE subscribers SET status = "unsubscribed" WHERE id = ?')->execute([$sub['id']]);
        }
        $done = true;
    }
}

page_head('Unsubscribe · ' . get_setting('company_name', COMPANY_NAME), 'Unsubscribe from the AMATETA Techs & Designs newsletter.');
?>
<section class="page-hero">
  <div class="container">
    <h1>Newsletter <span>Preferences</span></h1>
    <p>Manage the emails you receive from us.</p>
  </div>
</section>

<section class="section-pad" style="background:var(--offwhite);">
  <div class="container" style="max-width:640px;">
    <div class="form-card">
      <?php if ($done): ?>
        <div class="alert alert-success"><i class="fas fa-circle-check"></i>
          <strong><?= e($sub['email']) ?></strong> has been unsubscribed. You will not receive any further newsletters from us.
        </div>
        <p style="color:var(--text-muted);font-size:0.9rem;">Changed your mind? You can subscribe again any time from our homepage.</p>
      <?php else: ?>
        <div class="alert alert-error"><i class="fas fa-circle-exclamation"></i>
          This unsubscribe link is not valid or has already been used.
        </div>
        <p style="color:var(--text-muted);font-size:0.9rem;">If you keep receiving our emails, contact us at
          <a href="mailto:<?= e(get_setting('order_email', ORDER_EMAIL)) ?>"><?= e(get_setting('order_email', ORDER_EMAIL)) ?></a>
          and we will remove you manually.</p>
      <?php endif; ?>
      <a href="index.php" class="btn btn-primary" style="margin-top:14px;"><i class="fas fa-house"></i> Back to Home</a>
    </div>
  </div>
</section>
<?php page_foot(); ?>
