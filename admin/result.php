<?php
require 'header.php';

$db = db_load();
$results = isset($db['results']) && is_array($db['results']) ? $db['results'] : [];

$items = array_values($results);

$page_title = 'Results | Admin';
?>

<div class="gallery-page-head">
    <h1>Results</h1>
    <a href="result-add.php" class="btn">Add Result</a>
</div>

<?php if (!$items): ?>
    <div class="empty-state">No results added yet.</div>
<?php else: ?>
    <div class="admin-card-grid">
        <?php foreach ($items as $item): ?>
            <div class="admin-card">
                <?php if (!empty($item['image'])): ?>
                    <img src="../<?= e($item['image']) ?>" alt="<?= e($item['title']) ?>" style="width:100%;height:180px;object-fit:cover;border-radius:12px;">
                <?php endif; ?>
                <h3><?= e($item['title']) ?></h3>
                <p><?= nl2br(e($item['review'])) ?></p>
                <div class="meta-row">
                    <small><?= e($item['created_at'] ?? '') ?></small>
                    <form method="post" action="result-delete.php" onsubmit="return confirm('Delete this result?');">
                        <input type="hidden" name="id" value="<?= (int)($item['id'] ?? 0) ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require 'footer.php'; ?>
