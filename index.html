<?php
require_once __DIR__ . '/includes/functions.php';
$page_title='Home';
$page_description='Janani Homeopathy in Surat — personalised homeopathic consultation and patient-focused care with Dr. Chirag Patel.';
$active='home';
include __DIR__ . '/includes/header.php';
$data=db();
?>
<section class="hero">
  <div class="container hero-grid">
    <div>
      <span class="eyebrow">Personalised Homeopathic Care</span>
      <h1>Care that begins with <span>understanding.</span></h1>
      <p>At Janani Homeopathy, every consultation starts by listening carefully, understanding your concerns and creating a thoughtful care approach tailored to the individual.</p>
      <div class="hero-actions">
        <a class="btn btn-primary" href="<?= e(url('contact.php')) ?>">Book a Consultation ↗</a>
        <a class="btn btn-outline" href="<?= e(url('services.php')) ?>">Explore Services</a>
      </div>
    </div>
    <div class="hero-card">
      <div class="doctor-mark">Dr</div>
      <h2><?= e(setting('doctor_name')) ?></h2>
      <p><?= e(setting('doctor_qualification')) ?> · <?= e(setting('experience')) ?> of experience</p>
      <p>Consultant Homoeopath focused on individualised consultation and supportive long-term care.</p>
      <div class="stat-row">
        <div class="stat"><strong>12+</strong><span>Years experience</span></div>
        <div class="stat"><strong>BHMS</strong><span>Qualification</span></div>
        <div class="stat"><strong>Surat</strong><span>Gujarat</span></div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head">
      <div><span class="eyebrow">Our Services</span><h2>Support for a range of health concerns.</h2></div>
      <p>Explore our dedicated service pages. Each page is independently editable, making it easy to expand your SEO content over time.</p>
    </div>
    <div class="service-grid">
      <?php
      $services=[
        ['Homeopathy Treatment','Individualised consultation and homeopathic support.','services/homeopathy-treatment.php','✦'],
        ['Child Care','Gentle, thoughtful care for children and families.','services/child-care.php','◉'],
        ['Women’s Health','Support for women’s health concerns with personalised consultation.','services/women-health.php','♡'],
        ['Skin Problems','Consultation for common skin-related concerns.','services/skin-problems.php','✧'],
        ['Hair Problems','Supportive care for common hair and scalp concerns.','services/hair-problems.php','⌁'],
        ['Allergy Treatment','Individualised consultation for recurring allergy concerns.','services/allergy-treatment.php','≈'],
      ];
      foreach($services as $s): ?>
      <article class="service-card"><div class="service-icon"><?= $s[3] ?></div><h3><?= e($s[0]) ?></h3><p><?= e($s[1]) ?></p><a href="<?= e(url($s[2])) ?>">View service →</a></article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section-soft">
  <div class="container about-grid">
    <div class="about-visual"><div class="about-quote"><strong>“Listen first. Understand deeply. Care thoughtfully.”</strong><p>Our website is designed around a simple idea: make it easy for patients to understand the clinic and take the next step.</p></div></div>
    <div>
      <span class="eyebrow">Why Janani Homeopathy</span>
      <h2>A patient-first experience from the first click.</h2>
      <p>Good healthcare communication should feel clear, respectful and approachable. Janani Homeopathy combines a warm digital experience with detailed service information and easy enquiry options.</p>
      <div class="checks">
        <div class="check"><b>✓</b><span>Personalised consultation</span></div>
        <div class="check"><b>✓</b><span>Easy appointment enquiry</span></div>
        <div class="check"><b>✓</b><span>Dedicated service pages</span></div>
        <div class="check"><b>✓</b><span>Educational health blog</span></div>
      </div>
      <a class="btn btn-primary" href="<?= e(url('about.php')) ?>">Meet the Doctor</a>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head"><div><span class="eyebrow">How It Works</span><h2>A simple consultation journey.</h2></div></div>
    <div class="process">
      <div class="step"><div class="step-num">01</div><h3>Share your concern</h3><p>Tell us what you are experiencing and what you would like help with.</p></div>
      <div class="step"><div class="step-num">02</div><h3>Detailed consultation</h3><p>Your concerns, history and individual context are discussed carefully.</p></div>
      <div class="step"><div class="step-num">03</div><h3>Care approach</h3><p>The doctor explains the appropriate next steps for your situation.</p></div>
      <div class="step"><div class="step-num">04</div><h3>Follow-up</h3><p>Continue the conversation and discuss progress during follow-up care.</p></div>
    </div>
  </div>
</section>

<section class="section section-soft">
  <div class="container">
    <div class="section-head"><div><span class="eyebrow">Patient Voice</span><h2>What patients say.</h2></div><a class="btn btn-outline" href="<?= e(url('contact.php')) ?>">Share an Enquiry</a></div>
    <div class="testimonial-grid">
      <?php foreach($data['testimonials'] as $t): if(($t['status']??'')!=='published') continue; ?>
      <article class="testimonial"><div class="stars"><?= str_repeat('★', max(1,min(5,(int)($t['rating']??5)))) ?></div><p>“<?= e($t['message']) ?>”</p><strong><?= e($t['name']) ?></strong><small><?= e($t['role']) ?></small></article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head"><div><span class="eyebrow">Health Journal</span><h2>Helpful reads from our blog.</h2></div><a class="btn btn-outline" href="<?= e(url('blogs.php')) ?>">View All Posts</a></div>
    <div class="blog-grid">
      <?php $posts=array_slice(array_reverse(array_filter($data['blogs'],fn($b)=>($b['status']??'')==='published')),0,3); foreach($posts as $b): ?>
      <article class="blog-card"><div class="blog-image"><?php if(!empty($b['image'])):?><img src="<?= e(url($b['image'])) ?>" alt="<?= e($b['title']) ?>"><?php else: ?>JANANI • HEALTH JOURNAL<?php endif; ?></div><div class="blog-content"><div class="blog-meta"><?= e(date('M d, Y',strtotime($b['created_at']))) ?> · <?= e($b['author']) ?></div><h3><?= e($b['title']) ?></h3><p><?= e($b['excerpt'] ?: excerpt($b['content'])) ?></p><a href="<?= e(url('blog-detail.php?slug='.urlencode($b['slug']))) ?>" style="color:var(--primary);font-weight:800">Read article →</a></div></article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="cta"><div class="container"><div class="cta-box"><div><span class="eyebrow" style="background:rgba(255,255,255,.1);border-color:rgba(255,255,255,.15);color:#fff">Take the next step</span><h2>Have a health concern to discuss?</h2><p>Send an enquiry and the clinic can get back to you with the next steps.</p></div><a class="btn" style="background:#fff;color:var(--primary);border-color:#fff" href="<?= e(url('contact.php')) ?>">Contact Janani Homeopathy ↗</a></div></div></section>
<?php include __DIR__ . '/includes/footer.php'; ?>
