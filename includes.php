<?php
if (session_status() === PHP_SESSION_NONE) session_start();
function db_load(): array
{
    $data = include __DIR__ . '/db.php';
    return is_array($data) ? $data : [];
}
function db_save(array $data): void
{
    $php = "<?php\n// FILE-BASED DATABASE: No MySQL / SQL is used.\nreturn " . var_export($data, true) . ";\n";
    file_put_contents(__DIR__ . '/db.php', $php, LOCK_EX);
}
function default_db(): array
{
    return ['settings' => [], 'patients' => [], 'appointments' => [], 'inquiries' => [], 'blogs' => [], 'gallery' => [], 'results' => []];
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
