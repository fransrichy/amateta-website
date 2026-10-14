<?php
/**
 * Shared, self-contained header + footer used by EVERY public page.
 * render_nav()/render_footer() carry their own namespaced CSS (.amt-*) so they
 * render identically on the custom-CSS pages and the old Bootstrap pages.
 * All text/links come from admin Settings, so updating once changes every page.
 */

/** Nav definition shared by header + mobile menus. */
function amt_nav_items(): array
{
    return [
        'home'      => ['Home', 'index', 'fa-house'],
        'about'     => ['About', 'about', 'fa-circle-info'],
        'services'  => ['Services', 'services', 'fa-layer-group'],
        'apps'      => ['App Development', 'app-development', 'fa-mobile-screen-button'],
        'stamps'    => ['Stamps', 'stamps', 'fa-stamp'],
        'portfolio' => ['Portfolio', 'portfolio', 'fa-briefcase'],
        'team'      => ['Team', 'team', 'fa-users'],
        'contact'   => ['Contact', 'contact', 'fa-envelope'],
    ];
}

/** THE shared header (top navbar + slide-in menu + mobile bottom nav). */
function render_nav(string $active = ''): void
{
    static $done = false;          // CSS + markup only once per request
    if ($done) return;
    $done = true;

    $company = get_setting('company_name', COMPANY_NAME);
    $logo    = get_setting('logo', 'images/OUR LOGO REVISED.png');
    $items   = amt_nav_items();
    ?>
<style>
/* ===== AMATETA shared header / nav (namespaced) ===== */
:root{--amt-navy:#0a2540;--amt-navy2:#03045e;--amt-blue:#00b4d8;--amt-blue2:#0077b6;--amt-orange:#f77f00;}
body{padding-top:84px!important;}
.amt-nav{position:fixed;top:0;left:0;right:0;z-index:3000;height:84px;display:flex;align-items:center;
  background:rgba(10,37,64,.97);backdrop-filter:blur(18px);-webkit-backdrop-filter:blur(18px);
  border-bottom:1px solid rgba(0,180,216,.22);transition:.3s;font-family:'Poppins','Inter',sans-serif;}
.amt-nav.scrolled{height:70px;background:rgba(3,4,94,.98);box-shadow:0 6px 30px rgba(0,0,0,.3);}
.amt-nav-in{width:100%;max-width:1220px;margin:0 auto;padding:0 20px;display:flex;align-items:center;justify-content:space-between;gap:16px;}
.amt-logo{display:flex;align-items:center;flex-shrink:0;}
.amt-logo img{height:64px;width:auto;transition:.3s;display:block;}
.amt-nav.scrolled .amt-logo img{height:54px;}
.amt-links{display:flex;align-items:center;gap:2px;list-style:none;margin:0;padding:0;}
.amt-links a{font-size:.82rem;font-weight:600;color:rgba(255,255,255,.85);text-decoration:none;padding:8px 13px;border-radius:9px;transition:.25s;white-space:nowrap;display:inline-flex;align-items:center;gap:6px;}
.amt-links a:hover,.amt-links a.on{color:#fff;background:rgba(0,180,216,.18);}
.amt-links a.stamps{color:#e0a3ff;}
.amt-cta{display:flex;align-items:center;gap:9px;flex-shrink:0;}
.amt-btn{display:inline-flex;align-items:center;gap:6px;font-family:'Poppins',sans-serif;font-weight:600;font-size:.8rem;padding:9px 18px;border-radius:50px;text-decoration:none;border:none;cursor:pointer;transition:.25s;white-space:nowrap;}
.amt-btn-b{background:linear-gradient(135deg,var(--amt-blue),var(--amt-blue2));color:#fff;}
.amt-btn-o{background:linear-gradient(135deg,var(--amt-orange),#e36200);color:#fff;}
.amt-btn:hover{transform:translateY(-2px);color:#fff;}
.amt-burger{display:none;flex-direction:column;gap:5px;background:none;border:none;cursor:pointer;padding:8px;}
.amt-burger span{width:26px;height:2.5px;background:#fff;border-radius:2px;transition:.3s;}
/* slide-in full menu */
.amt-drawer{position:fixed;inset:0 0 0 auto;width:min(320px,82vw);background:linear-gradient(180deg,#03045e,#0a2540);z-index:4000;transform:translateX(100%);transition:.32s cubic-bezier(.4,0,.2,1);padding:26px 22px;display:flex;flex-direction:column;gap:6px;box-shadow:-10px 0 40px rgba(0,0,0,.4);overflow-y:auto;}
.amt-drawer.open{transform:translateX(0);}
.amt-drawer-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;}
.amt-drawer-top img{height:46px;}
.amt-drawer-close{background:rgba(255,255,255,.1);border:none;color:#fff;width:38px;height:38px;border-radius:10px;font-size:1.1rem;cursor:pointer;}
.amt-drawer a.amt-d-link{display:flex;align-items:center;gap:13px;color:rgba(255,255,255,.85);text-decoration:none;font-family:'Poppins',sans-serif;font-weight:600;font-size:.95rem;padding:13px 12px;border-radius:11px;border-bottom:1px solid rgba(255,255,255,.06);}
.amt-drawer a.amt-d-link i{width:22px;text-align:center;color:var(--amt-blue);font-size:1rem;}
.amt-drawer a.amt-d-link:hover,.amt-drawer a.amt-d-link.on{background:rgba(0,180,216,.16);color:#fff;}
.amt-drawer .amt-d-cta{margin-top:14px;display:flex;flex-direction:column;gap:10px;}
.amt-drawer .amt-d-cta .amt-btn{justify-content:center;padding:13px;font-size:.9rem;}
.amt-overlay{position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:3500;opacity:0;pointer-events:none;transition:.3s;}
.amt-overlay.show{opacity:1;pointer-events:all;}
/* mobile bottom nav */
.amt-bnav{display:none;position:fixed;bottom:0;left:0;right:0;z-index:3000;height:64px;
  background:rgba(10,37,64,.98);backdrop-filter:blur(16px);border-top:1px solid rgba(0,180,216,.25);
  align-items:center;justify-content:space-around;padding:0 6px;box-shadow:0 -6px 24px rgba(0,0,0,.25);}
.amt-bnav a{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:3px;
  color:rgba(255,255,255,.65);text-decoration:none;font-family:'Poppins',sans-serif;font-size:.62rem;font-weight:600;padding:6px 0;transition:.2s;}
.amt-bnav a i{font-size:1.15rem;}
.amt-bnav a.on,.amt-bnav a:hover{color:var(--amt-blue);}
.amt-bnav a.wa{position:relative;}
.amt-bnav a.wa .amt-wa-c{width:50px;height:50px;margin-top:-26px;border-radius:50%;background:linear-gradient(135deg,#25d366,#128c7e);
  display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.4rem;box-shadow:0 6px 18px rgba(37,211,102,.55);border:3px solid #0a2540;}
.amt-bnav a.wa span{color:#25d366;margin-top:1px;}
@media(max-width:992px){
  .amt-links,.amt-cta{display:none;}
  .amt-burger{display:flex;}
  .amt-nav{height:74px;}
  body{padding-top:74px!important;padding-bottom:70px!important;}
  .amt-logo img{height:54px;}
  .amt-nav.scrolled{height:66px;}
  .amt-bnav{display:flex;}
}
@media(max-width:380px){.amt-bnav a{font-size:.56rem;} .amt-bnav a i{font-size:1.05rem;}}
</style>

<nav class="amt-nav" id="amtNav">
  <div class="amt-nav-in">
    <a href="index" class="amt-logo"><img src="<?= e($logo) ?>" alt="<?= e($company) ?>"></a>
    <ul class="amt-links">
      <?php foreach ($items as $k => $it): ?>
        <li><a href="<?= e($it[1]) ?>" class="<?= $active === $k ? 'on' : '' ?><?= $k === 'stamps' ? ' stamps' : '' ?>"><?= e($it[0]) ?></a></li>
      <?php endforeach; ?>
    </ul>
    <div class="amt-cta">
      <a href="services" class="amt-btn amt-btn-b"><i class="fas fa-layer-group"></i> Services</a>
      <a href="contact" class="amt-btn amt-btn-o"><i class="fas fa-paper-plane"></i> Get Quote</a>
    </div>
    <button class="amt-burger" id="amtBurger" aria-label="Open menu"><span></span><span></span><span></span></button>
  </div>
</nav>

<div class="amt-overlay" id="amtOverlay"></div>
<aside class="amt-drawer" id="amtDrawer">
  <div class="amt-drawer-top">
    <img src="<?= e(get_setting('logo_white', 'images/OUR LOGO WHITE.png')) ?>" alt="<?= e($company) ?>">
    <button class="amt-drawer-close" id="amtDrawerClose" aria-label="Close">&times;</button>
  </div>
  <?php foreach ($items as $k => $it): ?>
    <a href="<?= e($it[1]) ?>" class="amt-d-link <?= $active === $k ? 'on' : '' ?>"><i class="fas <?= e($it[2]) ?>"></i><?= e($it[0]) ?></a>
  <?php endforeach; ?>
  <div class="amt-d-cta">
    <a href="<?= e(wa_link('Hello, I would like to order a service')) ?>" target="_blank" class="amt-btn" style="background:linear-gradient(135deg,#25d366,#128c7e);"><i class="fab fa-whatsapp"></i> Order on WhatsApp</a>
    <a href="contact" class="amt-btn amt-btn-o"><i class="fas fa-paper-plane"></i> Get a Free Quote</a>
  </div>
</aside>

<nav class="amt-bnav">
  <a href="index" class="<?= $active === 'home' ? 'on' : '' ?>"><i class="fas fa-house"></i><span>Home</span></a>
  <a href="services" class="<?= $active === 'services' ? 'on' : '' ?>"><i class="fas fa-layer-group"></i><span>Services</span></a>
  <a href="<?= e(wa_link('Hello, I would like to order a service')) ?>" target="_blank" class="wa"><span class="amt-wa-c"><i class="fab fa-whatsapp"></i></span><span>Order</span></a>
  <a href="portfolio" class="<?= $active === 'portfolio' ? 'on' : '' ?>"><i class="fas fa-briefcase"></i><span>Work</span></a>
  <a href="contact" class="<?= $active === 'contact' ? 'on' : '' ?>"><i class="fas fa-envelope"></i><span>Contact</span></a>
</nav>

<script>
(function(){
  var nav=document.getElementById('amtNav'),burger=document.getElementById('amtBurger'),
      drawer=document.getElementById('amtDrawer'),ov=document.getElementById('amtOverlay'),
      close=document.getElementById('amtDrawerClose');
  window.addEventListener('scroll',function(){nav.classList.toggle('scrolled',window.scrollY>50);});
  function open(){drawer.classList.add('open');ov.classList.add('show');}
  function shut(){drawer.classList.remove('open');ov.classList.remove('show');}
  if(burger)burger.addEventListener('click',open);
  if(close)close.addEventListener('click',shut);
  if(ov)ov.addEventListener('click',shut);
})();
</script>
<?php
}

/** THE shared footer (self-contained, settings-driven). */
function render_footer(): void
{
    static $done = false;
    if ($done) return;
    $done = true;

    $company  = get_setting('company_name', COMPANY_NAME);
    $logoW    = get_setting('logo_white', 'images/OUR LOGO WHITE.png');
    $phone    = get_setting('contact_phone', '+264 85 344 1248');
    $email    = get_setting('contact_email', 'info@amateta.com');
    $order    = get_setting('order_email', 'order@amateta.com');
    $addrMain = get_setting('address_main', 'Eluwa Building, Shop No.2, Independence Avenue, Windhoek, Namibia');
    $addrShop = get_setting('address_shop', 'Bismark Street 36, Windhoek West, Windhoek, Namibia');
    $fb = get_setting('social_facebook', '#');
    $ln = get_setting('social_linkedin', '#');
    $ig = get_setting('social_instagram', '#');
    $year = date('Y');
    ?>
<style>
.amt-foot{background:linear-gradient(180deg,#03045e,#020317);color:rgba(255,255,255,.7);padding:64px 0 0;font-family:'Inter',sans-serif;border-top:1px solid rgba(0,180,216,.18);}
.amt-foot .amt-fin{max-width:1220px;margin:0 auto;padding:0 22px;}
.amt-fgrid{display:grid;grid-template-columns:1.5fr 1fr 1fr 1.4fr;gap:42px;}
.amt-foot img.amt-flogo{height:62px;margin-bottom:16px;}
.amt-foot p.amt-fdesc{font-size:.85rem;line-height:1.7;color:rgba(255,255,255,.55);margin:0 0 18px;}
.amt-soc{display:flex;gap:10px;}
.amt-soc a{width:38px;height:38px;border-radius:10px;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.75);text-decoration:none;transition:.25s;}
.amt-soc a:hover{background:var(--amt-blue,#00b4d8);color:#fff;}
.amt-foot h5{font-family:'Poppins',sans-serif;font-size:.85rem;font-weight:700;color:#fff;text-transform:uppercase;letter-spacing:1px;margin:0 0 16px;padding-bottom:10px;border-bottom:1px solid rgba(0,180,216,.25);}
.amt-flinks{list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:9px;}
.amt-flinks a{color:rgba(255,255,255,.6);text-decoration:none;font-size:.84rem;display:flex;align-items:center;gap:8px;transition:.2s;}
.amt-flinks a i{font-size:.6rem;color:var(--amt-blue,#00b4d8);}
.amt-flinks a:hover{color:var(--amt-blue,#00b4d8);transform:translateX(4px);}
.amt-fci{display:flex;gap:10px;align-items:flex-start;margin-bottom:12px;font-size:.83rem;color:rgba(255,255,255,.6);}
.amt-fci i{color:var(--amt-blue,#00b4d8);margin-top:3px;}
.amt-fci a{color:rgba(255,255,255,.6);text-decoration:none;}
.amt-fci a:hover{color:var(--amt-blue,#00b4d8);}
.amt-fbottom{margin-top:46px;padding:20px 0;border-top:1px solid rgba(255,255,255,.08);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;}
.amt-fbottom p{font-size:.78rem;color:rgba(255,255,255,.4);margin:0;}
.amt-fbottom a{font-size:.78rem;color:rgba(255,255,255,.4);text-decoration:none;margin-left:18px;}
.amt-fbottom a:hover{color:var(--amt-blue,#00b4d8);}
.amt-manage{display:inline-flex;align-items:center;gap:5px;font-size:.68rem!important;font-weight:600;
  color:rgba(255,255,255,.45)!important;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);
  border-radius:50px;padding:4px 11px;margin-left:18px;transition:.25s;}
.amt-manage:hover{background:rgba(0,180,216,.18);border-color:rgba(0,180,216,.4);color:#fff!important;}
.amt-manage i{font-size:.6rem;}
.amt-wafloat{position:fixed;bottom:26px;right:24px;z-index:2500;background:linear-gradient(135deg,#25d366,#128c7e);color:#fff;text-decoration:none;border-radius:50px;padding:14px 22px;display:flex;align-items:center;gap:10px;font-family:'Poppins',sans-serif;font-weight:700;font-size:.88rem;box-shadow:0 6px 26px rgba(37,211,102,.5);border:2px solid rgba(255,255,255,.3);}
.amt-wafloat:hover{transform:translateY(-3px);color:#fff;}
@media(max-width:1100px){.amt-fgrid{grid-template-columns:1fr 1fr;gap:32px;}}
@media(max-width:992px){.amt-wafloat{display:none;}}
@media(max-width:640px){.amt-fgrid{grid-template-columns:1fr;gap:26px;}.amt-fbottom{flex-direction:column;align-items:flex-start;}.amt-fbottom a{margin:0 18px 0 0;}}
</style>
<footer class="amt-foot">
  <div class="amt-fin">
    <div class="amt-fgrid">
      <div>
        <img class="amt-flogo" src="<?= e($logoW) ?>" alt="<?= e($company) ?>">
        <p class="amt-fdesc"><?= e($company) ?> is Windhoek's premier technology & graphics company — web development, hosting & domains, printing, company stamps, CCTV, IT support and digital marketing.</p>
        <div class="amt-soc">
          <a href="<?= e($fb) ?>" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="<?= e($ln) ?>" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
          <a href="<?= e($ig) ?>" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="<?= e(wa_link()) ?>" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
        </div>
      </div>
      <div>
        <h5>Quick Links</h5>
        <ul class="amt-flinks">
          <li><a href="index"><i class="fas fa-chevron-right"></i>Home</a></li>
          <li><a href="about"><i class="fas fa-chevron-right"></i>About Us</a></li>
          <li><a href="services"><i class="fas fa-chevron-right"></i>All Services</a></li>
          <li><a href="stamps"><i class="fas fa-stamp"></i>Company Stamps</a></li>
          <li><a href="portfolio"><i class="fas fa-chevron-right"></i>Portfolio</a></li>
          <li><a href="team"><i class="fas fa-chevron-right"></i>Our Team</a></li>
          <li><a href="contact"><i class="fas fa-chevron-right"></i>Contact</a></li>
        </ul>
      </div>
      <div>
        <h5>Services</h5>
        <ul class="amt-flinks">
          <li><a href="web-development"><i class="fas fa-code"></i>Web Development</a></li>
          <li><a href="services"><i class="fas fa-server"></i>Hosting & Domains</a></li>
          <li><a href="digital-marketing"><i class="fas fa-bullhorn"></i>Digital Marketing</a></li>
          <li><a href="graphic-design"><i class="fas fa-palette"></i>Graphic Design</a></li>
          <li><a href="corporate-printing"><i class="fas fa-print"></i>Printing</a></li>
          <li><a href="stamps"><i class="fas fa-stamp"></i>Company Stamps</a></li>
          <li><a href="it-support"><i class="fas fa-headset"></i>IT Support</a></li>
        </ul>
      </div>
      <div>
        <h5>Contact & Locations</h5>
        <div class="amt-fci"><i class="fas fa-map-marker-alt"></i><div><strong style="color:rgba(255,255,255,.85);">Our Office</strong><br><?= e($addrMain) ?></div></div>
        <div class="amt-fci"><i class="fas fa-phone"></i><a href="tel:<?= e(preg_replace('/\s/', '', $phone)) ?>"><?= e($phone) ?></a></div>
        <div class="amt-fci"><i class="fas fa-envelope"></i><a href="mailto:<?= e($email) ?>"><?= e($email) ?></a></div>
        <div class="amt-fci"><i class="fas fa-envelope"></i><a href="mailto:<?= e($order) ?>"><?= e($order) ?></a></div>
      </div>
    </div>
    <div class="amt-fbottom">
      <p>© <?= $year ?> <?= e($company) ?>. All Rights Reserved. | Windhoek, Namibia</p>
      <div>
        <a href="privacy-policy">Privacy</a>
        <a href="terms-of-service">Terms</a>
        <a href="cookie-policy">Cookies</a>
        <a href="sitemap">Sitemap</a>
        <a href="<?= e(url('admin/login.php')) ?>" class="amt-manage" title="Website admin login"><i class="fas fa-lock"></i> Manage</a>
      </div>
    </div>
  </div>
</footer>

<a href="<?= e(wa_link()) ?>" class="amt-wafloat" target="_blank" aria-label="WhatsApp Us"><i class="fab fa-whatsapp" style="font-size:1.15rem;"></i> WhatsApp Us</a>

<script>
(function(){
  var els=document.querySelectorAll('.service-card,.add-card,.pub-card,.partner-card,.stamp-type,.team-card,.portfolio-card,.tile-card');
  if(!('IntersectionObserver' in window))return;
  var o=new IntersectionObserver(function(en){en.forEach(function(x){if(x.isIntersecting){x.target.style.opacity='1';x.target.style.transform='none';o.unobserve(x.target);}});},{threshold:.1});
  els.forEach(function(el){el.style.opacity='0';el.style.transform='translateY(22px)';el.style.transition='opacity .5s ease, transform .5s ease, box-shadow .3s';o.observe(el);});
  var f=document.getElementById('newsletterForm');
  if(f)f.addEventListener('submit',function(e){e.preventDefault();var msg=document.getElementById('newsletterMsg'),btn=f.querySelector('button'),o=btn.innerHTML;btn.disabled=true;btn.innerHTML='Subscribing…';msg.textContent='';msg.className='newsletter-msg';fetch('newsletter-subscribe',{method:'POST',body:new FormData(f)}).then(r=>r.json()).then(d=>{msg.textContent=d.message;msg.className='newsletter-msg '+(d.success?'ok':'err');if(d.success)f.reset();}).catch(()=>{msg.textContent='Something went wrong. Please try again.';msg.className='newsletter-msg err';}).finally(()=>{btn.disabled=false;btn.innerHTML=o;});});
})();
</script>
<?php
}

/* ---------------------------------------------------------------------------
 * page_head()/page_foot() — used by the custom-design pages (index, services,
 * contact, team, portfolio, about). They load the full shared stylesheet then
 * delegate the navbar/footer to the shared render_nav()/render_footer().
 * ------------------------------------------------------------------------- */

function page_head(string $title, string $desc = '', string $active = ''): void
{
    $company = get_setting('company_name', COMPANY_NAME);
    $desc = $desc ?: 'Premium web development, hosting & domains, printing, CCTV, graphic design, digital marketing and IT support in Windhoek, Namibia.';
    track_visitor($_SERVER['REQUEST_URI'] ?? basename($_SERVER['SCRIPT_NAME'] ?? 'index.php'));
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($title) ?></title>
<meta name="description" content="<?= e($desc) ?>">
<meta name="author" content="<?= e($company) ?>">
<link rel="icon" href="images/fav.png" type="image/x-icon">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<?php
$styleVersion = (string) (@filemtime(APP_ROOT . '/assets/css/style.css') ?: '1');
$componentsVersion = (string) (@filemtime(APP_ROOT . '/assets/css/components.css') ?: '1');
?>
<link rel="stylesheet" href="<?= e(url('assets/css/style.css')) ?>?v=<?= e($styleVersion) ?>">
<link rel="stylesheet" href="<?= e(url('assets/css/components.css')) ?>?v=<?= e($componentsVersion) ?>">
</head>
<body>
<?php render_nav($active); ?>
<?php
}

function page_foot(): void
{
    render_footer();
    echo "\n</body>\n</html>";
}
