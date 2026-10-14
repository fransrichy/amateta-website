<?php
require_once __DIR__ . '/includes/auth.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) { flash('err', 'Session expired.'); redirect('admin/services.php'); }
    $action = $_POST['action'] ?? '';

    if ($action === 'save') {
        $id    = (int) ($_POST['id'] ?? 0);
        $data = [
            clean($_POST['title'] ?? ''),
            clean($_POST['description'] ?? ''),
            clean($_POST['icon'] ?? 'fas fa-star'),
            clean($_POST['color'] ?? 'linear-gradient(135deg,#00b4d8,#0077b6)'),
            clean($_POST['tag'] ?? ''),
            clean($_POST['wa_text'] ?? ''),
            (int) ($_POST['sort_order'] ?? 0),
            isset($_POST['featured']) ? 1 : 0,
            isset($_POST['active']) ? 1 : 0,
            (int) ($_POST['category_id'] ?? 0),
            clean($_POST['link'] ?? ''),
        ];
        $imgErr = null;
        $newImg = handle_upload('image', 'services', $imgErr);
        if ($imgErr) { flash('err', $imgErr); redirect('admin/services.php'); }

        if ($id > 0) {
            if ($newImg) {
                db()->prepare('UPDATE services SET title=?,description=?,icon=?,color=?,tag=?,wa_text=?,sort_order=?,featured=?,active=?,category_id=?,link=?,image=? WHERE id=?')
                    ->execute([...$data, $newImg, $id]);
            } else {
                db()->prepare('UPDATE services SET title=?,description=?,icon=?,color=?,tag=?,wa_text=?,sort_order=?,featured=?,active=?,category_id=?,link=? WHERE id=?')
                    ->execute([...$data, $id]);
            }
            flash('ok', 'Service updated.');
        } else {
            db()->prepare('INSERT INTO services (title,description,icon,color,tag,wa_text,sort_order,featured,active,category_id,link,image) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)')
                ->execute([...$data, $newImg ?? '']);
            flash('ok', 'Service added.');
        }
        redirect('admin/services.php');
    }
    if ($action === 'delete') { db()->prepare('DELETE FROM services WHERE id=?')->execute([(int) $_POST['id']]); flash('ok', 'Service deleted.'); redirect('admin/services.php'); }
    if ($action === 'toggle') { db()->prepare('UPDATE services SET active=1-active WHERE id=?')->execute([(int) $_POST['id']]); redirect('admin/services.php'); }
}

$editId = (int) ($_GET['edit'] ?? 0);
$edit   = $editId ? fetch_one('SELECT * FROM services WHERE id=?', [$editId]) : null;
$rows   = fetch_all('SELECT s.*, c.name AS cat_name FROM services s LEFT JOIN service_categories c ON c.id=s.category_id ORDER BY s.sort_order, s.id');
$cats   = fetch_all('SELECT * FROM service_categories ORDER BY sort_order, id');

$icons = ['fas fa-code','fas fa-server','fas fa-tools','fas fa-headset','fas fa-bullhorn','fas fa-palette','fas fa-tshirt','fas fa-print','fas fa-stamp','fas fa-video','fas fa-wifi','fas fa-book-open','fas fa-pen-nib','fas fa-desktop','fas fa-mobile-screen','fas fa-shield-halved'];
$colors = [
    'Blue' => 'linear-gradient(135deg,#00b4d8,#0077b6)',
    'Orange' => 'linear-gradient(135deg,#f77f00,#e36200)',
    'Indigo' => 'linear-gradient(135deg,#3949ab,#283593)',
    'Teal' => 'linear-gradient(135deg,#00897b,#004d40)',
    'Pink' => 'linear-gradient(135deg,#c2185b,#880e4f)',
    'Purple' => 'linear-gradient(135deg,#9c27b0,#6a1b9a)',
];

$page = 'services'; $title = 'Services';
include __DIR__ . '/includes/head.php';
?>
<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-<?= $edit ? 'pen' : 'plus' ?>" style="color:var(--blue)"></i> <?= $edit ? 'Edit Service' : 'Add Service' ?></h2><?php if ($edit): ?><a href="services.php" class="btn btn-light btn-sm"><i class="fas fa-xmark"></i> Cancel</a><?php endif; ?></div>
  <div class="panel-body">
    <form method="post" enctype="multipart/form-data">
      <?= csrf_field() ?><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?= (int) ($edit['id'] ?? 0) ?>">
      <div class="form-grid">
        <div class="fg full"><label>Service Title</label><input type="text" name="title" value="<?= e($edit['title'] ?? '') ?>" required></div>
        <div class="fg full"><label>Description</label><textarea name="description"><?= e($edit['description'] ?? '') ?></textarea></div>
        <div class="fg"><label>Icon</label><select name="icon"><?php foreach ($icons as $ic): ?><option value="<?= e($ic) ?>" <?= ($edit['icon'] ?? '') === $ic ? 'selected' : '' ?>><?= e($ic) ?></option><?php endforeach; ?></select><p class="help">Font Awesome class</p></div>
        <div class="fg"><label>Icon Colour</label><select name="color"><?php foreach ($colors as $n => $c): ?><option value="<?= e($c) ?>" <?= ($edit['color'] ?? '') === $c ? 'selected' : '' ?>><?= e($n) ?></option><?php endforeach; ?></select></div>
        <div class="fg"><label>Category</label><select name="category_id">
          <option value="0">— Uncategorised —</option>
          <?php foreach ($cats as $c): ?><option value="<?= $c['id'] ?>" <?= (int) ($edit['category_id'] ?? 0) === (int) $c['id'] ? 'selected' : '' ?>><?= e($c['name']) ?></option><?php endforeach; ?>
        </select><p class="help"><a href="categories.php">Manage categories</a></p></div>
        <div class="fg"><label>Tag line</label><input type="text" name="tag" value="<?= e($edit['tag'] ?? '') ?>" placeholder="HTML · PHP · React"></div>
        <div class="fg"><label>WhatsApp order text</label><input type="text" name="wa_text" value="<?= e($edit['wa_text'] ?? '') ?>" placeholder="I would like a quote for…"></div>
        <div class="fg full"><label>Detail Page Link (the "View Details" button)</label><input type="text" name="link" value="<?= e($edit['link'] ?? '') ?>" placeholder="web-development.php  or  https://…"><p class="help">Page this service links to. Leave empty to hide the View Details button.</p></div>
        <div class="fg"><label>Sort Order</label><input type="number" name="sort_order" value="<?= (int) ($edit['sort_order'] ?? count($rows)) ?>"></div>
        <div class="fg"><label>Options</label>
          <label style="font-weight:500;display:flex;gap:8px;align-items:center;"><input type="checkbox" name="active" style="width:auto" <?= (!$edit || $edit['active']) ? 'checked' : '' ?>> Active</label>
          <label style="font-weight:500;display:flex;gap:8px;align-items:center;margin-top:6px;"><input type="checkbox" name="featured" style="width:auto" <?= ($edit['featured'] ?? 0) ? 'checked' : '' ?>> Featured (highlighted)</label>
        </div>
        <div class="fg full"><label>Image <?= $edit ? '(leave empty to keep current)' : '' ?></label><input type="file" name="image" accept="image/*">
          <?php if (!empty($edit['image'])): ?><div style="margin-top:10px;"><img src="../<?= e($edit['image']) ?>" class="thumb"></div><?php endif; ?>
        </div>
      </div>
      <button class="btn btn-primary"><i class="fas fa-floppy-disk"></i> <?= $edit ? 'Update' : 'Add Service' ?></button>
    </form>
  </div>
</div>

<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-cogs" style="color:var(--blue)"></i> All Services (<?= count($rows) ?>)</h2></div>
  <div class="panel-body" style="padding:0;">
    <table>
      <thead><tr><th>Image</th><th>Title</th><th>Tag</th><th>Order</th><th>Status</th><th style="text-align:right;">Actions</th></tr></thead>
      <tbody>
      <?php foreach ($rows as $s): ?>
        <tr>
          <td><?php if ($s['image']): ?><img src="../<?= e($s['image']) ?>" class="thumb" onerror="this.style.opacity=.3"><?php else: ?><span style="width:54px;height:54px;border-radius:9px;background:<?= e($s['color']) ?>;display:flex;align-items:center;justify-content:center;color:#fff;"><i class="<?= e($s['icon']) ?>"></i></span><?php endif; ?></td>
          <td><strong><?= e($s['title']) ?></strong><?php if ($s['featured']): ?> <span class="badge badge-new">Featured</span><?php endif; ?></td>
          <td class="muted"><?= e($s['tag'] ?: '—') ?></td>
          <td><?= (int) $s['sort_order'] ?></td>
          <td><form method="post" style="display:inline"><?= csrf_field() ?><input type="hidden" name="action" value="toggle"><input type="hidden" name="id" value="<?= $s['id'] ?>"><button class="badge <?= $s['active'] ? 'badge-on' : 'badge-off' ?>" style="border:none;cursor:pointer;"><?= $s['active'] ? 'Active' : 'Hidden' ?></button></form></td>
          <td style="text-align:right;white-space:nowrap;">
            <a href="services.php?edit=<?= $s['id'] ?>" class="btn btn-light btn-icon"><i class="fas fa-pen"></i></a>
            <form method="post" style="display:inline" data-confirm="Delete this service?"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $s['id'] ?>"><button class="btn btn-danger btn-icon"><i class="fas fa-trash"></i></button></form>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/includes/foot.php'; ?>
