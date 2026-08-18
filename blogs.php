<?php
require_once __DIR__ . '/includes/functions.php';
$page_title='Health Blog';$active='blogs';
include __DIR__ . '/includes/header.php';
$posts=array_reverse(array_filter(db()['blogs'],fn($b)=>($b['status']??'')==='published'));
?>
<section class="page-hero"><div class="container"><div class="breadcrumb"><a href="<?= e(url('index.php')) ?>">Home</a> / Blog</div><span class="eyebrow">Health Journal</span><h1>Helpful information, explained simply.</h1><p style="max-width:720px">Educational articles for general awareness. Blog content should not replace professional medical advice.</p></div></section>
<section class="section"><div class="container"><div class="blog-grid"><?php foreach($posts as $b):?><article class="blog-card"><div class="blog-image"><?php if(!empty($b['image'])):?><img src="<?= e(url($b['image'])) ?>" alt="<?= e($b['title']) ?>"><?php else: ?>JANANI • HEALTH JOURNAL<?php endif;?></div><div class="blog-content"><div class="blog-meta"><?= e(date('M d, Y',strtotime($b['created_at']))) ?> · <?= e($b['author']) ?></div><h3><?= e($b['title']) ?></h3><p><?= e($b['excerpt'] ?: excerpt($b['content'])) ?></p><a href="<?= e(url('blog-detail.php?slug='.urlencode($b['slug']))) ?>" style="color:var(--primary);font-weight:800">Read article →</a></div></article><?php endforeach;?></div></div></section>
<?php include __DIR__ . '/includes/footer.php'; ?>
