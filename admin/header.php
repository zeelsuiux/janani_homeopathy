<?php require_once '../includes.php';
admin_required();
$s = settings(); ?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= e($page_title ?? 'Admin Panel') ?></title>
    <style>
        :root {
            --primary: <?= e($s['primary_color']) ?>;
            --light: <?= e($s['light_color']) ?>;
            --medium: <?= e($s['medium_color']) ?>;
        }
    </style>
    </style>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
</head>

<body class="admin-body">
    <div class="admin-shell">
        <aside class="sidebar">
            <div class="brand">Doctor Panel</div><a href="index.php">Dashboard</a><a href="patients.php">Patients</a><a href="appointments.php">Appointments</a><a href="calendar.php">Calendar</a><a href="inquiries.php">Inquiries</a><a href="blogs.php">Blogs</a><a href="gallery.php">Gallery</a><a href="result.php">Results</a><a href="settings.php">Settings</a><a href="logout.php">Logout</a>
        </aside>
        <main class="admin-main">