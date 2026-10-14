<?php
require_once __DIR__ . '/includes/auth.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) { flash('err', 'Session expired.'); redirect('admin/settings.php'); }
    $action = $_POST['action'] ?? '';

    if ($action === 'save_settings') {
        $keys = ['company_name','site_url','tagline','whatsapp_number','contact_email','support_email','order_email',
                 'contact_phone','address_main','address_shop','social_facebook','social_linkedin','social_instagram',
                 'stat_projects','stat_clients','stat_years','hero_title','hero_desc',
                 'from_email','from_name','email_logo','smtp_host','smtp_port','smtp_user','smtp_secure'];
        foreach ($keys as $k) {
            if (isset($_POST[$k])) set_setting($k, clean($_POST[$k]));
        }
        // Password is special — only update if provided (don't blank it)
        if (!empty($_POST['smtp_pass'])) set_setting('smtp_pass', $_POST['smtp_pass']);
        // Logo uploads (header + white footer logo)
        $le = null;
        if ($lg = handle_upload('logo_file', 'branding', $le))       set_setting('logo', $lg);
        if ($lw = handle_upload('logo_white_file', 'branding', $le)) set_setting('logo_white', $lw);
        if ($le) { flash('err', $le); redirect('admin/settings.php'); }
        flash('ok', 'Settings saved.');
        redirect('admin/settings.php');
    }

    if ($action === 'change_password') {
        $me = admin_user();
        $cur = $_POST['current'] ?? '';
        $new = $_POST['new'] ?? '';
        $confirm = $_POST['confirm'] ?? '';
        $row = fetch_one('SELECT * FROM admins WHERE id=?', [$me['id']]);
        if (!$row || !password_verify($cur, $row['password'])) {
            flash('err', 'Current password is incorrect.');
        } elseif (strlen($new) < 6) {
            flash('err', 'New password must be at least 6 characters.');
        } elseif ($new !== $confirm) {
            flash('err', 'New passwords do not match.');
        } else {
            db()->prepare('UPDATE admins SET password=? WHERE id=?')->execute([password_hash($new, PASSWORD_DEFAULT), $me['id']]);
            flash('ok', 'Password updated.');
        }
        redirect('admin/settings.php');
    }

    if ($action === 'send_test') {
        $to = clean_email($_POST['test_email'] ?? '');
        if ($to === '') { flash('err', 'Enter a valid test email address.'); }
        else {
            $html = email_template('Test Email ✅', '<p>This is a test email from your AMATETA admin panel. If you received this, your SMTP settings are working! 🎉</p>', 'SMTP test');
            $err = null;
            if (send_mail($to, 'AMATETA SMTP Test', $html, $err)) flash('ok', "Test email sent to $to.");
            else flash('err', 'Test failed: ' . ($err ?: 'unknown error') . '. Check your SMTP settings.');
        }
        redirect('admin/settings.php');
    }
}

function s($k, $d = '') { return e(get_setting($k, $d)); }

$page = 'settings'; $title = 'Settings';
include __DIR__ . '/includes/head.php';
?>
<form method="post" enctype="multipart/form-data">
  <?= csrf_field() ?><input type="hidden" name="action" value="save_settings">

  <div class="panel">
    <div class="panel-head"><h2><i class="fas fa-image" style="color:var(--blue)"></i> Branding / Logos</h2></div>
    <div class="panel-body"><div class="form-grid">
      <div class="fg"><label>Header Logo (shown on light backgrounds)</label><input type="file" name="logo_file" accept="image/*">
        <div style="margin-top:10px;background:#0a2540;border-radius:10px;padding:10px;display:inline-block;"><img src="../<?= s('logo', 'images/OUR LOGO REVISED.png') ?>" style="height:46px;" onerror="this.style.opacity=.3"></div>
      </div>
      <div class="fg"><label>Footer / White Logo (shown on dark backgrounds)</label><input type="file" name="logo_white_file" accept="image/*">
        <div style="margin-top:10px;background:#0a2540;border-radius:10px;padding:10px;display:inline-block;"><img src="../<?= s('logo_white', 'images/OUR LOGO WHITE.png') ?>" style="height:46px;" onerror="this.style.opacity=.3"></div>
      </div>
    </div><p class="help">These logos appear in the shared header and footer across the whole website.</p></div>
  </div>

  <div class="panel">
    <div class="panel-head"><h2><i class="fas fa-building" style="color:var(--blue)"></i> Company Information</h2></div>
    <div class="panel-body"><div class="form-grid">
      <div class="fg"><label>Company Name</label><input type="text" name="company_name" value="<?= s('company_name') ?>"></div>
      <div class="fg"><label>Website URL</label><input type="text" name="site_url" value="<?= s('site_url') ?>"></div>
      <div class="fg full"><label>Tagline</label><input type="text" name="tagline" value="<?= s('tagline') ?>"></div>
      <div class="fg full"><label>Hero Title (HTML &lt;span&gt; allowed for colour)</label><input type="text" name="hero_title" value="<?= s('hero_title') ?>"></div>
      <div class="fg full"><label>Hero Description</label><textarea name="hero_desc"><?= s('hero_desc') ?></textarea></div>
    </div></div>
  </div>

  <div class="panel">
    <div class="panel-head"><h2><i class="fas fa-address-book" style="color:var(--blue)"></i> Contact & Social</h2></div>
    <div class="panel-body"><div class="form-grid">
      <div class="fg"><label>WhatsApp Number (digits only)</label><input type="text" name="whatsapp_number" value="<?= s('whatsapp_number') ?>" placeholder="264853441248"></div>
      <div class="fg"><label>Phone (display)</label><input type="text" name="contact_phone" value="<?= s('contact_phone') ?>"></div>
      <div class="fg"><label>Main Email</label><input type="email" name="contact_email" value="<?= s('contact_email') ?>"></div>
      <div class="fg"><label>Support Email</label><input type="email" name="support_email" value="<?= s('support_email') ?>"></div>
      <div class="fg"><label>Orders Email</label><input type="email" name="order_email" value="<?= s('order_email') ?>"></div>
      <div class="fg"><label>Facebook URL</label><input type="url" name="social_facebook" value="<?= s('social_facebook') ?>"></div>
      <div class="fg"><label>LinkedIn URL</label><input type="url" name="social_linkedin" value="<?= s('social_linkedin') ?>"></div>
      <div class="fg"><label>Instagram URL</label><input type="url" name="social_instagram" value="<?= s('social_instagram') ?>"></div>
      <div class="fg full"><label>Main Office Address</label><input type="text" name="address_main" value="<?= s('address_main') ?>"></div>
      <div class="fg full"><label>Second Address</label><input type="text" name="address_shop" value="<?= s('address_shop') ?>"></div>
    </div></div>
  </div>

  <div class="panel">
    <div class="panel-head"><h2><i class="fas fa-chart-simple" style="color:var(--blue)"></i> Homepage Stats</h2></div>
    <div class="panel-body"><div class="form-grid">
      <div class="fg"><label>Projects Done</label><input type="number" name="stat_projects" value="<?= s('stat_projects') ?>"></div>
      <div class="fg"><label>Happy Clients</label><input type="number" name="stat_clients" value="<?= s('stat_clients') ?>"></div>
      <div class="fg"><label>Years Experience</label><input type="number" name="stat_years" value="<?= s('stat_years') ?>"></div>
    </div></div>
  </div>

  <div class="panel">
    <div class="panel-head"><h2><i class="fas fa-envelope" style="color:var(--blue)"></i> Email / SMTP (for newsletters & contact emails)</h2></div>
    <div class="panel-body">
      <div class="alert alert-ok" style="background:#eef6ff;color:#0a4d8c;border-color:#bcd9f5;"><i class="fas fa-circle-info"></i> To send real emails (e.g. Gmail): Host <code>smtp.gmail.com</code>, Port <code>587</code>, Security <code>tls</code>, and an App Password as the SMTP password.</div>
      <div class="alert alert-err" style="background:#fff6ed;color:#8a4b00;border-color:#f5d9bc;"><i class="fas fa-triangle-exclamation"></i> <strong>From Email must be <code>order@amateta.com</code></strong> — the same mailbox as the SMTP username. If it is a different address, Gmail and Outlook reject the confirmation emails we send to clients, and only our own inbox receives them.</div>
      <div class="form-grid">
        <div class="fg"><label>From Name</label><input type="text" name="from_name" value="<?= s('from_name') ?>"></div>
        <div class="fg"><label>From Email</label><input type="email" name="from_email" value="<?= s('from_email') ?>"></div>
        <div class="fg full"><label>Email Logo URL</label><input type="url" name="email_logo" value="<?= s('email_logo') ?>"></div>
        <div class="fg"><label>SMTP Host</label><input type="text" name="smtp_host" value="<?= s('smtp_host') ?>" placeholder="smtp.gmail.com"></div>
        <div class="fg"><label>SMTP Port</label><input type="number" name="smtp_port" value="<?= s('smtp_port', '587') ?>"></div>
        <div class="fg"><label>SMTP Username</label><input type="text" name="smtp_user" value="<?= s('smtp_user') ?>"></div>
        <div class="fg"><label>SMTP Password</label><input type="password" name="smtp_pass" placeholder="<?= get_setting('smtp_pass') ? '•••••• (unchanged)' : 'Enter app password' ?>"></div>
        <div class="fg"><label>Security</label><select name="smtp_secure">
          <?php foreach (['tls' => 'TLS (587)', 'ssl' => 'SSL (465)', 'none' => 'None'] as $v => $lbl): ?>
            <option value="<?= $v ?>" <?= get_setting('smtp_secure', 'tls') === $v ? 'selected' : '' ?>><?= $lbl ?></option>
          <?php endforeach; ?>
        </select></div>
      </div>
    </div>
  </div>

  <div style="margin-bottom:24px;"><button class="btn btn-primary btn-lg"><i class="fas fa-floppy-disk"></i> Save All Settings</button></div>
</form>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;" class="set-2col">
  <div class="panel">
    <div class="panel-head"><h2><i class="fas fa-paper-plane" style="color:var(--blue)"></i> Send Test Email</h2></div>
    <div class="panel-body">
      <form method="post" style="display:flex;gap:10px;flex-wrap:wrap;align-items:flex-end;">
        <?= csrf_field() ?><input type="hidden" name="action" value="send_test">
        <div class="fg" style="flex:1;margin:0;min-width:200px;"><label>Test recipient</label><input type="email" name="test_email" value="<?= s('contact_email') ?>" required></div>
        <button class="btn btn-orange"><i class="fas fa-paper-plane"></i> Send Test</button>
      </form>
    </div>
  </div>
  <div class="panel">
    <div class="panel-head"><h2><i class="fas fa-key" style="color:var(--blue)"></i> Change Admin Password</h2></div>
    <div class="panel-body">
      <form method="post">
        <?= csrf_field() ?><input type="hidden" name="action" value="change_password">
        <div class="fg"><label>Current Password</label><input type="password" name="current" required></div>
        <div class="fg"><label>New Password</label><input type="password" name="new" required></div>
        <div class="fg"><label>Confirm New Password</label><input type="password" name="confirm" required></div>
        <button class="btn btn-dark"><i class="fas fa-key"></i> Update Password</button>
      </form>
    </div>
  </div>
</div>
<style>@media(max-width:980px){.set-2col{grid-template-columns:1fr!important}}</style>
<?php include __DIR__ . '/includes/foot.php'; ?>
