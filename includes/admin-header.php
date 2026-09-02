<?php
require_once dirname(__DIR__) . '/includes/functions.php';
require_admin();
$admin_page = $admin_page ?? 'Dashboard';
$flash = get_flash();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($admin_page) ?> | <?= e(setting('site_name')) ?> Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= e(url('assets/css/admin.css')) ?>">
</head>
<body class="admin-body">
<aside class="admin-sidebar">
  <a class="admin-brand" href="<?= e(url('dashboard.php')) ?>">
    <img src="<?= e(url('../assets/images/janani-homeopathy-logo.png')) ?>" alt="">
    <span>Admin Panel</span>
  </a>
  <nav>
    <a href="<?= e(url('dashboard.php')) ?>">⌂ Dashboard</a>
    <a href="<?= e(url('blogs.php')) ?>">✎ Blogs</a>
    <a href="<?= e(url('testimonials.php')) ?>">★ Testimonials</a>
    <a href="<?= e(url('enquiries.php')) ?>">✉ Enquiries</a>
    <a href="<?= e(url('settings.php')) ?>">⚙ Settings</a>
    <a href="<?= e(url('../index.php')) ?>" target="_blank">↗ View Website</a>
    <a href="<?= e(url('login.php?action=logout')) ?>">↪ Logout</a>
  </nav>
</aside>
<section class="admin-main">
  <div class="admin-topbar"><strong><?= e($admin_page) ?></strong><span><?= e(setting('doctor_name')) ?></span></div>
  <?php if ($flash): ?><div class="flash <?= e($flash['type']) ?>"><?= e($flash['message']) ?></div><?php endif; ?>
