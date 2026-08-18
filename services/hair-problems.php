<?php
$SERVICE = [
    'title' => 'Hair Problems',
    'meta' => 'Supportive consultation for common hair and scalp concerns.',
    'intro' => 'Supportive consultation for common hair and scalp concerns.',
    'lead' => 'Hair fall and scalp concerns can be influenced by nutrition, stress, hormones, genetics and other factors.',
    'benefit' => 'A detailed history helps identify the context around the concern and whether further evaluation may be appropriate.',
    'expect' => "The consultation considers the pattern and duration of the concern and explains the next steps based on the individual's situation.",
    'body' => "Every patient is different. A consultation should consider the person's symptoms, history, lifestyle and any previous medical care. This service page is intentionally written as a flexible base that the clinic can edit manually with its own verified information, FAQs and clinical guidance.",
    'concerns' => [
        'Hair fall',
        'Dandruff',
        'Scalp concerns',
        'Hair thinning',
        'General consultation'
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
