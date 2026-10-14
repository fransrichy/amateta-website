<?php
/** AMATETA — Portfolio (self-contained, database-driven). */
require_once __DIR__ . '/config/config.php';
$categories = fetch_all('SELECT * FROM portfolio_categories WHERE active = 1 ORDER BY sort_order, id');
$projects   = fetch_all('SELECT * FROM portfolio WHERE active = 1 ORDER BY sort_order, id');

$byCat = [];
$uncategorised = [];
foreach ($projects as $p) {
    if (!empty($p['category_id'])) { $byCat[(int) $p['category_id']][] = $p; }
    else { $uncategorised[] = $p; }
}

function portfolio_card(array $p): void { ?>
  <a href="<?= e($p['url']) ?>" target="_blank" rel="noopener" class="portfolio-card" style="text-decoration:none;display:block;">
    <div class="portfolio-img">
      <?php if ($p['category']): ?><span class="portfolio-cat"><?= e($p['category']) ?></span><?php endif; ?>
      <?php if ($p['image']): ?><img src="<?= e(img_src($p['image'])) ?>" alt="<?= e($p['title']) ?>" loading="lazy"><?php else: ?><div class="pf-fallback"><i class="fas fa-globe"></i></div><?php endif; ?>
    </div>
    <div class="portfolio-body">
      <h4><?= e($p['title']) ?></h4>
      <p><?= e($p['description']) ?></p>
      <span class="service-tag"><i class="fas fa-external-link-alt"></i> Visit Live Site</span>
    </div>
  </a>
<?php }

page_head('Our Portfolio · ' . get_setting('company_name', COMPANY_NAME), 'Websites, online shops and systems designed and developed by AMATETA Techs & Designs.', 'portfolio');
?>

<section class="page-hero">
  <div class="container">
    <h1>Our <span>Portfolio</span></h1>
    <p>Some of the recently developed platforms we have proudly designed, built and launched for our clients.</p>
    <div class="breadcrumb"><a href="index.php">Home</a><i class="fas fa-chevron-right"></i><span>Portfolio</span></div>
  </div>
</section>

<!-- Category quick-jump chips -->
<section style="background:var(--offwhite);padding:34px 0 0;">
  <div class="container">
    <div class="text-center" style="margin-bottom:18px;">
      <span class="section-label"><i class="fas fa-folder-tree"></i>Browse by Category</span>
      <h2 class="section-title">Our <span>Work</span> by Category</h2>
      <div class="divider"></div>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
      <?php foreach ($categories as $c): if (empty($byCat[(int) $c['id']])) continue; ?>
        <a href="#pcat-<?= e($c['slug'] ?: $c['id']) ?>" class="hero-chip" style="background:rgba(0,180,216,.1);border:1px solid rgba(0,180,216,.25);color:var(--blue2);padding:8px 16px;text-decoration:none;">
          <i class="<?= e($c['icon']) ?>"></i> <?= e($c['name']) ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php foreach ($categories as $idx => $c): $list = $byCat[(int) $c['id']] ?? []; if (!$list) continue; ?>
  <section class="section-pad-sm" id="pcat-<?= e($c['slug'] ?: $c['id']) ?>" style="background:<?= $idx % 2 ? '#fff' : 'var(--offwhite)' ?>;padding-top:46px;">
    <div class="container">
      <div style="display:flex;align-items:center;gap:16px;margin-bottom:24px;flex-wrap:wrap;">
        <div style="width:54px;height:54px;border-radius:14px;background:linear-gradient(135deg,var(--blue),var(--blue2));color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0;"><i class="<?= e($c['icon']) ?>"></i></div>
        <div style="flex:1;min-width:200px;">
          <h2 class="section-title" style="margin-bottom:4px;font-size:clamp(1.4rem,3vw,2rem);"><?= e($c['name']) ?></h2>
          <?php if ($c['description']): ?><p style="color:var(--text-muted);font-size:0.9rem;"><?= e($c['description']) ?></p><?php endif; ?>
        </div>
      </div>
      <div class="portfolio-grid"><?php foreach ($list as $p) portfolio_card($p); ?></div>
    </div>
  </section>
<?php endforeach; ?>

<?php if ($uncategorised): ?>
  <section class="section-pad-sm" style="background:var(--offwhite);">
    <div class="container">
      <h2 class="section-title" style="margin-bottom:22px;">More <span>Projects</span></h2>
      <div class="portfolio-grid"><?php foreach ($uncategorised as $p) portfolio_card($p); ?></div>
    </div>
  </section>
<?php endif; ?>

<section class="section-pad-sm" style="background:#fff;">
  <div class="container text-center">
    <p style="color:var(--text-muted);max-width:640px;margin:0 auto 22px;line-height:1.7;">Thank you for viewing our work. We look forward to helping you bring your next digital project to life — website development, e-commerce platforms, booking systems, invoicing solutions and custom software.</p>
    <a href="contact.php" class="btn btn-primary btn-lg"><i class="fas fa-rocket"></i> Start Your Project</a>
    <a href="<?= e(wa_link('Hello, I would like to discuss a project')) ?>" target="_blank" class="btn btn-orange btn-lg"><i class="fab fa-whatsapp"></i> Chat on WhatsApp</a>
  </div>
</section>

<?php page_foot(); ?>
