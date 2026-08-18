<?php
$SERVICE = [
    'title' => 'Women’s Health',
    'meta' => 'Personalised consultation for women’s health concerns.',
    'intro' => 'Personalised consultation for women’s health concerns.',
    'lead' => 'Women’s health concerns can be influenced by many individual factors, so a detailed consultation is important.',
    'benefit' => 'The consultation provides a comfortable space to discuss symptoms, history, routine and concerns.',
    'expect' => "Care is discussed according to the individual's needs, with appropriate medical referral recommended whenever necessary.",
    'body' => "Every patient is different. A consultation should consider the person's symptoms, history, lifestyle and any previous medical care. This service page is intentionally written as a flexible base that the clinic can edit manually with its own verified information, FAQs and clinical guidance.",
    'concerns' => [
        'Menstrual concerns',
        'PCOS-related concerns',
        'Lifestyle-related concerns',
        'General wellness',
        'Individualised consultation'
    ]
];
require_once __DIR__ . '/../includes/functions.php';
$page_title=$SERVICE['title'];
$page_description=$SERVICE['meta'];
$active='services';
include __DIR__ . '/../includes/header.php';
?>
<section class="page-hero"><div class="container"><div class="breadcrumb"><a href="<?= e(url('index.php')) ?>">Home</a> / <a href="<?= e(url('services.php')) ?>">Services</a> / <?= e($SERVICE['title']) ?></div><span class="eyebrow">Janani Homeopathy</span><h1><?= e($SERVICE['title']) ?></h1><p style="max-width:760px"><?= e($SERVICE['intro']) ?></p></div></section>
<section class="section"><div class="container service-detail">
<p class="lead"><?= e($SERVICE['lead']) ?></p>
<div class="detail-grid">
<div class="info-box"><h3>Who may benefit from a consultation?</h3><p><?= e($SERVICE['benefit']) ?></p></div>
<div class="info-box"><h3>What to expect</h3><p><?= e($SERVICE['expect']) ?></p></div>
</div>
<h2>Our approach</h2>
<p><?= e($SERVICE['body']) ?></p>
<h2>Common concerns</h2>
<ul><?php foreach($SERVICE['concerns'] as $c): ?><li><?= e($c) ?></li><?php endforeach; ?></ul>
<div class="cta-box" style="margin-top:45px"><div><h2>Want to discuss your concern?</h2><p>Send an enquiry to the clinic for the next step.</p></div><a class="btn" style="background:#fff;color:var(--primary);border-color:#fff" href="<?= e(url('../contact.php')) ?>">Book Consultation ↗</a></div>
<p style="font-size:12px;margin-top:25px">Disclaimer: This page is for general educational information and does not replace diagnosis, emergency care or professional medical advice. Treatment suitability varies by individual.</p>
</div></section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
