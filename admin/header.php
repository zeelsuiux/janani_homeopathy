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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: <?= e($s['primary_color']) ?>;
            --light: <?= e($s['light_color']) ?>;
            --medium: <?= e($s['medium_color']) ?>;
        }
    </style>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin-date-filter.css">
    <script src="../assets/js/admin-date-filter.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
</head>

<body class="admin-body">
    <div class="admin-shell">
        <button type="button" class="admin-mobile-toggle" aria-expanded="false" aria-controls="adminSidebar">Menu</button>
        <aside class="sidebar" id="adminSidebar">
            <div class="brand">Doctor Panel</div>
            <a class="<?= $current_page === 'index.php' ? 'active' : '' ?>" href="index.php"><svg class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="m3 11 9-8 9 8v9a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1z"/></svg>Dashboard</a>
            <a class="<?= in_array($current_page, ['patients.php', 'patient-form.php', 'patient-view.php'], true) ? 'active' : '' ?>" href="patients.php"><svg class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><circle cx="9" cy="8" r="3"/><path d="M3 20c.5-4 2.5-6 6-6s5.5 2 6 6M16 5a3 3 0 0 1 0 6M17 14c2.5.5 3.5 2.5 4 6"/></svg>Patients</a>
            <a class="<?= in_array($current_page, ['appointments.php', 'appointment-edit.php'], true) ? 'active' : '' ?>" href="appointments.php"><svg class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M8 3v4M16 3v4M3 10h18M8 14h3M8 17h6"/></svg>Appointments</a>
            <a class="<?= $current_page === 'calendar.php' ? 'active' : '' ?>" href="calendar.php"><svg class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="17" rx="2"/><path d="M8 2v4M16 2v4M3 9h18M8 13h.01M12 13h.01M16 13h.01M8 17h.01M12 17h.01"/></svg>Calendar</a>
            <a class="<?= in_array($current_page, ['inquiries.php', 'inquiry-convert.php'], true) ? 'active' : '' ?>" href="inquiries.php"><svg class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5h16v11H8l-4 4z"/><path d="M8 9h8M8 12h5"/></svg>Inquiries</a>
            <a class="<?= in_array($current_page, ['blogs.php', 'blog-add.php', 'blog-edit.php'], true) ? 'active' : '' ?>" href="blogs.php"><svg class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 4h11a3 3 0 0 1 3 3v13H8a3 3 0 0 1-3-3z"/><path d="M5 17a3 3 0 0 1 3-3h11M9 8h6M9 11h5"/></svg>Blogs</a>
            <a class="<?= $current_page === 'gallery.php' ? 'active' : '' ?>" href="gallery.php"><svg class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="8" cy="9" r="1.5"/><path d="m4 17 5-5 3 3 2-2 6 6"/></svg>Gallery</a>
            <div class="admin-nav-group open"><button class="admin-nav-toggle" type="button" aria-expanded="true"><span><svg class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5h16M4 12h16M4 19h16"/></svg>Results</span><svg class="sidebar-chevron" viewBox="0 0 24 24" aria-hidden="true"><path d="m7 10 5 5 5-5"/></svg></button><div class="admin-nav-submenu"><a class="<?= $current_page === 'before-after.php' ? 'active' : '' ?>" href="before-after.php"><svg class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M12 4v16M8 10h1M15 14h1"/></svg>Before &amp; After</a><a class="<?= $current_page === 'testimonial-videos.php' ? 'active' : '' ?>" href="testimonial-videos.php"><svg class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m10 9 5 3-5 3z"/></svg>Testimonial Videos</a></div></div>
            <a class="<?= $current_page === 'finance.php' ? 'active' : '' ?>" href="finance.php"><svg class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M15 8.5c-.7-.6-1.7-1-3-1-1.7 0-3 .8-3 2s1.3 2 3 2 3 .8 3 2-1.3 2-3 2c-1.3 0-2.3-.4-3-1M12 6v12"/></svg>Finance</a>
            <a class="<?= $current_page === 'export.php' ? 'active' : '' ?>" href="export.php"><svg class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v12M7 10l5 5 5-5M5 21h14"/></svg>Export Data</a>
            <?php if (current_admin_is_master()): ?>
                <a class="<?= $current_page === 'backup.php' ? 'active' : '' ?>" href="backup.php"><svg class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16v13H4zM7 4h10v3H7zM8 11h8M8 15h5"/></svg>Backup</a>
                <a class="<?= in_array($current_page, ['manage-users.php', 'admin-user-edit.php', 'admin-user-view.php'], true) ? 'active' : '' ?>" href="manage-users.php"><svg class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><circle cx="9" cy="8" r="3"/><path d="M3 20c.5-4 2.5-6 6-6 1.5 0 2.7.3 3.7 1M16 13a3 3 0 1 1 0 6M14 21c.4-2.5 1.8-4 4-4s3.6 1.5 4 4"/></svg>Admin Users</a>
                <a class="<?= $current_page === 'settings.php' ? 'active' : '' ?>" href="settings.php"><svg class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M18.4 5.6l-2.1 2.1M7.7 16.3l-2.1 2.1"/><circle cx="12" cy="12" r="4"/></svg>Settings</a>
            <?php endif; ?>
            <a href="logout.php"><svg class="sidebar-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M10 4H5v16h5M14 8l4 4-4 4M9 12h9"/></svg>Logout</a>
        </aside>
        <main class="admin-main">