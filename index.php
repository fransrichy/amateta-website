<?php
/** AMATETA — Home (self-contained, database-driven). */
require_once __DIR__ . '/config/config.php';

$slides    = fetch_all('SELECT * FROM slides WHERE active = 1 ORDER BY sort_order, id');
$services  = fetch_all('SELECT * FROM services WHERE active = 1 ORDER BY sort_order, id LIMIT 9');
$portfolio = fetch_all('SELECT * FROM portfolio WHERE active = 1 ORDER BY sort_order, id LIMIT 6');
$sales     = fetch_all('SELECT * FROM sales WHERE active = 1 ORDER BY sort_order, id');

$heroTitle = get_setting('hero_title', 'Premium <span>Technology</span> & Graphics Solutions in Namibia');
$heroDesc  = get_setting('hero_desc', 'Web development, hosting & domains, graphic design, printing, CCTV, company stamps, digital marketing and IT support — all under one roof in Windhoek.');

page_head(get_setting('company_name', COMPANY_NAME) . ' | Web Development, Hosting, Printing & IT – Windhoek, Namibia', '', 'home');
?>

<!-- ========== HERO SLIDESHOW ========== -->
<section class="hero">
  <div class="slideshow" id="slideshow">
    <?php foreach ($slides as $i => $s): ?>
      <div class="slide <?= $i === 0 ? 'active' : '' ?> slide-<?= $i + 1 ?>">
        <img src="<?= e(img_src($s['image'])) ?>" alt="<?= e($s['title']) ?>" class="slide-bg"
             onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
        <div class="slide-placeholder" style="display:none;"></div>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="hero-overlay-pattern"></div>

  <div class="container">
    <div class="hero-content">
      <div class="hero-text">
        <div class="hero-badge"><i class="fas fa-star" style="font-size:0.65rem;"></i> #1 Technology & Graphics Company – Windhoek</div>
        <h1 class="hero-title"><?= $heroTitle /* admin-managed, allows <span> */ ?></h1>
        <p class="hero-desc"><?= e($heroDesc) ?></p>
        <div class="hero-btns">
          <a href="services.php" class="btn btn-primary btn-lg"><i class="fas fa-th"></i> Explore Services</a>
          <a href="contact.php" class="btn btn-orange btn-lg"><i class="fas fa-comments"></i> Get Free Quote</a>
          <a href="<?= e(wa_link('Hello, I would like to order a service')) ?>" target="_blank" class="btn btn-stamps btn-lg"><i class="fab fa-whatsapp"></i> Order on WhatsApp</a>
        </div>
        <div class="hero-chips">
          <span class="hero-chip"><i class="fas fa-check-circle"></i> Web Development</span>
          <span class="hero-chip"><i class="fas fa-check-circle"></i> Hosting & Domains</span>
          <span class="hero-chip"><i class="fas fa-check-circle"></i> Company Stamps</span>
          <span class="hero-chip"><i class="fas fa-check-circle"></i> CCTV Installation</span>
          <span class="hero-chip"><i class="fas fa-check-circle"></i> 24/7 IT Support</span>
        </div>
      </div>
      <div class="hero-floats">
        <div class="float-card">
          <div class="float-card-img fp1"><img src="images/web2026.jpg" alt="Web Dev" onerror="this.parentElement.innerHTML='<div class=\'fp-fallback fp1\'><i class=\'fas fa-code\'></i></div>'"></div>
          <div class="float-card-body"><strong>Web Development</strong><span>Custom, responsive websites</span></div>
        </div>
        <div class="float-card">
          <div class="float-card-img fp2"><img src="images/web-development-hero.jpg" alt="Hosting" onerror="this.parentElement.innerHTML='<div class=\'fp-fallback fp2\'><i class=\'fas fa-server\'></i></div>'"></div>
          <div class="float-card-body"><strong>Hosting & Domains</strong><span>Reliable, secure, fast</span></div>
        </div>
      </div>
    </div>
  </div>

  <?php if (count($slides) > 1): ?>
  <div class="slide-arrows">
    <button class="slide-arrow" id="prevSlide"><i class="fas fa-chevron-left"></i></button>
    <button class="slide-arrow" id="nextSlide"><i class="fas fa-chevron-right"></i></button>
  </div>
  <div class="slide-dots" id="slideDots">
    <?php foreach ($slides as $i => $s): ?><button class="dot <?= $i === 0 ? 'active' : '' ?>" onclick="goToSlide(<?= $i ?>)"></button><?php endforeach; ?>
  </div>
  <?php endif; ?>
</section>

<!-- ========== STATS BAR ========== -->
<div class="stats-bar">
  <div class="container" style="padding:0;">
    <div class="stats-grid">
      <div class="stat-item"><div class="stat-num" data-count="<?= (int) get_setting('stat_projects', 240) ?>">0<span>+</span></div><div class="stat-lbl">Projects Done</div></div>
      <div class="stat-item"><div class="stat-num" data-count="<?= (int) get_setting('stat_clients', 500) ?>">0<span>+</span></div><div class="stat-lbl">Happy Clients</div></div>
      <div class="stat-item"><div class="stat-num" data-count="<?= (int) get_setting('stat_years', 4) ?>">0<span>+</span></div><div class="stat-lbl">Years Experience</div></div>
      <div class="stat-item"><div class="stat-num" style="color:var(--orange);">24<span style="color:var(--orange);">/7</span></div><div class="stat-lbl">IT Support</div></div>
    </div>
  </div>
</div>

<!-- ========== OUR DIGITAL ECOSYSTEM ========== -->
<style>
.eco-section{background:linear-gradient(180deg,#f4f8fc,#eef3f8);padding:56px 0;border-top:1px solid rgba(0,119,182,.1);border-bottom:1px solid rgba(0,119,182,.1);}
.eco-head{text-align:center;margin-bottom:36px;}
.eco-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;}
.eco-card{background:#fff;border-radius:18px;padding:28px 26px;box-shadow:0 8px 30px rgba(10,37,64,.07);border:1px solid rgba(10,37,64,.06);
  display:flex;flex-direction:column;gap:12px;transition:.25s;}
.eco-card:hover{transform:translateY(-6px);box-shadow:0 16px 40px rgba(10,37,64,.13);}
.eco-ic{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;color:#fff;}
.eco-card h4{font-family:var(--ff-head);font-size:1.15rem;color:var(--navy);margin:0;}
.eco-card p{color:var(--text-muted);font-size:0.88rem;line-height:1.6;margin:0;flex:1;}
.eco-url{font-size:0.78rem;font-weight:700;color:var(--blue);word-break:break-all;}
.eco-card .btn{width:100%;justify-content:center;margin-top:4px;}
@media(max-width:860px){.eco-grid{grid-template-columns:1fr;}}
</style>
<section class="eco-section" id="ecosystem">
  <div class="container">
    <div class="eco-head">
      <span class="section-label"><i class="fas fa-diagram-project"></i>Beyond This Website</span>
      <h2 class="section-title">Our Digital <span>Ecosystem</span></h2>
      <div class="divider"></div>
      <p class="section-sub">AMATETA builds and runs its own suite of live platforms — free to use, made in Windhoek.</p>
    </div>
    <div class="eco-grid">
      <div class="eco-card">
        <div class="eco-ic" style="background:linear-gradient(135deg,#00b4d8,#0077b6);"><i class="fas fa-server"></i></div>
        <h4>AMATETA Host</h4>
        <p>Fast, secure hosting and domain registration for businesses across Namibia — managed end-to-end by our own team.</p>
        <span class="eco-url">amatetahost.com</span>
        <a href="https://www.amatetahost.com/" target="_blank" rel="noopener" class="btn btn-primary btn-sm"><i class="fas fa-arrow-up-right-from-square"></i> Visit AMATETA Host</a>
      </div>
      <div class="eco-card">
        <div class="eco-ic" style="background:linear-gradient(135deg,#f77f00,#e36200);"><i class="fas fa-file-invoice-dollar"></i></div>
        <h4>Free Online Invoice Creator</h4>
        <p>Generate professional invoices instantly — no sign-up, completely free. Perfect for freelancers and small businesses.</p>
        <span class="eco-url">invoice.amateta.com</span>
        <a href="https://www.invoice.amateta.com/" target="_blank" rel="noopener" class="btn btn-orange btn-sm"><i class="fas fa-arrow-up-right-from-square"></i> Create Free Invoice</a>
      </div>
      <div class="eco-card">
        <div class="eco-ic" style="background:linear-gradient(135deg,#9c27b0,#6a1b9a);"><i class="fas fa-cash-register"></i></div>
        <h4>AMATETA POS</h4>
        <p>Our cloud point-of-sale system for shops and retailers — sales, stock and reporting in one simple dashboard.</p>
        <span class="eco-url">apos.amateta.com</span>
        <a href="https://apos.amateta.com/" target="_blank" rel="noopener" class="btn btn-stamps btn-sm"><i class="fas fa-arrow-up-right-from-square"></i> Visit AMATETA POS</a>
      </div>
    </div>
  </div>
</section>

<!-- ========== ABOUT ========== -->
<section class="about-section section-pad" id="about">
  <div class="container">
    <div class="about-grid">
      <div class="about-img-wrap">
        <img src="images/Our Goal.jpg" alt="About <?= e(COMPANY_NAME) ?>" loading="lazy">
        <div class="about-badge-float"><strong><?= (int) get_setting('stat_years', 4) ?>+</strong><span>Years Serving<br>Namibia</span></div>
      </div>
      <div>
        <span class="section-label"><i class="fas fa-info-circle"></i>Who We Are</span>
        <h2 class="section-title">Transforming Businesses Through <span>Technology</span></h2>
        <div class="divider"></div>
        <p style="color:var(--text-muted);line-height:1.75;font-size:0.96rem;margin-bottom:16px;"><?= e(get_setting('company_name', COMPANY_NAME)) ?> is Windhoek's premier one-stop technology and graphics company. We blend creative design with powerful technology to deliver results that move your business forward.</p>
        <ul class="about-points">
          <li><i class="fas fa-check-circle"></i>Full-service web development — from landing pages to complex e-commerce platforms</li>
          <li><i class="fas fa-check-circle"></i>Web hosting, domain registration (.com / .na) and website management</li>
          <li><i class="fas fa-check-circle"></i>All corporate printing: T-shirts, brochures, banners, business cards, uniforms</li>
          <li><i class="fas fa-check-circle"></i>Company stamps, CCTV installation, network/WiFi setup and 24/7 IT support</li>
          <li><i class="fas fa-check-circle"></i>Digital marketing, social media management and SEO growth strategies</li>
        </ul>
        <div style="display:flex;gap:12px;flex-wrap:wrap;">
          <a href="about.php" class="btn btn-primary"><i class="fas fa-arrow-right"></i>Learn More About Us</a>
          <a href="contact.php" class="btn btn-outline-navy"><i class="fas fa-phone"></i>Talk to Us</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ========== CORE SERVICES (dynamic) ========== -->
<section class="app-launch-section" aria-labelledby="app-launch-title">
  <div class="container app-launch-grid">
    <div class="app-launch-copy">
      <span class="section-label"><i class="fas fa-mobile-screen-button"></i>New capability</span>
      <h2 id="app-launch-title" class="section-title">We now build <span>mobile & web apps</span></h2>
      <p>From a first product idea to a secure live application, AMATETA now delivers the complete journey: planning, interface design, development, launch and ongoing support.</p>
      <div class="app-launch-points"><span><i class="fas fa-check"></i>Android & iOS</span><span><i class="fas fa-check"></i>Business systems</span><span><i class="fas fa-check"></i>Customer portals</span></div>
      <a href="app-development.php" class="btn btn-primary btn-lg"><i class="fas fa-arrow-right"></i> Explore App Development</a>
    </div>
    <a href="app-development.php" class="app-launch-visual" aria-label="Explore our app development service">
      <div class="app-browser"><span></span><span></span><span></span><em></em></div>
      <div class="app-ui-grid"><div class="app-ui-stat"><small>ACTIVE USERS</small><strong>1,248</strong><i class="fas fa-arrow-trend-up"></i></div><div class="app-ui-chart"><b></b><b></b><b></b><b></b><b></b><b></b></div><div class="app-ui-list"><span></span><span></span><span></span></div></div>
      <div class="app-phone"><div class="app-phone-top"></div><i class="fas fa-layer-group"></i><strong>Your App</strong><span></span><span></span><span></span></div>
    </a>
  </div>
</section>

<section class="services-section section-pad" id="services">
  <div class="container">
    <div class="text-center" style="margin-bottom:48px;">
      <span class="section-label"><i class="fas fa-cogs"></i>What We Do</span>
      <h2 class="section-title">Our <span>Core Services</span></h2>
      <div class="divider"></div>
      <p class="section-sub">Comprehensive technology, printing and digital solutions tailored for businesses in Namibia and beyond.</p>
    </div>
    <div class="services-grid">
      <?php foreach ($services as $s): ?>
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
            <?php if (!empty($s['link'])): ?><a href="<?= e($s['link']) ?>" class="btn btn-outline-navy btn-sm" style="width:100%;margin-top:12px;"><i class="fas fa-circle-info"></i> View Details</a><?php endif; ?>
            <a href="<?= e(wa_link($s['wa_text'] ?: ('I would like a quote for ' . $s['title']))) ?>" target="_blank" class="btn btn-wa btn-sm"><i class="fab fa-whatsapp"></i> Order on WhatsApp</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="all-services-bar">
      <a href="services.php" class="btn btn-primary btn-lg"><i class="fas fa-th-large"></i> View Full Service List</a>
      <a href="contact.php" class="btn btn-orange btn-lg"><i class="fas fa-phone-alt"></i> Request a Quote</a>
    </div>
  </div>
</section>

<!-- ========== ON SALE (admin-managed) ========== -->
<?php if ($sales): ?>
<section class="sale-section section-pad" id="sale">
  <div class="sale-float"><i class="fas fa-tags"></i><span>SALE</span></div>
  <div class="container">
    <div class="text-center" style="margin-bottom:42px;">
      <span class="section-label" style="background:rgba(231,23,91,.1);border-color:rgba(231,23,91,.25);color:#e3175b;"><i class="fas fa-fire"></i>Limited Time</span>
      <h2 class="section-title">Special <span style="color:#e3175b;">Offers</span> &amp; Deals</h2>
      <div class="divider" style="background:linear-gradient(90deg,#e3175b,var(--orange));"></div>
      <p class="section-sub">Grab these limited-time deals before they're gone!</p>
    </div>
    <div class="sale-grid">
      <?php foreach ($sales as $sale): ?>
        <div class="sale-card">
          <?php if ($sale['badge']): ?><span class="sale-badge"><i class="fas fa-bolt"></i><?= e($sale['badge']) ?></span><?php endif; ?>
          <div class="sale-img">
            <?php if ($sale['image']): ?>
              <img src="<?= e(img_src($sale['image'])) ?>" alt="<?= e($sale['title']) ?>" loading="lazy" onerror="this.parentElement.innerHTML='<div class=\'sale-fallback\'><i class=\'fas fa-tags\'></i></div>'">
            <?php else: ?><div class="sale-fallback"><i class="fas fa-tags"></i></div><?php endif; ?>
          </div>
          <div class="sale-body">
            <h4><?= e($sale['title']) ?></h4>
            <p><?= e($sale['description']) ?></p>
            <?php if ($sale['new_price']): ?>
              <div class="sale-price"><span class="new"><?= e($sale['new_price']) ?></span><?php if ($sale['old_price']): ?><span class="old"><?= e($sale['old_price']) ?></span><?php endif; ?></div>
            <?php endif; ?>
            <a href="<?= e(wa_link('I am interested in the offer: ' . $sale['title'])) ?>" target="_blank" class="btn btn-wa btn-sm" style="width:100%;"><i class="fab fa-whatsapp"></i> Grab This Deal</a>
            <?php if ($sale['link']): ?><a href="<?= e($sale['link']) ?>" class="btn btn-outline-navy btn-sm" style="width:100%;margin-top:8px;"><i class="fas fa-circle-info"></i> Learn More</a><?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ========== COMPANY STAMPS ========== -->
<section class="stamps-section section-pad" id="stamps">
  <div class="container">
    <div class="stamps-content-grid">
      <div>
        <span class="section-label" style="background:rgba(156,39,176,0.1);border-color:rgba(156,39,176,0.25);color:#9c27b0;"><i class="fas fa-stamp"></i>Stamp Services</span>
        <h2 class="section-title">Company <span style="color:#9c27b0;">Stamps</span> –<br>All Types Available</h2>
        <div class="divider" style="background:linear-gradient(90deg,#9c27b0,var(--blue));"></div>
        <p style="color:var(--text-muted);font-size:0.95rem;line-height:1.75;margin-bottom:16px;">We produce all types of professional company and personal stamps for businesses, organisations, law firms, schools and government offices in Namibia. Fast turnaround, sharp impression quality.</p>
        <div class="stamps-types-grid">
          <div class="stamp-type"><i class="fas fa-stamp"></i><strong>Self-Inking Stamps</strong><span>Thousands of clean impressions</span></div>
          <div class="stamp-type"><i class="fas fa-circle"></i><strong>Pre-Inked Stamps</strong><span>Crisp, professional detail</span></div>
          <div class="stamp-type"><i class="fas fa-building"></i><strong>Company Round Stamps</strong><span>Official seal for documents</span></div>
          <div class="stamp-type"><i class="fas fa-user-tie"></i><strong>Signature Stamps</strong><span>Personalised for officials</span></div>
        </div>
        <div class="stamp-section-cta">
          <div class="stamp-cta-img"><img src="images/float-stamp.webp" alt="Stamp" loading="lazy" width="1120" height="1411" onerror="this.parentElement.innerHTML='🔖'"></div>
          <div class="stamp-cta-text" style="flex:1;"><strong>🖊️ Order Your Company Stamp Today</strong><span>Same-day service · All types · Custom designs</span></div>
          <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <a href="stamps.php" class="btn btn-stamps"><i class="fas fa-stamp"></i>View All Stamps</a>
            <a href="<?= e(wa_link('I would like to order a Company Stamp')) ?>" target="_blank" class="btn btn-outline-navy"><i class="fab fa-whatsapp"></i>Order Now</a>
          </div>
        </div>
      </div>
      <div class="stamps-visual">
        <div class="stamps-circle"><i class="fas fa-stamp"></i>
          <div class="stamp-float sf1">✅ Same Day Service</div>
          <div class="stamp-float sf2">🖊️ Custom Design</div>
          <div class="stamp-float sf3">📦 All Sizes Available</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ========== PORTFOLIO PREVIEW (dynamic) ========== -->
<section class="section-pad" style="background:var(--offwhite);" id="portfolio">
  <div class="container">
    <div class="text-center" style="margin-bottom:48px;">
      <span class="section-label"><i class="fas fa-rocket"></i>Our Work</span>
      <h2 class="section-title">Recently <span>Launched Platforms</span></h2>
      <div class="divider"></div>
      <p class="section-sub">A selection of websites, shops and systems we have proudly designed, developed and launched.</p>
    </div>
    <div class="portfolio-grid">
      <?php foreach ($portfolio as $p): ?>
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
      <?php endforeach; ?>
    </div>
    <div class="text-center" style="margin-top:40px;">
      <a href="portfolio.php" class="btn btn-primary btn-lg"><i class="fas fa-briefcase"></i> View Full Portfolio</a>
    </div>
  </div>
</section>

<!-- ========== NEWSLETTER ========== -->
<section class="newsletter-section section-pad">
  <div class="container">
    <div class="newsletter-inner">
      <span class="section-label" style="background:rgba(247,127,0,0.15);border-color:rgba(247,127,0,0.3);color:var(--orange);"><i class="fas fa-envelope-open-text"></i>Stay Updated</span>
      <h2>Join Our Newsletter</h2>
      <p>Get the latest offers on web development, hosting, printing and technology — plus tips to grow your business. No spam, ever.</p>
      <form class="newsletter-form" id="newsletterForm">
        <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">
        <input type="text" name="name" placeholder="Your name (optional)">
        <input type="email" name="email" placeholder="Enter your email address" required>
        <button type="submit" class="btn btn-orange btn-lg"><i class="fas fa-paper-plane"></i> Subscribe</button>
      </form>
      <div class="newsletter-msg" id="newsletterMsg"></div>
    </div>
  </div>
</section>

<!-- ========== CTA ========== -->
<section class="cta-section section-pad-sm">
  <div class="container">
    <div class="cta-inner">
      <span class="section-label" style="background:rgba(247,127,0,0.15);border-color:rgba(247,127,0,0.3);color:var(--orange);margin-bottom:18px;"><i class="fas fa-rocket"></i>Ready to Start?</span>
      <h2>Ready to Transform Your<br>Digital Presence?</h2>
      <p>Let's discuss how our technology and printing solutions can drive real growth for your business. Free consultation — no obligations.</p>
      <div class="cta-btns">
        <a href="contact.php" class="btn btn-primary btn-lg"><i class="far fa-calendar-check"></i>Get Free Consultation</a>
        <a href="<?= e(wa_link('Hello, I would like to order a service')) ?>" target="_blank" class="btn btn-orange btn-lg"><i class="fab fa-whatsapp"></i>Order on WhatsApp</a>
      </div>
    </div>
  </div>
</section>

<script>
let curSlide=0;const slides=document.querySelectorAll('.slide');const dots=document.querySelectorAll('.dot');let ssTimer;
function goToSlide(n){if(!slides.length)return;slides[curSlide].classList.remove('active');if(dots[curSlide])dots[curSlide].classList.remove('active');curSlide=(n+slides.length)%slides.length;slides[curSlide].classList.add('active');if(dots[curSlide])dots[curSlide].classList.add('active');}
function nextSlide(){goToSlide(curSlide+1);}function prevSlide(){goToSlide(curSlide-1);}
function startAuto(){ssTimer=setInterval(nextSlide,5500);}function resetAuto(){clearInterval(ssTimer);startAuto();}
var nx=document.getElementById('nextSlide'),pv=document.getElementById('prevSlide');
if(nx)nx.addEventListener('click',()=>{nextSlide();resetAuto();});if(pv)pv.addEventListener('click',()=>{prevSlide();resetAuto();});
if(slides.length>1)startAuto();
function animateStats(){document.querySelectorAll('.stat-num[data-count]').forEach(el=>{const t=+el.getAttribute('data-count');const suf=el.querySelector('span')?el.querySelector('span').outerHTML:'';let c=0;const st=t/60;const iv=setInterval(()=>{c=Math.min(c+st,t);el.innerHTML=Math.floor(c)+suf;if(c>=t)clearInterval(iv);},18);});}
const so=new IntersectionObserver(en=>{if(en[0].isIntersecting){animateStats();so.disconnect();}},{threshold:0.4});const sb=document.querySelector('.stats-bar');if(sb)so.observe(sb);
</script>

<?php page_foot(); ?>
