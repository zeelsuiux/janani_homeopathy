<?php require_once '../includes.php';
admin_required();
if (!current_admin_can('view')) {
    http_response_code(403);
    exit('Access denied.');
}
$s = settings();
$current_page = basename($_SERVER['PHP_SELF'] ?? ''); ?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= e($page_title ?? 'Admin Panel') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: <?= e($s['primary_color']) ?>;
            --light: <?= e($s['light_color']) ?>;
            --medium: <?= e($s['medium_color']) ?>;
        }
    </style>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
</head>

<body class="admin-body">
    <div class="admin-shell">
        <button type="button" class="admin-mobile-toggle" aria-expanded="false" aria-controls="adminSidebar">Menu</button>
        <aside class="sidebar" id="adminSidebar">
            <div class="brand">Doctor Panel</div>
            <a class="<?= $current_page === 'index.php' ? 'active' : '' ?>" href="index.php">Dashboard</a>
            <a class="<?= in_array($current_page, ['patients.php', 'patient-form.php', 'patient-view.php'], true) ? 'active' : '' ?>" href="patients.php">Patients</a>
            <a class="<?= in_array($current_page, ['appointments.php', 'appointment-edit.php'], true) ? 'active' : '' ?>" href="appointments.php">Appointments</a>
            <a class="<?= $current_page === 'calendar.php' ? 'active' : '' ?>" href="calendar.php">Calendar</a>
            <a class="<?= in_array($current_page, ['inquiries.php', 'inquiry-convert.php'], true) ? 'active' : '' ?>" href="inquiries.php">Inquiries</a>
            <a class="<?= in_array($current_page, ['blogs.php', 'blog-add.php', 'blog-edit.php'], true) ? 'active' : '' ?>" href="blogs.php">Blogs</a>
            <a class="<?= $current_page === 'gallery.php' ? 'active' : '' ?>" href="gallery.php">Gallery</a>
            <a class="<?= in_array($current_page, ['result.php', 'result-add.php'], true) ? 'active' : '' ?>" href="result.php">Results</a>
            <?php if (current_admin_is_master()): ?>
                <a class="<?= $current_page === 'backup.php' ? 'active' : '' ?>" href="backup.php">Backup</a>
                <a class="<?= $current_page === 'manage-users.php' ? 'active' : '' ?>" href="manage-users.php">Admin Users</a>
                <a class="<?= $current_page === 'settings.php' ? 'active' : '' ?>" href="settings.php">Settings</a>
            <?php endif; ?>
            <a href="logout.php">Logout</a>
        </aside>
        <main class="admin-main">