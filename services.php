<?php
$page_title = 'Our Services';
$page_desc  = 'Explore BIM Digital\'s four core service areas: Business Intelligence, Strategic Marketing, Digital Performance, and Media Intelligence.';
include 'header.php';
?>

<!-- ══════════════════════════════════════════
     PAGE HERO
══════════════════════════════════════════ -->
<section class="page-hero">
  <div class="container">
    <div class="page-hero-content">
      <span class="badge">What We Offer</span>
      <h1>Four Pillars of <em class="text-cyan">Intelligent</em> Growth</h1>
      <p>Our integrated service framework covers every dimension of intelligence-led business growth — from data and analytics to brand, performance, and media.</p>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════
     SERVICES LIST
══════════════════════════════════════════ -->
<section style="background:var(--white);">
  <div class="container">
    <div class="services-list">

      <!-- Service 1 -->
      <div class="service-item">
        <div class="service-number">01</div>
        <div class="service-content">
          <h3>Business Intelligence &amp; Advanced Analytics</h3>
          <p>We design intelligence systems that provide clarity across operations, sales, and market positioning. Our BI frameworks enable leadership teams to move from reactive management to proactive strategy.</p>
          <ul class="service-bullets">
            <li>Market &amp; Industry Research</li>
            <li>Competitive Intelligence Mapping</li>
            <li>Customer Segmentation &amp; Behavioral Insights</li>
            <li>Sales Funnel Analysis &amp; Optimization</li>
            <li>Executive Dashboards &amp; Performance Reporting</li>
            <li>Revenue Forecasting &amp; Growth Modeling</li>
          </ul>
        </div>
      </div>

      <!-- Service 2 -->
      <div class="service-item">
        <div class="service-number">02</div>
        <div class="service-content">
          <h3>Strategic Marketing &amp; Brand Architecture</h3>
          <p>Strong brands are built on clarity, consistency, and differentiation. We craft positioning strategies that elevate businesses in crowded markets, ensuring your brand communicates credibility, expertise, and long-term value.</p>
          <ul class="service-bullets">
            <li>Brand Positioning &amp; Messaging Strategy</li>
            <li>Go-to-Market Planning</li>
            <li>B2B &amp; B2C Growth Strategy</li>
            <li>Thought Leadership &amp; Content Architecture</li>
            <li>Reputation &amp; Authority Building</li>
          </ul>
        </div>
      </div>

      <!-- Service 3 -->
      <div class="service-item">
        <div class="service-number">03</div>
        <div class="service-content">
          <h3>Digital Performance &amp; Demand Generation</h3>
          <p>Our performance marketing division focuses on measurable ROI and structured lead generation systems. Every campaign is built around analytics, continuous optimization, and revenue impact.</p>
          <ul class="service-bullets">
            <li>SEO &amp; Organic Visibility Strategy</li>
            <li>Paid Advertising Campaigns (Search &amp; Social)</li>
            <li>Conversion Funnel Optimization</li>
            <li>Marketing Automation &amp; CRM Integration</li>
            <li>Email &amp; LinkedIn Outreach Campaigns</li>
          </ul>
        </div>
      </div>

      <!-- Service 4 -->
      <div class="service-item">
        <div class="service-number">04</div>
        <div class="service-content">
          <h3>Media Intelligence &amp; Corporate Communication</h3>
          <p>As Business Intelligence Media, we combine insight with influence — helping organizations build credibility, visibility, and strategic authority within their industries.</p>
          <ul class="service-bullets">
            <li>Business Newsletters &amp; Industry Reports</li>
            <li>Corporate Communication Advisory</li>
            <li>PR &amp; Strategic Media Outreach</li>
            <li>Event &amp; Webinar Growth Strategy</li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════
     PROCESS
══════════════════════════════════════════ -->
<section style="background:var(--off-white);">
  <div class="container">
    <div class="section-header centered">
      <span class="badge">How It Works</span>
      <h2>From Insight to Execution</h2>
      <p>Our engagement model is structured to deliver intelligence at every stage of your growth journey.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;position:relative;" class="process-grid">
      <!-- connector line -->
      <div style="position:absolute;top:36px;left:calc(12.5% + 1rem);right:calc(12.5% + 1rem);height:2px;background:linear-gradient(90deg,var(--cyan),var(--cyan-dark));opacity:0.3;pointer-events:none;"></div>

      <?php
      $process = [
        ['Discover', 'Deep audit of your market, operations, and competitive position.'],
        ['Diagnose', 'Identify critical growth gaps, opportunities, and priority areas.'],
        ['Design', 'Build a customized intelligence and marketing framework.'],
        ['Execute', 'Deploy, measure, and continuously optimize for results.'],
      ];
      foreach ($process as $i => $step): ?>
      <div style="text-align:center;padding:1.5rem;background:var(--white);border:1px solid var(--border-light);border-radius:var(--radius-lg);">
        <div style="width:52px;height:52px;border-radius:50%;background:var(--cyan);color:white;display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-weight:800;font-size:1.1rem;margin:0 auto 1.25rem;">0<?= $i+1 ?></div>
        <h4 style="margin-bottom:0.5rem;"><?= $step[0] ?></h4>
        <p style="font-size:0.85rem;"><?= $step[1] ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
