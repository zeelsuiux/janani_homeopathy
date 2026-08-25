<?php
require_once __DIR__ . '/includes/functions.php';
$page_title = 'Services';
$active = 'services';
include __DIR__ . '/includes/header.php';
$services = [
    ['Homeopathy Treatment', 'Individualised homeopathic consultation and supportive care.', 'services/homeopathy-treatment.php', '✦'],
    ['Child Care', 'Thoughtful consultation for children and family health concerns.', 'services/child-care.php', '◉'],
    ['Women’s Health', 'Personalised consultation for women’s health concerns.', 'services/women-health.php', '♡'],
    ['Skin Problems', 'Consultation for common skin and recurring skin concerns.', 'services/skin-problems.php', '✧'],
    ['Hair Problems', 'Supportive consultation for hair fall and scalp concerns.', 'services/hair-problems.php', '⌁'],
    ['Allergy Treatment', 'Individualised support for recurring allergy concerns.', 'services/allergy-treatment.php', '≈'],
    ['Lifestyle Disorders', 'A holistic consultation approach for lifestyle-related concerns.', 'services/lifestyle-disorders.php', '◌'],
];
?>
<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="<?= e(url('index.php')) ?>">Home</a> / Services</div><span class="eyebrow">What
            We Offer</span>
        <h1>Homeopathic services with a personal touch.</h1>
        <p style="max-width:720px">Every service has its own dedicated page so you can expand the content, FAQs,
            keywords and educational information manually as your clinic grows.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="service-grid"><?php foreach ($services as $s): ?>
                <article class="service-card">
                    <div class="service-icon"><?= $s[3] ?></div>
                    <h3><?= e($s[0]) ?></h3>
                    <p><?= e($s[1]) ?></p><a href="<?= e(url($s[2])) ?>">Explore service →</a>
                </article><?php endforeach; ?>
        </div>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>