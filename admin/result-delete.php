<?php
require_once '../includes.php';
admin_required();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('result.php');
    exit;
}

$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) {
    redirect('result.php');
    exit;
}

$db = db_load();
$results = isset($db['results']) && is_array($db['results']) ? $db['results'] : [];

$filtered = [];
foreach ($results as $item) {
    if ((int)($item['id'] ?? 0) !== $id) {
        $filtered[] = $item;
    }
}

$db['results'] = $filtered;
db_save($db);
redirect('result.php');
