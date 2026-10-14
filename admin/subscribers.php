<?php
require_once __DIR__ . '/includes/auth.php';
require_admin();

// CSV export
if (($_GET['export'] ?? '') === 'csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="amateta-subscribers-' . date('Y-m-d') . '.csv"');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['Email', 'Name', 'Status', 'IP', 'Subscribed At']);
    foreach (fetch_all('SELECT email,name,status,ip,subscribed_at FROM subscribers ORDER BY id DESC') as $r) {
        fputcsv($out, $r);
    }
    fclose($out);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) { flash('err', 'Session expired.'); redirect('admin/subscribers.php'); }
    $action = $_POST['action'] ?? '';
    $id = (int) ($_POST['id'] ?? 0);
    if ($action === 'delete') { db()->prepare('DELETE FROM subscribers WHERE id=?')->execute([$id]); flash('ok', 'Subscriber deleted.'); }
    if ($action === 'toggle') { db()->prepare("UPDATE subscribers SET status = IF(status='active','unsubscribed','active') WHERE id=?")->execute([$id]); }
    redirect('admin/subscribers.php');
}

$rows = fetch_all('SELECT * FROM subscribers ORDER BY id DESC');
$active = count_rows('subscribers', "status='active'");

$page = 'subscribers'; $title = 'Newsletter Subscribers';
include __DIR__ . '/includes/head.php';
?>
<div class="cards" style="grid-template-columns:repeat(3,1fr);">
  <div class="stat-card"><div class="ic ic-blue"><i class="fas fa-users"></i></div><div><div class="v"><?= count($rows) ?></div><div class="l">Total Subscribers</div></div></div>
  <div class="stat-card"><div class="ic ic-green"><i class="fas fa-circle-check"></i></div><div><div class="v"><?= $active ?></div><div class="l">Active</div></div></div>
  <div class="stat-card"><div class="ic ic-orange"><i class="fas fa-user-slash"></i></div><div><div class="v"><?= count($rows) - $active ?></div><div class="l">Unsubscribed</div></div></div>
</div>

<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-users" style="color:var(--blue)"></i> Subscribers</h2>
    <div style="display:flex;gap:10px;">
      <a href="subscribers.php?export=csv" class="btn btn-light btn-sm"><i class="fas fa-file-csv"></i> Export CSV</a>
      <a href="newsletter.php" class="btn btn-orange btn-sm"><i class="fas fa-paper-plane"></i> Send Newsletter</a>
    </div>
  </div>
  <div class="panel-body" style="padding:0;">
    <table>
      <thead><tr><th>Email</th><th>Name</th><th>Status</th><th>Subscribed</th><th style="text-align:right;">Actions</th></tr></thead>
      <tbody>
      <?php if (!$rows): ?><tr><td colspan="5" class="muted" style="text-align:center;padding:24px;">No subscribers yet.</td></tr><?php endif; ?>
      <?php foreach ($rows as $r): ?>
        <tr>
          <td><strong><?= e($r['email']) ?></strong></td>
          <td class="muted"><?= e($r['name'] ?: '—') ?></td>
          <td><span class="badge <?= $r['status'] === 'active' ? 'badge-on' : 'badge-off' ?>"><?= e(ucfirst($r['status'])) ?></span></td>
          <td class="muted"><?= e(date('d M Y', strtotime($r['subscribed_at']))) ?></td>
          <td style="text-align:right;white-space:nowrap;">
            <form method="post" style="display:inline"><?= csrf_field() ?><input type="hidden" name="action" value="toggle"><input type="hidden" name="id" value="<?= $r['id'] ?>"><button class="btn btn-light btn-sm" title="Toggle status"><i class="fas fa-right-left"></i></button></form>
            <form method="post" style="display:inline" data-confirm="Delete this subscriber?"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $r['id'] ?>"><button class="btn btn-danger btn-icon"><i class="fas fa-trash"></i></button></form>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/includes/foot.php'; ?>
