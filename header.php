<?php
// header.php - BIM Digital shared header
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= isset($page_title) ? htmlspecialchars($page_title) . ' | BIM Digital' : 'BIM Digital – Business Intelligence Media' ?></title>
  <meta name="description" content="<?= isset($page_desc) ? htmlspecialchars($page_desc) : 'BIM Digital is a global Business Intelligence and Strategic Marketing firm helping SMEs achieve measurable, intelligent growth.' ?>" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <!-- Favicon placeholder -->
  <link rel="icon" type="image/png" href="assets/images/logo.png" />
</head>
<body>

<header class="site-header" id="site-header">
  <div class="container">
    <nav class="nav-inner">
      <a href="index.php" class="nav-logo">
        <img src="assets/images/logo.png" alt="BIM Digital" />
      </a>

      <ul class="nav-links" id="nav-links">
        <li><a href="index.php"    class="<?= $current_page === 'index'   ? 'active' : '' ?>">Home</a></li>
        <li><a href="about.php"    class="<?= $current_page === 'about'   ? 'active' : '' ?>">About</a></li>
        <li><a href="services.php" class="<?= $current_page === 'services'? 'active' : '' ?>">Services</a></li>
        <li><a href="contact.php"  class="<?= $current_page === 'contact' ? 'active' : '' ?>">Contact</a></li>
        <li class="nav-cta">
          <a href="contact.php" class="btn btn-primary">
            Get Started
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </li>
      </ul>

      <button class="hamburger" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </nav>
  </div>
</header>

<script>
  // Sticky header
  const header = document.getElementById('site-header');
  window.addEventListener('scroll', () => {
    header.classList.toggle('scrolled', window.scrollY > 20);
  });
  // Mobile nav
  const hamburger = document.getElementById('hamburger');
  const navLinks  = document.getElementById('nav-links');
  hamburger.addEventListener('click', () => {
    navLinks.classList.toggle('open');
  });
</script>
