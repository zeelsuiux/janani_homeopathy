<?php require_once '../includes.php';
if (!empty($_SESSION['admin_logged_in'])) redirect('index.php');
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim(post('username'));
    $password = post('password');
    $db = db_load();
    $matched = null;
    foreach (($db['admins'] ?? []) as $admin) {
        if (($admin['username'] ?? '') === $username && (password_verify($password, $admin['password'] ?? '') || $password === ($admin['password'] ?? ''))) {
            $matched = $admin;
            break;
        }
    }
    $s = $db['settings'] ?? [];
    if (!$matched && $username === ($s['admin_user'] ?? 'admin') && $password === ($s['admin_password'] ?? '')) $matched = ['id' => 'master', 'username' => $username, 'role' => 'master'];
    if ($matched) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $matched['id'] ?? '';
        $_SESSION['admin_username'] = $matched['username'] ?? $username;
        $_SESSION['admin_role'] = $matched['role'] ?? 'subadmin';
        redirect('index.php');
    }
    $error = 'Invalid username or password.';
} ?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Doctor Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
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
</head>

<body>
    <div class="login-wrap">
        <div class="login-card"><img src="../assets/images/logo.png" alt="logo">
            <h2 style="text-align:center;color:var(--dark)">Doctor / Admin Panel</h2><?php if ($error): ?><div class="notice danger"><?= e($error) ?></div><?php endif; ?><form method="post">
                <div class="field"><label>Username</label><input name="username" required></div><br>
                <div class="field"><label>Password</label><div class="password-toggle-wrap"><input type="password" id="loginPassword" name="password" required><button type="button" class="password-toggle-btn" data-target="loginPassword" aria-label="Show password">👁</button></div></div><br><button class="btn" style="width:100%">Login</button>
            </form>
            <p style="text-align:center;font-size:12px;color:#777;margin-bottom:0">Change credentials from Admin &rarr; Settings before production.</p>
        </div>
    </div>
    <script>
        document.querySelectorAll('.password-toggle-btn').forEach(function(button){
            button.addEventListener('click', function(){
                var input = document.getElementById(this.dataset.target);
                if (!input) return;
                var isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                this.textContent = isPassword ? '🙈' : '👁';
                this.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
            });
        });
    </script>
</body>

</html>