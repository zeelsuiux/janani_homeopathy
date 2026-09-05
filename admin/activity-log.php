<?php
require 'header.php';
master_admin_required();
$db = db_load();
$activities = array_reverse($db['activities'] ?? []);
?>
<div class="admin-top"><h1>Activity Log</h1></div>
<div class="table-wrap"><table><tr><th>Date &amp; Time</th><th>Admin</th><th>Action</th></tr><?php foreach ($activities as $activity): ?><tr><td><?= e($activity['created_at'] ?? '-') ?></td><td><?= e($activity['admin_username'] ?? '-') ?></td><td><?= e($activity['action'] ?? '-') ?></td></tr><?php endforeach; ?><?php if (!$activities): ?><tr><td colspan="3">No activity recorded yet.</td></tr><?php endif; ?></table></div>
<?php require 'footer.php'; ?>
