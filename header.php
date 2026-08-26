<?php $s = settings(); ?>
<!doctype html>
<html lang="en">

<head>
    

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= e($page_title ?? $s['clinic_name']) ?></title>
    <meta name="description" content="<?= e($s['tagline']) ?>">
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
            <nav class="menu"><a href="index.php">Home</a><a href="about.php">About</a><div class="menu-dropdown"><a href="treatments.php">Treatments <span class="dropdown-arrow">▾</span></a><div class="submenu"><a href="mental-diseases.php">Mental Diseases</a></div></div><a href="gallery.php">Gallery</a><a href="result.php">Results</a><a href="blog.php">Blog</a><a href="contact.php">Contact</a><a class="btn" href="appointment.php">Book Appointment</a></nav>
        </div>
    </header>