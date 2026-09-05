<?php require 'includes.php';
$s = settings();
$db = db_load();
$success = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db['inquiries'][] = ['id' => make_id(), 'type' => 'Appointment Request', 'name' => trim(post('name')), 'mobile' => trim(post('mobile')), 'email' => trim(post('email')), 'message' => trim(post('message')), 'appointment_date' => post('date'), 'appointment_time' => post('time'), 'dob' => post('dob'), 'age' => (int)post('age'), 'city' => trim(post('city')), 'state' => trim(post('state')), 'country' => trim(post('country')), 'address' => trim(post('address')), 'gender' => post('gender'), 'blood_group' => post('blood_group'), 'created_at' => now_iso(), 'status' => 'New'];
    db_save($db);
    $success = 'Appointment request submitted successfully. Our clinic will contact you to confirm the appointment.';
}
$page_title = 'Book Appointment | ' . $s['clinic_name'];
require 'header.php'; ?><section class="page-head">
    <div class="container">
        <h1>Book an Appointment</h1>
        <p>Enter patient details and choose your preferred appointment slot.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="form-card"><?php if ($success): ?><div class="notice"><?= e($success) ?></div><?php endif; ?><form method="post">
                <div class="form-grid">
                    <div class="field"><label>Patient Name *</label><input required name="name"></div>
                    <div class="field"><label>Age *</label><input id="age" name="age" inputmode="numeric" min="0" value=""></div>
                    <div class="field"><label>Mobile Number *</label><input required name="mobile" inputmode="numeric" pattern="[0-9+ ]{8,15}"></div>
                    <div class="field"><label>Email</label><input type="email" name="email"></div>
                    <div class="field full"><label>Message / Reason for Visit *</label><textarea name="message" rows="3" ></textarea></div>
                    <div class="field full"><button class="btn" type="submit">Confirm Appointment</button></div>
                </div>
            </form>
        </div>
    </div>
</section><?php require 'footer.php'; ?>