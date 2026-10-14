<?php
require_once __DIR__ . '/includes/auth.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) { flash('err', 'Session expired.'); redirect('admin/messages.php'); }
    $action = $_POST['action'] ?? '';
    $id = (int) ($_POST['id'] ?? 0);
    if ($action === 'delete') { db()->prepare('DELETE FROM messages WHERE id=?')->execute([$id]); flash('ok', 'Message deleted.'); }
    if ($action === 'read')   { db()->prepare('UPDATE messages SET is_read=1 WHERE id=?')->execute([$id]); }
    if ($action === 'unread') { db()->prepare('UPDATE messages SET is_read=0 WHERE id=?')->execute([$id]); }
    redirect('admin/messages.php' . ($id ? '?open=' . $id : ''));
}

$open = (int) ($_GET['open'] ?? 0);
if ($open) { db()->prepare('UPDATE messages SET is_read=1 WHERE id=?')->execute([$open]); }
$current = $open ? fetch_one('SELECT * FROM messages WHERE id=?', [$open]) : null;
$rows = fetch_all('SELECT * FROM messages ORDER BY id DESC');

$page = 'messages'; $title = 'Contact Messages';
include __DIR__ . '/includes/head.php';
?>
<?php if ($current): ?>
  <div class="panel">
    <div class="panel-head"><h2><i class="fas fa-envelope-open-text" style="color:var(--blue)"></i> Message from <?= e($current['name']) ?></h2><a href="messages.php" class="btn btn-light btn-sm"><i class="fas fa-arrow-left"></i> Back to inbox</a></div>
    <div class="panel-body">
      <table style="margin-bottom:18px;">
        <tr><td style="width:130px;color:var(--muted);">From</td><td><strong><?= e($current['name']) ?></strong></td></tr>
        <tr><td style="color:var(--muted);">Email</td><td><a href="mailto:<?= e($current['email']) ?>"><?= e($current['email']) ?></a></td></tr>
        <tr><td style="color:var(--muted);">Phone</td><td><?= e($current['phone'] ?: '—') ?></td></tr>
        <tr><td style="color:var(--muted);">Service</td><td><?= e($current['service'] ?: '—') ?></td></tr>
        <tr><td style="color:var(--muted);">Subject</td><td><?= e($current['subject'] ?: '—') ?></td></tr>
        <tr><td style="color:var(--muted);">Received</td><td><?= e(date('d M Y, H:i', strtotime($current['created_at']))) ?> · IP <?= e($current['ip']) ?></td></tr>
      </table>
      <div style="background:#f8fbfe;border:1px solid var(--line);border-radius:12px;padding:18px;white-space:pre-wrap;line-height:1.7;"><?= e($current['message']) ?></div>
      <div style="margin-top:18px;display:flex;gap:10px;flex-wrap:wrap;">
        <a href="mailto:<?= e($current['email']) ?>?subject=RE: <?= e($current['subject'] ?: 'Your enquiry') ?>" class="btn btn-primary"><i class="fas fa-reply"></i> Reply by Email</a>
        <?php if ($current['phone']): ?><a href="https://wa.me/<?= e(preg_replace('/\D/', '', $current['phone'])) ?>" target="_blank" class="btn btn-success"><i class="fab fa-whatsapp"></i> WhatsApp</a><?php endif; ?>
        <form method="post" data-confirm="Delete this message?"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $current['id'] ?>"><button class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button></form>
      </div>
    </div>
  </div>
<?php endif; ?>

<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-inbox" style="color:var(--blue)"></i> Inbox (<?= count($rows) ?>)</h2></div>
  <div class="panel-body" style="padding:0;">
    <table>
      <thead><tr><th></th><th>From</th><th>Subject / Service</th><th>Received</th><th style="text-align:right;">Actions</th></tr></thead>
      <tbody>
      <?php if (!$rows): ?><tr><td colspan="5" class="muted" style="text-align:center;padding:24px;">No messages yet.</td></tr><?php endif; ?>
      <?php foreach ($rows as $m): ?>
        <tr style="<?= $m['is_read'] ? '' : 'background:#fffdf5;' ?>">
          <td><?php if (!$m['is_read']): ?><span class="badge badge-new">New</span><?php else: ?><i class="fas fa-envelope-open muted"></i><?php endif; ?></td>
          <td><a href="messages.php?open=<?= $m['id'] ?>" style="text-decoration:none;color:var(--navy);"><strong><?= e($m['name']) ?></strong></a><br><span class="muted" style="font-size:11.5px;"><?= e($m['email']) ?></span></td>
          <td><a href="messages.php?open=<?= $m['id'] ?>" style="text-decoration:none;color:var(--navy);"><?= e($m['subject'] ?: $m['service'] ?: 'Enquiry') ?></a></td>
          <td class="muted"><?= e(time_ago($m['created_at'])) ?></td>
          <td style="text-align:right;white-space:nowrap;">
            <a href="messages.php?open=<?= $m['id'] ?>" class="btn btn-light btn-icon" title="Open"><i class="fas fa-eye"></i></a>
            <form method="post" style="display:inline" data-confirm="Delete this message?"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $m['id'] ?>"><button class="btn btn-danger btn-icon"><i class="fas fa-trash"></i></button></form>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/includes/foot.php'; ?>
