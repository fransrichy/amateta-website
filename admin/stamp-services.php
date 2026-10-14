<?php
require_once __DIR__ . '/includes/auth.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) { flash('err', 'Session expired.'); redirect('admin/stamp-services.php'); }
    $action = $_POST['action'] ?? '';

    if ($action === 'save') {
        $id = (int) ($_POST['id'] ?? 0);
        $data = [
            clean($_POST['name'] ?? ''), clean($_POST['description'] ?? ''), clean($_POST['icon'] ?? 'fas fa-stamp'),
            clean($_POST['wa_text'] ?? ''), (int) ($_POST['sort_order'] ?? 0), isset($_POST['active']) ? 1 : 0,
        ];
        $imgErr = null;
        $img = handle_upload('image', 'stamps', $imgErr);
        if ($imgErr) { flash('err', $imgErr); redirect('admin/stamp-services.php'); }

        if ($id > 0) {
            if ($img) db()->prepare('UPDATE stamp_services SET name=?,description=?,icon=?,wa_text=?,sort_order=?,active=?,image=? WHERE id=?')->execute([...$data, $img, $id]);
            else      db()->prepare('UPDATE stamp_services SET name=?,description=?,icon=?,wa_text=?,sort_order=?,active=? WHERE id=?')->execute([...$data, $id]);
            flash('ok', 'Stamp service updated.');
        } else {
            db()->prepare('INSERT INTO stamp_services (name,description,icon,wa_text,sort_order,active,image) VALUES (?,?,?,?,?,?,?)')->execute([...$data, $img ?? '']);
            flash('ok', 'Stamp service added.');
        }
        redirect('admin/stamp-services.php');
    }
    if ($action === 'delete') { db()->prepare('DELETE FROM stamp_services WHERE id=?')->execute([(int) $_POST['id']]); flash('ok', 'Stamp service deleted.'); redirect('admin/stamp-services.php'); }
    if ($action === 'toggle') { db()->prepare('UPDATE stamp_services SET active=1-active WHERE id=?')->execute([(int) $_POST['id']]); redirect('admin/stamp-services.php'); }
}

$editId = (int) ($_GET['edit'] ?? 0);
$edit = $editId ? fetch_one('SELECT * FROM stamp_services WHERE id=?', [$editId]) : null;
$rows = fetch_all('SELECT * FROM stamp_services ORDER BY sort_order, id');

$page = 'stamp-services'; $title = 'Stamp Services';
include __DIR__ . '/includes/head.php';
?>
<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-<?= $edit ? 'pen' : 'plus' ?>" style="color:var(--blue)"></i> <?= $edit ? 'Edit Stamp Service' : 'Add Stamp Service' ?></h2><?php if ($edit): ?><a href="stamp-services.php" class="btn btn-light btn-sm"><i class="fas fa-xmark"></i> Cancel</a><?php endif; ?></div>
  <div class="panel-body">
    <form method="post" enctype="multipart/form-data">
      <?= csrf_field() ?><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?= (int) ($edit['id'] ?? 0) ?>">
      <div class="form-grid">
        <div class="fg"><label>Stamp Name</label><input type="text" name="name" value="<?= e($edit['name'] ?? '') ?>" placeholder="e.g. Self-Inking Stamps" required></div>
        <div class="fg"><label>Icon (Font Awesome)</label><input type="text" name="icon" value="<?= e($edit['icon'] ?? 'fas fa-stamp') ?>" placeholder="fas fa-stamp"></div>
        <div class="fg full"><label>Description</label><textarea name="description"><?= e($edit['description'] ?? '') ?></textarea></div>
        <div class="fg"><label>WhatsApp order text</label><input type="text" name="wa_text" value="<?= e($edit['wa_text'] ?? '') ?>" placeholder="I would like to order…"></div>
        <div class="fg"><label>Sort Order</label><input type="number" name="sort_order" value="<?= (int) ($edit['sort_order'] ?? count($rows)) ?>"></div>
        <div class="fg full"><label>Image <?= $edit ? '(leave empty to keep current)' : '' ?></label><input type="file" name="image" accept="image/*">
          <?php if (!empty($edit['image'])): ?><div style="margin-top:10px;"><img src="../<?= e($edit['image']) ?>" class="thumb"></div><?php endif; ?>
          <label style="font-weight:500;display:flex;gap:8px;align-items:center;margin-top:12px;"><input type="checkbox" name="active" style="width:auto" <?= (!$edit || $edit['active']) ? 'checked' : '' ?>> Show on Stamps page</label>
        </div>
      </div>
      <button class="btn btn-primary"><i class="fas fa-floppy-disk"></i> <?= $edit ? 'Update' : 'Add Stamp Service' ?></button>
    </form>
  </div>
</div>

<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-stamp" style="color:var(--blue)"></i> Stamp Services (<?= count($rows) ?>)</h2><a href="../stamps.php" target="_blank" class="btn btn-light btn-sm"><i class="fas fa-external-link-alt"></i> View Stamps Page</a></div>
  <div class="panel-body" style="padding:0;">
    <table>
      <thead><tr><th>Icon / Image</th><th>Name</th><th>Order</th><th>Status</th><th style="text-align:right;">Actions</th></tr></thead>
      <tbody>
      <?php if (!$rows): ?><tr><td colspan="5" class="muted" style="text-align:center;padding:24px;">No stamp services yet.</td></tr><?php endif; ?>
      <?php foreach ($rows as $s): ?>
        <tr>
          <td><?php if ($s['image']): ?><img src="../<?= e($s['image']) ?>" class="thumb" onerror="this.style.opacity=.3"><?php else: ?><span style="width:54px;height:54px;border-radius:9px;background:linear-gradient(135deg,#9c27b0,#6a1b9a);display:flex;align-items:center;justify-content:center;color:#fff;"><i class="<?= e($s['icon']) ?>"></i></span><?php endif; ?></td>
          <td><strong><?= e($s['name']) ?></strong><br><span class="muted" style="font-size:11.5px;"><?= e($s['description']) ?></span></td>
          <td><?= (int) $s['sort_order'] ?></td>
          <td><form method="post" style="display:inline"><?= csrf_field() ?><input type="hidden" name="action" value="toggle"><input type="hidden" name="id" value="<?= $s['id'] ?>"><button class="badge <?= $s['active'] ? 'badge-on' : 'badge-off' ?>" style="border:none;cursor:pointer;"><?= $s['active'] ? 'Visible' : 'Hidden' ?></button></form></td>
          <td style="text-align:right;white-space:nowrap;">
            <a href="stamp-services.php?edit=<?= $s['id'] ?>" class="btn btn-light btn-icon"><i class="fas fa-pen"></i></a>
            <form method="post" style="display:inline" data-confirm="Delete this stamp service?"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $s['id'] ?>"><button class="btn btn-danger btn-icon"><i class="fas fa-trash"></i></button></form>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/includes/foot.php'; ?>
