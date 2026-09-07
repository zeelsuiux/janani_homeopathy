<?php
require 'header.php';
$db = db_load();
$page_title = 'Dashboard';
$today = date('Y-m-d');
$tomorrow = date('Y-m-d', strtotime('+1 day'));
$newInquiries = 0;
$todayAppointments = 0;
$totalRevenue = 0;
$finance = is_array($db['finance'] ?? null) ? $db['finance'] : [];
$financeIncome = 0;
$financeExpense = 0;
foreach (($finance['entries'] ?? []) as $financeEntry) {
    if (!finance_entry_is_realized($financeEntry)) continue;
    if (($financeEntry['type'] ?? '') === 'income') $financeIncome += (float)($financeEntry['amount'] ?? 0);
    else $financeExpense += (float)($financeEntry['amount'] ?? 0);
}
$rows = [];
$todayRows = [];
$tomorrowRows = [];
foreach ($db['inquiries'] as $inq) {
    if (($inq['status'] ?? '') === 'New') $newInquiries++;
}
foreach ($db['appointments'] as $appt) {
    if (($appt['date'] ?? '') <= $today) $totalRevenue += (float)($appt['amount'] ?? 0);
    if (($appt['date'] ?? '') === $today) $todayAppointments++;
    if (($appt['date'] ?? '') === $today) $todayRows[] = $appt;
    if (($appt['date'] ?? '') === $tomorrow) $tomorrowRows[] = $appt;
    if (($appt['date'] ?? '') >= $today) $rows[] = $appt;
}
usort($rows, function ($a, $b) {
    return strcmp(($a['date'] ?? '') . ($a['time'] ?? ''), ($b['date'] ?? '') . ($b['time'] ?? ''));
});
usort($todayRows, function ($a, $b) {
    return strcmp($a['time'] ?? '', $b['time'] ?? '');
});
usort($tomorrowRows, function ($a, $b) {
    return strcmp($a['time'] ?? '', $b['time'] ?? '');
});
$nextAppointment = null;
foreach ($rows as $appt) {
    if (empty($appt['patient_id'])) continue;
    $nextAppointment = $appt;
    break;
}
?>
<div class="admin-top">
    <h1>Dashboard</h1><a class="btn" href="../appointment.php" target="_blank">Public Booking</a>
</div>
<div class="dash-cards">
    <div class="dash-card"><span>Total Patients</span><strong><?= count($db['patients']) ?></strong></div>
    <div class="dash-card"><span>Today's Appointments</span><strong><?= $todayAppointments ?></strong></div>
    <div class="dash-card"><span>New Inquiries</span><strong><?= $newInquiries ?></strong></div>
    <div class="dash-card"><span>Total Revenue</span><strong>₹<?= number_format($totalRevenue, 2) ?></strong></div>
    <div class="dash-card"><span>Finance Balance</span><strong>₹<?= number_format($financeIncome - $financeExpense, 2) ?></strong></div>
</div>
<div class="form-card dashboard-appointments" style="margin-top:20px;">
    <h2>Upcoming Appointments</h2>
    <div class="dashboard-appointment-tabs" role="tablist"><button type="button" class="dashboard-appointment-tab active" data-appointment-tab="today" role="tab" aria-selected="true">Today <span><?= count($todayRows) ?></span></button><button type="button" class="dashboard-appointment-tab" data-appointment-tab="tomorrow" role="tab" aria-selected="false">Tomorrow <span><?= count($tomorrowRows) ?></span></button></div><?php foreach (['today' => $todayRows, 'tomorrow' => $tomorrowRows] as $tab => $appointments): ?><div class="dashboard-appointment-panel <?= $tab === 'today' ? 'active' : '' ?>" data-appointment-panel="<?= e($tab) ?>">
            <div class="table-wrap">
                <table>
                    <tr>
                        <th>Appointment</th>
                        <th>Patient</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr><?php foreach ($appointments as $a): $p = find_item($db['patients'], $a['patient_id']); ?><tr>
                            <td><?= e($a['number']) ?></td>
                            <td><?= e($p['name'] ?? '-') ?></td>
                            <td><?= e(date_fmt($a['date'])) ?></td>
                            <td><?= e($a['time']) ?></td>
                            <td><span class="badge"><?= e($a['status']) ?></span></td>
                        </tr><?php endforeach; ?><?php if (!$appointments): ?><tr>
                            <td colspan="5" class="dashboard-empty">No appointments.</td>
                        </tr><?php endif; ?>
                </table>
            </div>
        </div><?php endforeach; ?>
</div>
<script>
    (function() {
        const tabs = document.querySelectorAll('.dashboard-appointment-tab');
        const panels = document.querySelectorAll('.dashboard-appointment-panel');
        tabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                tabs.forEach(item => {
                    const active = item === tab;
                    item.classList.toggle('active', active);
                    item.setAttribute('aria-selected', active ? 'true' : 'false');
                });
                panels.forEach(panel => panel.classList.toggle('active', panel.dataset.appointmentPanel === tab.dataset.appointmentTab));
            });
        });
    })();
</script>
<?php require 'footer.php'; ?>