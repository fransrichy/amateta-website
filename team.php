<?php
/** AMATETA — Team (self-contained, database-driven). */
require_once __DIR__ . '/config/config.php';
$team = fetch_all('SELECT * FROM team WHERE active = 1 ORDER BY sort_order, id');
page_head('Our Team · ' . get_setting('company_name', COMPANY_NAME), 'Meet the AMATETA Techs & Designs team — developers, designers and IT specialists serving Windhoek, Namibia.', 'team');
?>

<section class="page-hero">
  <div class="container">
    <h1>Meet Our <span>Team</span></h1>
    <p>The passionate people behind AMATETA — developers, designers and technology specialists dedicated to your success.</p>
    <div class="breadcrumb"><a href="index.php">Home</a><i class="fas fa-chevron-right"></i><span>Team</span></div>
  </div>
</section>

<section class="section-pad" style="background:var(--offwhite);">
  <div class="container">
    <div class="text-center" style="margin-bottom:42px;">
      <span class="section-label"><i class="fas fa-users"></i>Who We Are</span>
      <h2 class="section-title">The <span>People</span> Behind the Work</h2>
      <div class="divider"></div>
      <p class="section-sub">A dedicated team blending creativity and technology to deliver outstanding results.</p>
    </div>

    <?php if (!$team): ?>
      <p class="text-center" style="color:var(--text-muted);">Our team profiles are coming soon.</p>
    <?php else: ?>
      <div class="team-grid">
        <?php foreach ($team as $m): ?>
          <div class="team-card">
            <div class="team-photo">
              <?php if ($m['photo']): ?>
                <img src="<?= e(img_src($m['photo'])) ?>" alt="<?= e($m['name']) ?>" loading="lazy" onerror="this.parentElement.innerHTML='<div class=\'ph-fallback\'><i class=\'fas fa-user\'></i></div>'">
              <?php else: ?>
                <div class="ph-fallback"><i class="fas fa-user"></i></div>
              <?php endif; ?>
            </div>
            <div class="team-body">
              <h4><?= e($m['name']) ?></h4>
              <span class="team-role"><?= e($m['role']) ?></span>
              <?php if ($m['bio']): ?><p><?= e($m['bio']) ?></p><?php endif; ?>
              <div class="team-social">
                <?php if ($m['email']): ?><a href="mailto:<?= e($m['email']) ?>" aria-label="Email"><i class="fas fa-envelope"></i></a><?php endif; ?>
                <?php if ($m['phone']): ?><a href="<?= e(wa_link('Hello ' . $m['name'])) ?>" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a><?php endif; ?>
                <?php if ($m['linkedin']): ?><a href="<?= e($m['linkedin']) ?>" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a><?php endif; ?>
                <?php if ($m['facebook']): ?><a href="<?= e($m['facebook']) ?>" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a><?php endif; ?>
                <?php if ($m['instagram']): ?><a href="<?= e($m['instagram']) ?>" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a><?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<section class="cta-section section-pad-sm">
  <div class="container">
    <div class="cta-inner">
      <span class="section-label" style="background:rgba(247,127,0,0.15);border-color:rgba(247,127,0,0.3);color:var(--orange);margin-bottom:18px;"><i class="fas fa-handshake"></i>Work With Us</span>
      <h2>Ready to Start Your<br>Next Project?</h2>
      <p>Our team is ready to help you build, design and grow. Let's talk.</p>
      <div class="cta-btns">
        <a href="contact.php" class="btn btn-primary btn-lg"><i class="fas fa-envelope"></i>Contact the Team</a>
        <a href="<?= e(wa_link()) ?>" target="_blank" class="btn btn-orange btn-lg"><i class="fab fa-whatsapp"></i>WhatsApp Us</a>
      </div>
    </div>
  </div>
</section>

<?php page_foot(); ?>
