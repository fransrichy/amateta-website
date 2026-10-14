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
  <form class="login-card" method="post" autocomplete="off">
    <div class="lg"><img src="../images/OUR LOGO REVISED.png" alt="AMATETA"></div>
    <h1>Admin Panel</h1>
    <p class="sub">Sign in to manage your website</p>
    <?php if ($error): ?><div class="alert alert-err"><i class="fas fa-circle-exclamation"></i> <?= e($error) ?></div><?php endif; ?>
    <?= csrf_field() ?>
    <div class="fg">
      <label>Email Address</label>
      <input type="email" name="email" placeholder="admin@amateta.com" value="<?= e($_POST['email'] ?? '') ?>" required autofocus>
    </div>
    <div class="fg">
      <label>Password</label>
      <input type="password" name="password" placeholder="••••••••" required>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-right-to-bracket"></i> Sign In</button>
    <p style="text-align:center;margin-top:18px;font-size:12.5px;"><a href="../index.php" style="color:var(--muted);text-decoration:none;"><i class="fas fa-arrow-left"></i> Back to website</a></p>
  </form>
</div>
</body>
</html>
