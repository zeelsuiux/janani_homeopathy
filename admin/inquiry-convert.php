<?php
require 'header.php';
admin_require_permission('edit');
$db = db_load();
$id = (string)get('id');
$result = convert_inquiry_to_patient($db, $id);
if ($result['status'] === 'not_found') redirect('inquiries.php');
db_save($db);
if ($result['status'] === 'old_patient') {
    redirect('inquiries.php?error=' . urlencode('This inquiry matches an existing patient and was moved to Old Patient.'));
}
redirect('patient-form.php?id=' . urlencode($result['patient_id']));
