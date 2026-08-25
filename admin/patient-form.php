<?php
require 'header.php';
$db = db_load();
$id = get('id');
$existing = $id ? find_item($db['patients'], $id) : null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = post('id');
    $name = trim(post('name'));
    $mobile = trim(post('mobile'));
    $nameKey = strtolower(preg_replace('/\s+/', ' ', $name));
    $mobileKey = preg_replace('/\D+/', '', $mobile);

    // A patient is considered duplicate only when BOTH name and mobile match.
    foreach ($db['patients'] as $patient) {
        if ($id && $patient['id'] === $id) {
            continue;
        }
        $existingNameKey = strtolower(preg_replace('/\s+/', ' ', trim($patient['name'] ?? '')));
        $existingMobileKey = preg_replace('/\D+/', '', (string)($patient['mobile'] ?? ''));

        if ($nameKey !== '' && $mobileKey !== '' && $nameKey === $existingNameKey && $mobileKey === $existingMobileKey) {
            $error = $name . ' patient ' . $mobile . ' already che.';
            break;
        }
    }

    if ($error === '') {
        if ($id) {
            foreach ($db['patients'] as &$p) {
                if ($p['id'] === $id) {
                    $p = array_merge($p, [
                        'name' => $name,
                        'dob' => post('dob'),
                        'age' => (int)post('age'),
                        'city' => trim(post('city')),
                        'state' => trim(post('state')),
                        'country' => trim(post('country')),
                        'address' => trim(post('address')),
                        'mobile' => $mobile,
                        'gender' => post('gender'),
                        'blood_group' => post('blood_group')
                    ]);
                }
            }
            unset($p);
        } else {
            $db['patients'][] = [
                'id' => make_id(),
                'number' => next_number($db['patients'], 'PAT-'),
                'name' => $name,
                'dob' => post('dob'),
                'age' => (int)post('age'),
                'city' => trim(post('city')),
                'state' => trim(post('state')),
                'country' => trim(post('country')),
                'address' => trim(post('address')),
                'mobile' => $mobile,
                'gender' => post('gender'),
                'blood_group' => post('blood_group'),
                'created_at' => now_iso()
            ];
        }
        db_save($db);
        redirect('patients.php');
    }
}

$p = $existing ?: [
    'id' => '',
    'name' => '',
    'dob' => '',
    'age' => '',
    'city' => '',
    'state' => '',
    'country' => 'India',
    'address' => '',
    'mobile' => '',
    'gender' => 'Male',
    'blood_group' => ''
];

// Keep submitted values visible when duplicate validation fails.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $error !== '') {
    $p = array_merge($p, [
        'name' => post('name'),
        'dob' => post('dob'),
        'age' => post('age'),
        'city' => post('city'),
        'state' => post('state'),
        'country' => post('country'),
        'address' => post('address'),
        'mobile' => post('mobile'),
        'gender' => post('gender'),
        'blood_group' => post('blood_group')
    ]);
}

$page_title = $existing ? 'Edit Patient' : 'New Patient';
?>
<div class="admin-top">
    <h1><?= e($page_title) ?></h1><a class="btn btn-outline" href="patients.php">Back</a>
</div>
<div class="form-card">
    <?php if ($error !== ''): ?>
        <div style="background:#ffe8e8;color:#b42318;border:1px solid #f5b5b5;padding:12px 15px;border-radius:8px;margin-bottom:18px;font-weight:600;">
            <?= e($error) ?>
        </div>
    <?php endif; ?>
    <form method="post">
        <input type="hidden" name="id" value="<?= e($p['id']) ?>">
        <div class="form-grid">
            <div class="field"><label>Patient Name *</label><input required name="name" value="<?= e($p['name']) ?>"></div>
            <div class="field"><label>DOB *</label><input required type="date" id="dob" name="dob" value="<?= e($p['dob']) ?>" onchange="calcAge()"></div>
            <div class="field"><label>Age</label><input readonly id="age" name="age" value="<?= e($p['age']) ?>"></div>
            <div class="field"><label>City</label><input name="city" value="<?= e($p['city']) ?>"></div>
            <div class="field"><label>State</label><input name="state" value="<?= e($p['state']) ?>"></div>
            <div class="field"><label>Country</label><input name="country" value="<?= e($p['country']) ?>"></div>
            <div class="field full"><label>Address</label><textarea name="address" rows="3"><?= e($p['address']) ?></textarea></div>
            <div class="field"><label>Mobile Number</label><input name="mobile" inputmode="numeric" value="<?= e($p['mobile']) ?>"></div>
            <div class="field"><label>Gender</label>
                <div class="check-row"><?php foreach (['Male', 'Female', 'Other'] as $g): ?><label><input type="radio" name="gender" value="<?= e($g) ?>" <?= $p['gender'] === $g ? 'checked' : '' ?>> <?= e($g) ?></label><?php endforeach; ?></div>
            </div>
            <div class="field"><label>Blood Group</label><select name="blood_group">
                    <option value="">Select</option><?php foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $g): ?><option <?= $p['blood_group'] === $g ? 'selected' : '' ?>><?= e($g) ?></option><?php endforeach; ?>
                </select></div>
            <div class="field full"><button class="btn">Save Patient</button></div>
        </div>
    </form>
</div>
<script src="../assets/js/app.js"></script>
<?php require 'footer.php'; ?>