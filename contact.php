<?php
// ════════════════════════════════════════════════
// SMTP Configuration
// ════════════════════════════════════════════════
define('SMTP_HOST',    'sg1-ts4.a2hosting.com');
define('SMTP_PORT',    465);
define('SMTP_USER',    'info@bimdigital.in');
define('SMTP_PASS',    'U0~$^.V21b]Yw');
define('SMTP_FROM',    'info@bimdigital.in');
define('SMTP_NAME',    'BIM Digital');
define('MAIL_TO',      'akhileshs@bimdigital.in');
define('MAIL_TO_NAME', 'Akhilesh — BIM Digital');

require_once __DIR__ . '/smtp_mailer.php';

// ════════════════════════════════════════════════
// Process Form
// ════════════════════════════════════════════════
$form_success = false;
$form_error   = '';
$form_data    = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['_csrf'])) {

    // Simple CSRF validation
    session_start();
    $csrf_valid = isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['_csrf']);

    $name    = trim(strip_tags($_POST['name']    ?? ''));
    $email   = trim(strip_tags($_POST['email']   ?? ''));
    $company = trim(strip_tags($_POST['company'] ?? ''));
    $phone   = trim(strip_tags($_POST['phone']   ?? ''));
    $service = trim(strip_tags($_POST['service'] ?? ''));
    $message = trim(strip_tags($_POST['message'] ?? ''));

    // Preserve data on error
    $form_data = compact('name','email','company','phone','service','message');

    // Validate
    if (!$csrf_valid) {
        $form_error = 'Security token mismatch. Please refresh and try again.';
    } elseif (empty($name)) {
        $form_error = 'Please enter your full name.';
    } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $form_error = 'Please enter a valid email address.';
    } elseif (empty($message)) {
        $form_error = 'Please enter your message.';
    } else {
        // Build HTML email body
        $serviceLabel = match($service) {
            'bi'        => 'Business Intelligence &amp; Analytics',
            'marketing' => 'Strategic Marketing &amp; Brand',
            'digital'   => 'Digital Performance &amp; Demand Generation',
            'media'     => 'Media Intelligence &amp; Communications',
            'all'       => 'Full Growth Partnership',
            default     => 'Not specified',
        };

        $htmlBody = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <style>
    body  { font-family: 'Segoe UI', Arial, sans-serif; background: #f7fbfe; margin: 0; padding: 0; }
    .wrap { max-width: 600px; margin: 30px auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.07); }
    .hd   { background: #00AEEF; padding: 32px 36px; color: #fff; }
    .hd h2{ margin: 0; font-size: 1.4rem; font-weight: 800; }
    .hd p { margin: 4px 0 0; font-size: 0.9rem; opacity: .85; }
    .bd   { padding: 32px 36px; }
    .row  { margin-bottom: 18px; }
    .lbl  { font-size: 0.72rem; text-transform: uppercase; letter-spacing: .1em; color: #8a94a6; font-weight: 700; margin-bottom: 4px; }
    .val  { font-size: 0.95rem; color: #1c2333; font-weight: 500; }
    .msg  { background: #f7fbfe; border: 1px solid #e8eff5; border-radius: 8px; padding: 16px; color: #5a6478; font-size: 0.95rem; line-height: 1.7; white-space: pre-wrap; }
    .ft   { background: #f7fbfe; padding: 20px 36px; text-align: center; font-size: 0.8rem; color: #8a94a6; border-top: 1px solid #e8eff5; }
  </style>
</head>
<body>
<div class="wrap">
  <div class="hd">
    <h2>&#128222; New Contact Form Submission</h2>
    <p>BIM Digital Website — {$_SERVER['HTTP_HOST']}</p>
  </div>
  <div class="bd">
    <div class="row"><div class="lbl">Full Name</div><div class="val">{$name}</div></div>
    <div class="row"><div class="lbl">Email Address</div><div class="val"><a href="mailto:{$email}">{$email}</a></div></div>
    <div class="row"><div class="lbl">Phone</div><div class="val">{$phone}</div></div>
    <div class="row"><div class="lbl">Company</div><div class="val">{$company}</div></div>
    <div class="row"><div class="lbl">Service Interest</div><div class="val">{$serviceLabel}</div></div>
    <div class="row">
      <div class="lbl">Message</div>
      <div class="msg">{$message}</div>
    </div>
  </div>
  <div class="ft">Sent from bimdigital.in &nbsp;|&nbsp; {$_SERVER['REMOTE_ADDR']} &nbsp;|&nbsp; {$_SERVER['HTTP_USER_AGENT']}</div>
</div>
</body>
</html>
HTML;

        $mailer = new SmtpMailer(SMTP_HOST, SMTP_PORT, SMTP_USER, SMTP_PASS, SMTP_FROM, SMTP_NAME);
        $subject = "New Enquiry from {$name} — BIM Digital Website";

        if ($mailer->send(MAIL_TO, MAIL_TO_NAME, $subject, $htmlBody)) {
            $form_success = true;
            $form_data    = []; // clear fields on success

            // Auto-reply to sender
            $replyHtml = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"/>
<style>
  body{font-family:'Segoe UI',Arial,sans-serif;background:#f7fbfe;margin:0;padding:0;}
  .wrap{max-width:600px;margin:30px auto;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.07);}
  .hd{background:#00AEEF;padding:32px 36px;color:#fff;}
  .hd h2{margin:0;font-size:1.4rem;font-weight:800;}
  .bd{padding:32px 36px;color:#5a6478;line-height:1.8;font-size:.95rem;}
  .bd h3{color:#1c2333;font-size:1.1rem;margin-bottom:1rem;}
  .btn{display:inline-block;background:#00AEEF;color:#fff;padding:12px 28px;border-radius:8px;text-decoration:none;font-weight:700;margin-top:1.5rem;}
  .ft{background:#f7fbfe;padding:20px 36px;text-align:center;font-size:.8rem;color:#8a94a6;border-top:1px solid #e8eff5;}
</style>
</head>
<body>
<div class="wrap">
  <div class="hd"><h2>Thank you, {$name}!</h2></div>
  <div class="bd">
    <h3>We've received your message.</h3>
    <p>Our team at BIM Digital will review your enquiry and get back to you within <strong>24–48 business hours</strong>.</p>
    <p>In the meantime, feel free to explore our services or reach us directly:</p>
    <p>&#128222; <strong>+91 98711 97779</strong><br>
       &#128140; <strong>info@bimdigital.in</strong></p>
    <a href="https://bimdigital.in" class="btn">Visit BIM Digital</a>
  </div>
  <div class="ft">&copy; BIM Digital (Business Intelligence Media) &nbsp;|&nbsp; bimdigital.in</div>
</div>
</body>
</html>
HTML;
            // Best-effort auto-reply (ignore failure)
            $mailer->send($email, $name, 'Thank you for contacting BIM Digital', $replyHtml);

        } else {
            $form_error = 'Message could not be sent. Please email us directly at <a href="mailto:info@bimdigital.in">info@bimdigital.in</a> or WhatsApp us at +91&nbsp;98711&nbsp;97779.';
            error_log('[BIM SMTP] ' . $mailer->lastError);
        }
    }
} else {
    // New page load — generate CSRF token
    if (!headers_sent()) {
        session_start();
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(24));
        }
        $csrf_token = $_SESSION['csrf_token'];
    }
}
if (!isset($csrf_token)) {
    if (!isset($_SESSION)) { session_start(); }
    $csrf_token = $_SESSION['csrf_token'] ?? bin2hex(random_bytes(24));
    $_SESSION['csrf_token'] = $csrf_token;
}

// ════════════════════════════════════════════════
$page_title = 'Contact Us';
$page_desc  = 'Get in touch with BIM Digital to schedule a strategic consultation and begin your intelligence-driven growth journey.';
$hide_cta   = true;
include 'header.php';
?>

<!-- ══════════════════════════════════════════
     PAGE HERO
══════════════════════════════════════════ -->
<section class="page-hero">
  <div class="container">
    <div class="page-hero-content">
      <span class="badge">Get in Touch</span>
      <h1>Begin Your <em class="text-cyan">Intelligence-Driven</em> Growth Journey</h1>
      <p>Whether you are seeking clarity in your growth roadmap, enhanced visibility, or structured demand generation — BIM Digital is ready to partner with you.</p>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════
     CONTACT LAYOUT
══════════════════════════════════════════ -->
<section style="background:var(--white);">
  <div class="container">
    <div class="contact-layout">

      <!-- ── Left Info ── -->
      <div class="contact-info">
        <span class="badge" style="margin-bottom:1.5rem;">Contact Information</span>
        <h2>Let's Start a Conversation</h2>
        <p>Connect with our team to schedule a strategic consultation and explore how intelligent systems can redefine your business trajectory.</p>

        <div class="contact-cards">

          <a href="mailto:info@bimdigital.in" class="contact-card">
            <div class="contact-card-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
            <div>
              <div class="contact-card-label">Email</div>
              <div class="contact-card-value" style="color:var(--cyan);">info@bimdigital.in</div>
            </div>
          </a>

          <a href="tel:+919871197779" class="contact-card">
            <div class="contact-card-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.23h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.18 6.18l1.04-.94a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </div>
            <div>
              <div class="contact-card-label">Phone / WhatsApp</div>
              <div class="contact-card-value" style="color:var(--cyan);">+91 98711 97779</div>
            </div>
          </a>

          <a href="https://wa.me/919871197779" target="_blank" rel="noopener" class="contact-card">
            <div class="contact-card-icon" style="background:rgba(37,211,102,0.1);">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="#25D366"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
            </div>
            <div>
              <div class="contact-card-label">WhatsApp</div>
              <div class="contact-card-value" style="color:#25D366;">Chat with us instantly</div>
            </div>
          </a>

          <a href="http://www.bimdigital.in" target="_blank" rel="noopener" class="contact-card">
            <div class="contact-card-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
            </div>
            <div>
              <div class="contact-card-label">Website</div>
              <div class="contact-card-value" style="color:var(--cyan);">www.bimdigital.in</div>
            </div>
          </a>

        </div><!-- /.contact-cards -->

        <div style="margin-top:2rem;padding:1.75rem;background:var(--off-white);border:1px solid var(--border-light);border-radius:var(--radius-lg);">
          <div style="font-family:'Raleway',sans-serif;font-weight:800;color:var(--dark);margin-bottom:0.5rem;">Strategic Consultation</div>
          <p style="font-size:0.9rem;">Our first consultation is a deep strategic session — no obligation, no generic advice. We discuss your business, your market, and your goals in detail.</p>
        </div>
      </div><!-- /.contact-info -->

      <!-- ── Right Form ── -->
      <div class="contact-form">
        <h3>Send Us a Message</h3>

        <?php if ($form_success): ?>
        <div style="background:rgba(0,174,239,0.08);border:1.5px solid var(--cyan);border-radius:var(--radius);padding:1.5rem;margin-bottom:1.5rem;text-align:center;">
          <div style="font-size:2rem;margin-bottom:0.5rem;">✅</div>
          <div style="font-family:'Raleway',sans-serif;font-weight:800;color:var(--cyan);font-size:1.1rem;margin-bottom:0.5rem;">Message Sent Successfully!</div>
          <p style="font-size:0.9rem;margin:0;color:var(--text-muted);">Thank you for reaching out. Our team will contact you within 24–48 hours. Check your inbox for a confirmation email.</p>
        </div>
        <?php endif; ?>

        <?php if ($form_error): ?>
        <div style="background:#fff0f0;border:1.5px solid #ffcdd2;border-radius:var(--radius);padding:1rem 1.25rem;margin-bottom:1.5rem;color:#c62828;font-size:0.9rem;display:flex;align-items:flex-start;gap:8px;">
          <span style="font-size:1.1rem;flex-shrink:0;">⚠️</span>
          <span><?= $form_error ?></span>
        </div>
        <?php endif; ?>

        <form method="POST" action="contact.php" novalidate>
          <input type="hidden" name="_csrf" value="<?= htmlspecialchars($csrf_token) ?>" />

          <div class="form-row">
            <div class="form-group">
              <label for="name">Full Name <span style="color:var(--cyan);">*</span></label>
              <input type="text" id="name" name="name" placeholder="John Smith"
                     value="<?= htmlspecialchars($form_data['name'] ?? '') ?>" required />
            </div>
            <div class="form-group">
              <label for="email">Email Address <span style="color:var(--cyan);">*</span></label>
              <input type="email" id="email" name="email" placeholder="john@company.com"
                     value="<?= htmlspecialchars($form_data['email'] ?? '') ?>" required />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="phone">Phone / WhatsApp</label>
              <input type="tel" id="phone" name="phone" placeholder="+91 98711 97779"
                     value="<?= htmlspecialchars($form_data['phone'] ?? '') ?>" />
            </div>
            <div class="form-group">
              <label for="company">Company Name</label>
              <input type="text" id="company" name="company" placeholder="Your Company"
                     value="<?= htmlspecialchars($form_data['company'] ?? '') ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="service">Service Interest</label>
            <select id="service" name="service">
              <option value="">— Select a service —</option>
              <option value="bi"        <?= ($form_data['service'] ?? '') === 'bi'        ? 'selected' : '' ?>>Business Intelligence &amp; Analytics</option>
              <option value="marketing" <?= ($form_data['service'] ?? '') === 'marketing' ? 'selected' : '' ?>>Strategic Marketing &amp; Brand</option>
              <option value="digital"   <?= ($form_data['service'] ?? '') === 'digital'   ? 'selected' : '' ?>>Digital Performance &amp; Demand Generation</option>
              <option value="media"     <?= ($form_data['service'] ?? '') === 'media'     ? 'selected' : '' ?>>Media Intelligence &amp; Communications</option>
              <option value="all"       <?= ($form_data['service'] ?? '') === 'all'       ? 'selected' : '' ?>>Full Growth Partnership</option>
            </select>
          </div>

          <div class="form-group">
            <label for="message">Your Message <span style="color:var(--cyan);">*</span></label>
            <textarea id="message" name="message" placeholder="Tell us about your business, goals, and what you're looking to achieve..." required><?= htmlspecialchars($form_data['message'] ?? '') ?></textarea>
          </div>

          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;font-size:0.95rem;padding:15px 28px;">
            Send Message
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
          </button>

          <p style="font-size:0.78rem;color:var(--text-light);text-align:center;margin-top:1rem;">
            By submitting this form you agree to our privacy policy. We never share your data.
          </p>
        </form>
      </div><!-- /.contact-form -->

    </div><!-- /.contact-layout -->
  </div>
</section>

<?php include 'footer.php'; ?>
