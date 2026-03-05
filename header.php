<?php
// header.php — BIM Digital
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
  <meta name="theme-color" content="#00AEEF" />
  <title><?= isset($page_title) ? htmlspecialchars($page_title) . ' | BIM Digital' : 'BIM Digital – Business Intelligence Media' ?></title>
  <meta name="description" content="<?= isset($page_desc) ? htmlspecialchars($page_desc) : 'BIM Digital is a global Business Intelligence and Strategic Marketing firm helping SMEs achieve measurable, intelligent growth.' ?>" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="icon" type="image/png" href="assets/images/logo.png" />
</head>
<body>

<!-- ══ HEADER ══ -->
<header class="site-header" id="site-header">
  <div class="container">
    <nav class="nav-inner" role="navigation" aria-label="Main navigation">

      <a href="index.php" class="nav-logo" aria-label="BIM Digital Home">
        <img src="assets/images/logo.png" alt="BIM Digital" width="140" height="44" />
      </a>

      <!-- Desktop nav links -->
      <ul class="nav-links" id="nav-links" role="menubar">
        <li role="none"><a href="index.php"    role="menuitem" class="<?= $current_page === 'index'    ? 'active' : '' ?>">Home</a></li>
        <li role="none"><a href="about.php"    role="menuitem" class="<?= $current_page === 'about'    ? 'active' : '' ?>">About</a></li>
        <li role="none"><a href="services.php" role="menuitem" class="<?= $current_page === 'services' ? 'active' : '' ?>">Services</a></li>
        <li role="none"><a href="contact.php"  role="menuitem" class="<?= $current_page === 'contact'  ? 'active' : '' ?>">Contact</a></li>
        <li role="none" class="nav-cta">
          <a href="contact.php" class="btn btn-primary" role="menuitem">
            Get Started
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </li>
      </ul>

      <!-- Hamburger button (mobile only) -->
      <button class="hamburger" id="hamburger" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="mobile-nav">
        <span></span>
        <span></span>
        <span></span>
      </button>

    </nav>
  </div>
</header>

<!-- ══ MOBILE NAV DRAWER ══ -->
<div class="mobile-nav" id="mobile-nav" aria-hidden="true">
  <div class="mobile-nav-header">
    <a href="index.php" class="mobile-nav-logo">
      <img src="assets/images/logo.png" alt="BIM Digital" height="38" />
    </a>
    <button class="mobile-nav-close" id="mobile-nav-close" aria-label="Close navigation">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg>
    </button>
  </div>
  <ul class="mobile-nav-links">
    <li><a href="index.php"    class="<?= $current_page === 'index'    ? 'active' : '' ?>">Home</a></li>
    <li><a href="about.php"    class="<?= $current_page === 'about'    ? 'active' : '' ?>">About</a></li>
    <li><a href="services.php" class="<?= $current_page === 'services' ? 'active' : '' ?>">Services</a></li>
    <li><a href="contact.php"  class="<?= $current_page === 'contact'  ? 'active' : '' ?>">Contact</a></li>
  </ul>
  <div class="mobile-nav-footer">
    <a href="contact.php" class="btn btn-primary" style="width:100%;justify-content:center;">
      Get Started
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
    </a>
    <a href="tel:+919871197779" class="mobile-nav-phone">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.23h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.18 6.18l1.04-.94a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
      +91 98711 97779
    </a>
  </div>
</div>
<!-- Backdrop -->
<div class="mobile-nav-backdrop" id="mobile-nav-backdrop"></div>

<!-- ══ WHATSAPP STICKY CTA ══ -->
<a href="https://wa.me/919871197779?text=Hello%20BIM%20Digital%2C%20I%20would%20like%20to%20know%20more%20about%20your%20services."
   class="whatsapp-sticky" target="_blank" rel="noopener noreferrer" aria-label="Chat with us on WhatsApp">
  <span class="whatsapp-sticky-icon">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>
    </svg>
  </span>
  <span class="whatsapp-sticky-label">Chat with us</span>
</a>

<script>
(function () {
  'use strict';

  /* ── Sticky header ── */
  const header = document.getElementById('site-header');
  window.addEventListener('scroll', function () {
    header.classList.toggle('scrolled', window.scrollY > 20);
  }, { passive: true });

  /* ── Mobile nav ── */
  var hamburger = document.getElementById('hamburger');
  var mobileNav = document.getElementById('mobile-nav');
  var backdrop  = document.getElementById('mobile-nav-backdrop');
  var closeBtn  = document.getElementById('mobile-nav-close');

  function openNav() {
    mobileNav.classList.add('open');
    backdrop.classList.add('open');
    hamburger.classList.add('active');
    hamburger.setAttribute('aria-expanded', 'true');
    mobileNav.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }

  function closeNav() {
    mobileNav.classList.remove('open');
    backdrop.classList.remove('open');
    hamburger.classList.remove('active');
    hamburger.setAttribute('aria-expanded', 'false');
    mobileNav.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }

  hamburger.addEventListener('click', function (e) {
    e.stopPropagation();
    mobileNav.classList.contains('open') ? closeNav() : openNav();
  });

  if (closeBtn)  closeBtn.addEventListener('click',  closeNav);
  if (backdrop)  backdrop.addEventListener('click',  closeNav);

  // Close when any nav link is clicked
  var navLinks = mobileNav.querySelectorAll('a');
  navLinks.forEach(function (link) {
    link.addEventListener('click', closeNav);
  });

  // Close on Escape key
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && mobileNav.classList.contains('open')) closeNav();
  });
})();
</script>
