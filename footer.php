<?php // footer.php - BIM Digital shared footer ?>

<!-- CTA Banner (shown on all pages except contact) -->
<?php if (!isset($hide_cta) || !$hide_cta): ?>
<section class="cta-banner">
  <div class="container">
    <div class="cta-inner">
      <span class="badge">Start Today</span>
      <h2>Ready to Grow Intelligently?</h2>
      <p>Schedule a strategic consultation and discover how BIM Digital can transform your growth trajectory.</p>
      <div class="cta-actions">
        <a href="contact.php" class="btn btn-white">
          Book a Consultation
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
        <a href="services.php" class="btn btn-outline" style="color:#fff;border-color:rgba(255,255,255,0.3);">
          Explore Services
        </a>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">

      <div class="footer-brand">
        <img src="assets/images/logo.png" alt="BIM Digital" />
        <p>BIM Digital is a global Business Intelligence and Strategic Marketing firm empowering SMEs with enterprise-grade intelligence and market execution capabilities.</p>
      </div>

      <div class="footer-col">
        <h5>Navigation</h5>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About Us</a></li>
          <li><a href="services.php">Our Services</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h5>Services</h5>
        <ul>
          <li><a href="services.php">Business Intelligence</a></li>
          <li><a href="services.php">Strategic Marketing</a></li>
          <li><a href="services.php">Digital Performance</a></li>
          <li><a href="services.php">Media Intelligence</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h5>Connect</h5>
        <ul>
          <li><a href="mailto:info@bimdigital.in">info@bimdigital.in</a></li>
          <li><a href="http://www.bimdigital.in" target="_blank">www.bimdigital.in</a></li>
          <li><a href="contact.php">LinkedIn</a></li>
          <li><a href="contact.php">Schedule a Call</a></li>
        </ul>
      </div>

    </div>

    <div class="footer-bottom">
      <p>&copy; <?= date('Y') ?> BIM Digital (Business Intelligence Media). All rights reserved.</p>
      <div class="footer-bottom-links">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
      </div>
    </div>
  </div>
</footer>

</body>
</html>
