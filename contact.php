<?php
$page_title = 'Contact Us';
$page_desc  = 'Get in touch with BIM Digital to schedule a strategic consultation and begin your intelligence-driven growth journey.';
$hide_cta   = true; // Don't show CTA banner on contact page

// Handle form submission
$form_success = false;
$form_error   = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name    = trim($_POST['name']    ?? '');
  $email   = trim($_POST['email']   ?? '');
  $company = trim($_POST['company'] ?? '');
  $service = trim($_POST['service'] ?? '');
  $message = trim($_POST['message'] ?? '');

  if (!$name || !$email || !$message) {
    $form_error = 'Please fill in all required fields.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $form_error = 'Please enter a valid email address.';
  } else {
    // In production: use mail() or SMTP
    // mail('info@bimdigital.com', 'New Contact: '.$name, $message, 'From: '.$email);
    $form_success = true;
  }
}

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

      <!-- Left: Info -->
      <div class="contact-info">
        <span class="badge" style="margin-bottom:1.5rem;">Contact Information</span>
        <h2>Let's Start a Conversation</h2>
        <p>Connect with our team to schedule a strategic consultation and explore how intelligent systems can redefine your business trajectory.</p>

        <div class="contact-cards">
          <div class="contact-card">
            <div class="contact-card-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
            <div>
              <div class="contact-card-label">Email</div>
              <div class="contact-card-value"><a href="mailto:info@bimdigital.com" style="color:var(--cyan);">info@bimdigital.com</a></div>
            </div>
          </div>

          <div class="contact-card">
            <div class="contact-card-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
            </div>
            <div>
              <div class="contact-card-label">Website</div>
              <div class="contact-card-value"><a href="http://www.bimdigital.com" target="_blank" style="color:var(--cyan);">www.bimdigital.com</a></div>
            </div>
          </div>

          <div class="contact-card">
            <div class="contact-card-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.23h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.18 6.18l1.04-.94a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </div>
            <div>
              <div class="contact-card-label">Phone</div>
              <div class="contact-card-value">+[Your Contact Number]</div>
            </div>
          </div>
        </div>

        <div style="margin-top:2.5rem;padding:1.75rem;background:var(--off-white);border:1px solid var(--border-light);border-radius:var(--radius-lg);">
          <div style="font-family:'Syne',sans-serif;font-weight:700;color:var(--dark);margin-bottom:0.5rem;">Strategic Consultation</div>
          <p style="font-size:0.9rem;">Our first consultation is a deep strategic session — no obligation, no generic advice. We discuss your business, your market, and your goals in detail.</p>
        </div>
      </div>

      <!-- Right: Form -->
      <div class="contact-form">
        <h3>Send Us a Message</h3>

        <?php if ($form_success): ?>
        <div style="background:rgba(0,174,239,0.08);border:1px solid var(--border);border-radius:var(--radius);padding:1.5rem;margin-bottom:1.5rem;text-align:center;">
          <div style="font-family:'Syne',sans-serif;font-weight:700;color:var(--cyan);margin-bottom:0.5rem;">Message Sent!</div>
          <p style="font-size:0.9rem;margin:0;">Thank you for reaching out. Our team will contact you within 24–48 hours.</p>
        </div>
        <?php endif; ?>

        <?php if ($form_error): ?>
        <div style="background:#fff0f0;border:1px solid #ffcdd2;border-radius:var(--radius);padding:1rem;margin-bottom:1.5rem;color:#c62828;font-size:0.9rem;">
          <?= htmlspecialchars($form_error) ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="contact.php">
          <div class="form-row">
            <div class="form-group">
              <label for="name">Full Name <span style="color:var(--cyan);">*</span></label>
              <input type="text" id="name" name="name" placeholder="John Smith" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required />
            </div>
            <div class="form-group">
              <label for="email">Email Address <span style="color:var(--cyan);">*</span></label>
              <input type="email" id="email" name="email" placeholder="john@company.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="company">Company Name</label>
              <input type="text" id="company" name="company" placeholder="Your Company" value="<?= htmlspecialchars($_POST['company'] ?? '') ?>" />
            </div>
            <div class="form-group">
              <label for="service">Service Interest</label>
              <select id="service" name="service">
                <option value="">Select a service</option>
                <option value="bi" <?= ($_POST['service'] ?? '') === 'bi' ? 'selected' : '' ?>>Business Intelligence &amp; Analytics</option>
                <option value="marketing" <?= ($_POST['service'] ?? '') === 'marketing' ? 'selected' : '' ?>>Strategic Marketing &amp; Brand</option>
                <option value="digital" <?= ($_POST['service'] ?? '') === 'digital' ? 'selected' : '' ?>>Digital Performance &amp; Demand Gen</option>
                <option value="media" <?= ($_POST['service'] ?? '') === 'media' ? 'selected' : '' ?>>Media Intelligence &amp; Comms</option>
                <option value="all" <?= ($_POST['service'] ?? '') === 'all' ? 'selected' : '' ?>>Full Growth Partnership</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="message">Your Message <span style="color:var(--cyan);">*</span></label>
            <textarea id="message" name="message" placeholder="Tell us about your business, goals, and what you're looking to achieve..." required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
          </div>

          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
            Send Message
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
          </button>
        </form>
      </div>

    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
