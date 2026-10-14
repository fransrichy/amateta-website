<?php
require_once __DIR__ . '/includes/auth.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) { flash('err', 'Session expired.'); redirect('admin/sales.php'); }
    $action = $_POST['action'] ?? '';

    if ($action === 'save') {
        $id = (int) ($_POST['id'] ?? 0);
        $data = [
            clean($_POST['title'] ?? ''), clean($_POST['description'] ?? ''), clean($_POST['badge'] ?? 'SALE'),
            clean($_POST['old_price'] ?? ''), clean($_POST['new_price'] ?? ''), clean($_POST['link'] ?? ''),
            (int) ($_POST['sort_order'] ?? 0), isset($_POST['active']) ? 1 : 0,
        ];
        $imgErr = null;
        $img = handle_upload('image', 'sales', $imgErr);
        if ($imgErr) { flash('err', $imgErr); redirect('admin/sales.php'); }

        if ($id > 0) {
            if ($img) db()->prepare('UPDATE sales SET title=?,description=?,badge=?,old_price=?,new_price=?,link=?,sort_order=?,active=?,image=? WHERE id=?')->execute([...$data, $img, $id]);
            else      db()->prepare('UPDATE sales SET title=?,description=?,badge=?,old_price=?,new_price=?,link=?,sort_order=?,active=? WHERE id=?')->execute([...$data, $id]);
            flash('ok', 'Sale updated.');
        } else {
            db()->prepare('INSERT INTO sales (title,description,badge,old_price,new_price,link,sort_order,active,image) VALUES (?,?,?,?,?,?,?,?,?)')->execute([...$data, $img ?? '']);
            flash('ok', 'Sale added.');
        }
        redirect('admin/sales.php');
    }
    if ($action === 'delete') { db()->prepare('DELETE FROM sales WHERE id=?')->execute([(int) $_POST['id']]); flash('ok', 'Sale deleted.'); redirect('admin/sales.php'); }
    if ($action === 'toggle') { db()->prepare('UPDATE sales SET active=1-active WHERE id=?')->execute([(int) $_POST['id']]); redirect('admin/sales.php'); }
}

$editId = (int) ($_GET['edit'] ?? 0);
$edit = $editId ? fetch_one('SELECT * FROM sales WHERE id=?', [$editId]) : null;
$rows = fetch_all('SELECT * FROM sales ORDER BY sort_order, id');

$page = 'sales'; $title = 'Sales & Offers';
include __DIR__ . '/includes/head.php';
?>
<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-<?= $edit ? 'pen' : 'plus' ?>" style="color:var(--blue)"></i> <?= $edit ? 'Edit Sale' : 'Add Sale / Offer' ?></h2><?php if ($edit): ?><a href="sales.php" class="btn btn-light btn-sm"><i class="fas fa-xmark"></i> Cancel</a><?php endif; ?></div>
  <div class="panel-body">
    <form method="post" enctype="multipart/form-data">
      <?= csrf_field() ?><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?= (int) ($edit['id'] ?? 0) ?>">
      <div class="form-grid">
        <div class="fg full"><label>Offer Title</label><input type="text" name="title" value="<?= e($edit['title'] ?? '') ?>" placeholder="e.g. Website Starter Special" required></div>
        <div class="fg full"><label>Description</label><textarea name="description"><?= e($edit['description'] ?? '') ?></textarea></div>
        <div class="fg"><label>Badge text</label><input type="text" name="badge" value="<?= e($edit['badge'] ?? 'SALE') ?>" placeholder="SALE / 20% OFF / HOT DEAL"></div>
        <div class="fg"><label>Link (button "Learn More")</label><input type="text" name="link" value="<?= e($edit['link'] ?? '') ?>" placeholder="contact.php or https://…"></div>
        <div class="fg"><label>Old Price</label><input type="text" name="old_price" value="<?= e($edit['old_price'] ?? '') ?>" placeholder="N$4500"></div>
        <div class="fg"><label>New / Sale Price</label><input type="text" name="new_price" value="<?= e($edit['new_price'] ?? '') ?>" placeholder="N$2999"></div>
        <div class="fg"><label>Sort Order</label><input type="number" name="sort_order" value="<?= (int) ($edit['sort_order'] ?? count($rows)) ?>"></div>
        <div class="fg"><label>Status</label><label style="font-weight:500;display:flex;gap:8px;align-items:center;margin-top:8px;"><input type="checkbox" name="active" style="width:auto" <?= (!$edit || $edit['active']) ? 'checked' : '' ?>> Show on website</label></div>
        <div class="fg full"><label>Offer Image <?= $edit ? '(leave empty to keep current)' : '' ?></label><input type="file" name="image" accept="image/*">
          <?php if (!empty($edit['image'])): ?><div style="margin-top:10px;"><img src="../<?= e($edit['image']) ?>" class="thumb" style="width:120px;height:75px;"></div><?php endif; ?>
          <p class="help">The floating <strong>SALE</strong> icon appears automatically on the home page section.</p>
        </div>
      </div>
      <button class="btn btn-primary"><i class="fas fa-floppy-disk"></i> <?= $edit ? 'Update' : 'Add Sale' ?></button>
    </form>
  </div>
</div>

<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-tags" style="color:var(--blue)"></i> Sales & Offers (<?= count($rows) ?>)</h2></div>
  <div class="panel-body" style="padding:0;">
    <table>
      <thead><tr><th>Image</th><th>Title</th><th>Badge</th><th>Price</th><th>Status</th><th style="text-align:right;">Actions</th></tr></thead>
      <tbody>
      <?php if (!$rows): ?><tr><td colspan="6" class="muted" style="text-align:center;padding:24px;">No offers yet — add your first deal above.</td></tr><?php endif; ?>
      <?php foreach ($rows as $s): ?>
        <tr>
          <td><?php if ($s['image']): ?><img src="../<?= e($s['image']) ?>" class="thumb" style="width:72px;height:46px;" onerror="this.style.opacity=.3"><?php else: ?><span style="width:54px;height:54px;border-radius:9px;background:linear-gradient(135deg,#e3175b,#f77f00);display:flex;align-items:center;justify-content:center;color:#fff;"><i class="fas fa-tags"></i></span><?php endif; ?></td>
          <td><strong><?= e($s['title']) ?></strong></td>
          <td><span class="badge badge-new"><?= e($s['badge']) ?></span></td>
          <td><?php if ($s['new_price']): ?><strong style="color:#e3175b;"><?= e($s['new_price']) ?></strong> <?php if ($s['old_price']): ?><span class="muted" style="text-decoration:line-through;font-size:11px;"><?= e($s['old_price']) ?></span><?php endif; ?><?php else: ?><span class="muted">—</span><?php endif; ?></td>
          <td><form method="post" style="display:inline"><?= csrf_field() ?><input type="hidden" name="action" value="toggle"><input type="hidden" name="id" value="<?= $s['id'] ?>"><button class="badge <?= $s['active'] ? 'badge-on' : 'badge-off' ?>" style="border:none;cursor:pointer;"><?= $s['active'] ? 'Live' : 'Hidden' ?></button></form></td>
          <td style="text-align:right;white-space:nowrap;">
            <a href="sales.php?edit=<?= $s['id'] ?>" class="btn btn-light btn-icon"><i class="fas fa-pen"></i></a>
            <form method="post" style="display:inline" data-confirm="Delete this offer?"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $s['id'] ?>"><button class="btn btn-danger btn-icon"><i class="fas fa-trash"></i></button></form>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/includes/foot.php'; ?>
