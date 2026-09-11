<?php
require 'includes.php';
$db = db_load();
$treatments = treatment_options();
$selected = (string)get('treatment');
$items = array_values(array_filter($db['before_after'] ?? [], fn($item) => $selected === '' || ($item['treatment'] ?? '') === $selected));
$page_title = 'Before & After Results | ' . settings()['clinic_name'];
require 'header.php';
?>
<section class="page-head">
    <div class="container">
        <p class="eyebrow">Patient Results</p>
        <h1>Before &amp; After</h1>
        <p>Real treatment journeys shared by our patients.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="row">
            <?php if (!$items): ?><div class="empty-state">No before &amp; after results available yet.</div><?php else: ?><div class="before-after-grid  "><?php foreach ($items as $item): ?><article class="before-after-card col-12 col-md-6 col-lg-4">
                            <div class="before-after-compare" data-before-after>
                                <div class="before-after-image"><img src="<?= e($item['after_image']) ?>" alt="<?= e($item['title']) ?> after"></div>
                                <div class="before-after-image before-after-before"><img src="<?= e($item['before_image']) ?>" alt="<?= e($item['title']) ?> before"></div><span class="before-after-label before-label">Before</span><span class="before-after-label after-label">After</span><span class="before-after-handle" aria-hidden="true">&#10094; &#10095;</span><input class="before-after-range" type="range" min="0" max="100" value="50" aria-label="Compare before and after images">
                            </div>
                            <div class="result-media-body"><small><?= e($treatments[$item['treatment']] ?? '') ?></small>
                                <h3><?= e($item['title']) ?></h3>
                            </div>
                        </article><?php endforeach; ?></div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php require 'footer.php'; ?>