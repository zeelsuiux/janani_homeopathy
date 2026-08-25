<?php
require 'header.php';
$db = db_load();
$page_title = 'Dashboard';
$newInquiries = 0;
foreach ($db['inquiries'] as $inq) { if (($inq['status'] ?? '') === 'New') $newInquiries++; }
$rows = [];
foreach ($db['appointments'] as $appt) { if (($appt['date'] ?? '') >= date('Y-m-d')) $rows[] = $appt; }
usort($rows, function($a,$b){ return strcmp(($a['date'] ?? '').($a['time'] ?? ''), ($b['date'] ?? '').($b['time'] ?? '')); });
?>
<div class="admin-top"><h1>Dashboard</h1><a class="btn" href="../appointment.php" target="_blank">Public Booking</a></div>
<div class="dash-cards">
<div class="dash-card"><span>Total Patients</span><strong><?=count($db['patients'])?></strong></div>
<div class="dash-card"><span>Total Appointments</span><strong><?=count($db['appointments'])?></strong></div>
<div class="dash-card"><span>New Inquiries</span><strong><?=$newInquiries?></strong></div>
<div class="dash-card"><span>Published Blogs</span><strong><?=count($db['blogs'])?></strong></div>
</div>
<div class="form-card"><h2>Upcoming Appointments</h2><div class="table-wrap"><table><tr><th>Appointment</th><th>Patient</th><th>Date</th><th>Time</th><th>Status</th></tr>
<?php foreach(array_slice($rows,0,8) as $a): $p=find_item($db['patients'],$a['patient_id']); ?>
<tr><td><?=e($a['number'])?></td><td><?=e($p['name']??'-')?></td><td><?=e(date_fmt($a['date']))?></td><td><?=e($a['time'])?></td><td><span class="badge"><?=e($a['status'])?></span></td></tr>
<?php endforeach; ?>
</table></div></div>
<?php require 'footer.php'; ?>
