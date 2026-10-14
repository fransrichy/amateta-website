<?php
require_once __DIR__ . '/includes/auth.php';
require_admin();

$totalVisitors  = count_rows('visitors');
$todayVisitors  = count_rows('visitors', 'DATE(visited_at) = CURDATE()');
$uniqueToday    = (int) db()->query('SELECT COUNT(DISTINCT ip) FROM visitors WHERE DATE(visited_at)=CURDATE()')->fetchColumn();
$subscribers    = count_rows('subscribers', "status = 'active'");
$messages       = count_rows('messages');
$unread         = count_rows('messages', 'is_read = 0');
$servicesCount  = count_rows('services');
$teamCount      = count_rows('team');
$smtpReady      = trim(get_setting('smtp_host', '')) !== ''
               && clean_email(get_setting('smtp_user', '')) !== ''
               && get_setting('smtp_pass', '') !== '';
$uploadsReady   = is_dir(UPLOAD_PATH) && is_writable(UPLOAD_PATH);
$httpsReady     = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
               || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');

$recentVisitors = fetch_all('SELECT * FROM visitors ORDER BY id DESC LIMIT 8');
$recentMessages = fetch_all('SELECT * FROM messages ORDER BY id DESC LIMIT 6');

// 7-day visit chart
$chart = [];
for ($i = 6; $i >= 0; $i--) {
    $day = date('Y-m-d', strtotime("-$i days"));
    $chart[$day] = 0;
}
foreach (fetch_all("SELECT DATE(visited_at) d, COUNT(*) c FROM visitors WHERE visited_at >= DATE_SUB(CURDATE(), INTERVAL 6 DAY) GROUP BY DATE(visited_at)") as $r) {
    $chart[$r['d']] = (int) $r['c'];
}
$chartMax = max(1, max($chart));

$page = 'index'; $title = 'Dashboard';
include __DIR__ . '/includes/head.php';
?>
<div class="cards">
  <div class="stat-card"><div class="ic ic-blue"><i class="fas fa-eye"></i></div><div><div class="v"><?= number_format($totalVisitors) ?></div><div class="l">Total Visits</div></div></div>
  <div class="stat-card"><div class="ic ic-green"><i class="fas fa-user-clock"></i></div><div><div class="v"><?= number_format($todayVisitors) ?></div><div class="l">Visits Today (<?= $uniqueToday ?> unique)</div></div></div>
  <div class="stat-card"><div class="ic ic-orange"><i class="fas fa-users"></i></div><div><div class="v"><?= number_format($subscribers) ?></div><div class="l">Newsletter Subscribers</div></div></div>
  <div class="stat-card"><div class="ic ic-purple"><i class="fas fa-envelope"></i></div><div><div class="v"><?= number_format($messages) ?></div><div class="l"><?= $unread ?> unread message<?= $unread === 1 ? '' : 's' ?></div></div></div>
</div>

<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-heart-pulse" style="color:var(--blue)"></i> System Health</h2><a href="settings.php" class="btn btn-light btn-sm">Open settings</a></div>
  <div class="panel-body system-health">
    <div class="health-item"><i class="fas <?= $smtpReady ? 'fa-circle-check ok' : 'fa-circle-exclamation warn' ?>"></i><div><strong>Email delivery</strong><span><?= $smtpReady ? 'SMTP credentials are configured' : 'Action required: configure and test SMTP' ?></span></div></div>
    <div class="health-item"><i class="fas <?= $uploadsReady ? 'fa-circle-check ok' : 'fa-circle-exclamation warn' ?>"></i><div><strong>Media uploads</strong><span><?= $uploadsReady ? 'Upload storage is writable' : 'Action required: check uploads permissions' ?></span></div></div>
    <div class="health-item"><i class="fas <?= $httpsReady ? 'fa-circle-check ok' : 'fa-circle-exclamation warn' ?>"></i><div><strong>HTTPS</strong><span><?= $httpsReady ? 'Secure connection active' : (AMATETA_DEV ? 'Local development connection' : 'Action required: enable HTTPS') ?></span></div></div>
  </div>
</div>

<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-chart-line" style="color:var(--blue)"></i> Visits — Last 7 Days</h2></div>
  <div class="panel-body">
    <div style="display:flex;align-items:flex-end;gap:14px;height:180px;padding-top:10px;">
      <?php foreach ($chart as $day => $count): ?>
        <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:8px;height:100%;justify-content:flex-end;">
          <div style="font-size:12px;font-weight:700;color:var(--navy)"><?= $count ?></div>
          <div title="<?= e($day) ?>: <?= $count ?> visits" style="width:100%;max-width:46px;border-radius:8px 8px 0 0;background:linear-gradient(180deg,var(--blue),var(--blue2));height:<?= max(4, round($count / $chartMax * 130)) ?>px;transition:.3s;"></div>
          <div style="font-size:11px;color:var(--muted)"><?= date('D', strtotime($day)) ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<div style="display:grid;grid-template-columns:1.2fr 1fr;gap:24px;" class="dash-2col">
  <div class="panel">
    <div class="panel-head"><h2><i class="fas fa-clock-rotate-left" style="color:var(--blue)"></i> Recent Visitors</h2><a href="visitors.php" class="btn btn-light btn-sm">View all</a></div>
    <div class="panel-body" style="padding:0;">
      <table>
        <thead><tr><th>IP</th><th>Page</th><th>Device</th><th>When</th></tr></thead>
        <tbody>
        <?php if (!$recentVisitors): ?>
          <tr><td colspan="4" class="muted" style="text-align:center;padding:24px;">No visits recorded yet.</td></tr>
        <?php else: foreach ($recentVisitors as $v): ?>
          <tr>
            <td><?= e($v['ip']) ?></td>
            <td class="muted" style="max-width:180px;overflow:hidden;text-overflow:ellipsis;"><?= e($v['page']) ?></td>
            <td><span class="badge badge-on"><?= e($v['device'] ?: '—') ?></span></td>
            <td class="muted"><?= e(time_ago($v['visited_at'])) ?></td>
          </tr>
        <?php endforeach; endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="panel">
    <div class="panel-head"><h2><i class="fas fa-inbox" style="color:var(--blue)"></i> Latest Messages</h2><a href="messages.php" class="btn btn-light btn-sm">View all</a></div>
    <div class="panel-body" style="padding:0;">
      <table>
        <thead><tr><th>From</th><th>Subject</th><th></th></tr></thead>
        <tbody>
        <?php if (!$recentMessages): ?>
          <tr><td colspan="3" class="muted" style="text-align:center;padding:24px;">No messages yet.</td></tr>
        <?php else: foreach ($recentMessages as $m): ?>
          <tr>
            <td><strong><?= e($m['name']) ?></strong><br><span class="muted" style="font-size:11.5px;"><?= e($m['email']) ?></span></td>
            <td><?= e($m['subject'] ?: $m['service'] ?: 'Enquiry') ?><br><span class="muted" style="font-size:11px;"><?= e(time_ago($m['created_at'])) ?></span></td>
            <td><?php if (!$m['is_read']): ?><span class="badge badge-new">New</span><?php endif; ?></td>
          </tr>
        <?php endforeach; endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-bolt" style="color:var(--orange)"></i> Quick Actions</h2></div>
  <div class="panel-body" style="display:flex;gap:12px;flex-wrap:wrap;">
    <a href="slides.php" class="btn btn-primary"><i class="fas fa-images"></i> Manage Slides</a>
    <a href="services.php" class="btn btn-primary"><i class="fas fa-cogs"></i> Manage Services</a>
    <a href="team.php" class="btn btn-primary"><i class="fas fa-user-tie"></i> Manage Team</a>
    <a href="newsletter.php" class="btn btn-orange"><i class="fas fa-paper-plane"></i> Send Newsletter</a>
    <a href="settings.php" class="btn btn-dark"><i class="fas fa-sliders"></i> Site Settings</a>
  </div>
</div>
<style>
.system-health{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}.health-item{display:flex;gap:12px;align-items:flex-start;background:#f8fbfe;border:1px solid var(--line);border-radius:12px;padding:16px}.health-item>i{font-size:1.25rem;margin-top:1px}.health-item .ok{color:var(--ok)}.health-item .warn{color:var(--orange)}.health-item strong,.health-item span{display:block}.health-item span{color:var(--muted);font-size:12px;margin-top:4px;line-height:1.4}
@media(max-width:980px){.dash-2col{grid-template-columns:1fr!important}.system-health{grid-template-columns:1fr}}
</style>
<?php include __DIR__ . '/includes/foot.php'; ?>
