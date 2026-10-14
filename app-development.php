<?php
require_once __DIR__ . '/config/config.php';

page_head(
    'Mobile App Development in Namibia | ' . get_setting('company_name', COMPANY_NAME),
    'Custom Android, iOS, web and business app development in Windhoek, Namibia—from product planning and UX design to secure launch and ongoing support.',
    'apps'
);
?>
<style>
.app-hero{min-height:640px;display:grid;align-items:center;position:relative;overflow:hidden;background:#061d35;color:#fff}
.app-hero:before{content:"";position:absolute;inset:0;background:linear-gradient(90deg,rgba(3,17,35,.98) 0%,rgba(3,24,48,.9) 40%,rgba(3,24,48,.15) 74%),url('images/app-development-studio.webp') center/cover no-repeat}
.app-hero .container,.app-section .container{position:relative;z-index:1}.app-copy{max-width:650px;padding:90px 0}.app-kicker{display:inline-flex;gap:8px;align-items:center;padding:8px 13px;border-radius:99px;background:rgba(0,180,216,.13);border:1px solid rgba(0,180,216,.35);color:#7ce9ff;font-weight:700;font-size:.78rem;letter-spacing:.04em;text-transform:uppercase}
.app-copy h1{font-size:clamp(2.25rem,5vw,4.7rem);line-height:1.03;margin:20px 0;font-weight:800}.app-copy h1 span{color:#00b4d8}.app-copy p{font-size:1.08rem;line-height:1.75;color:rgba(255,255,255,.78);max-width:610px}.app-actions{display:flex;flex-wrap:wrap;gap:12px;margin-top:30px}.app-proof{display:flex;gap:22px;flex-wrap:wrap;margin-top:28px;color:rgba(255,255,255,.72);font-size:.84rem}.app-proof span{display:flex;align-items:center;gap:7px}.app-proof i{color:#35d07f}
.app-section{padding:86px 0}.app-intro{text-align:center;max-width:760px;margin:0 auto 42px}.app-intro h2{font-size:clamp(1.8rem,4vw,3rem);color:var(--navy);margin:12px 0}.app-intro p{color:var(--text-muted);line-height:1.75}.app-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}.app-card{background:#fff;border:1px solid rgba(10,37,64,.08);border-radius:18px;padding:28px;box-shadow:0 10px 35px rgba(10,37,64,.07);transition:.25s}.app-card:hover{transform:translateY(-5px);box-shadow:0 18px 46px rgba(10,37,64,.12)}.app-card i{width:52px;height:52px;border-radius:14px;display:grid;place-items:center;background:linear-gradient(135deg,#00b4d8,#0077b6);color:#fff;font-size:1.25rem}.app-card h3{font-size:1.05rem;color:var(--navy);margin:18px 0 9px}.app-card p{font-size:.88rem;line-height:1.65;color:var(--text-muted)}
.app-process{background:linear-gradient(180deg,#f4f8fc,#edf5fb)}.process-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:14px;counter-reset:steps}.process-step{position:relative;background:#fff;border-radius:16px;padding:24px 20px;border:1px solid rgba(0,119,182,.12)}.process-step:before{counter-increment:steps;content:"0" counter(steps);display:block;color:#00a6ca;font-weight:800;font-size:.78rem;margin-bottom:14px}.process-step h3{font-size:.96rem;margin-bottom:8px}.process-step p{font-size:.8rem;color:var(--text-muted);line-height:1.55}
.app-cta{margin:0 auto 86px;max-width:1160px;border-radius:24px;padding:48px;background:linear-gradient(135deg,#03045e,#0077b6);color:#fff;display:flex;align-items:center;justify-content:space-between;gap:30px}.app-cta h2{font-size:clamp(1.55rem,3vw,2.4rem);margin-bottom:8px}.app-cta p{color:rgba(255,255,255,.75)}
@media(max-width:900px){.app-grid{grid-template-columns:repeat(2,1fr)}.process-grid{grid-template-columns:repeat(2,1fr)}.app-hero:before{background:linear-gradient(90deg,rgba(3,17,35,.97),rgba(3,24,48,.77)),url('images/app-development-studio.webp') 63% center/cover no-repeat}}
@media(max-width:600px){.app-hero{min-height:620px}.app-copy{padding:68px 0}.app-grid,.process-grid{grid-template-columns:1fr}.app-actions .btn{width:100%;justify-content:center}.app-cta{margin:0 16px 70px;padding:32px 24px;display:block}.app-cta .btn{margin-top:22px;width:100%;justify-content:center}}
</style>

<main>
  <section class="app-hero">
    <div class="container"><div class="app-copy">
      <span class="app-kicker"><i class="fas fa-mobile-screen-button"></i> App development is now available</span>
      <h1>Turn your idea into a <span>real app.</span></h1>
      <p>We plan, design, develop and support reliable mobile and web applications for Namibian businesses—built around your users, operations and growth goals.</p>
      <div class="app-actions">
        <a class="btn btn-orange btn-lg" href="contact.php?service=App%20Development"><i class="fas fa-rocket"></i> Start Your App</a>
        <a class="btn btn-primary btn-lg" target="_blank" rel="noopener" href="<?= e(wa_link('Hello, I would like to discuss an app development project')) ?>"><i class="fab fa-whatsapp"></i> Discuss on WhatsApp</a>
      </div>
      <div class="app-proof"><span><i class="fas fa-check-circle"></i> Android & iOS</span><span><i class="fas fa-check-circle"></i> Secure back-office systems</span><span><i class="fas fa-check-circle"></i> Launch & support</span></div>
    </div></div>
  </section>

  <section class="app-section">
    <div class="container">
      <div class="app-intro"><span class="section-label"><i class="fas fa-code"></i> What we build</span><h2>Apps made for how your business works</h2><p>From customer-facing mobile apps to internal systems, every project is designed for practical daily use, speed and maintainability.</p></div>
      <div class="app-grid">
        <article class="app-card"><i class="fas fa-mobile-screen"></i><h3>Mobile applications</h3><p>Responsive Android and iOS experiences for customers, field teams and service delivery.</p></article>
        <article class="app-card"><i class="fas fa-window-maximize"></i><h3>Web applications</h3><p>Secure browser-based portals, dashboards, booking systems and operational tools.</p></article>
        <article class="app-card"><i class="fas fa-cart-shopping"></i><h3>Commerce & payments</h3><p>Catalogues, ordering, subscriptions and payment-ready customer journeys.</p></article>
        <article class="app-card"><i class="fas fa-database"></i><h3>Business systems</h3><p>Custom workflows for inventory, sales, reporting, staff and customer management.</p></article>
        <article class="app-card"><i class="fas fa-plug"></i><h3>Integrations</h3><p>Connect existing websites, APIs, notifications and third-party business services.</p></article>
        <article class="app-card"><i class="fas fa-shield-halved"></i><h3>Support & improvement</h3><p>Monitoring, updates, security reviews and feature releases after launch.</p></article>
      </div>
    </div>
  </section>

  <section class="app-section app-process"><div class="container">
    <div class="app-intro"><span class="section-label"><i class="fas fa-route"></i> Our process</span><h2>A clear path from idea to launch</h2><p>You stay involved at each stage, with clear deliverables and no mystery around what comes next.</p></div>
    <div class="process-grid">
      <article class="process-step"><h3>Discovery</h3><p>Goals, users, workflows and success criteria.</p></article>
      <article class="process-step"><h3>Product plan</h3><p>Scope, priorities, technical approach and milestones.</p></article>
      <article class="process-step"><h3>UX & interface</h3><p>Screen flows and a polished, usable visual system.</p></article>
      <article class="process-step"><h3>Development</h3><p>Tested functionality with regular progress reviews.</p></article>
      <article class="process-step"><h3>Launch & care</h3><p>Deployment, handover, monitoring and ongoing support.</p></article>
    </div>
  </div></section>

  <section class="app-cta"><div><h2>Ready to build your application?</h2><p>Tell us what you want to improve, automate or launch. We’ll help shape the right solution.</p></div><a class="btn btn-orange btn-lg" href="contact.php?service=App%20Development"><i class="fas fa-paper-plane"></i> Request a Consultation</a></section>
</main>
<?php page_foot(); ?>
