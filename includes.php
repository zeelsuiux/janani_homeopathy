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
    sync_permanent_storage($data);
    backup_deleted_records($oldData, $data);
    record_admin_activity($oldData, $data);
    foreach (db_collections() as $collection => $file) {
        file_put_contents(__DIR__ . '/database/' . $file, json_encode($data[$collection] ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL, LOCK_EX);
    }
}

function sync_permanent_storage(array $data): void
{
    $storageDir = __DIR__ . '/database/permanent_storage/';
    if (!is_dir($storageDir)) mkdir($storageDir, 0775, true);
    foreach (db_collections() as $collection => $file) {
        $path = $storageDir . $file;
        $stored = is_file($path) ? json_decode(file_get_contents($path) ?: '', true) : [];
        if (!is_array($stored)) $stored = [];
        $current = $data[$collection] ?? [];
        if (is_array($current) && is_list_array($current)) {
            $byId = [];
            foreach ($stored as $record) if (is_array($record) && isset($record['id'])) $byId[(string)$record['id']] = $record;
            foreach ($current as $record) {
                if (!is_array($record) || !isset($record['id'])) continue;
                $id = (string)$record['id'];
                $record['permanent_first_seen_at'] = $byId[$id]['permanent_first_seen_at'] ?? now_iso();
                $record['permanent_updated_at'] = now_iso();
                $byId[$id] = array_merge($byId[$id] ?? [], $record);
            }
            file_put_contents($path, json_encode(array_values($byId), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL, LOCK_EX);
        } elseif ($collection === 'finance' && is_array($current)) {
            $storedEntries = is_array($stored['entries'] ?? null) ? $stored['entries'] : [];
            $entriesById = [];
            foreach ($storedEntries as $entry) if (is_array($entry) && isset($entry['id'])) $entriesById[(string)$entry['id']] = $entry;
            foreach (($current['entries'] ?? []) as $entry) {
                if (!is_array($entry) || !isset($entry['id'])) continue;
                $entriesById[(string)$entry['id']] = array_merge($entriesById[(string)$entry['id']] ?? [], $entry, ['permanent_updated_at' => now_iso()]);
            }
            $stored['categories'] = $current['categories'] ?? ($stored['categories'] ?? []);
            $stored['entries'] = array_values($entriesById);
            file_put_contents($path, json_encode($stored, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL, LOCK_EX);
        } else {
            file_put_contents($path, json_encode($current, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL, LOCK_EX);
        }
    }
}

function archive_database_snapshot(array $before, array $after): void
{
    $archiveDir = __DIR__ . '/database/backup/';
    if (!is_dir($archiveDir)) mkdir($archiveDir, 0775, true);
    foreach (db_collections() as $collection => $file) {
        $archivePath = $archiveDir . $file;
        $archived = is_file($archivePath) ? json_decode(file_get_contents($archivePath) ?: '', true) : [];
        if (!is_array($archived)) $archived = [];
        $archivedById = [];
        foreach ($archived as $record) {
            if (is_array($record) && isset($record['id'])) $archivedById[(string)$record['id']] = $record;
        }
        $listCollection = is_array($after[$collection] ?? null) && is_list_array($after[$collection]);
        foreach ([$before[$collection] ?? [], $after[$collection] ?? []] as $records) {
            if (!is_array($records)) continue;
            if (!$listCollection) {
                $snapshotId = $collection . '-' . date('YmdHis') . '-' . bin2hex(random_bytes(3));
                $archivedById[$snapshotId] = ['id' => $snapshotId, 'snapshot' => $records, 'created_at' => now_iso()];
                continue;
            }
            if (!is_list_array($records)) continue;
            foreach ($records as $record) {
                if (!is_array($record) || !isset($record['id'])) continue;
                $id = (string)$record['id'];
                if (isset($archivedById[$id])) {
                    $record['first_seen_at'] = $archivedById[$id]['first_seen_at'] ?? now_iso();
                    $record['last_seen_at'] = now_iso();
                    if (isset($archivedById[$id]['deleted_at'])) unset($record['deleted_at']);
                } else {
                    $record['first_seen_at'] = now_iso();
                    $record['last_seen_at'] = now_iso();
                }
                $archivedById[$id] = array_merge($archivedById[$id] ?? [], $record);
            }
        }
        $afterIds = [];
        if ($listCollection) {
            foreach ($after[$collection] as $record) if (is_array($record) && isset($record['id'])) $afterIds[(string)$record['id']] = true;
        }
        foreach ($archivedById as $id => &$record) {
            if (!isset($afterIds[$id]) && !isset($record['deleted_at'])) $record['deleted_at'] = now_iso();
        }
        unset($record);
        file_put_contents($archivePath, json_encode(array_values($archivedById), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL, LOCK_EX);
    }
}
function db_collections(): array
{
    return ['settings' => 'settings.json', 'admins' => 'admins.json', 'activities' => 'activities.json', 'patients' => 'patients.json', 'appointments' => 'appointments.json', 'inquiries' => 'inquiries.json', 'blogs' => 'blogs.json', 'gallery' => 'gallery.json', 'results' => 'results.json', 'finance' => 'finance.json'];
}
function record_admin_activity(array $before, array &$data): void
{
    if (empty($_SESSION['admin_logged_in'])) return;
    if (!isset($data['activities']) || !is_array($data['activities'])) $data['activities'] = [];
    $actions = detailed_activity_actions($before, $data);
    if (!$actions) $actions[] = 'Updated settings';
    foreach ($actions as $action) {
        $data['activities'][] = ['id' => make_id(), 'admin_id' => (string)($_SESSION['admin_id'] ?? ''), 'admin_username' => (string)($_SESSION['admin_username'] ?? 'admin'), 'action' => $action, 'created_at' => date('Y-m-d H:i:s')];
    }
    if (count($data['activities']) > 500) $data['activities'] = array_slice($data['activities'], -500);
}

function detailed_activity_actions(array $before, array $after): array
{
    $labels = ['patients' => 'patient', 'appointments' => 'appointment', 'inquiries' => 'inquiry', 'blogs' => 'blog', 'gallery' => 'gallery image', 'results' => 'result', 'admins' => 'subadmin'];
    $actions = [];
    foreach ($labels as $collection => $label) {
        $old = []; $new = [];
        foreach (($before[$collection] ?? []) as $item) if (is_array($item) && isset($item['id'])) $old[(string)$item['id']] = $item;
        foreach (($after[$collection] ?? []) as $item) if (is_array($item) && isset($item['id'])) $new[(string)$item['id']] = $item;
        foreach (array_diff_key($new, $old) as $item) $actions[] = 'Added ' . $label . ' "' . activity_record_name($item) . '"';
        foreach (array_diff_key($old, $new) as $item) $actions[] = 'Deleted ' . $label . ' "' . activity_record_name($item) . '"';
        foreach (array_intersect_key($new, $old) as $id => $item) {
            if (json_encode($item) === json_encode($old[$id])) continue;
            if ($collection === 'appointments' && (float)($item['amount'] ?? 0) !== (float)($old[$id]['amount'] ?? 0)) {
                $difference = (float)($item['amount'] ?? 0) - (float)($old[$id]['amount'] ?? 0);
                $actions[] = ($difference >= 0 ? 'Received payment ₹' : 'Updated payment ₹') . number_format(abs($difference), 2) . ' for appointment "' . activity_record_name($item) . '"';
            } elseif ($collection === 'inquiries' && ($item['status'] ?? '') !== ($old[$id]['status'] ?? '')) {
                $actions[] = 'Changed inquiry "' . activity_record_name($item) . '" status to ' . ($item['status'] ?? '');
            } else {
                $actions[] = 'Edited ' . $label . ' "' . activity_record_name($item) . '"';
            }
        }
    }
    $oldFinance = []; $newFinance = [];
    foreach (($before['finance']['entries'] ?? []) as $item) if (is_array($item) && isset($item['id'])) $oldFinance[(string)$item['id']] = $item;
    foreach (($after['finance']['entries'] ?? []) as $item) if (is_array($item) && isset($item['id'])) $newFinance[(string)$item['id']] = $item;
    foreach (array_diff_key($newFinance, $oldFinance) as $item) $actions[] = 'Recorded ' . (($item['type'] ?? '') === 'expense' ? 'expense' : 'income') . ' ₹' . number_format((float)($item['amount'] ?? 0), 2) . ' for ' . activity_record_name($item);
    foreach (array_diff_key($oldFinance, $newFinance) as $item) $actions[] = 'Deleted finance entry ₹' . number_format((float)($item['amount'] ?? 0), 2) . ' for ' . activity_record_name($item);
    return array_slice($actions, 0, 10);
}

function activity_record_name(array $record): string
{
    return (string)($record['name'] ?? $record['title'] ?? $record['number'] ?? $record['note'] ?? $record['id'] ?? 'record');
}
function backup_deleted_records(array $before, array $after): void
{
    $deletedDir = __DIR__ . '/database/deleted/';
    foreach ($before as $collection => $records) {
        if ($collection === 'finance' && is_array($records) && is_array($after[$collection] ?? null)) {
            $deletedPath = $deletedDir . 'finance.json';
            $deleted = is_file($deletedPath) ? json_decode(file_get_contents($deletedPath) ?: '', true) : [];
            if (!is_array($deleted)) $deleted = [];
            $beforeEntries = is_array($records['entries'] ?? null) ? $records['entries'] : [];
            $afterIds = array_map(fn($entry) => (string)($entry['id'] ?? ''), (array)($after[$collection]['entries'] ?? []));
            $deletedIds = array_map(fn($entry) => (string)($entry['id'] ?? ''), $deleted);
            foreach ($beforeEntries as $entry) {
                $entryId = (string)($entry['id'] ?? '');
                if ($entryId !== '' && !in_array($entryId, $afterIds, true) && !in_array($entryId, $deletedIds, true)) {
                    $entry['deleted_at'] = now_iso();
                    $deleted[] = $entry;
                }
            }
            file_put_contents($deletedPath, json_encode($deleted, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL, LOCK_EX);
            continue;
        }
        if (!is_array($records) || !is_list_array($records)) continue;
        $deletedPath = $deletedDir . $collection . '.json';
        $deleted = is_file($deletedPath) ? json_decode(file_get_contents($deletedPath) ?: '', true) : [];
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
    return ['settings' => [], 'admins' => [], 'activities' => [], 'patients' => [], 'appointments' => [], 'inquiries' => [], 'blogs' => [], 'gallery' => [], 'results' => [], 'finance' => ['categories' => [], 'entries' => []]];
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

function convert_inquiry_to_patient(array &$data, string $inquiryId): array
{
    $inquiryIndex = null;
    foreach (($data['inquiries'] ?? []) as $index => $inquiry) {
        if ((string)($inquiry['id'] ?? '') === $inquiryId) {
            $inquiryIndex = $index;
            break;
        }
    }
    if ($inquiryIndex === null) return ['status' => 'not_found', 'patient_id' => ''];

    $inquiry = $data['inquiries'][$inquiryIndex];
    foreach (($data['patients'] ?? []) as $patient) {
        if (($patient['source_inquiry_id'] ?? '') === $inquiryId) {
            $data['inquiries'][$inquiryIndex]['status'] = 'Converted';
            return ['status' => 'converted', 'patient_id' => (string)$patient['id']];
        }
    }

    $nameKey = strtolower(preg_replace('/\s+/', ' ', trim((string)($inquiry['name'] ?? ''))));
    $mobileKey = preg_replace('/\D+/', '', (string)($inquiry['mobile'] ?? ''));
    foreach (($data['patients'] ?? []) as $patient) {
        $patientNameKey = strtolower(preg_replace('/\s+/', ' ', trim((string)($patient['name'] ?? ''))));
        $patientMobileKey = preg_replace('/\D+/', '', (string)($patient['mobile'] ?? ''));
        if ($nameKey !== '' && $mobileKey !== '' && $nameKey === $patientNameKey && $mobileKey === $patientMobileKey) {
            $data['inquiries'][$inquiryIndex]['status'] = 'Old Patient';
            return ['status' => 'old_patient', 'patient_id' => (string)$patient['id']];
        }
    }

    $patientId = make_id();
    $data['patients'][] = ['id' => $patientId, 'number' => next_number($data['patients'], 'PAT-'), 'name' => $inquiry['name'] ?? '', 'dob' => $inquiry['dob'] ?? '', 'age' => (int)($inquiry['age'] ?? 0), 'city' => $inquiry['city'] ?? '', 'state' => $inquiry['state'] ?? '', 'country' => $inquiry['country'] ?? 'India', 'address' => $inquiry['address'] ?? '', 'mobile' => $inquiry['mobile'] ?? '', 'gender' => $inquiry['gender'] ?? '', 'blood_group' => $inquiry['blood_group'] ?? '', 'created_at' => now_iso(), 'source_inquiry_id' => $inquiryId];
    if (($inquiry['type'] ?? 'Contact Inquiry') === 'Appointment Request' && !empty($inquiry['appointment_date'])) {
        $data['appointments'][] = ['id' => make_id(), 'number' => next_number($data['appointments'], 'APT-'), 'patient_id' => $patientId, 'date' => $inquiry['appointment_date'], 'time' => $inquiry['appointment_time'] ?? '', 'status' => 'Scheduled', 'amount' => 0, 'medicine' => '', 'instructions' => '', 'next_date' => '', 'created_at' => now_iso(), 'source_inquiry_id' => $inquiryId];
    }
    $data['inquiries'][$inquiryIndex]['status'] = 'Converted';
    return ['status' => 'converted', 'patient_id' => $patientId];
}

function sync_appointment_income(array &$data, array $appointment): void
{
    if (!isset($data['finance']) || !is_array($data['finance'])) $data['finance'] = ['categories' => [], 'entries' => []];
    if (!isset($data['finance']['categories']) || !is_array($data['finance']['categories'])) $data['finance']['categories'] = [];
    if (!isset($data['finance']['entries']) || !is_array($data['finance']['entries'])) $data['finance']['entries'] = [];
    $appointmentId = (string)($appointment['id'] ?? '');
    $data['finance']['entries'] = array_values(array_filter($data['finance']['entries'], fn($entry) => (string)($entry['source_appointment_id'] ?? '') !== $appointmentId));
    $amount = (float)($appointment['amount'] ?? 0);
    if ($appointmentId === '' || $amount <= 0 || ($appointment['status'] ?? '') === 'Cancelled') return;
    if (!in_array('Consultation', $data['finance']['categories'], true)) $data['finance']['categories'][] = 'Consultation';
    $patient = find_item($data['patients'] ?? [], (string)($appointment['patient_id'] ?? ''));
    $data['finance']['entries'][] = ['id' => make_id(), 'type' => 'income', 'title' => 'Appointment Income', 'category' => 'Consultation', 'amount' => $amount, 'method' => ($appointment['payment_method'] ?? 'cash') === 'online' ? 'online' : 'cash', 'person' => $patient['name'] ?? '', 'note' => 'Appointment ' . ($appointment['number'] ?? ''), 'date' => $appointment['date'] ?? date('Y-m-d'), 'created_at' => now_iso(), 'created_by' => (string)($_SESSION['admin_username'] ?? 'admin'), 'source_appointment_id' => $appointmentId];
}

function finance_entry_is_realized(array $entry, ?string $asOf = null): bool
{
    $asOf = $asOf ?: date('Y-m-d');
    return empty($entry['source_appointment_id']) || (string)($entry['date'] ?? '') <= $asOf;
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