<?php
/** AMATETA — Hosting & Domains (self-contained, shared header/footer). */
require_once __DIR__ . '/config/config.php';
page_head('Web Hosting & Domain Registration · ' . get_setting('company_name', COMPANY_NAME),
    'Reliable web hosting, .com & .na domain registration, SSL certificates and website management in Windhoek, Namibia.', 'services');

$plans = [
    ['Starter', 'N$99', '/mo', 'fas fa-leaf', false, ['10 GB SSD Storage', '5 Email Accounts', 'Free SSL Certificate', '1 Website', 'Daily Backups', '99.9% Uptime']],
    ['Business', 'N$199', '/mo', 'fas fa-rocket', true, ['50 GB SSD Storage', 'Unlimited Emails', 'Free SSL + Domain', '5 Websites', 'Daily Backups', 'Priority Support']],
    ['Premium', 'N$349', '/mo', 'fas fa-crown', false, ['150 GB SSD Storage', 'Unlimited Emails', 'Free SSL + Domain', 'Unlimited Websites', 'Hourly Backups', '24/7 Priority Support']],
];
$domains = [['.com', 'N$249/yr'], ['.na', 'N$450/yr'], ['.co.na', 'N$399/yr'], ['.org', 'N$280/yr'], ['.net', 'N$260/yr'], ['.shop', 'N$320/yr']];
?>

<section class="page-hero">
  <div class="container">
    <h1>Web <span>Hosting</span> & Domains</h1>
    <p>Fast, secure and reliable hosting with a 99.9% uptime guarantee — plus .com and .na domain registration, SSL certificates and full website management.</p>
    <div class="breadcrumb"><a href="index.php">Home</a><i class="fas fa-chevron-right"></i><a href="services.php">Services</a><i class="fas fa-chevron-right"></i><span>Hosting & Domains</span></div>
    <div style="margin-top:24px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
      <a href="<?= e(wa_link('Hello, I would like a hosting plan')) ?>" target="_blank" class="btn btn-orange btn-lg"><i class="fab fa-whatsapp"></i> Order Hosting</a>
      <a href="#domains" class="btn btn-primary btn-lg"><i class="fas fa-globe"></i> Register a Domain</a>
    </div>
  </div>
</section>

<!-- Hosting plans -->
<section class="section-pad" style="background:var(--offwhite);">
  <div class="container">
    <div class="text-center" style="margin-bottom:42px;">
      <span class="section-label"><i class="fas fa-server"></i>Hosting Plans</span>
      <h2 class="section-title">Choose Your <span>Hosting Plan</span></h2>
      <div class="divider"></div>
      <p class="section-sub">All plans include free SSL, daily backups and our 99.9% uptime guarantee. Upgrade anytime.</p>
    </div>
    <div class="services-grid" style="grid-template-columns:repeat(3,1fr);">
      <?php foreach ($plans as $p): ?>
        <div class="service-card<?= $p[4] ? ' stamps-featured' : '' ?>" style="text-align:center;">
          <div class="service-body" style="padding:30px 24px;">
            <?php if ($p[4]): ?><span style="position:absolute;top:14px;right:14px;background:linear-gradient(135deg,var(--orange),#e36200);color:#fff;font-size:0.66rem;font-weight:700;padding:4px 12px;border-radius:50px;">POPULAR</span><?php endif; ?>
            <div class="service-icon" style="margin:0 auto 14px;width:56px;height:56px;font-size:1.4rem;background:linear-gradient(135deg,var(--blue),var(--blue2));"><i class="<?= e($p[3]) ?>"></i></div>
            <h4 style="font-size:1.2rem;"><?= e($p[0]) ?></h4>
            <div style="margin:10px 0 18px;"><span style="font-family:var(--ff-head);font-size:2.2rem;font-weight:800;color:var(--navy);"><?= e($p[1]) ?></span><span style="color:var(--text-muted);font-size:0.9rem;"><?= e($p[2]) ?></span></div>
            <ul style="list-style:none;text-align:left;margin-bottom:22px;display:flex;flex-direction:column;gap:9px;">
              <?php foreach ($p[5] as $f): ?><li style="font-size:0.86rem;color:#3a5472;display:flex;gap:9px;align-items:center;"><i class="fas fa-check-circle" style="color:var(--blue);"></i><?= e($f) ?></li><?php endforeach; ?>
            </ul>
            <a href="<?= e(wa_link('I would like the ' . $p[0] . ' hosting plan (' . $p[1] . $p[2] . ')')) ?>" target="_blank" class="btn btn-wa" style="width:100%;"><i class="fab fa-whatsapp"></i> Order <?= e($p[0]) ?></a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Domains -->
<section class="section-pad" id="domains" style="background:#fff;">
  <div class="container">
    <div class="text-center" style="margin-bottom:42px;">
      <span class="section-label"><i class="fas fa-globe"></i>Domain Registration</span>
      <h2 class="section-title">Register Your <span>Perfect Domain</span></h2>
      <div class="divider"></div>
      <p class="section-sub">Secure your brand with a memorable domain name. We handle registration, transfers and renewals.</p>
    </div>
    <div class="tiles-grid" style="grid-template-columns:repeat(3,1fr);max-width:760px;margin:0 auto;">
      <?php foreach ($domains as $d): ?>
        <div class="tile-card" style="text-align:center;">
          <div class="tile-body" style="align-items:center;">
            <div style="font-family:var(--ff-head);font-size:1.6rem;font-weight:800;color:var(--blue2);"><?= e($d[0]) ?></div>
            <p style="text-align:center;color:var(--text-muted);margin:6px 0 12px;"><?= e($d[1]) ?></p>
            <a href="<?= e(wa_link('I would like to register a ' . $d[0] . ' domain')) ?>" target="_blank" class="btn btn-wa btn-sm" style="width:100%;"><i class="fab fa-whatsapp"></i> Register</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Why us -->
<section class="section-pad" style="background:var(--offwhite);">
  <div class="container">
    <div class="text-center" style="margin-bottom:42px;">
      <span class="section-label"><i class="fas fa-shield-halved"></i>Why AMATETA</span>
      <h2 class="section-title">Hosting You Can <span>Rely On</span></h2>
      <div class="divider"></div>
    </div>
    <div class="services-grid" style="grid-template-columns:repeat(4,1fr);">
      <?php foreach ([['fas fa-bolt', 'Lightning Fast', 'SSD storage and optimised servers for fast load times.'],
                      ['fas fa-shield-halved', 'Secure & Free SSL', 'Free SSL certificates and daily malware scans.'],
                      ['fas fa-clock-rotate-left', 'Daily Backups', 'Automatic backups so your data is always safe.'],
                      ['fas fa-headset', '24/7 Support', 'Local Namibian support whenever you need help.']] as $w): ?>
        <div class="add-card" style="text-align:center;">
          <div class="add-icon ai-blue" style="margin:0 auto 14px;"><i class="<?= e($w[0]) ?>"></i></div>
          <h4 style="margin-bottom:8px;"><?= e($w[1]) ?></h4>
          <p style="margin:0;"><?= e($w[2]) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="cta-section section-pad-sm">
  <div class="container">
    <div class="cta-inner">
      <span class="section-label" style="background:rgba(247,127,0,0.15);border-color:rgba(247,127,0,0.3);color:var(--orange);margin-bottom:18px;"><i class="fas fa-server"></i>Get Online Today</span>
      <h2>Ready to Launch Your<br>Website Online?</h2>
      <p>Let us host your website with speed, security and reliable Namibian support. Order now or chat with us.</p>
      <div class="cta-btns">
        <a href="<?= e(wa_link('Hello, I would like a hosting plan')) ?>" target="_blank" class="btn btn-orange btn-lg"><i class="fab fa-whatsapp"></i> Order on WhatsApp</a>
        <a href="contact.php" class="btn btn-primary btn-lg"><i class="fas fa-envelope"></i> Request a Quote</a>
      </div>
    </div>
  </div>
</section>

<?php page_foot(); ?>
