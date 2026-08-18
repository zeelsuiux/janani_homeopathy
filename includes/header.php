<?php
require_once __DIR__ . '/functions.php';
$page_title = $page_title ?? setting('site_name');
$page_description = $page_description ?? setting('meta_description');
$active = $active ?? '';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php render_meta($page_title, $page_description, site_url(ltrim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '', '/'))); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= e(site_url('assets/css/style.css')) ?>">
<script type="application/ld+json">
</script>
</head>
<body>
<a class="skip-link" href="#main">Skip to content</a>
<header class="site-header">
  <div class="container nav-wrap">
    <a class="brand" href="<?= e(url('index.php')) ?>" aria-label="<?= e(setting('site_name')) ?> home">
      <img src="<?= e(url('assets/images/janani-homeopathy-logo.png')) ?>" alt="<?= e(setting('site_name')) ?> logo">
    </a>
    <button class="menu-toggle" aria-label="Toggle menu" aria-expanded="false">☰</button>
    <nav class="main-nav" aria-label="Primary navigation">
      <a class="" href="<?= e(url('index.php')) ?>">Home</a>
      <a class="" href="<?= e(url('about.php')) ?>">About Us</a>
      <a class="" href="<?= e(url('services.php')) ?>">Services</a>
      <a class="" href="<?= e(url('blogs.php')) ?>">Blog</a>
      <a class="" href="<?= e(url('contact.php')) ?>">Contact Us</a>
      <a class="nav-cta" href="<?= e(url('contact.php')) ?>">Book Consultation <span>↗</span></a>
    </nav>
  </div>
</header>
<main id="main">
