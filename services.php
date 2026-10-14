<?php
/** AMATETA — All Services (self-contained, database-driven). */
require_once __DIR__ . '/config/config.php';
$categories = fetch_all('SELECT * FROM service_categories WHERE active = 1 ORDER BY sort_order, id');
$services   = fetch_all('SELECT * FROM services WHERE active = 1 ORDER BY sort_order, id');

// Group services under their category
$byCat = [];
$uncategorised = [];
foreach ($services as $s) {
    if (!empty($s['category_id'])) { $byCat[(int) $s['category_id']][] = $s; }
    else { $uncategorised[] = $s; }
}

// Helper to render one service card
function service_card(array $s): void { ?>
  <div class="service-card<?= $s['featured'] ? ' stamps-featured' : '' ?>">
    <div class="service-img-wrap">
      <img src="<?= e(img_src($s['image'])) ?>" alt="<?= e($s['title']) ?>" class="service-img" loading="lazy"
           onerror="this.parentElement.innerHTML='<div class=\'service-img-placeholder sip-1\'><i class=\'<?= e($s['icon']) ?>\'></i></div>'">
    </div>
    <div class="service-body">
      <div class="service-icon" style="background:<?= e($s['color']) ?>;"><i class="<?= e($s['icon']) ?>"></i></div>
      <h4><?= e($s['title']) ?></h4>
      <p><?= e($s['description']) ?></p>
      <?php if ($s['tag']): ?><span class="service-tag"><?= e($s['tag']) ?></span><?php endif; ?>
      <?php if (!empty($s['link'])): ?>
        <a href="<?= e($s['link']) ?>" class="btn btn-outline-navy btn-sm" style="width:100%;margin-top:12px;"><i class="fas fa-circle-info"></i> View Details</a>
      <?php endif; ?>
      <a href="<?= e(wa_link($s['wa_text'] ?: ('I would like a quote for ' . $s['title']))) ?>" target="_blank" class="btn btn-wa btn-sm"><i class="fab fa-whatsapp"></i> Order on WhatsApp</a>
    </div>
  </div>
<?php }

page_head('Our Services · ' . get_setting('company_name', COMPANY_NAME), 'Full list of AMATETA services by category — web development, hosting & domains, printing, company stamps, digital marketing, IT support and more in Windhoek, Namibia.', 'services');
?>

<section class="page-hero">
  <div class="container">
    <h1>Our <span>Services</span></h1>
    <p>Everything your business needs under one roof — technology, design, printing and IT. Tap <strong>Order on WhatsApp</strong> on any service to get started in seconds.</p>
    <div class="breadcrumb"><a href="index.php">Home</a><i class="fas fa-chevron-right"></i><span>Services</span></div>
  </div>
</section>

<!-- Category quick-jump chips -->
<section style="background:var(--offwhite);padding:34px 0 0;">
  <div class="container">
    <div class="text-center" style="margin-bottom:18px;">
      <span class="section-label"><i class="fas fa-folder-tree"></i>Browse by Category</span>
      <h2 class="section-title">Our <span>Services</span> by Category</h2>
      <div class="divider"></div>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
      <?php foreach ($categories as $c): if (empty($byCat[(int) $c['id']])) continue; ?>
        <a href="#cat-<?= e($c['slug'] ?: $c['id']) ?>" class="hero-chip" style="background:rgba(0,180,216,.1);border:1px solid rgba(0,180,216,.25);color:var(--blue2);padding:8px 16px;text-decoration:none;">
          <i class="<?= e($c['icon']) ?>"></i> <?= e($c['name']) ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php foreach ($categories as $idx => $c): $list = $byCat[(int) $c['id']] ?? []; if (!$list) continue; ?>
  <section class="section-pad<?= $idx % 2 ? '' : '-sm' ?>" id="cat-<?= e($c['slug'] ?: $c['id']) ?>" style="background:<?= $idx % 2 ? '#fff' : 'var(--offwhite)' ?>;padding-top:46px;">
    <div class="container">
      <div style="display:flex;align-items:center;gap:16px;margin-bottom:26px;flex-wrap:wrap;">
        <div style="width:54px;height:54px;border-radius:14px;background:linear-gradient(135deg,var(--blue),var(--blue2));color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0;"><i class="<?= e($c['icon']) ?>"></i></div>
        <div style="flex:1;min-width:200px;">
          <h2 class="section-title" style="margin-bottom:4px;font-size:clamp(1.4rem,3vw,2rem);"><?= e($c['name']) ?></h2>
          <?php if ($c['description']): ?><p style="color:var(--text-muted);font-size:0.9rem;"><?= e($c['description']) ?></p><?php endif; ?>
        </div>
        <a href="<?= e(wa_link('I am interested in your ' . $c['name'] . ' services')) ?>" target="_blank" class="btn btn-wa" style="width:auto;"><i class="fab fa-whatsapp"></i> Enquire</a>
      </div>
      <div class="services-grid">
        <?php foreach ($list as $s) service_card($s); ?>
      </div>
    </div>
  </section>
<?php endforeach; ?>

<?php if ($uncategorised): ?>
  <section class="section-pad-sm" style="background:var(--offwhite);">
    <div class="container">
      <h2 class="section-title" style="margin-bottom:22px;">More <span>Services</span></h2>
      <div class="services-grid"><?php foreach ($uncategorised as $s) service_card($s); ?></div>
    </div>
  </section>
<?php endif; ?>

<section class="section-pad-sm" style="background:#fff;">
  <div class="container">
    <div class="all-services-bar" style="margin-top:0;">
      <a href="contact.php" class="btn btn-primary btn-lg"><i class="fas fa-envelope"></i> Request a Detailed Quote</a>
      <a href="<?= e(wa_link('Hello, I would like to discuss a service')) ?>" target="_blank" class="btn btn-orange btn-lg"><i class="fab fa-whatsapp"></i> Chat With Us Now</a>
    </div>
  </div>
</section>

<!-- ========== CTA ========== -->
<section class="cta-section section-pad-sm">
  <div class="container">
    <div class="cta-inner">
      <span class="section-label" style="background:rgba(247,127,0,0.15);border-color:rgba(247,127,0,0.3);color:var(--orange);margin-bottom:18px;"><i class="fas fa-rocket"></i>Let's Build</span>
      <h2>Not Sure Which Service<br>You Need?</h2>
      <p>Tell us about your project and we'll recommend the perfect solution. Free consultation — no obligations.</p>
      <div class="cta-btns">
        <a href="contact.php" class="btn btn-primary btn-lg"><i class="far fa-calendar-check"></i>Get Free Consultation</a>
        <a href="<?= e(wa_link()) ?>" target="_blank" class="btn btn-orange btn-lg"><i class="fab fa-whatsapp"></i>WhatsApp Us</a>
      </div>
    </div>
  </div>
</section>

<?php page_foot(); ?>
