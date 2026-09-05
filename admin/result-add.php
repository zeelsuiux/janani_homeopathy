<?php
require_once '../includes.php';
admin_required();
admin_require_permission('edit');

$db = db_load();
$page_title = 'Add Result | Admin';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim(post('title'));
    $review = trim(post('review'));
    $files = $_FILES['image'] ?? null;

    if ($title === '' || $review === '' || !$files || !$files['name']) {
        redirect('result.php');
        exit;
    }

    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $fileName = $files['name'];
    $tmpName = $files['tmp_name'];
    $error = $files['error'];
    $size = (int)($files['size'] ?? 0);

    if ($error !== UPLOAD_ERR_OK || $size > 5 * 1024 * 1024) {
        redirect('result.php');
        exit;
    }

    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed, true)) {
        redirect('result.php');
        exit;
    }

    $root = __DIR__ . '/../uploads';
    if (!is_dir($root)) {
        mkdir($root, 0775, true);
    }

    try {
        $random = bin2hex(random_bytes(8));
    } catch (Exception $e) {
        $random = uniqid();
    }

    $filename = date('YmdHis') . '_' . $random . '.' . $ext;
    $destination = $root . '/' . $filename;

    if (!move_uploaded_file($tmpName, $destination)) {
        redirect('result.php');
        exit;
    }

    if (!isset($db['results']) || !is_array($db['results'])) {
        $db['results'] = [];
    }

    $db['results'][] = [
        'id' => make_id(),
        'title' => $title,
        'review' => $review,
        'image' => 'uploads/' . $filename,
        'created_at' => now_iso(),
    ];

    db_save($db);
    redirect('result.php');
    exit;
}

require 'header.php';
?>

<div class="gallery-page-head">
    <h1>Add Result</h1>
    <a href="result.php" class="btn btn-outline">Back</a>
</div>

<div class="form-card" style="max-width:760px;margin:0 auto;"> 
    <form method="post" enctype="multipart/form-data">
        <div class="field" style="margin-bottom:18px;">
            <label for="resultTitle">Result Name</label>
            <input id="resultTitle" type="text" name="title" required placeholder="e.g. Patient Recovery Story">
        </div>

        <div class="field" style="margin-bottom:18px;">
            <label for="resultReview">Review / Description</label>
            <textarea id="resultReview" name="review" rows="6" required placeholder="Write patient review, result details, or healing experience..."></textarea>
        </div>

        <div class="field" style="margin-bottom:18px;">
            <label for="resultImage">Upload Image</label>
            <input id="resultImage" type="file" name="image" accept="image/jpeg,image/png,image/webp,image/gif" required>
        </div>

        <div class="actions">
            <button type="submit" class="btn">Save Result</button>
        </div>
    </form>
</div>

<?php require 'footer.php'; ?>
