<?php
require_once '../includes.php';
admin_required();
admin_require_permission('edit');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('result.php');
    exit;
}

$id = (int)($_POST['id'] ?? 0);
$title = trim(post('title'));
$review = trim(post('review'));

if ($id <= 0 || $title === '' || $review === '') {
    redirect('result.php');
    exit;
}

$db = db_load();
foreach ($db['results'] as &$result) {
    if ((int)($result['id'] ?? 0) !== $id) continue;

    $result['title'] = $title;
    $result['review'] = $review;
    $newImage = upload_image('image', 'result');
    if ($newImage !== '') {
        $oldImage = (string)($result['image'] ?? '');
        if (str_starts_with($oldImage, 'uploads/')) {
            $oldPath = dirname(__DIR__) . '/' . $oldImage;
            if (is_file($oldPath)) unlink($oldPath);
        }
        $result['image'] = $newImage;
    }
    break;
}
unset($result);

db_save($db);
redirect('result.php');
