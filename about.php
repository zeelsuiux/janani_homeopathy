<<<<<<< HEAD
<?php require 'includes.php';
$s = settings();
$page_title = 'About Us | ' . $s['clinic_name'];
require 'header.php'; ?><section class="page-head">
    <div class="container">
        <h1>About Us</h1>
        <p><?= e($s['tagline']) ?></p>
    </div>
</section>
<section class="section">
    <div class="container about-grid">
        <img class="about-img" src="assets/images/doctor.png" alt="Doctor">
        <div>
            <h2 style="margin: 0;">Dr. Chirag Patel</h2>
            <p style="margin:0;color:var(--muted)">BHMS | CCPH | SCPH | Consulting Homoeopath</p>
            <p>Dr. Chirag Patel is a <b>dedicated and experienced Homeopathic Doctor</b> practicing in <b>Surat</b>. With <b>over a decade of clinical experience</b>, he is committed to providing <b>personalized and holistic homoeopathic care</b>.</p>
            <p>
                He completed his <b>BHMS</b> and has further enhanced his expertise through specialized training in Predictive Homoeopathy. Dr. Patel believes in <b>detailed case evaluation and regular follow-ups</b> to provide individualized care for every patient.
            </p>
            <p>
                Known for his <b>calm and compassionate approach</b>, Dr. Chirag Patel is dedicated to supporting his patients on their journey towards <b>better health and overall well-being</b>.
            </p>
        </div>
    </div>
</section><?php require 'footer.php'; ?>
=======
<?php
require_once __DIR__ . '/includes/functions.php';
$page_title='About Us';$active='about';
include __DIR__ . '/includes/header.php';
?>
<section class="page-hero"><div class="container"><div class="breadcrumb"><a href="<?= e(url('index.php')) ?>">Home</a> / About Us</div><span class="eyebrow">About Janani</span><h1>Thoughtful care, built around the individual.</h1><p style="max-width:720px">Learn more about Janani Homeopathy and <?= e(setting('doctor_name')) ?>.</p></div></section>
<section class="section"><div class="container about-grid">
<div class="about-visual"><div class="about-quote"><strong><?= e(setting('doctor_name')) ?></strong><p><?= e(setting('doctor_qualification')) ?><br><?= e(setting('experience')) ?> experience</p><a class="btn btn-primary" href="<?= e(setting('linkedin')) ?>" target="_blank" rel="noopener">View LinkedIn ↗</a></div></div>
<div><span class="eyebrow">Meet Your Doctor</span><h2><?= e(setting('doctor_name')) ?></h2><p><?= e(setting('doctor_name')) ?> is a consultant homoeopath based in Surat, offering individualised consultation with a focus on understanding the patient's concerns and overall context.</p><p><strong>Qualifications:</strong> <?= e(setting('doctor_qualification')) ?></p><p><strong>Experience:</strong> <?= e(setting('experience')) ?></p><p>The clinic website is designed to make service information, educational resources and appointment enquiries simple to access.</p></div>
</div></section>
<section class="section section-soft"><div class="container"><div class="section-head"><div><span class="eyebrow">Our Approach</span><h2>What patients can expect.</h2></div></div><div class="process"><div class="step"><div class="step-num">01</div><h3>Listen</h3><p>We begin by understanding what you are experiencing.</p></div><div class="step"><div class="step-num">02</div><h3>Understand</h3><p>Your history and individual context are considered carefully.</p></div><div class="step"><div class="step-num">03</div><h3>Explain</h3><p>Clear communication helps you understand the next steps.</p></div><div class="step"><div class="step-num">04</div><h3>Follow up</h3><p>Follow-up conversations help review your progress and concerns.</p></div></div></div></section>
<?php include __DIR__ . '/includes/footer.php'; ?>
>>>>>>> bda632c62c755cac8c67ec97d65083b1a3585c71
