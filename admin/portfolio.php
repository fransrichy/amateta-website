<?php
require_once __DIR__ . '/includes/auth.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) { flash('err', 'Session expired.'); redirect('admin/portfolio.php'); }
    $action = $_POST['action'] ?? '';

    if ($action === 'save') {
        $id = (int) ($_POST['id'] ?? 0);
        $catId = (int) ($_POST['category_id'] ?? 0);
        $catName = '';
        if ($catId) { $crow = fetch_one('SELECT name FROM portfolio_categories WHERE id=?', [$catId]); $catName = $crow['name'] ?? ''; }
        $data = [
            clean($_POST['title'] ?? ''), clean($_POST['url'] ?? ''), $catName,
            clean($_POST['description'] ?? ''), (int) ($_POST['sort_order'] ?? 0), isset($_POST['active']) ? 1 : 0, $catId,
        ];
        $imgErr = null;
        $img = handle_upload('image', 'portfolio', $imgErr);
        if ($imgErr) { flash('err', $imgErr); redirect('admin/portfolio.php'); }

        if ($id > 0) {
            if ($img) {
                db()->prepare('UPDATE portfolio SET title=?,url=?,category=?,description=?,sort_order=?,active=?,category_id=?,image=? WHERE id=?')->execute([...$data, $img, $id]);
            } else {
                db()->prepare('UPDATE portfolio SET title=?,url=?,category=?,description=?,sort_order=?,active=?,category_id=? WHERE id=?')->execute([...$data, $id]);
            }
            flash('ok', 'Project updated.');
        } else {
            db()->prepare('INSERT INTO portfolio (title,url,category,description,sort_order,active,category_id,image) VALUES (?,?,?,?,?,?,?,?)')->execute([...$data, $img ?? '']);
            flash('ok', 'Project added.');
        }
        redirect('admin/portfolio.php');
    }
    if ($action === 'delete') { db()->prepare('DELETE FROM portfolio WHERE id=?')->execute([(int) $_POST['id']]); flash('ok', 'Project deleted.'); redirect('admin/portfolio.php'); }
    if ($action === 'toggle') { db()->prepare('UPDATE portfolio SET active=1-active WHERE id=?')->execute([(int) $_POST['id']]); redirect('admin/portfolio.php'); }
}

$editId = (int) ($_GET['edit'] ?? 0);
$edit = $editId ? fetch_one('SELECT * FROM portfolio WHERE id=?', [$editId]) : null;
$rows = fetch_all('SELECT * FROM portfolio ORDER BY sort_order, id');
$cats = fetch_all('SELECT * FROM portfolio_categories ORDER BY sort_order, id');

$page = 'portfolio'; $title = 'Portfolio Projects';
include __DIR__ . '/includes/head.php';
?>
<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-<?= $edit ? 'pen' : 'plus' ?>" style="color:var(--blue)"></i> <?= $edit ? 'Edit Project' : 'Add Project' ?></h2><?php if ($edit): ?><a href="portfolio.php" class="btn btn-light btn-sm"><i class="fas fa-xmark"></i> Cancel</a><?php endif; ?></div>
  <div class="panel-body">
    <form method="post" enctype="multipart/form-data">
      <?= csrf_field() ?><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?= (int) ($edit['id'] ?? 0) ?>">
      <div class="form-grid">
        <div class="fg"><label>Project Title</label><input type="text" name="title" value="<?= e($edit['title'] ?? '') ?>" required></div>
        <div class="fg"><label>Live URL</label><input type="url" name="url" value="<?= e($edit['url'] ?? '') ?>" placeholder="https://example.com"></div>
        <div class="fg"><label>Category</label><select name="category_id">
          <option value="0">— Uncategorised —</option>
          <?php foreach ($cats as $c): ?><option value="<?= $c['id'] ?>" <?= (int) ($edit['category_id'] ?? 0) === (int) $c['id'] ? 'selected' : '' ?>><?= e($c['name']) ?></option><?php endforeach; ?>
        </select><p class="help"><a href="portfolio-categories.php">Manage categories</a></p></div>
        <div class="fg"><label>Sort Order</label><input type="number" name="sort_order" value="<?= (int) ($edit['sort_order'] ?? count($rows)) ?>"></div>
        <div class="fg full"><label>Description</label><textarea name="description"><?= e($edit['description'] ?? '') ?></textarea></div>
        <div class="fg full"><label>Screenshot / Image <?= $edit ? '(leave empty to keep current)' : '' ?></label><input type="file" name="image" accept="image/*">
          <?php if (!empty($edit['image'])): ?><div style="margin-top:10px;"><img src="../<?= e($edit['image']) ?>" class="thumb" style="width:120px;height:72px;"></div><?php endif; ?>
          <label style="font-weight:500;display:flex;gap:8px;align-items:center;margin-top:12px;"><input type="checkbox" name="active" style="width:auto" <?= (!$edit || $edit['active']) ? 'checked' : '' ?>> Show on website</label>
        </div>
      </div>
      <button class="btn btn-primary"><i class="fas fa-floppy-disk"></i> <?= $edit ? 'Update' : 'Add Project' ?></button>
    </form>
  </div>
</div>

<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-briefcase" style="color:var(--blue)"></i> Projects (<?= count($rows) ?>)</h2></div>
  <div class="panel-body" style="padding:0;">
    <table>
      <thead><tr><th>Image</th><th>Title</th><th>Category</th><th>URL</th><th>Status</th><th style="text-align:right;">Actions</th></tr></thead>
      <tbody>
      <?php foreach ($rows as $p): ?>
        <tr>
          <td><?php if ($p['image']): ?><img src="../<?= e($p['image']) ?>" class="thumb" style="width:72px;height:46px;" onerror="this.style.opacity=.3"><?php else: ?><span class="muted">—</span><?php endif; ?></td>
          <td><strong><?= e($p['title']) ?></strong></td>
          <td class="muted"><?= e($p['category'] ?: '—') ?></td>
          <td><?php if ($p['url']): ?><a href="<?= e($p['url']) ?>" target="_blank" style="font-size:12px;"><?= e(preg_replace('#^https?://#', '', $p['url'])) ?></a><?php else: ?><span class="muted">—</span><?php endif; ?></td>
          <td><form method="post" style="display:inline"><?= csrf_field() ?><input type="hidden" name="action" value="toggle"><input type="hidden" name="id" value="<?= $p['id'] ?>"><button class="badge <?= $p['active'] ? 'badge-on' : 'badge-off' ?>" style="border:none;cursor:pointer;"><?= $p['active'] ? 'Visible' : 'Hidden' ?></button></form></td>
          <td style="text-align:right;white-space:nowrap;">
            <a href="portfolio.php?edit=<?= $p['id'] ?>" class="btn btn-light btn-icon"><i class="fas fa-pen"></i></a>
            <form method="post" style="display:inline" data-confirm="Delete this project?"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $p['id'] ?>"><button class="btn btn-danger btn-icon"><i class="fas fa-trash"></i></button></form>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/includes/foot.php'; ?>
