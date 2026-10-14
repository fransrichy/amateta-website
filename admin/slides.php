<?php
require_once __DIR__ . '/includes/auth.php';
require_admin();

$action = $_POST['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) { flash('err', 'Session expired, please retry.'); redirect('admin/slides.php'); }

    if ($action === 'save') {
        $id    = (int) ($_POST['id'] ?? 0);
        $title = clean($_POST['title'] ?? '');
        $sub   = clean($_POST['subtitle'] ?? '');
        $bt    = clean($_POST['button_text'] ?? '');
        $bl    = clean($_POST['button_link'] ?? '');
        $order = (int) ($_POST['sort_order'] ?? 0);
        $active = isset($_POST['active']) ? 1 : 0;

        $imgErr = null;
        $newImg = handle_upload('image', 'slides', $imgErr);
        if ($imgErr) { flash('err', $imgErr); redirect('admin/slides.php'); }

        if ($id > 0) {
            if ($newImg) {
                db()->prepare('UPDATE slides SET title=?,subtitle=?,image=?,button_text=?,button_link=?,sort_order=?,active=? WHERE id=?')
                    ->execute([$title, $sub, $newImg, $bt, $bl, $order, $active, $id]);
            } else {
                db()->prepare('UPDATE slides SET title=?,subtitle=?,button_text=?,button_link=?,sort_order=?,active=? WHERE id=?')
                    ->execute([$title, $sub, $bt, $bl, $order, $active, $id]);
            }
            flash('ok', 'Slide updated.');
        } else {
            db()->prepare('INSERT INTO slides (title,subtitle,image,button_text,button_link,sort_order,active) VALUES (?,?,?,?,?,?,?)')
                ->execute([$title, $sub, $newImg ?? '', $bt, $bl, $order, $active]);
            flash('ok', 'Slide added.');
        }
        redirect('admin/slides.php');
    }

    if ($action === 'delete') {
        db()->prepare('DELETE FROM slides WHERE id=?')->execute([(int) $_POST['id']]);
        flash('ok', 'Slide deleted.');
        redirect('admin/slides.php');
    }

    if ($action === 'toggle') {
        db()->prepare('UPDATE slides SET active = 1 - active WHERE id=?')->execute([(int) $_POST['id']]);
        redirect('admin/slides.php');
    }
}

$editId = (int) ($_GET['edit'] ?? 0);
$edit   = $editId ? fetch_one('SELECT * FROM slides WHERE id=?', [$editId]) : null;
$slides = fetch_all('SELECT * FROM slides ORDER BY sort_order, id');

$page = 'slides'; $title = 'Home Slideshow';
include __DIR__ . '/includes/head.php';
?>
<div class="panel">
  <div class="panel-head">
    <h2><i class="fas fa-<?= $edit ? 'pen' : 'plus' ?>" style="color:var(--blue)"></i> <?= $edit ? 'Edit Slide' : 'Add New Slide' ?></h2>
    <?php if ($edit): ?><a href="slides.php" class="btn btn-light btn-sm"><i class="fas fa-xmark"></i> Cancel edit</a><?php endif; ?>
  </div>
  <div class="panel-body">
    <form method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <input type="hidden" name="action" value="save">
      <input type="hidden" name="id" value="<?= (int) ($edit['id'] ?? 0) ?>">
      <div class="form-grid">
        <div class="fg full"><label>Slide Title</label><input type="text" name="title" value="<?= e($edit['title'] ?? '') ?>" placeholder="e.g. Premium Web Development"></div>
        <div class="fg full"><label>Subtitle</label><input type="text" name="subtitle" value="<?= e($edit['subtitle'] ?? '') ?>" placeholder="Short supporting line"></div>
        <div class="fg"><label>Button Text</label><input type="text" name="button_text" value="<?= e($edit['button_text'] ?? '') ?>" placeholder="Explore Services"></div>
        <div class="fg"><label>Button Link</label><input type="text" name="button_link" value="<?= e($edit['button_link'] ?? '') ?>" placeholder="services.php"></div>
        <div class="fg"><label>Sort Order</label><input type="number" name="sort_order" value="<?= (int) ($edit['sort_order'] ?? count($slides)) ?>"></div>
        <div class="fg"><label>Status</label><label style="font-weight:500;display:flex;gap:8px;align-items:center;margin-top:8px;"><input type="checkbox" name="active" style="width:auto" <?= (!$edit || $edit['active']) ? 'checked' : '' ?>> Active (visible on site)</label></div>
        <div class="fg full">
          <label>Slide Image <?= $edit ? '(leave empty to keep current)' : '' ?></label>
          <input type="file" name="image" accept="image/*">
          <?php if (!empty($edit['image'])): ?><div style="margin-top:10px;"><img src="../<?= e($edit['image']) ?>" class="thumb" style="width:120px;height:70px;"></div><?php endif; ?>
          <p class="help">Recommended: wide image (1600×900). JPG, PNG, WEBP or AVIF, max 8 MB.</p>
        </div>
      </div>
      <button type="submit" class="btn btn-primary"><i class="fas fa-floppy-disk"></i> <?= $edit ? 'Update Slide' : 'Add Slide' ?></button>
    </form>
  </div>
</div>

<div class="panel">
  <div class="panel-head"><h2><i class="fas fa-images" style="color:var(--blue)"></i> All Slides (<?= count($slides) ?>)</h2></div>
  <div class="panel-body" style="padding:0;">
    <table>
      <thead><tr><th>#</th><th>Image</th><th>Title</th><th>Button</th><th>Order</th><th>Status</th><th style="text-align:right;">Actions</th></tr></thead>
      <tbody>
      <?php if (!$slides): ?>
        <tr><td colspan="7" class="muted" style="text-align:center;padding:24px;">No slides yet — add your first one above.</td></tr>
      <?php else: foreach ($slides as $i => $s): ?>
        <tr>
          <td class="muted"><?= $i + 1 ?></td>
          <td><?php if ($s['image']): ?><img src="../<?= e($s['image']) ?>" class="thumb" style="width:80px;height:48px;" onerror="this.style.opacity=.3"><?php else: ?><span class="muted">—</span><?php endif; ?></td>
          <td><strong><?= e($s['title'] ?: 'Untitled') ?></strong><br><span class="muted" style="font-size:11.5px;"><?= e($s['subtitle']) ?></span></td>
          <td class="muted"><?= e($s['button_text'] ?: '—') ?></td>
          <td><?= (int) $s['sort_order'] ?></td>
          <td>
            <form method="post" style="display:inline">
              <?= csrf_field() ?><input type="hidden" name="action" value="toggle"><input type="hidden" name="id" value="<?= $s['id'] ?>">
              <button class="badge <?= $s['active'] ? 'badge-on' : 'badge-off' ?>" style="border:none;cursor:pointer;"><?= $s['active'] ? 'Active' : 'Hidden' ?></button>
            </form>
          </td>
          <td style="text-align:right;white-space:nowrap;">
            <a href="slides.php?edit=<?= $s['id'] ?>" class="btn btn-light btn-icon" title="Edit"><i class="fas fa-pen"></i></a>
            <form method="post" style="display:inline" data-confirm="Delete this slide?">
              <?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $s['id'] ?>">
              <button class="btn btn-danger btn-icon" title="Delete"><i class="fas fa-trash"></i></button>
            </form>
          </td>
        </tr>
      <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/includes/foot.php'; ?>
