<?php
require 'header.php';
admin_require_permission('edit');
$db = db_load();
$id = get('id');
$patientId = get('patient_id');
$appointment = $id ? find_item($db['appointments'], $id) : null;
if (!$appointment && $patientId) {
    $appointment = ['id' => '', 'number' => next_number($db['appointments'], 'APT-'), 'patient_id' => $patientId, 'date' => '', 'time' => '', 'status' => 'Scheduled', 'amount' => 0, 'payment_method' => 'cash', 'medicine' => '', 'instructions' => '', 'next_date' => '', 'next_time' => '', 'created_at' => now_iso()];
}
if (!$appointment) redirect('appointments.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newData = ['date' => post('date'), 'time' => post('time'), 'status' => post('status'), 'amount' => (float)post('amount'), 'payment_method' => post('payment_method') === 'online' ? 'online' : 'cash', 'medicine' => trim(post('medicine')), 'instructions' => trim(post('instructions')), 'next_date' => post('next_date'), 'next_time' => post('next_time')];
    $appointment = array_merge($appointment, $newData);
    if ($id) {
        foreach ($db['appointments'] as &$item) if ($item['id'] === $id) $item = $appointment;
        unset($item);
    } else {
        $appointment['id'] = make_id();
        $db['appointments'][] = $appointment;
    }
    sync_appointment_income($db, $appointment);
    db_save($db);
    redirect('patient-view.php?id=' . urlencode($appointment['patient_id']));
}
$patient = find_item($db['patients'], $appointment['patient_id']);
?>
<div class="admin-top"><h1>Appointment <?= e($appointment['number']) ?></h1><a class="btn btn-outline" href="patient-view.php?id=<?= e($appointment['patient_id']) ?>">Back to Patient</a></div>
<div class="form-card"><p><b>Patient:</b> <?= e($patient['name'] ?? '-') ?> (<?= e($patient['number'] ?? '-') ?>)</p><form method="post"><div class="form-grid">
    <div class="field"><label>Appointment Date</label><input required type="date" name="date" value="<?= e($appointment['date']) ?>"></div>
    <div class="field"><label>Time</label><input required type="time" name="time" value="<?= e($appointment['time']) ?>"></div>
    <div class="field"><label>Status</label><select name="status"><?php foreach (['Scheduled', 'Confirmed', 'Completed', 'Cancelled', 'No Show'] as $status): ?><option <?= $appointment['status'] === $status ? 'selected' : '' ?>><?= e($status) ?></option><?php endforeach; ?></select></div>
    <div class="field"><label>Amount Paid</label><input type="number" step="0.01" min="0" name="amount" value="<?= e($appointment['amount']) ?>"></div>
    <div class="field"><label>Payment Method</label><div class="gender-options"><label><input type="radio" name="payment_method" value="cash" <?= ($appointment['payment_method'] ?? 'cash') === 'cash' ? 'checked' : '' ?>> Cash</label><label><input type="radio" name="payment_method" value="online" <?= ($appointment['payment_method'] ?? '') === 'online' ? 'checked' : '' ?>> Online</label></div></div>
    <div class="field full"><label>Medicine</label><textarea name="medicine"><?= e($appointment['medicine'] ?? '') ?></textarea></div>
    <div class="field full"><label>Instructions</label><textarea name="instructions"><?= e($appointment['instructions'] ?? '') ?></textarea></div>
    <div class="field"><label>Next Appointment Date</label><input type="date" name="next_date" value="<?= e($appointment['next_date'] ?? '') ?>"></div>
    <div class="field"><label>Next Appointment Time</label><input type="time" name="next_time" value="<?= e($appointment['next_time'] ?? '') ?>"></div>
    <div class="field full"><button class="btn">Save Appointment</button></div>
</div></form></div>
<?php require 'footer.php'; ?>
