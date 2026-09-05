<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('BASE_PATH', dirname(__DIR__));
define('DB_DIR', BASE_PATH . '/database/');
define('UPLOAD_DIR', BASE_PATH . '/uploads/');
define('UPLOAD_URL', 'uploads/');

function db(): array {
    static $data = null;
    if ($data === null) {
        $data = [];
        foreach (db_collections() as $collection => $file) {
            $json = file_get_contents(DB_DIR . $file);
            $value = json_decode($json ?: '', true);
            $data[$collection] = is_array($value) ? $value : [];
        }
    }
    return $data;
}
function db_collections(): array {
    return ['settings' => 'settings.json', 'admins' => 'admins.json', 'activities' => 'activities.json', 'patients' => 'patients.json', 'appointments' => 'appointments.json', 'inquiries' => 'inquiries.json', 'blogs' => 'blogs.json', 'gallery' => 'gallery.json', 'results' => 'results.json'];
}

function save_db(array $data): bool {
    backup_deleted_records(db(), $data);
    if (admin_logged_in()) {
        if (!isset($data['activities']) || !is_array($data['activities'])) $data['activities'] = [];
        $data['activities'][] = ['id' => bin2hex(random_bytes(8)), 'admin_id' => (string)($_SESSION['admin_id'] ?? ''), 'admin_username' => (string)($_SESSION['admin_username'] ?? 'admin'), 'action' => 'Updated application data', 'created_at' => date('Y-m-d H:i:s')];
        if (count($data['activities']) > 500) $data['activities'] = array_slice($data['activities'], -500);
    }
    foreach (db_collections() as $collection => $file) {
        $export = json_encode($data[$collection] ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
        $tmp = DB_DIR . $file . '.tmp';
        $ok = file_put_contents($tmp, $export, LOCK_EX);
        if ($ok === false || !rename($tmp, DB_DIR . $file)) return false;
    }
    return true;
}

function backup_deleted_records(array $before, array $after): void {
    $deletedDir = DB_DIR . 'deleted/';
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

function is_list_array(array $value): bool {
    if ($value === []) return true;
    return array_keys($value) === range(0, count($value) - 1);
}

function setting(string $key, string $fallback = ''): string {
    $data = db();
    return (string)($data['settings'][$key] ?? $fallback);
}

function e($value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function url(string $path = ''): string {
    $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
    if ($base === '/' || $base === '.') $base = '';
    return ($base ? $base . '/' : '') . ltrim($path, '/');
}

function site_url(string $path = ''): string {
    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (($_SERVER['SERVER_PORT'] ?? '') == 443);
    $scheme = $https ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $script = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
    $root = preg_replace('#/admin$#', '', $script);
    $root = preg_replace('#/services$#', '', $root);
    $root = rtrim($root, '/');
    return $scheme . '://' . $host . $root . '/' . ltrim($path, '/');
}

function slugify(string $text): string {
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/i', '-', $text);
    return trim($text, '-') ?: 'post-' . time();
}

function excerpt(string $html, int $length = 155): string {
    $text = trim(preg_replace('/\s+/', ' ', strip_tags($html)));
    return mb_strlen($text) > $length ? mb_substr($text, 0, $length - 3) . '...' : $text;
}

function csrf_token(): string {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf'];
}

function csrf_field(): string {
    return '<input type="hidden" name="csrf" value="' . e(csrf_token()) . '">';
}

function verify_csrf(): void {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token = $_POST['csrf'] ?? '';
        if (!hash_equals($_SESSION['csrf'] ?? '', $token)) {
            http_response_code(419);
            exit('Invalid security token. Please go back and try again.');
        }
    }
}

function admin_logged_in(): bool {
    return !empty($_SESSION['admin_logged_in']);
}

function require_admin(): void {
    if (!admin_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

function flash(string $type, string $message): void {
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function get_flash(): ?array {
    $f = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $f;
}

function find_blog_by_slug(string $slug): ?array {
    foreach (db()['blogs'] as $blog) {
        if (($blog['slug'] ?? '') === $slug && ($blog['status'] ?? '') === 'published') return $blog;
    }
    return null;
}

function find_blog_by_id(int $id): ?array {
    foreach (db()['blogs'] as $blog) if ((int)$blog['id'] === $id) return $blog;
    return null;
}

function next_id(array $items): int {
    $max = 0;
    foreach ($items as $item) $max = max($max, (int)($item['id'] ?? 0));
    return $max + 1;
}

function upload_image(string $field, string $prefix = 'image'): string {
    if (empty($_FILES[$field]['name']) || ($_FILES[$field]['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        return '';
    }
    $file = $_FILES[$field];
    if (($file['size'] ?? 0) > 4 * 1024 * 1024) return '';
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);
    $allowed = ['image/jpeg'=>'jpg', 'image/png'=>'png', 'image/webp'=>'webp', 'image/gif'=>'gif'];
    if (!isset($allowed[$mime])) return '';
    if (!is_dir(UPLOAD_DIR)) mkdir(UPLOAD_DIR, 0755, true);
    $name = $prefix . '-' . date('YmdHis') . '-' . bin2hex(random_bytes(4)) . '.' . $allowed[$mime];
    $target = UPLOAD_DIR . $name;
    if (!move_uploaded_file($file['tmp_name'], $target)) return '';
    return UPLOAD_URL . $name;
}

function delete_upload(string $relative): void {
    if (!$relative) return;
    $path = BASE_PATH . '/' . ltrim($relative, '/');
    if (is_file($path) && str_starts_with(realpath($path) ?: '', realpath(UPLOAD_DIR) ?: '')) @unlink($path);
}

function render_meta(string $title, string $description = '', string $canonical = ''): void {
    $desc = $description ?: setting('meta_description');
    $canonical = $canonical ?: site_url();
    echo '<title>' . e($title) . ' | ' . e(setting('site_name')) . '</title>';
    echo '<meta name="description" content="' . e($desc) . '">';
    echo '<meta name="keywords" content="' . e(setting('keywords')) . '">';
    echo '<link rel="canonical" href="' . e($canonical) . '">';
    echo '<meta property="og:title" content="' . e($title) . '">';
    echo '<meta property="og:description" content="' . e($desc) . '">';
    echo '<meta property="og:type" content="website">';
    echo '<meta property="og:url" content="' . e($canonical) . '">';
    echo '<meta property="og:image" content="' . e(site_url('assets/images/janani-homeopathy-logo.png')) . '">';
    echo '<meta name="twitter:card" content="summary_large_image">';
}
