<?php
require_once __DIR__ . '/includes/functions.php';
$slug=trim($_GET['slug']??'');$blog=find_blog_by_slug($slug);
if(!$blog){http_response_code(404);$page_title='Article Not Found';include __DIR__.'/includes/header.php';echo '<section class="section"><div class="container"><h1>Article not found.</h1><a class="btn btn-primary" href="'.e(url('blogs.php')).'">Back to Blog</a></div></section>';include __DIR__.'/includes/footer.php';exit;}
$page_title=$blog['title'];$page_description=$blog['excerpt']?:excerpt($blog['content']);
include __DIR__ . '/includes/header.php';
?>
<section class="page-hero"><div class="container"><div class="breadcrumb"><a href="<?= e(url('blogs.php')) ?>">Blog</a> / Article</div><span class="eyebrow"><?= e(date('M d, Y',strtotime($blog['created_at']))) ?></span><h1><?= e($blog['title']) ?></h1><p style="max-width:760px"><?= e($blog['excerpt']) ?></p></div></section>
<section class="section"><div class="container blog-detail"><div class="blog-meta"><?= e($blog['author']) ?> · <?= e(date('F d, Y',strtotime($blog['created_at']))) ?></div><?php if(!empty($blog['image'])):?><img src="<?= e(url($blog['image'])) ?>" alt="<?= e($blog['title']) ?>" style="width:100%;max-height:480px;object-fit:cover;border-radius:28px;margin:20px 0 35px"><?php endif;?><div class="content"><?= $blog['content'] ?></div><div style="margin-top:45px"><a class="btn btn-outline" href="<?= e(url('blogs.php')) ?>">← Back to Blog</a></div></div></section>
<?php include __DIR__ . '/includes/footer.php'; ?>
