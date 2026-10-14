<?php
/** AMATETA — Contact (self-contained). Saves to DB + sends branded emails. */
require_once __DIR__ . '/config/config.php';

$sent = false;
$error = '';
$notice = '';
$old = ['name' => '', 'email' => '', 'phone' => '', 'service' => clean($_GET['service'] ?? ''), 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $error = 'Your session expired. Please try again.';
    } elseif (!empty($_POST['website'])) {
        $sent = true; // honeypot — pretend success for bots
    } elseif (!rate_limit('contact', 3, 600)) {
        $error = 'You have already sent a few messages. Please wait '
               . ceil(rate_limit_wait('contact', 600) / 60) . ' minute(s) before sending another.';
    } elseif (!form_timer_ok('contact')) {
        $sent = true; // submitted faster than a human can type — silently drop
    } else {
        $old['name']    = clean($_POST['name'] ?? '');
        $old['email']   = clean_email($_POST['email'] ?? '');
        $old['phone']   = clean($_POST['phone'] ?? '');
        $old['service'] = clean($_POST['service'] ?? '');
        $old['message'] = clean($_POST['message'] ?? '');
        $subject        = clean($_POST['subject'] ?? '') ?: ('Enquiry: ' . ($old['service'] ?: 'General'));

        $captchaOk = isset($_SESSION['captcha_sum']) && (int) ($_POST['captcha'] ?? -1) === (int) $_SESSION['captcha_sum'];
        if (!$captchaOk) {
            $error = 'Please answer the security question correctly (anti-spam check).';
        } elseif ($old['name'] === '' || $old['email'] === '' || $old['message'] === '') {
            $error = 'Please fill in your name, a valid email and your message.';
        } elseif (is_spam($old['message'], $old['name'], $_POST['email'] ?? '')) {
            $sent = true; // looks like bot spam — accept quietly, store nothing
        } else {
            // 1) Store in database
            db()->prepare('INSERT INTO messages (name,email,phone,service,subject,message,ip) VALUES (?,?,?,?,?,?,?)')
                ->execute([$old['name'], $old['email'], $old['phone'], $old['service'], $subject, $old['message'], client_ip()]);

            // 2) Notify the company (branded)
            $company = get_setting('company_name', COMPANY_NAME);
            $adminBody = '<p>You have received a new enquiry from your website:</p>
              <table style="width:100%;border-collapse:collapse;font-size:14px;margin:12px 0;">
                <tr><td style="padding:8px 0;color:#5a7a99;width:120px;">Name</td><td style="padding:8px 0;font-weight:600;">' . e($old['name']) . '</td></tr>
                <tr><td style="padding:8px 0;color:#5a7a99;">Email</td><td style="padding:8px 0;"><a href="mailto:' . e($old['email']) . '" style="color:#0077b6;">' . e($old['email']) . '</a></td></tr>
                <tr><td style="padding:8px 0;color:#5a7a99;">Phone</td><td style="padding:8px 0;">' . e($old['phone'] ?: '—') . '</td></tr>
                <tr><td style="padding:8px 0;color:#5a7a99;">Service</td><td style="padding:8px 0;">' . e($old['service'] ?: '—') . '</td></tr>
                <tr><td style="padding:8px 0;color:#5a7a99;vertical-align:top;">Message</td><td style="padding:8px 0;">' . nl2br(e($old['message'])) . '</td></tr>
              </table>';
            $adminHtml = email_template('📨 New Website Enquiry', $adminBody, 'New enquiry from ' . $old['name']);
            // Goes to our main inbox (order@amateta.com). Reply-To is the visitor,
            // so hitting "Reply" answers the client instead of ourselves.
            $adminErr = null;
            send_mail(mail_inbox(), '[Website] ' . $subject, $adminHtml, $adminErr, [
                'reply_to'   => $old['email'],
                'reply_name' => $old['name'],
            ]);

            // 3) Branded auto-reply to the visitor
            $replyBody = '<p>Hi ' . e($old['name']) . ',</p>
              <p>Thank you for reaching out to <strong>' . e($company) . '</strong>! 💙 We have received your message and our team will get back to you shortly — usually within a few business hours.</p>
              <p style="background:#f4f8fc;border-left:3px solid #00b4d8;padding:12px 16px;border-radius:8px;color:#3a5472;"><em>"' . nl2br(e($old['message'])) . '"</em></p>
              <p>Need a faster response? Chat with us directly on WhatsApp:</p>
              <p style="text-align:center;margin:24px 0;"><a href="' . e(wa_link('Hello, I just sent an enquiry through your website')) . '" style="background:linear-gradient(135deg,#25d366,#128c7e);color:#fff;text-decoration:none;padding:13px 28px;border-radius:50px;font-weight:700;display:inline-block;">💬 Chat on WhatsApp</a></p>';
            $replyHtml = email_template('We received your message ✅', $replyBody, 'Thanks for contacting ' . $company);
            $replyErr = null;
            $replySent = send_mail($old['email'], 'Thank you for contacting ' . $company, $replyHtml, $replyErr, [
                'reply_to'   => mail_inbox(),
                'reply_name' => $company,
            ]);
            if (!$replySent) {
                // The enquiry is safely stored — just tell the visitor the truth
                // instead of promising a confirmation email that never arrives.
                $notice = 'We could not send your confirmation email, but your message reached us safely and we will reply shortly.';
            }

            $sent = true;
            $old = ['name' => '', 'email' => '', 'phone' => '', 'service' => '', 'message' => ''];
        }
    }
}

// Fresh anti-spam math question for this page view
$cap_a = random_int(2, 9);
$cap_b = random_int(2, 9);
$_SESSION['captcha_sum'] = $cap_a + $cap_b;

$phone   = get_setting('contact_phone', '+264 85 344 1248');
$email   = get_setting('contact_email', 'info@amateta.com');
$order   = get_setting('order_email', 'order@amateta.com');
$addrMain = get_setting('address_main', 'Eluwa Building, Shop No.2, Independence Avenue, Windhoek, Namibia');

page_head('Contact Us · ' . get_setting('company_name', COMPANY_NAME), 'Contact AMATETA Techs & Designs in Windhoek, Namibia — web development, hosting, printing, stamps and IT support. Call, email or WhatsApp us.', 'contact');
?>

<section class="page-hero">
  <div class="container">
    <h1>Get In <span>Touch</span></h1>
    <p>Have a project in mind or need a quote? Send us a message and we'll respond fast. Or reach us instantly on WhatsApp.</p>
    <div class="breadcrumb"><a href="index.php">Home</a><i class="fas fa-chevron-right"></i><span>Contact</span></div>
  </div>
</section>

<section class="section-pad" style="background:var(--offwhite);">
  <div class="container">
    <div class="contact-grid">
      <!-- Info -->
      <div class="contact-info-card">
        <h3>Contact Information</h3>
        <p style="color:rgba(255,255,255,0.7);font-size:0.9rem;margin-bottom:24px;line-height:1.7;">Reach out through any channel below — we're here to help bring your project to life.</p>
        <div class="contact-info-item"><div class="ci-ic"><i class="fas fa-map-marker-alt"></i></div><div><strong>Visit Us</strong><span><?= e($addrMain) ?></span></div></div>
        <div class="contact-info-item"><div class="ci-ic"><i class="fas fa-phone"></i></div><div><strong>Call Us</strong><a href="tel:<?= e(preg_replace('/\s/', '', $phone)) ?>"><?= e($phone) ?></a></div></div>
        <div class="contact-info-item"><div class="ci-ic"><i class="fas fa-envelope"></i></div><div><strong>Email Us</strong><a href="mailto:<?= e($email) ?>"><?= e($email) ?></a><br><a href="mailto:<?= e($order) ?>"><?= e($order) ?></a></div></div>
        <div class="contact-info-item"><div class="ci-ic"><i class="fab fa-whatsapp"></i></div><div><strong>WhatsApp</strong><a href="<?= e(wa_link()) ?>" target="_blank">Chat with us instantly</a></div></div>
        <a href="<?= e(wa_link('Hello, I would like to order a service')) ?>" target="_blank" class="btn btn-wa" style="width:100%;margin-top:8px;"><i class="fab fa-whatsapp"></i> Order on WhatsApp</a>
      </div>

      <!-- Form -->
      <div class="form-card">
        <?php if ($sent && $notice): ?>
          <div class="alert alert-success"><i class="fas fa-circle-check"></i> Thank you! Your message has been received. <?= e($notice) ?></div>
        <?php elseif ($sent): ?>
          <div class="alert alert-success"><i class="fas fa-circle-check"></i> Thank you! Your message has been sent. We'll be in touch shortly — a confirmation email is on its way to your inbox (please also check your spam folder).</div>
        <?php elseif ($error): ?>
          <div class="alert alert-error"><i class="fas fa-circle-exclamation"></i> <?= e($error) ?></div>
        <?php endif; ?>
        <h3 style="font-family:var(--ff-head);font-size:1.4rem;color:var(--navy);margin-bottom:6px;">Send Us a Message</h3>
        <p style="color:var(--text-muted);font-size:0.88rem;margin-bottom:22px;">Fill in the form and we'll get back to you as soon as possible.</p>
        <form method="post" novalidate>
          <?= csrf_field() ?>
          <?= form_timer_field('contact') ?>
          <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off" aria-hidden="true">
          <div class="form-row">
            <div class="form-group"><label>Your Name *</label><input type="text" name="name" class="form-control" value="<?= e($old['name']) ?>" required></div>
            <div class="form-group"><label>Email Address *</label><input type="email" name="email" class="form-control" value="<?= e($old['email']) ?>" required></div>
          </div>
          <div class="form-row">
            <div class="form-group"><label>Phone (optional)</label><input type="text" name="phone" class="form-control" value="<?= e($old['phone']) ?>"></div>
            <div class="form-group"><label>Service Needed</label>
              <select name="service" class="form-control">
                <option value="">Select a service…</option>
                <?php foreach (fetch_all('SELECT title FROM services WHERE active=1 ORDER BY sort_order,id') as $sv): ?>
                  <option <?= $old['service'] === $sv['title'] ? 'selected' : '' ?>><?= e($sv['title']) ?></option>
                <?php endforeach; ?>
                <option>Other</option>
              </select>
            </div>
          </div>
          <div class="form-group"><label>Message *</label><textarea name="message" class="form-control" placeholder="Tell us about your project…" required><?= e($old['message']) ?></textarea></div>
          <div class="form-group" style="max-width:240px;">
            <label><i class="fas fa-shield-halved" style="color:var(--blue);"></i> Security check: what is <?= $cap_a ?> + <?= $cap_b ?>? *</label>
            <input type="number" name="captcha" class="form-control" required placeholder="Type the answer" autocomplete="off">
          </div>
          <button type="submit" class="btn btn-primary btn-lg" style="width:100%;"><i class="fas fa-paper-plane"></i> Send Message</button>
        </form>
      </div>
    </div>
  </div>
</section>

<?php page_foot(); ?>
