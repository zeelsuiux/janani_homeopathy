<?php
require 'header.php';
master_admin_required();
$db = db_load();
$id = (string)get('id');
$admin = null;
foreach (($db['admins'] ?? []) as $item) {
    if ((string)($item['id'] ?? '') === $id) {
        $admin = $item;
        break;
    }
}
if (!$admin) redirect('manage-users.php');
$permissions = admin_permissions_for($admin);
$activities = array_reverse(array_values(array_filter($db['activities'] ?? [], function ($activity) use ($admin) {
    return (string)($activity['admin_id'] ?? '') === (string)($admin['id'] ?? '') || (($activity['admin_username'] ?? '') === ($admin['username'] ?? ''));
})));
?>
<div class="admin-top"><div><span class="profile-eyebrow">Staff account</span><h1>Admin Details</h1></div><a class="btn btn-outline" href="manage-users.php">Back</a></div>
<div class="admin-user-layout">
<section class="admin-user-profile admin-user-profile-col">
    <div class="admin-user-hero">
        <?php if (!empty($admin['photo'])): ?><img src="../<?= e($admin['photo']) ?>" alt="<?= e($admin['name'] ?? $admin['username'] ?? '') ?>" class="admin-user-profile-photo"><?php else: ?><div class="admin-user-profile-photo admin-user-placeholder"><?= e(strtoupper(substr($admin['name'] ?? $admin['username'] ?? 'A', 0, 1))) ?></div><?php endif; ?>
        <div class="admin-user-hero-copy"><span class="profile-role"><?= e(ucfirst($admin['role'] ?? 'subadmin')) ?></span><h2><?= e($admin['name'] ?? $admin['username'] ?? '-') ?></h2><p>@<?= e($admin['username'] ?? '-') ?> <span class="profile-dot">&bull;</span> Joined <?= e(date_fmt($admin['created_at'] ?? '')) ?></p></div>
    </div>
    <div class="admin-user-info-grid">
        <div class="profile-detail"><span>Gender</span><strong><?= e($admin['gender'] ?? '-') ?></strong></div><div class="profile-detail"><span>Date of birth</span><strong><?= e($admin['dob'] ?? 'Not provided') ?></strong></div><div class="profile-detail"><span>Designation</span><strong><?= e($admin['designation'] ?? '-') ?></strong></div><div class="profile-detail"><span>Degree</span><strong><?= e($admin['degree'] ?? '-') ?></strong></div><div class="profile-detail"><span>Mobile number</span><strong><?= e($admin['mobile'] ?? '-') ?></strong></div><div class="profile-detail"><span>Email</span><strong><?= e($admin['email'] ?? 'Not provided') ?></strong></div><div class="profile-detail profile-detail-wide"><span>Address</span><strong><?= nl2br(e($admin['address'] ?? 'Not provided')) ?></strong></div><div class="profile-detail profile-detail-wide"><span>Access rights</span><strong><?= e(($permissions['view'] ? 'View' : '') . ($permissions['edit'] ? ($permissions['view'] ? ', ' : '') . 'Edit' : '') . ($permissions['delete'] ? (($permissions['view'] || $permissions['edit']) ? ', ' : '') . 'Delete' : '')) ?: 'None' ?></strong></div>
    </div>
</section>
<section class="admin-activity-panel admin-activity-col"><div class="activity-panel-head"><div><span class="profile-eyebrow">Audit trail</span><h2>Recent activity</h2></div><span class="activity-count"><?= e((string)count($activities)) ?> events</span></div><div class="table-wrap"><table><tr><th>Date &amp; Time</th><th>Action</th></tr><?php foreach ($activities as $activity): ?><tr><td><?= e($activity['created_at'] ?? '-') ?></td><td><?= e($activity['action'] ?? '-') ?></td></tr><?php endforeach; ?><?php if (!$activities): ?><tr><td colspan="2">No activity recorded for this admin.</td></tr><?php endif; ?></table></div></section>
</div>
<?php require 'footer.php'; ?>
