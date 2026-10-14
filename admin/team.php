<?php
require_once __DIR__ . '/includes/auth.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) { flash('err', 'Session expired.'); redirect('admin/team.php'); }
    $action = $_POST['action'] ?? '';

    if ($action === 'save') {
        $id = (int) ($_POST['id'] ?? 0);
        $data = [
            clean($_POST['name'] ?? ''), clean($_POST['role'] ?? ''), clean($_POST['bio'] ?? ''),
            clean_email($_POST['email'] ?? ''), clean($_POST['phone'] ?? ''),
            clean($_POST['facebook'] ?? ''), clean($_POST['linkedin'] ?? ''), clean($_POST['instagram'] ?? ''),
            (int) ($_POST['sort_order'] ?? 0), isset($_POST['active']) ? 1 : 0,
        ];
        $imgErr = null;
        $photo = handle_upload('photo', 'team', $imgErr);
        if ($imgErr) { flash('err', $imgErr); redirect('admin/team.php'); }

        if ($id > 0) {
            if ($photo) {
                db()->prepare('UPDATE team SET name=?,role=?,bio=?,email=?,phone=?,facebook=?,linkedin=?,instagram=?,sort_order=?,active=?,photo=? WHERE id=?')->execute([...$data, $photo, $id]);
            } else {
                db()->prepare('UPDATE team SET name=?,role=?,bio=?,email=?,phone=?,facebook=?,linkedin=?,instagram=?,sort_order=?,active=? WHERE id=?')->execute([...$data, $id]);
            }
            flash('ok', 'Team member updated.');
        } else {
            db()->prepare('INSERT INTO team (name,role,bio,email,phone,facebook,linkedin,instagram,sort_order,active,photo) VALUES (?,?,?,?,?,?,?,?,?,?,?)')->execute([...$data, $photo ?? '']);
            flash('ok', 'Team member added.');
        }
        redirect('admin/team.php');
    }
    if ($action === 'delete') { db()->prepare('DELETE FROM team WHERE id=?')->execute([(int) $_POST['id']]); flash('ok', 'Team member removed.'); redirect('admin/team.php'); }
    if ($action === 'toggle') { db()->prepare('UPDATE team SET active=1-active WHERE id=?')->execute([(int) $_POST['id']]); redirect('admin/team.php'); }
}

$editId = (int) ($_GET['edit'] ?? 0);
$edit = $editId ? fetch_one('SELECT * FROM team WHERE id=?', [$editId]) : null;
$rows = fetch_all('SELECT * FROM team ORDER BY sort_order, id');

$page = 'team'; $title = 'Team Members';
include __DIR__ . '/includes/head.php';
?>
<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-<?= $edit ? 'pen' : 'plus' ?>" style="color:var(--blue)"></i> <?= $edit ? 'Edit Member' : 'Add Member' ?></h2><?php if ($edit): ?><a href="team.php" class="btn btn-light btn-sm"><i class="fas fa-xmark"></i> Cancel</a><?php endif; ?></div>
  <div class="panel-body">
    <form method="post" enctype="multipart/form-data">
      <?= csrf_field() ?><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?= (int) ($edit['id'] ?? 0) ?>">
      <div class="form-grid">
        <div class="fg"><label>Full Name</label><input type="text" name="name" value="<?= e($edit['name'] ?? '') ?>" required></div>
        <div class="fg"><label>Role / Title</label><input type="text" name="role" value="<?= e($edit['role'] ?? '') ?>" placeholder="Lead Developer"></div>
        <div class="fg full"><label>Short Bio</label><textarea name="bio"><?= e($edit['bio'] ?? '') ?></textarea></div>
        <div class="fg"><label>Email</label><input type="email" name="email" value="<?= e($edit['email'] ?? '') ?>"></div>
        <div class="fg"><label>Phone</label><input type="text" name="phone" value="<?= e($edit['phone'] ?? '') ?>"></div>
        <div class="fg"><label>LinkedIn URL</label><input type="url" name="linkedin" value="<?= e($edit['linkedin'] ?? '') ?>"></div>
        <div class="fg"><label>Facebook URL</label><input type="url" name="facebook" value="<?= e($edit['facebook'] ?? '') ?>"></div>
        <div class="fg"><label>Instagram URL</label><input type="url" name="instagram" value="<?= e($edit['instagram'] ?? '') ?>"></div>
        <div class="fg"><label>Sort Order</label><input type="number" name="sort_order" value="<?= (int) ($edit['sort_order'] ?? count($rows)) ?>"></div>
        <div class="fg full"><label>Photo <?= $edit ? '(leave empty to keep current)' : '' ?></label><input type="file" name="photo" accept="image/*">
          <?php if (!empty($edit['photo'])): ?><div style="margin-top:10px;"><img src="../<?= e($edit['photo']) ?>" class="thumb" style="border-radius:50%;"></div><?php endif; ?>
          <label style="font-weight:500;display:flex;gap:8px;align-items:center;margin-top:12px;"><input type="checkbox" name="active" style="width:auto" <?= (!$edit || $edit['active']) ? 'checked' : '' ?>> Show on website</label>
        </div>
      </div>
      <button class="btn btn-primary"><i class="fas fa-floppy-disk"></i> <?= $edit ? 'Update Member' : 'Add Member' ?></button>
    </form>
  </div>
</div>

<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-user-tie" style="color:var(--blue)"></i> Team (<?= count($rows) ?>)</h2></div>
  <div class="panel-body" style="padding:0;">
    <table>
      <thead><tr><th>Photo</th><th>Name</th><th>Role</th><th>Order</th><th>Status</th><th style="text-align:right;">Actions</th></tr></thead>
      <tbody>
      <?php if (!$rows): ?><tr><td colspan="6" class="muted" style="text-align:center;padding:24px;">No team members yet.</td></tr><?php endif; ?>
      <?php foreach ($rows as $m): ?>
        <tr>
          <td><?php if ($m['photo']): ?><img src="../<?= e($m['photo']) ?>" class="thumb" style="border-radius:50%;" onerror="this.style.opacity=.3"><?php else: ?><span class="thumb" style="display:flex;align-items:center;justify-content:center;background:#eef3f8;border-radius:50%;"><i class="fas fa-user muted"></i></span><?php endif; ?></td>
          <td><strong><?= e($m['name']) ?></strong></td>
          <td class="muted"><?= e($m['role']) ?></td>
          <td><?= (int) $m['sort_order'] ?></td>
          <td><form method="post" style="display:inline"><?= csrf_field() ?><input type="hidden" name="action" value="toggle"><input type="hidden" name="id" value="<?= $m['id'] ?>"><button class="badge <?= $m['active'] ? 'badge-on' : 'badge-off' ?>" style="border:none;cursor:pointer;"><?= $m['active'] ? 'Visible' : 'Hidden' ?></button></form></td>
          <td style="text-align:right;white-space:nowrap;">
            <a href="team.php?edit=<?= $m['id'] ?>" class="btn btn-light btn-icon"><i class="fas fa-pen"></i></a>
            <form method="post" style="display:inline" data-confirm="Remove this team member?"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $m['id'] ?>"><button class="btn btn-danger btn-icon"><i class="fas fa-trash"></i></button></form>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/includes/foot.php'; ?>
