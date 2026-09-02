<?php
$s = settings();
$current_page = basename($_SERVER['PHP_SELF'] ?? '');
$treatment_pages = [
    'treatments.php',
    'mental-diseases.php',
    'gastric-diseases.php',
    'skin-diseases.php',
    'gynaecological-problems.php',
    'neurological-disorders.php',
    'autoimmune-disorders.php',
    'bone-joint-diseases.php',
    'respiratory-problems.php',
    'childrens-problems.php'
];
?>
<!doctype html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= e($page_title ?? $s['clinic_name']) ?></title>
    <meta name="description" content="<?= e($s['tagline']) ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: <?= e($s['primary_color']) ?>;
            --light: <?= e($s['light_color']) ?>;
            --medium: <?= e($s['medium_color']) ?>
        }
    </style>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header class="nav">
        <div class="container nav-inner"><a href="index.php"><img class="logo" src="assets/images/logo.png" alt="<?= e($s['clinic_name']) ?>"></a><button class="mobile-toggle">☰</button>
            <nav class="menu"><a class="<?= $current_page === 'index.php' ? 'active' : '' ?>" href="index.php">Home</a><a class="<?= $current_page === 'about.php' ? 'active' : '' ?>" href="about.php">About</a>
                <div class="menu-dropdown">
                    <a class="<?= in_array($current_page, $treatment_pages, true) ? 'active' : '' ?>" href="treatments.php">Treatments
                        <span class="dropdown-arrow">▾</span>
                    </a>
                    <div class="submenu">
                        <a href="mental-diseases.php">Mental Diseases</a>
                        <a href="gastric-diseases.php">Gastric Diseases</a>
                           <a href="skin-diseases.php">Skin Diseases</a>
                                <a href="gynaecological-problems.php">Gynaecological Problems</a>
                                <a href="neurological-disorders.php">Neurological Disorders</a>
                            <a href="autoimmune-disorders.php">Autoimmune Disorders</a>
                        <a href="bone-joint-diseases.php">Bone &amp; Joint Diseases</a>
                        <a href="respiratory-problems.php">Respiratory Problems</a>
                        <a href="childrens-problems.php">Children&apos;s Problems</a>
                    </div>
                </div>
                    <a class="<?= $current_page === 'gallery.php' ? 'active' : '' ?>" href="gallery.php">Gallery</a>
                    <a class="<?= $current_page === 'result.php' ? 'active' : '' ?>" href="result.php">Results</a>
                    <a class="<?= in_array($current_page, ['blog.php', 'blog-detail.php'], true) ? 'active' : '' ?>" href="blog.php">Blog</a>
                    <a class="<?= $current_page === 'contact.php' ? 'active' : '' ?>" href="contact.php">Contact</a>
                    <a class="btn" href="appointment.php">Book Appointment</a>
            </nav>
        </div>
    </header>