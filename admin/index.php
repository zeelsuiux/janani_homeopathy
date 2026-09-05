<?php
require 'header.php';
$db = db_load();
$page_title = 'Dashboard';
$today = date('Y-m-d');
$newInquiries = 0;
$todayAppointments = 0;
$totalRevenue = 0;
$rows = [];
foreach ($db['inquiries'] as $inq) { if (($inq['status'] ?? '') === 'New') $newInquiries++; }
foreach ($db['appointments'] as $appt) {
    $totalRevenue += (float)($appt['amount'] ?? 0);
    if (($appt['date'] ?? '') === $today) $todayAppointments++;
    if (($appt['date'] ?? '') >= $today) $rows[] = $appt;
}
usort($rows, function($a,$b){ return strcmp(($a['date'] ?? '').($a['time'] ?? ''), ($b['date'] ?? '').($b['time'] ?? '')); });
$nextAppointment = null;
foreach ($rows as $appt) {
    if (empty($appt['patient_id'])) continue;
    $nextAppointment = $appt;
    break;
}
?>
<div class="admin-top"><h1>Dashboard</h1><a class="btn" href="../appointment.php" target="_blank">Public Booking</a></div>
<div class="dash-cards">
    <div class="dash-card"><span>Total Patients</span><strong><?=count($db['patients'])?></strong></div>
    <div class="dash-card"><span>Today's Appointments</span><strong><?=$todayAppointments?></strong></div>
    <div class="dash-card"><span>New Inquiries</span><strong><?=$newInquiries?></strong></div>
    <div class="dash-card"><span>Total Revenue</span><strong>₹<?=number_format($totalRevenue, 2)?></strong></div>
</div>
<div class="form-card" style="margin-top:20px;">
    <h2>Clinic Overview</h2>
    <div class="form-grid">
        <div class="field">
            <label>Next Appointment</label>
            <?php if ($nextAppointment): $p = find_item($db['patients'], $nextAppointment['patient_id']); ?>
                <div><strong><?=e($p['name'] ?? 'Patient')?></strong><br><?=e(date_fmt($nextAppointment['date']))?> at <?=e($nextAppointment['time'] ?? '-')?><br><small><?=e($nextAppointment['status'] ?? 'Scheduled')?></small></div>
            <?php else: ?>
                <div>No upcoming appointments.</div>
            <?php endif; ?>
        </div>
        <div class="field">
            <label>Quick Stats</label>
            <div>Total bookings: <strong><?=count($db['appointments'])?></strong><br>Published blogs: <strong><?=count($db['blogs'])?></strong><br>Open inquiries: <strong><?=$newInquiries?></strong></div>
        </div>
    </div>
</div>
<div class="form-card" style="margin-top:20px;"><h2>Upcoming Appointments</h2><div class="table-wrap"><table><tr><th>Appointment</th><th>Patient</th><th>Date</th><th>Time</th><th>Status</th></tr>
<?php foreach(array_slice($rows,0,8) as $a): $p=find_item($db['patients'],$a['patient_id']); ?>
<tr><td><?=e($a['number'])?></td><td><?=e($p['name']??'-')?></td><td><?=e(date_fmt($a['date']))?></td><td><?=e($a['time'])?></td><td><span class="badge"><?=e($a['status'])?></span></td></tr>
<?php endforeach; ?>
</table></div></div>
<?php require 'footer.php'; ?>
