<?php
require_once __DIR__ . '/includes/auth.php';

if (admin_user()) {
    redirect('admin/index.php');
}

$flash = get_flash();
$error = $flash && $flash['type'] === 'err' ? $flash['msg'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $error = 'Session expired. Please try again.';
    } elseif (attempt_login($_POST['email'] ?? '', $_POST['password'] ?? '', $error)) {
        redirect('admin/index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Admin Login · AMATETA</title>
<meta name="robots" content="noindex, nofollow">
<link rel="icon" href="../images/fav.png">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="assets/admin.css">
</head>
<body>
<div class="login-wrap">
  <div class="login-shell">
    <aside class="login-brand">
      <img src="../images/OUR LOGO WHITE.png" alt="AMATETA Techs & Designs">
      <span class="login-eyebrow"><i class="fas fa-shield-halved"></i> Secure management</span>
      <h2>Your business, managed in one place.</h2>
      <p>Update services, promotions, subscribers, enquiries and website content from your private workspace.</p>
      <div class="login-trust"><span><i class="fas fa-lock"></i> Encrypted session</span><span><i class="fas fa-user-shield"></i> Login protection</span></div>
    </aside>
    <form class="login-card" method="post">
      <a class="login-back" href="../index.php"><i class="fas fa-arrow-left"></i> Website</a>
      <div class="login-mobile-logo"><img src="../images/OUR LOGO REVISED.png" alt="AMATETA"></div>
      <span class="login-label">Administrator access</span>
      <h1>Welcome back</h1>
      <p class="sub">Enter your authorised account details.</p>
      <?php if ($error): ?><div class="alert alert-err"><i class="fas fa-circle-exclamation"></i> <?= e($error) ?></div><?php endif; ?>
      <?= csrf_field() ?>
      <div class="fg">
        <label for="admin-email">Email address</label>
        <div class="login-input"><i class="fas fa-envelope"></i><input id="admin-email" type="email" name="email" autocomplete="username" placeholder="name@yourdomain.com" value="<?= e($_POST['email'] ?? '') ?>" required autofocus></div>
      </div>
      <div class="fg">
        <label for="admin-password">Password</label>
        <div class="login-input"><i class="fas fa-key"></i><input id="admin-password" type="password" name="password" autocomplete="current-password" placeholder="Enter your password" required><button type="button" class="password-toggle" aria-label="Show password" aria-pressed="false"><i class="fas fa-eye"></i></button></div>
      </div>
      <button type="submit" class="btn btn-primary"><span>Sign in securely</span><i class="fas fa-arrow-right"></i></button>
      <p class="login-help"><i class="fas fa-circle-info"></i> Access is monitored and repeated failed attempts are temporarily blocked.</p>
    </form>
  </div>
</div>
<script>
const toggle=document.querySelector('.password-toggle'),password=document.getElementById('admin-password');
toggle?.addEventListener('click',()=>{const show=password.type==='password';password.type=show?'text':'password';toggle.setAttribute('aria-pressed',String(show));toggle.setAttribute('aria-label',show?'Hide password':'Show password');toggle.querySelector('i').className=show?'fas fa-eye-slash':'fas fa-eye';});
</script>
</body>
</html>
