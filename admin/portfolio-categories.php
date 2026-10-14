<?php
require_once __DIR__ . '/includes/auth.php';
require_admin();

function slugify($s) { return trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($s)), '-'); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) { flash('err', 'Session expired.'); redirect('admin/portfolio-categories.php'); }
    $action = $_POST['action'] ?? '';

    if ($action === 'save') {
        $id = (int) ($_POST['id'] ?? 0);
        $name = clean($_POST['name'] ?? '');
        $data = [$name, slugify($name), clean($_POST['icon'] ?? 'fas fa-folder'),
                 clean($_POST['description'] ?? ''), (int) ($_POST['sort_order'] ?? 0), isset($_POST['active']) ? 1 : 0];
        if ($id > 0) {
            db()->prepare('UPDATE portfolio_categories SET name=?,slug=?,icon=?,description=?,sort_order=?,active=? WHERE id=?')->execute([...$data, $id]);
            flash('ok', 'Category updated.');
        } else {
            db()->prepare('INSERT INTO portfolio_categories (name,slug,icon,description,sort_order,active) VALUES (?,?,?,?,?,?)')->execute($data);
            flash('ok', 'Category added.');
        }
        redirect('admin/portfolio-categories.php');
    }
    if ($action === 'delete') {
        $id = (int) $_POST['id'];
        db()->prepare('UPDATE portfolio SET category_id=0 WHERE category_id=?')->execute([$id]);
        db()->prepare('DELETE FROM portfolio_categories WHERE id=?')->execute([$id]);
        flash('ok', 'Category deleted (projects kept, now uncategorised).');
        redirect('admin/portfolio-categories.php');
    }
    if ($action === 'toggle') { db()->prepare('UPDATE portfolio_categories SET active=1-active WHERE id=?')->execute([(int) $_POST['id']]); redirect('admin/portfolio-categories.php'); }
}

$editId = (int) ($_GET['edit'] ?? 0);
$edit = $editId ? fetch_one('SELECT * FROM portfolio_categories WHERE id=?', [$editId]) : null;
$rows = fetch_all('SELECT c.*, (SELECT COUNT(*) FROM portfolio p WHERE p.category_id=c.id) AS cnt FROM portfolio_categories c ORDER BY c.sort_order, c.id');

$page = 'portfolio-categories'; $title = 'Portfolio Categories';
include __DIR__ . '/includes/head.php';
?>
<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-<?= $edit ? 'pen' : 'plus' ?>" style="color:var(--blue)"></i> <?= $edit ? 'Edit Category' : 'Add Category' ?></h2><?php if ($edit): ?><a href="portfolio-categories.php" class="btn btn-light btn-sm"><i class="fas fa-xmark"></i> Cancel</a><?php endif; ?></div>
  <div class="panel-body">
    <form method="post">
      <?= csrf_field() ?><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?= (int) ($edit['id'] ?? 0) ?>">
      <div class="form-grid">
        <div class="fg"><label>Category Name</label><input type="text" name="name" value="<?= e($edit['name'] ?? '') ?>" placeholder="e.g. E-Commerce" required></div>
        <div class="fg"><label>Icon (Font Awesome)</label><input type="text" name="icon" value="<?= e($edit['icon'] ?? 'fas fa-folder') ?>" placeholder="fas fa-cart-shopping"></div>
        <div class="fg full"><label>Description</label><textarea name="description"><?= e($edit['description'] ?? '') ?></textarea></div>
        <div class="fg"><label>Sort Order</label><input type="number" name="sort_order" value="<?= (int) ($edit['sort_order'] ?? count($rows)) ?>"></div>
        <div class="fg"><label>Status</label><label style="font-weight:500;display:flex;gap:8px;align-items:center;margin-top:8px;"><input type="checkbox" name="active" style="width:auto" <?= (!$edit || $edit['active']) ? 'checked' : '' ?>> Active</label></div>
      </div>
      <button class="btn btn-primary"><i class="fas fa-floppy-disk"></i> <?= $edit ? 'Update' : 'Add Category' ?></button>
    </form>
  </div>
</div>

<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-folder-tree" style="color:var(--blue)"></i> Portfolio Categories (<?= count($rows) ?>)</h2><a href="portfolio.php" class="btn btn-light btn-sm"><i class="fas fa-briefcase"></i> Manage Projects</a></div>
  <div class="panel-body" style="padding:0;">
    <table>
      <thead><tr><th>Icon</th><th>Name</th><th>Projects</th><th>Order</th><th>Status</th><th style="text-align:right;">Actions</th></tr></thead>
      <tbody>
      <?php foreach ($rows as $c): ?>
        <tr>
          <td><span style="width:44px;height:44px;border-radius:10px;background:linear-gradient(135deg,#00b4d8,#0077b6);display:flex;align-items:center;justify-content:center;color:#fff;"><i class="<?= e($c['icon']) ?>"></i></span></td>
          <td><strong><?= e($c['name']) ?></strong><br><span class="muted" style="font-size:11px;"><?= e($c['slug']) ?></span></td>
          <td><span class="badge badge-on"><?= (int) $c['cnt'] ?></span></td>
          <td><?= (int) $c['sort_order'] ?></td>
          <td><form method="post" style="display:inline"><?= csrf_field() ?><input type="hidden" name="action" value="toggle"><input type="hidden" name="id" value="<?= $c['id'] ?>"><button class="badge <?= $c['active'] ? 'badge-on' : 'badge-off' ?>" style="border:none;cursor:pointer;"><?= $c['active'] ? 'Active' : 'Hidden' ?></button></form></td>
          <td style="text-align:right;white-space:nowrap;">
            <a href="portfolio-categories.php?edit=<?= $c['id'] ?>" class="btn btn-light btn-icon"><i class="fas fa-pen"></i></a>
            <form method="post" style="display:inline" data-confirm="Delete this category?"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $c['id'] ?>"><button class="btn btn-danger btn-icon"><i class="fas fa-trash"></i></button></form>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/includes/foot.php'; ?>
