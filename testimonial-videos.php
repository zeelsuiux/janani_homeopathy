<?php
require 'includes.php';
$db = db_load();
$treatments = treatment_options();
$selected = (string)get('treatment');
$items = array_values(array_filter($db['testimonial_videos'] ?? [], fn($item) => $selected === '' || ($item['treatment'] ?? '') === $selected));
$page_title = 'Testimonial Videos | ' . settings()['clinic_name'];
require 'header.php';
?>
<section class="page-head"><div class="container"><p class="eyebrow">Patient Stories</p><h1>Testimonial Videos</h1><p>Watch real patient experiences from our clinic.</p></div></section>
<section class="section"><div class="container">
    <?php if (!$items): ?><div class="empty-state">No testimonial videos available yet.</div><?php else: ?><div class="testimonial-video-grid result-media-grid"><?php foreach ($items as $item): ?><article class="testimonial-video-card"><button class="testimonial-video-trigger" type="button" data-video-src="<?= e($item['video']) ?>" data-video-title="<?= e($item['title']) ?>"><video src="<?= e($item['video']) ?>" muted loop autoplay playsinline preload="metadata"></video><span class="testimonial-play" aria-hidden="true">&#9654;</span></button><div class="result-media-body"><small><?= e($treatments[$item['treatment']] ?? '') ?></small><h3><?= e($item['title']) ?></h3></div></article><?php endforeach; ?></div><?php endif; ?>
</div></section>
<?php require 'footer.php'; ?>
