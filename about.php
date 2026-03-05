<?php
$page_title = 'About Us';
$page_desc  = 'Learn about BIM Digital — our story, mission, vision, and the multidisciplinary team powering intelligent growth for SMEs worldwide.';
include 'header.php';
?>

<!-- ══════════════════════════════════════════
     PAGE HERO
══════════════════════════════════════════ -->
<section class="page-hero">
  <div class="container">
    <div class="page-hero-content">
      <span class="badge">Our Story</span>
      <h1>Intelligence Built to <em class="text-cyan">Democratize</em> Growth</h1>
      <p>BIM Digital was founded with a singular vision — to make high-quality Business Intelligence and strategic marketing accessible to small and growing businesses across the globe.</p>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════
     ABOUT GRID
══════════════════════════════════════════ -->
<section style="background:var(--white);">
  <div class="container">
    <div class="about-grid">
      <div>
        <span class="badge" style="margin-bottom:1.5rem;">Who We Are</span>
        <h2 style="margin-bottom:1.25rem;">Bridging the Intelligence Gap for SMEs</h2>
        <p style="margin-bottom:1.25rem;">While large enterprises invest heavily in data systems and consulting frameworks, SMEs often lack structured access to such resources. We bridge that gap — delivering enterprise-grade intelligence to businesses that are ready to grow.</p>
        <p style="margin-bottom:2rem;">Our multidisciplinary team brings together expertise in data analytics, competitive intelligence, brand architecture, digital transformation, demand generation, and corporate communications.</p>
        <p>We operate as long-term strategic partners, working closely with founders, leadership teams, and marketing heads to align intelligence with execution.</p>
      </div>

      <div class="about-visual">
        <div class="about-visual-inner">
          <div class="about-stat">
            <div class="about-stat-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div>
              <div class="about-stat-num">SME</div>
              <div class="about-stat-label">Focused — Our Primary Clients</div>
            </div>
          </div>
          <div class="about-stat">
            <div class="about-stat-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
            </div>
            <div>
              <div class="about-stat-num">Global</div>
              <div class="about-stat-label">Reach Across Markets</div>
            </div>
          </div>
          <div class="about-stat">
            <div class="about-stat-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            </div>
            <div>
              <div class="about-stat-num">360°</div>
              <div class="about-stat-label">Integrated Growth Approach</div>
            </div>
          </div>
          <div class="about-stat">
            <div class="about-stat-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            </div>
            <div>
              <div class="about-stat-num">Data</div>
              <div class="about-stat-label">Driven Every Decision</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════
     APPROACH
══════════════════════════════════════════ -->
<section style="background:var(--off-white);">
  <div class="container">
    <div class="section-header centered">
      <span class="badge">Our Approach</span>
      <h2>No Generic Solutions. Ever.</h2>
      <p>Every engagement begins with a deep diagnostic analysis of market position, customer landscape, revenue model, and operational efficiency.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;">
      <?php
      $steps = [
        ['01', 'Deep Diagnostic', 'We analyze your market position, customer landscape, revenue model, and operational efficiency before recommending anything.'],
        ['02', 'Custom Framework Design', 'From the diagnostic, we design customized intelligence frameworks and marketing systems tailored to your specific growth ambitions.'],
        ['03', 'Strategic Execution', 'We partner with you through execution — aligning intelligence, strategy, and action to deliver measurable outcomes.'],
      ];
      foreach ($steps as $s): ?>
      <div style="background:var(--white);border:1px solid var(--border-light);border-radius:var(--radius-lg);padding:2rem;position:relative;overflow:hidden;">
        <div style="font-family:'Syne',sans-serif;font-size:4rem;font-weight:800;color:rgba(0,174,239,0.07);line-height:1;position:absolute;top:1rem;right:1.5rem;"><?= $s[0] ?></div>
        <div style="font-family:'Syne',sans-serif;font-size:0.75rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--cyan);margin-bottom:0.75rem;">Step <?= $s[0] ?></div>
        <h3 style="margin-bottom:0.75rem;"><?= $s[1] ?></h3>
        <p style="font-size:0.9rem;"><?= $s[2] ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════
     PRINCIPLES
══════════════════════════════════════════ -->
<section style="background:var(--white);">
  <div class="container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:start;">
      <div>
        <span class="badge" style="margin-bottom:1.5rem;">Core Principles</span>
        <h2 style="margin-bottom:1.25rem;">The Values Behind Our Work</h2>
        <p style="margin-bottom:2rem;">Our principles are not just words — they are the operating framework behind every engagement, every recommendation, and every result we deliver for our clients.</p>
        <div class="principles-grid">
          <?php
          $principles = [
            'Insight-Led Decision Making',
            'Measurable Performance Metrics',
            'Strategic Clarity & Differentiation',
            'Long-Term Sustainable Growth',
          ];
          foreach ($principles as $p): ?>
          <div class="principle">
            <div class="principle-dot"></div>
            <span><?= $p ?></span>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div>
        <div class="highlight-box" style="margin-bottom:1.5rem;">
          <h3 style="margin-bottom:0.75rem;">Our Mission</h3>
          <p>To empower small and mid-sized enterprises worldwide with structured Business Intelligence and strategic marketing systems that unlock predictable growth.</p>
        </div>
        <div style="background:var(--dark);border-radius:var(--radius-lg);padding:2.5rem;">
          <h3 style="color:var(--white);margin-bottom:0.75rem;">Our Vision</h3>
          <p style="color:rgba(255,255,255,0.65);">To become a globally trusted partner for intelligent expansion and performance-driven market leadership — making enterprise-grade intelligence accessible to every ambitious business.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
