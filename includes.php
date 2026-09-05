<?php
if (session_status() === PHP_SESSION_NONE) session_start();
function db_load(): array
{
    $data = [];
    foreach (db_collections() as $collection => $file) {
        $json = file_get_contents(__DIR__ . '/database/' . $file);
        $value = json_decode($json ?: '', true);
        $data[$collection] = is_array($value) ? $value : (in_array($collection, ['settings'], true) ? [] : []);
    }
    return array_merge(default_db(), $data);
}
function db_save(array $data): void
{
    $oldData = db_load();
    backup_deleted_records($oldData, $data);
    record_admin_activity($oldData, $data);
    foreach (db_collections() as $collection => $file) {
        file_put_contents(__DIR__ . '/database/' . $file, json_encode($data[$collection] ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL, LOCK_EX);
    }
}
function db_collections(): array
{
    return ['settings' => 'settings.json', 'admins' => 'admins.json', 'activities' => 'activities.json', 'patients' => 'patients.json', 'appointments' => 'appointments.json', 'inquiries' => 'inquiries.json', 'blogs' => 'blogs.json', 'gallery' => 'gallery.json', 'results' => 'results.json'];
}
function record_admin_activity(array $before, array &$data): void
{
    if (empty($_SESSION['admin_logged_in'])) return;
    if (!isset($data['activities']) || !is_array($data['activities'])) $data['activities'] = [];
    $data['activities'][] = ['id' => make_id(), 'admin_id' => (string)($_SESSION['admin_id'] ?? ''), 'admin_username' => (string)($_SESSION['admin_username'] ?? 'admin'), 'action' => 'Updated application data', 'created_at' => date('Y-m-d H:i:s')];
    if (count($data['activities']) > 500) $data['activities'] = array_slice($data['activities'], -500);
}
function backup_deleted_records(array $before, array $after): void
{
    $deletedDir = __DIR__ . '/database/deleted/';
    foreach ($before as $collection => $records) {
        if (!is_array($records) || !is_list_array($records)) continue;
        $deletedPath = $deletedDir . $collection . '.json';
        if (!is_file($deletedPath)) continue;
        $deleted = json_decode(file_get_contents($deletedPath) ?: '', true);
        if (!is_array($deleted)) $deleted = [];
        $remaining = $after[$collection] ?? [];
        if (!is_array($remaining)) $remaining = [];
        $remainingIds = array_map(fn($record) => (string)($record['id'] ?? ''), $remaining);
        foreach ($records as $record) {
            if (!is_array($record) || !isset($record['id']) || in_array((string)$record['id'], $remainingIds, true)) continue;
            $backupIds = array_map(fn($saved) => (string)($saved['id'] ?? ''), $deleted);
            if (!in_array((string)$record['id'], $backupIds, true)) {
                $record['deleted_at'] = date('Y-m-d H:i:s');
                $deleted[] = $record;
            }
        }
        file_put_contents($deletedPath, json_encode($deleted, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL, LOCK_EX);
    }
}
function is_list_array(array $value): bool
{
    if ($value === []) return true;
    return array_keys($value) === range(0, count($value) - 1);
}
function default_db(): array
{
    return ['settings' => [], 'admins' => [], 'activities' => [], 'patients' => [], 'appointments' => [], 'inquiries' => [], 'blogs' => [], 'gallery' => [], 'results' => []];
}
function next_number(array $items, string $prefix): string
{
    $max = 0;
    foreach ($items as $item) {
        $n = $item['number'] ?? '';
        if (preg_match('/(\d+)$/', $n, $m)) $max = max($max, (int)$m[1]);
    }
    return $prefix . str_pad((string)($max + 1), 6, '0', STR_PAD_LEFT);
}
function e($value): string
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
function redirect(string $url): never
{
    header('Location: ' . $url);
    exit;
}
function post(string $key, $default = '')
{
    return $_POST[$key] ?? $default;
}
function get(string $key, $default = '')
{
    return $_GET[$key] ?? $default;
}
function now_iso(): string
{
    return date('Y-m-d H:i:s');
}
function upload_image(string $field, string $dir = 'uploads'): string
{
    if (empty($_FILES[$field]['name']) || $_FILES[$field]['error'] !== UPLOAD_ERR_OK) return '';
    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $ext = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed, true) || $_FILES[$field]['size'] > 5 * 1024 * 1024) return '';
    $name = date('YmdHis') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
    $root = __DIR__ . '/' . $dir;
    if (!is_dir($root)) mkdir($root, 0775, true);
    move_uploaded_file($_FILES[$field]['tmp_name'], $root . '/' . $name);
    return $dir . '/' . $name;
}
function settings(): array
{
    $db = db_load();
    return $db['settings'] ?? [];
}
function admin_required(): void
{
    if (empty($_SESSION['admin_logged_in'])) redirect('login.php');
}
function current_admin_is_master(): bool
{
    if (($_SESSION['admin_role'] ?? '') === 'master') return true;
    $settings = db_load()['settings'] ?? [];
    return ($_SESSION['admin_username'] ?? '') !== '' && ($_SESSION['admin_username'] ?? '') === ($settings['admin_user'] ?? '');
}
function admin_permission_defaults(): array
{
    return ['view' => true, 'edit' => true, 'delete' => true];
}
function admin_permissions_for(?array $admin): array
{
    $permissions = is_array($admin['permissions'] ?? null) ? $admin['permissions'] : [];
    $resolved = admin_permission_defaults();
    foreach ($resolved as $key => $value) {
        if (array_key_exists($key, $permissions)) {
            $resolved[$key] = (bool)$permissions[$key];
        }
    }
    return $resolved;
}
function current_admin_record(): ?array
{
    if (empty($_SESSION['admin_logged_in'])) return null;
    $db = db_load();
    $adminId = (string)($_SESSION['admin_id'] ?? '');
    $username = (string)($_SESSION['admin_username'] ?? '');
    foreach (($db['admins'] ?? []) as $admin) {
        if ((string)($admin['id'] ?? '') === $adminId || (string)($admin['username'] ?? '') === $username) {
            return $admin;
        }
    }
    if (($username !== '') && strtolower((string)($_SESSION['admin_role'] ?? '')) === 'master') {
        return ['id' => $adminId, 'username' => $username, 'role' => 'master', 'permissions' => admin_permission_defaults()];
    }
    return null;
}
function current_admin_can(string $action): bool
{
    if (current_admin_is_master()) return true;
    $admin = current_admin_record();
    if (!$admin) return false;
    $permissions = admin_permissions_for($admin);
    $action = strtolower(trim($action));
    return !empty($permissions[$action]);
}
function admin_require_permission(string $action): void
{
    admin_required();
    if (!current_admin_can($action)) {
        http_response_code(403);
        exit('Access denied.');
    }
}
function master_admin_required(): void
{
    admin_required();
    if (!current_admin_is_master()) { http_response_code(403); exit('Access denied.'); }
}
function find_item(array $items, string $id): ?array
{
    foreach ($items as $item) if (($item['id'] ?? '') === $id) return $item;
    return null;
}
function make_id(): string
{
    return bin2hex(random_bytes(8));
}
function date_fmt($date): string
{
    return $date ? date('d M Y', strtotime($date)) : '-';
}
function treatment_icon(string $title, int $variant = 0): string
{
    $paths = [
        '<circle cx="12" cy="12" r="8"/><path d="M12 8v8M8 12h8"/>',
        '<path d="M12 3c-2 3-6 5-6 9a6 6 0 0 0 12 0c0-4-4-6-6-9Z"/><path d="M9 14c1.5.8 2.5.8 4 0"/>',
        '<path d="M12 4v16"/><path d="M12 10c-2-3-6-3-7 1l-1 5c-.4 2 1 4 3 4 3 0 5-3 5-7"/><path d="M12 10c2-3 6-3 7 1l1 5c.4 2-1 4-3 4-3 0-5-3-5-7"/>',
        '<circle cx="8" cy="8" r="3"/><circle cx="16" cy="16" r="3"/><path d="m10 10 4 4M5 19l3-3M19 5l-3 3"/>',
        '<circle cx="12" cy="7" r="3"/><path d="M6 21c.5-4 2.5-6 6-6s5.5 2 6 6M8 13h8"/>',
        '<circle cx="12" cy="8" r="4"/><path d="M12 12v8M9 17h6"/>',
        '<path d="M12 21s8-4 8-10V5l-8-3-8 3v6c0 6 8 10 8 10Z"/><path d="M12 8v6M9 11h6"/>',
        '<path d="m12 3 2.4 5 5.6.8-4 3.9.9 5.5-4.9-2.6-4.9 2.6.9-5.5-4-3.9 5.6-.8L12 3Z"/>',
        '<path d="M5 12h14M12 5v14"/><circle cx="12" cy="12" r="8"/>'
    ];
    $path = $paths[$variant % count($paths)];
    return '<svg class="treatment-icon-svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">' . $path . '</svg>';
}