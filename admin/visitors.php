<?php
require_once __DIR__ . '/includes/auth.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'clear') {
    if (csrf_check()) { db()->exec('TRUNCATE TABLE visitors'); flash('ok', 'Visitor log cleared.'); }
    redirect('admin/visitors.php');
}

$total   = count_rows('visitors');
$today   = count_rows('visitors', 'DATE(visited_at)=CURDATE()');
$week    = count_rows('visitors', 'visited_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)');
$unique  = (int) db()->query('SELECT COUNT(DISTINCT ip) FROM visitors')->fetchColumn();

$devices = fetch_all('SELECT device, COUNT(*) c FROM visitors GROUP BY device ORDER BY c DESC');
$topPages = fetch_all('SELECT page, COUNT(*) c FROM visitors GROUP BY page ORDER BY c DESC LIMIT 8');
$topIps   = fetch_all('SELECT ip, COUNT(*) c, MAX(visited_at) last FROM visitors GROUP BY ip ORDER BY c DESC LIMIT 8');

$pageNum = max(1, (int) ($_GET['p'] ?? 1));
$per = 40; $offset = ($pageNum - 1) * $per;
$log = fetch_all("SELECT * FROM visitors ORDER BY id DESC LIMIT $per OFFSET $offset");
$pages = max(1, (int) ceil($total / $per));

$page = 'visitors'; $title = 'Visitor Analytics';
include __DIR__ . '/includes/head.php';
?>
<div class="cards">
  <div class="stat-card"><div class="ic ic-blue"><i class="fas fa-eye"></i></div><div><div class="v"><?= number_format($total) ?></div><div class="l">Total Visits</div></div></div>
  <div class="stat-card"><div class="ic ic-green"><i class="fas fa-user-clock"></i></div><div><div class="v"><?= number_format($today) ?></div><div class="l">Today</div></div></div>
  <div class="stat-card"><div class="ic ic-orange"><i class="fas fa-calendar-week"></i></div><div><div class="v"><?= number_format($week) ?></div><div class="l">Last 7 Days</div></div></div>
  <div class="stat-card"><div class="ic ic-purple"><i class="fas fa-fingerprint"></i></div><div><div class="v"><?= number_format($unique) ?></div><div class="l">Unique IPs</div></div></div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:24px;" class="v-3col">
  <div class="panel">
    <div class="panel-head"><h2><i class="fas fa-mobile-screen" style="color:var(--blue)"></i> Devices</h2></div>
    <div class="panel-body">
      <?php foreach ($devices as $d): $pct = $total ? round($d['c'] / $total * 100) : 0; ?>
        <div style="margin-bottom:14px;">
          <div style="display:flex;justify-content:space-between;font-size:13px;margin-bottom:5px;"><strong><?= e($d['device'] ?: 'Unknown') ?></strong><span class="muted"><?= $d['c'] ?> (<?= $pct ?>%)</span></div>
          <div style="height:8px;background:#eef3f8;border-radius:4px;overflow:hidden;"><div style="height:100%;width:<?= $pct ?>%;background:linear-gradient(90deg,var(--blue),var(--blue2));"></div></div>
        </div>
      <?php endforeach; ?>
      <?php if (!$devices): ?><p class="muted">No data yet.</p><?php endif; ?>
    </div>
  </div>
  <div class="panel">
    <div class="panel-head"><h2><i class="fas fa-fire" style="color:var(--orange)"></i> Top Pages</h2></div>
    <div class="panel-body" style="padding:0;">
      <table><tbody>
        <?php foreach ($topPages as $tp): ?><tr><td style="max-width:170px;overflow:hidden;text-overflow:ellipsis;"><?= e($tp['page']) ?></td><td style="text-align:right;"><span class="badge badge-on"><?= $tp['c'] ?></span></td></tr><?php endforeach; ?>
        <?php if (!$topPages): ?><tr><td class="muted">No data yet.</td></tr><?php endif; ?>
      </tbody></table>
    </div>
  </div>
  <div class="panel">
    <div class="panel-head"><h2><i class="fas fa-location-dot" style="color:var(--blue)"></i> Top Visitors (IP)</h2></div>
    <div class="panel-body" style="padding:0;">
      <table><tbody>
        <?php foreach ($topIps as $ti): ?><tr><td><strong><?= e($ti['ip']) ?></strong><br><span class="muted" style="font-size:11px;"><?= e(time_ago($ti['last'])) ?></span></td><td style="text-align:right;"><span class="badge badge-on"><?= $ti['c'] ?> visits</span></td></tr><?php endforeach; ?>
        <?php if (!$topIps): ?><tr><td class="muted">No data yet.</td></tr><?php endif; ?>
      </tbody></table>
    </div>
  </div>
</div>

<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-list" style="color:var(--blue)"></i> Visitor Log</h2>
    <form method="post" data-confirm="Clear the entire visitor log? This cannot be undone."><?= csrf_field() ?><input type="hidden" name="action" value="clear"><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Clear Log</button></form>
  </div>
  <div class="panel-body" style="padding:0;">
    <table>
      <thead><tr><th>IP</th><th>Page</th><th>Device</th><th>Referrer</th><th>When</th></tr></thead>
      <tbody>
      <?php if (!$log): ?><tr><td colspan="5" class="muted" style="text-align:center;padding:24px;">No visits recorded yet.</td></tr><?php endif; ?>
      <?php foreach ($log as $v): ?>
        <tr>
          <td><?= e($v['ip']) ?></td>
          <td class="muted" style="max-width:200px;overflow:hidden;text-overflow:ellipsis;"><?= e($v['page']) ?></td>
          <td><span class="badge badge-on"><?= e($v['device'] ?: '—') ?></span></td>
          <td class="muted" style="max-width:160px;overflow:hidden;text-overflow:ellipsis;"><?= e($v['referrer'] ?: 'Direct') ?></td>
          <td class="muted"><?= e(date('d M H:i', strtotime($v['visited_at']))) ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php if ($pages > 1): ?>
    <div class="panel-body" style="display:flex;gap:8px;justify-content:center;flex-wrap:wrap;">
      <?php for ($i = 1; $i <= min($pages, 12); $i++): ?>
        <a href="visitors.php?p=<?= $i ?>" class="btn <?= $i === $pageNum ? 'btn-primary' : 'btn-light' ?> btn-sm"><?= $i ?></a>
      <?php endfor; ?>
    </div>
  <?php endif; ?>
</div>
<style>@media(max-width:980px){.v-3col{grid-template-columns:1fr!important}}</style>
<?php include __DIR__ . '/includes/foot.php'; ?>
