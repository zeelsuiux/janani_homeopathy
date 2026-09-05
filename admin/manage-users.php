<?php
require 'header.php';
master_admin_required();
$db = db_load();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim(post('username'));
    $password = post('password');
    if ($username !== '' && $password !== '') {
        if (!isset($db['admins']) || !is_array($db['admins'])) $db['admins'] = [];
        $permissions = [
            'view' => !empty($_POST['perm_view']),
            'edit' => !empty($_POST['perm_edit']),
            'delete' => !empty($_POST['perm_delete'])
        ];
        $db['admins'][] = ['id' => make_id(), 'username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT), 'role' => 'subadmin', 'name' => trim(post('name')), 'gender' => post('gender'), 'photo' => upload_image('photo'), 'dob' => post('dob'), 'designation' => trim(post('designation')), 'mobile' => trim(post('mobile')), 'degree' => trim(post('degree')), 'email' => trim(post('email')), 'address' => trim(post('address')), 'permissions' => $permissions, 'created_at' => now_iso()];
        db_save($db);
    }
    redirect('manage-users.php');
}
?>
<div class="admin-top"><h1>Admin Users</h1><button type="button" class="btn" id="openUserModal">+ Add Sub Admin</button></div>
<div class="table-wrap"><table><tr><th>Photo</th><th>Name</th><th>Username</th><th>Designation</th><th>Mobile</th><th>Permissions</th><th>Created</th><th>Actions</th></tr><?php foreach (($db['admins'] ?? []) as $admin): $permissions = admin_permissions_for($admin); ?><tr><td><?php if (!empty($admin['photo'])): ?><img src="../<?= e($admin['photo']) ?>" alt="<?= e($admin['name'] ?? $admin['username'] ?? '') ?>" class="admin-user-avatar"><?php else: ?>-<?php endif; ?></td><td><?= e($admin['name'] ?? '-') ?></td><td><?= e($admin['username'] ?? '') ?></td><td><?= e($admin['designation'] ?? '-') ?></td><td><?= e($admin['mobile'] ?? '-') ?></td><td><?= e(($permissions['view'] ? 'View' : '') . ($permissions['edit'] ? ($permissions['view'] ? ', ' : '') . 'Edit' : '') . ($permissions['delete'] ? (($permissions['view'] || $permissions['edit']) ? ', ' : '') . 'Delete' : '')) ?: 'None' ?></td><td><?= e($admin['created_at'] ?? '-') ?></td><td><a class="btn btn-sm btn-outline" href="admin-user-view.php?id=<?= e((string)($admin['id'] ?? '')) ?>" title="View admin details" aria-label="View <?= e($admin['username'] ?? 'admin') ?> details">&#128065;</a></td></tr><?php endforeach; ?></table></div>
<div class="blog-modal" id="userModal" aria-hidden="true"><div class="blog-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="userModalTitle"><div class="blog-modal-header"><h2 id="userModalTitle">Add Sub Admin / Staff</h2><button type="button" class="blog-modal-close" id="closeUserModal" aria-label="Close">&times;</button></div><form method="post" enctype="multipart/form-data"><div class="form-grid"><div class="field"><label>Login Username</label><input name="username" required autocomplete="off"></div><div class="field"><label>Login Password</label><div class="password-toggle-wrap"><input type="password" id="newAdminPassword" name="password" required minlength="6" autocomplete="new-password"><button type="button" class="password-toggle-btn" data-target="newAdminPassword" aria-label="Show password">👁</button></div></div><div class="field"><label>Full Name</label><input name="name" required></div><div class="field"><label>Gender</label><div class="gender-options"><label><input type="radio" name="gender" value="Male" required> Male</label><label><input type="radio" name="gender" value="Female"> Female</label><label><input type="radio" name="gender" value="Other"> Other</label></div></div><div class="field"><label>Photo</label><input type="file" name="photo" accept="image/jpeg,image/png,image/webp,image/gif"></div><div class="field"><label>DOB (Optional)</label><input type="date" name="dob"></div><div class="field"><label>Designation</label><input name="designation" required placeholder="e.g. Receptionist"></div><div class="field"><label>Mobile Number</label><input name="mobile" required inputmode="tel"></div><div class="field"><label>Degree</label><input name="degree" required></div><div class="field"><label>Email (Optional)</label><input type="email" name="email"></div><div class="field full"><label>Address (Optional)</label><textarea name="address" rows="3"></textarea></div><div class="field full"><label>Access Rights</label><div class="gender-options"><label><input type="checkbox" name="perm_view" checked> View</label><label><input type="checkbox" name="perm_edit" checked> Edit</label><label><input type="checkbox" name="perm_delete" checked> Delete</label></div></div><div class="field full"><button class="btn" type="submit">Create Sub Admin</button></div></div></form></div></div>
<style>
    .password-toggle-wrap { position: relative; }
    .password-toggle-wrap input { width: 100%; padding-right: 42px; }
    .password-toggle-btn {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        border: 0;
        background: transparent;
        cursor: pointer;
        font-size: 18px;
        line-height: 1;
        color: #555;
        padding: 4px 6px;
    }
</style>
<script>(function(){const modal=document.getElementById('userModal');const close=()=>{modal.classList.remove('show');modal.setAttribute('aria-hidden','true');document.body.style.overflow='';};document.getElementById('openUserModal').addEventListener('click',()=>{modal.classList.add('show');modal.setAttribute('aria-hidden','false');document.body.style.overflow='hidden';});document.getElementById('closeUserModal').addEventListener('click',close);modal.addEventListener('click',e=>{if(e.target===modal)close();});document.addEventListener('keydown',e=>{if(e.key==='Escape'&&modal.classList.contains('show'))close();});document.querySelectorAll('.password-toggle-btn').forEach(function(button){button.addEventListener('click',function(){const input=document.getElementById(this.dataset.target);if(!input)return;const isPassword=input.type==='password';input.type=isPassword?'text':'password';this.textContent=isPassword?'🙈':'👁';this.setAttribute('aria-label',isPassword?'Hide password':'Show password');});});})();</script>
<?php require 'footer.php'; ?>
