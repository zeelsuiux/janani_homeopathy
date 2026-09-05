<?php
require 'header.php';

$db = db_load();
$canEdit = current_admin_can('edit');
$canDelete = current_admin_can('delete');
$results = isset($db['results']) && is_array($db['results']) ? $db['results'] : [];

$items = array_values($results);

$page_title = 'Results | Admin';
?>

<div class="gallery-page-head result-page-head">
    <h1>Results</h1>
    <div class="list-toolbar">
        <div class="list-search"><input type="search" id="resultSearch" placeholder="Search results..." autocomplete="off" aria-label="Search results"></div>
        <?php if ($canEdit): ?><button type="button" class="btn" id="openResultModal">+ Add Result</button><?php endif; ?>
    </div>
</div>

<?php if (!$items): ?>
    <div class="empty-state">No results added yet.</div>
<?php else: ?>
    <div class="admin-card-grid" id="resultsGrid">
        <?php foreach ($items as $item): ?>
            <div class="admin-card result-card" data-search="<?= e(strtolower(($item['title'] ?? '') . ' ' . ($item['review'] ?? ''))) ?>">
                <?php if (!empty($item['image'])): ?>
                    <img src="../<?= e($item['image']) ?>" alt="<?= e($item['title']) ?>" style="width:100%;height:180px;object-fit:cover;border-radius:12px;">
                <?php endif; ?>
                <h3><?= e($item['title']) ?></h3>
                <p><?= nl2br(e($item['review'])) ?></p>
                <div class="meta-row result-card-footer">
                    <small><?= e($item['created_at'] ?? '') ?></small>
                    <?php if ($canDelete): ?><form method="post" action="result-delete.php" onsubmit="return confirm('Delete this result?');">
                        <input type="hidden" name="id" value="<?= (int)($item['id'] ?? 0) ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form><?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="empty-state" id="noResultsFound" style="display:none;">No results found.</div>
    </div>
<?php endif; ?>

<?php if ($canEdit): ?><div class="blog-modal" id="resultModal" aria-hidden="true">
    <div class="blog-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="resultModalTitle">
        <div class="blog-modal-header">
            <h2 id="resultModalTitle">Add Result</h2>
            <button class="blog-modal-close" type="button" id="closeResultModal" aria-label="Close">&times;</button>
        </div>
        <form method="post" action="result-add.php" enctype="multipart/form-data">
            <div class="field"><label for="resultTitle">Result Name</label><input id="resultTitle" type="text" name="title" required placeholder="e.g. Patient Recovery Story"></div>
            <div class="field"><label for="resultReview">Review / Description</label><textarea id="resultReview" name="review" rows="6" required placeholder="Write patient review, result details, or healing experience..."></textarea></div>
            <div class="field"><label for="resultImage">Upload Image</label><input id="resultImage" type="file" name="image" accept="image/jpeg,image/png,image/webp,image/gif" required></div>
            <div class="actions"><button type="submit" class="btn">Save Result</button></div>
        </form>
    </div>
</div><?php endif; ?>

<script>
(function(){
    const search=document.getElementById('resultSearch');
    const rows=Array.from(document.querySelectorAll('.result-card'));
    const empty=document.getElementById('noResultsFound');
    if(search) search.addEventListener('input',function(){const query=this.value.trim().toLowerCase();let visible=0;rows.forEach(function(row){const match=!query||row.dataset.search.includes(query);row.style.display=match?'':'none';if(match)visible++;});if(empty)empty.style.display=visible?'none':'';});
    const modal=document.getElementById('resultModal');
    const close=function(){modal.classList.remove('show');modal.setAttribute('aria-hidden','true');document.body.style.overflow='';};
    document.getElementById('openResultModal')?.addEventListener('click',function(){modal.classList.add('show');modal.setAttribute('aria-hidden','false');document.body.style.overflow='hidden';document.getElementById('resultTitle')?.focus();});
    document.getElementById('closeResultModal')?.addEventListener('click',close);
    modal?.addEventListener('click',function(event){if(event.target===modal)close();});
    document.addEventListener('keydown',function(event){if(event.key==='Escape'&&modal?.classList.contains('show'))close();});
})();
</script>

<?php require 'footer.php'; ?>
