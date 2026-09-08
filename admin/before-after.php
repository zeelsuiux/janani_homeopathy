<?php
require 'header.php';
admin_require_permission('edit');
$db = db_load();
$treatments = treatment_options();
$editing = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = post('action');
    $id = (string)post('id');
    if ($action === 'delete') {
        foreach (($db['before_after'] ?? []) as $item) {
            if ((string)($item['id'] ?? '') === $id) {
                foreach (['before_image', 'after_image'] as $key) {
                    $path = __DIR__ . '/../' . ($item[$key] ?? '');
                    if (str_starts_with((string)($item[$key] ?? ''), 'uploads/') && is_file($path)) @unlink($path);
                }
            }
        }
        $db['before_after'] = array_values(array_filter($db['before_after'] ?? [], fn($item) => (string)($item['id'] ?? '') !== $id));
        db_save($db);
        redirect('before-after.php');
    }
    $title = trim(post('title'));
    $treatment = trim(post('treatment'));
    if ($title === '' || !isset($treatments[$treatment])) redirect('before-after.php');
    if ($action === 'edit') {
        foreach ($db['before_after'] as &$item) {
            if ((string)($item['id'] ?? '') !== $id) continue;
            $item['title'] = $title;
            $item['treatment'] = $treatment;
            foreach (['before_image', 'after_image'] as $field) {
                $newImage = upload_image($field, 'uploads');
                if ($newImage !== '') {
                    $oldPath = __DIR__ . '/../' . ($item[$field] ?? '');
                    if (str_starts_with((string)($item[$field] ?? ''), 'uploads/') && is_file($oldPath)) @unlink($oldPath);
                    $item[$field] = $newImage;
                }
            }
            break;
        }
        unset($item);
    } elseif ($action === 'add') {
        $before = upload_image('before_image', 'uploads');
        $after = upload_image('after_image', 'uploads');
        if ($before === '' || $after === '') redirect('before-after.php');
        $db['before_after'][] = ['id' => make_id(), 'title' => $title, 'treatment' => $treatment, 'before_image' => $before, 'after_image' => $after, 'created_at' => now_iso()];
    }
    db_save($db);
    redirect('before-after.php');
}

foreach (($db['before_after'] ?? []) as $item) if ((string)($_GET['edit'] ?? '') === (string)($item['id'] ?? '')) $editing = $item;
$page_title = 'Before & After | Admin';
?>
<div class="gallery-page-head"><h1>Before &amp; After</h1><div class="list-toolbar"><div class="list-search"><input type="search" id="beforeAfterSearch" placeholder="Search results..." autocomplete="off" aria-label="Search before and after results"></div><?php if (!$editing): ?><button type="button" class="btn" id="openBeforeAfterModal">+ Add New</button><?php endif; ?></div></div>
<?php if ($editing): ?><div class="form-card" style="max-width:760px;margin:0 auto 28px;">
    <h2><?= $editing ? 'Edit Before & After' : 'Add Before & After' ?></h2>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="<?= $editing ? 'edit' : 'add' ?>">
        <?php if ($editing): ?><input type="hidden" name="id" value="<?= e($editing['id']) ?>"><?php endif; ?>
        <div class="field"><label>Title *</label><input name="title" required value="<?= e($editing['title'] ?? '') ?>"></div>
        <div class="field"><label>Treatment *</label><select name="treatment" required><option value="">Select treatment</option><?php foreach ($treatments as $value => $label): ?><option value="<?= e($value) ?>" <?= (($editing['treatment'] ?? '') === $value) ? 'selected' : '' ?>><?= e($label) ?></option><?php endforeach; ?></select></div>
        <div class="form-grid"><div class="field"><label>Before Image <?= $editing ? '(optional)' : '*' ?></label><input type="file" name="before_image" accept="image/jpeg,image/png,image/webp,image/gif" <?= $editing ? '' : 'required' ?>></div><div class="field"><label>After Image <?= $editing ? '(optional)' : '*' ?></label><input type="file" name="after_image" accept="image/jpeg,image/png,image/webp,image/gif" <?= $editing ? '' : 'required' ?>></div></div>
        <button class="btn" type="submit">Save</button><?php if ($editing): ?> <a class="btn btn-outline" href="before-after.php">Cancel</a><?php endif; ?>
    </form>
</div><?php else: ?><div class="blog-modal" id="beforeAfterModal" aria-hidden="true"><div class="blog-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="beforeAfterModalTitle"><div class="blog-modal-header"><h2 id="beforeAfterModalTitle">Add Before &amp; After</h2><button class="blog-modal-close" type="button" id="closeBeforeAfterModal" aria-label="Close">&times;</button></div><form method="post" enctype="multipart/form-data"><input type="hidden" name="action" value="add"><div class="field"><label>Title *</label><input name="title" required></div><div class="field"><label>Treatment *</label><select name="treatment" required><option value="">Select treatment</option><?php foreach ($treatments as $value => $label): ?><option value="<?= e($value) ?>"><?= e($label) ?></option><?php endforeach; ?></select></div><div class="form-grid"><div class="field"><label>Before Image *</label><input type="file" name="before_image" accept="image/jpeg,image/png,image/webp,image/gif" required></div><div class="field"><label>After Image *</label><input type="file" name="after_image" accept="image/jpeg,image/png,image/webp,image/gif" required></div></div><button class="btn" type="submit">Save</button></form></div></div><script>(function(){const modal=document.getElementById('beforeAfterModal');const close=()=>{modal.classList.remove('show');modal.setAttribute('aria-hidden','true');document.body.style.overflow='';};document.getElementById('openBeforeAfterModal')?.addEventListener('click',()=>{modal.classList.add('show');modal.setAttribute('aria-hidden','false');document.body.style.overflow='hidden';modal.querySelector('input[name="title"]').focus();});document.getElementById('closeBeforeAfterModal')?.addEventListener('click',close);modal?.addEventListener('click',event=>{if(event.target===modal)close();});})();</script><?php endif; ?>
<div class="admin-card-grid before-after-admin-grid"><?php foreach (($db['before_after'] ?? []) as $item): ?><article class="admin-card result-card before-after-admin-card" data-search="<?= e(strtolower(($item['title'] ?? '') . ' ' . ($treatments[$item['treatment']] ?? $item['treatment']))) ?>"><div class="before-after-admin-compare" data-before-after><div class="before-after-image"><img src="../<?= e($item['after_image']) ?>" alt="After"></div><div class="before-after-image before-after-before"><img src="../<?= e($item['before_image']) ?>" alt="Before"></div><span class="before-after-label before-label">Before</span><span class="before-after-label after-label">After</span><span class="before-after-handle" aria-hidden="true">&#10094; &#10095;</span><input class="before-after-range" type="range" min="0" max="100" value="50" aria-label="Compare before and after images"></div><div class="result-card-body"><small><?= e($treatments[$item['treatment']] ?? $item['treatment']) ?></small><h3><?= e($item['title']) ?></h3><div class="result-card-actions"><a class="btn btn-outline" href="before-after.php?edit=<?= urlencode($item['id']) ?>">Edit</a><form method="post" onsubmit="return confirm('Delete this before & after result?');"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= e($item['id']) ?>"><button class="btn btn-danger" type="submit">Delete</button></form></div></div></article><?php endforeach; ?><div class="empty-state" id="noBeforeAfterFound" style="display:<?= ($db['before_after'] ?? []) ? 'none' : 'block' ?>;">No results found.</div></div><script>const beforeAfterSearch=document.getElementById('beforeAfterSearch');const beforeAfterCards=[...document.querySelectorAll('.before-after-admin-card')];const noBeforeAfterFound=document.getElementById('noBeforeAfterFound');beforeAfterSearch?.addEventListener('input',function(){const query=this.value.trim().toLowerCase();let visible=0;beforeAfterCards.forEach(function(card){const match=!query||card.dataset.search.includes(query);card.style.display=match?'':'none';if(match)visible++;});if(noBeforeAfterFound)noBeforeAfterFound.style.display=visible?'none':'';});document.querySelectorAll('[data-before-after]').forEach(function(compare){const range=compare.querySelector('.before-after-range');const before=compare.querySelector('.before-after-before');if(!range||!before)return;const update=function(){before.style.clipPath='inset(0 '+(100-range.value)+'% 0 0)';};range.addEventListener('input',update);update();});</script>
<?php require 'footer.php'; ?>
