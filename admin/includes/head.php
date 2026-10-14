<?php
/** Admin layout — top. Expects $page (nav key) and $title. */
$page  = $page ?? '';
$title = $title ?? 'Dashboard';
$me    = admin_user();
$flash = get_flash();

$menu = [
    'main' => [
        'index'       => ['Dashboard', 'fas fa-gauge-high', 'index.php'],
        'visitors'    => ['Visitors', 'fas fa-chart-line', 'visitors.php'],
        'messages'    => ['Messages', 'fas fa-envelope', 'messages.php'],
        'subscribers' => ['Subscribers', 'fas fa-users', 'subscribers.php'],
        'newsletter'  => ['Send Newsletter', 'fas fa-paper-plane', 'newsletter.php'],
    ],
    'content' => [
        'slides'     => ['Home Slides', 'fas fa-images', 'slides.php'],
        'sales'      => ['Sales & Offers', 'fas fa-tags', 'sales.php'],
        'categories' => ['Service Categories', 'fas fa-folder-tree', 'categories.php'],
        'services'   => ['Services', 'fas fa-cogs', 'services.php'],
        'stamp-services' => ['Stamp Services', 'fas fa-stamp', 'stamp-services.php'],
        'team'      => ['Team', 'fas fa-user-tie', 'team.php'],
        'portfolio' => ['Portfolio', 'fas fa-briefcase', 'portfolio.php'],
        'portfolio-categories' => ['Portfolio Categories', 'fas fa-folder-open', 'portfolio-categories.php'],
    ],
    'system' => [
        'settings' => ['Settings', 'fas fa-sliders', 'settings.php'],
    ],
];

// Unread badge
$unread = 0;
try { $unread = count_rows('messages', 'is_read = 0'); } catch (Throwable $e) {}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title><?= e($title) ?> · AMATETA Admin</title>
<link rel="icon" href="../images/fav.png">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="assets/admin.css">
</head>
<body>
<div class="adm-wrap">
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-logo"><img src="../images/OUR LOGO WHITE.png" alt="AMATETA Admin"></div>
    <nav class="sidebar-nav">
      <?php foreach ($menu as $group => $items): ?>
        <div class="nav-label"><?= e(ucfirst($group)) ?></div>
        <?php foreach ($items as $key => $it): ?>
          <a href="<?= e($it[2]) ?>" class="<?= $page === $key ? 'active' : '' ?>">
            <i class="<?= e($it[1]) ?>"></i><?= e($it[0]) ?>
            <?php if ($key === 'messages' && $unread > 0): ?>
              <span class="badge badge-new" style="margin-left:auto;"><?= $unread ?></span>
            <?php endif; ?>
          </a>
        <?php endforeach; ?>
      <?php endforeach; ?>
    </nav>
    <div class="sidebar-foot">
      <a href="../index.php" target="_blank"><i class="fas fa-globe"></i> View Website</a>
      <a href="logout.php"><i class="fas fa-right-from-bracket"></i> Logout</a>
    </div>
  </aside>

  <div class="main">
    <header class="topbar">
      <div style="display:flex;align-items:center;gap:12px;">
        <button class="hamb" onclick="admToggleSidebar()" aria-label="Menu"><i class="fas fa-bars"></i></button>
        <h1><?= e($title) ?></h1>
      </div>
      <div class="tb-right">
        <div class="tb-user">
          <div class="av"><?= e(strtoupper(substr($me['name'] ?? 'A', 0, 1))) ?></div>
          <div><strong style="color:var(--navy)"><?= e($me['name'] ?? 'Admin') ?></strong><br><span><?= e($me['email'] ?? '') ?></span></div>
        </div>
      </div>
    </header>
    <main class="content">
      <?php if ($flash): ?>
        <div class="alert alert-<?= $flash['type'] === 'ok' ? 'ok' : 'err' ?>"><?= e($flash['msg']) ?></div>
      <?php endif; ?>
