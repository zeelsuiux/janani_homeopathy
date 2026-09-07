<?php
require 'header.php';
master_admin_required();
$db = db_load();
$id = (string)get('id');
$index = null;
foreach (($db['admins'] ?? []) as $i => $item) {
    if ((string)($item['id'] ?? '') === $id) {
        $index = $i;
        break;
    }
}
if ($index === null) redirect('manage-users.php');
$admin = $db['admins'][$index];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $profileType = post('profile_type') === 'doctor' ? 'doctor' : 'subadmin';
    $username = trim(post('username'));
    if ($profileType === 'subadmin' && $username === '') exit('Username is required for a Sub Admin.');
    $admin['profile_type'] = $profileType;
    $admin['role'] = $profileType;
    $admin['username'] = $profileType === 'subadmin' ? $username : '';
    $admin['name'] = trim(post('name'));
    $admin['gender'] = post('gender');
    $admin['dob'] = post('dob');
    $admin['designation'] = trim(post('designation'));
    $admin['mobile'] = trim(post('mobile'));
    $admin['degree'] = trim(post('degree'));
    $admin['email'] = trim(post('email'));
    $admin['address'] = trim(post('address'));
    $admin['is_doctor'] = !empty($_POST['is_doctor']);
    $admin['show_on_home'] = !empty($_POST['show_on_home']);
    if ($profileType === 'doctor') $admin['is_doctor'] = true;
    $admin['permissions'] = ['view' => !empty($_POST['perm_view']), 'edit' => !empty($_POST['perm_edit']), 'delete' => !empty($_POST['perm_delete'])];
    $admin['password'] = $profileType === 'doctor' ? '' : ($admin['password'] ?? '');
    if ($profileType === 'subadmin' && post('password') !== '') $admin['password'] = password_hash(post('password'), PASSWORD_DEFAULT);
    $photo = upload_image('photo');
    if ($photo) $admin['photo'] = $photo;
    $db['admins'][$index] = $admin;
    db_save($db);
    redirect('manage-users.php');
}
$permissions = admin_permissions_for($admin);
?>
<div class="admin-top"><div><span class="profile-eyebrow">Staff account</span><h1>Edit Sub Admin</h1></div><a class="btn btn-outline" href="manage-users.php">Back</a></div>
<div class="admin-card"><form method="post" enctype="multipart/form-data"><div class="form-grid">
    <div class="field full"><label>Profile Type</label><div class="gender-options"><label><input type="radio" name="profile_type" value="subadmin" <?= ($admin['profile_type'] ?? $admin['role'] ?? 'subadmin') === 'subadmin' ? 'checked' : '' ?>> Sub Admin</label><label><input type="radio" name="profile_type" value="doctor" <?= ($admin['profile_type'] ?? $admin['role'] ?? '') === 'doctor' ? 'checked' : '' ?>> Doctor Profile</label></div></div>
    <div class="field login-field"><label>Login Username</label><input name="username" value="<?= e($admin['username'] ?? '') ?>"></div>
    <div class="field login-field"><label>New Password (Optional)</label><input type="password" name="password" minlength="6" autocomplete="new-password"></div>
    <div class="field"><label>Full Name</label><input name="name" required value="<?= e($admin['name'] ?? '') ?>"></div>
    <div class="field"><label>Gender</label><div class="gender-options"><label><input type="radio" name="gender" value="Male" <?= ($admin['gender'] ?? '') === 'Male' ? 'checked' : '' ?>> Male</label><label><input type="radio" name="gender" value="Female" <?= ($admin['gender'] ?? '') === 'Female' ? 'checked' : '' ?>> Female</label><label><input type="radio" name="gender" value="Other" <?= ($admin['gender'] ?? '') === 'Other' ? 'checked' : '' ?>> Other</label></div></div>
    <div class="field"><label>Photo</label><input type="file" name="photo" accept="image/jpeg,image/png,image/webp,image/gif"></div>
    <div class="field"><label>DOB (Optional)</label><input type="date" name="dob" value="<?= e($admin['dob'] ?? '') ?>"></div>
    <div class="field"><label>Designation</label><input name="designation" required value="<?= e($admin['designation'] ?? '') ?>"></div>
    <div class="field"><label>Mobile Number</label><input name="mobile" required value="<?= e($admin['mobile'] ?? '') ?>"></div>
    <div class="field"><label>Degree</label><input name="degree" required value="<?= e($admin['degree'] ?? '') ?>"></div>
    <div class="field"><label>Email (Optional)</label><input type="email" name="email" value="<?= e($admin['email'] ?? '') ?>"></div>
    <div class="field full"><label>Address (Optional)</label><textarea name="address" rows="3"><?= e($admin['address'] ?? '') ?></textarea></div>
    <div class="field full"><label>Profile Visibility</label><div class="gender-options"><label><input type="checkbox" name="is_doctor" <?= !empty($admin['is_doctor']) ? 'checked' : '' ?>> Show as doctor on About page</label><label><input type="checkbox" name="show_on_home" <?= !empty($admin['show_on_home']) ? 'checked' : '' ?>> Show doctor on main page</label></div></div>
    <div class="field full"><label>Access Rights</label><div class="gender-options"><label><input type="checkbox" name="perm_view" <?= $permissions['view'] ? 'checked' : '' ?>> View</label><label><input type="checkbox" name="perm_edit" <?= $permissions['edit'] ? 'checked' : '' ?>> Edit</label><label><input type="checkbox" name="perm_delete" <?= $permissions['delete'] ? 'checked' : '' ?>> Delete</label></div></div>
    <div class="field full"><button class="btn" type="submit">Save Changes</button></div>
</div></form></div>
<script>(function(){const form=document.querySelector('.admin-card form');const radios=form.querySelectorAll('[name="profile_type"]');const fields=form.querySelectorAll('.login-field');const username=form.querySelector('[name="username"]');const password=form.querySelector('[name="password"]');function sync(){const doctor=form.querySelector('[name="profile_type"]:checked').value==='doctor';fields.forEach(function(field){field.style.display=doctor?'none':'';});username.required=!doctor;username.disabled=doctor;password.disabled=doctor;if(doctor){username.value='';password.value='';}}radios.forEach(function(radio){radio.addEventListener('change',sync);});sync();})();</script>
<?php require 'footer.php'; ?>
