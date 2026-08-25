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