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
        foreach (($db['testimonial_videos'] ?? []) as $item) if ((string)($item['id'] ?? '') === $id) { $path = __DIR__ . '/../' . ($item['video'] ?? ''); if (str_starts_with((string)($item['video'] ?? ''), 'uploads/') && is_file($path)) @unlink($path); }
        $db['testimonial_videos'] = array_values(array_filter($db['testimonial_videos'] ?? [], fn($item) => (string)($item['id'] ?? '') !== $id));
        db_save($db);
        redirect('testimonial-videos.php');
    }
    $title = trim(post('title'));
    $treatment = trim(post('treatment'));
    if ($title === '' || !isset($treatments[$treatment])) redirect('testimonial-videos.php');
    if ($action === 'edit') {
        foreach ($db['testimonial_videos'] as &$item) {
            if ((string)($item['id'] ?? '') !== $id) continue;
            $item['title'] = $title;
            $item['treatment'] = $treatment;
            $newVideo = upload_video('video', 'uploads');
            if ($newVideo !== '') { $oldPath = __DIR__ . '/../' . ($item['video'] ?? ''); if (str_starts_with((string)($item['video'] ?? ''), 'uploads/') && is_file($oldPath)) @unlink($oldPath); $item['video'] = $newVideo; }
            break;
        }
        unset($item);
    } elseif ($action === 'add') {
        $video = upload_video('video', 'uploads');
        if ($video === '') redirect('testimonial-videos.php');
        $db['testimonial_videos'][] = ['id' => make_id(), 'title' => $title, 'treatment' => $treatment, 'video' => $video, 'created_at' => now_iso()];
    }
    db_save($db);
    redirect('testimonial-videos.php');
}

foreach (($db['testimonial_videos'] ?? []) as $item) if ((string)($_GET['edit'] ?? '') === (string)($item['id'] ?? '')) $editing = $item;
$page_title = 'Testimonial Videos | Admin';
?>
<div class="gallery-page-head"><h1>Testimonial Videos</h1><div class="list-toolbar"><div class="list-search"><input type="search" id="testimonialVideoSearch" placeholder="Search videos..." autocomplete="off" aria-label="Search testimonial videos"></div><?php if (!$editing): ?><button type="button" class="btn" id="openTestimonialVideoModal">+ Add New</button><?php endif; ?></div></div>
<?php if ($editing): ?><div class="form-card" style="max-width:760px;margin:0 auto 28px;">
    <h2><?= $editing ? 'Edit Testimonial Video' : 'Add Testimonial Video' ?></h2>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="<?= $editing ? 'edit' : 'add' ?>">
        <?php if ($editing): ?><input type="hidden" name="id" value="<?= e($editing['id']) ?>"><?php endif; ?>
        <div class="field"><label>Title *</label><input name="title" required value="<?= e($editing['title'] ?? '') ?>"></div>
        <div class="field"><label>Treatment *</label><select name="treatment" required><option value="">Select treatment</option><?php foreach ($treatments as $value => $label): ?><option value="<?= e($value) ?>" <?= (($editing['treatment'] ?? '') === $value) ? 'selected' : '' ?>><?= e($label) ?></option><?php endforeach; ?></select></div>
        <div class="field"><label>Video <?= $editing ? '(optional)' : '*' ?></label><input type="file" name="video" accept="video/mp4,video/webm,video/ogg" <?= $editing ? '' : 'required' ?>><small>MP4, WebM or OGG up to 40 MB.</small></div>
        <button class="btn" type="submit">Save</button><?php if ($editing): ?> <a class="btn btn-outline" href="testimonial-videos.php">Cancel</a><?php endif; ?>
    </form>
</div><?php else: ?><div class="blog-modal" id="testimonialVideoModal" aria-hidden="true"><div class="blog-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="testimonialVideoModalTitle"><div class="blog-modal-header"><h2 id="testimonialVideoModalTitle">Add Testimonial Video</h2><button class="blog-modal-close" type="button" id="closeTestimonialVideoModal" aria-label="Close">&times;</button></div><form method="post" enctype="multipart/form-data"><input type="hidden" name="action" value="add"><div class="field"><label>Title *</label><input name="title" required></div><div class="field"><label>Treatment *</label><select name="treatment" required><option value="">Select treatment</option><?php foreach ($treatments as $value => $label): ?><option value="<?= e($value) ?>"><?= e($label) ?></option><?php endforeach; ?></select></div><div class="field"><label>Video *</label><input type="file" name="video" accept="video/mp4,video/webm,video/ogg" required><small>MP4, WebM or OGG up to 40 MB.</small></div><button class="btn" type="submit">Save</button></form></div></div><script>(function(){const modal=document.getElementById('testimonialVideoModal');const close=()=>{modal.classList.remove('show');modal.setAttribute('aria-hidden','true');document.body.style.overflow='';};document.getElementById('openTestimonialVideoModal')?.addEventListener('click',()=>{modal.classList.add('show');modal.setAttribute('aria-hidden','false');document.body.style.overflow='hidden';modal.querySelector('input[name="title"]').focus();});document.getElementById('closeTestimonialVideoModal')?.addEventListener('click',close);modal?.addEventListener('click',event=>{if(event.target===modal)close();});})();</script><?php endif; ?>
<div class="admin-card-grid testimonial-video-admin-grid"><?php foreach (($db['testimonial_videos'] ?? []) as $item): ?><article class="admin-card result-card testimonial-video-admin-card" data-search="<?= e(strtolower(($item['title'] ?? '') . ' ' . ($treatments[$item['treatment']] ?? $item['treatment']))) ?>"><video class="testimonial-video-preview" src="../<?= e($item['video']) ?>" muted controls preload="metadata"></video><div class="result-card-body"><small><?= e($treatments[$item['treatment']] ?? $item['treatment']) ?></small><h3><?= e($item['title']) ?></h3><div class="result-card-actions"><a class="btn btn-outline" href="testimonial-videos.php?edit=<?= urlencode($item['id']) ?>">Edit</a><form method="post" onsubmit="return confirm('Delete this testimonial video?');"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= e($item['id']) ?>"><button class="btn btn-danger" type="submit">Delete</button></form></div></div></article><?php endforeach; ?><div class="empty-state" id="noTestimonialVideoFound" style="display:<?= ($db['testimonial_videos'] ?? []) ? 'none' : 'block' ?>;">No results found.</div></div><script>const testimonialVideoSearch=document.getElementById('testimonialVideoSearch');const testimonialVideoCards=[...document.querySelectorAll('.testimonial-video-admin-card')];const noTestimonialVideoFound=document.getElementById('noTestimonialVideoFound');testimonialVideoSearch?.addEventListener('input',function(){const query=this.value.trim().toLowerCase();let visible=0;testimonialVideoCards.forEach(function(card){const match=!query||card.dataset.search.includes(query);card.style.display=match?'':'none';if(match)visible++;});if(noTestimonialVideoFound)noTestimonialVideoFound.style.display=visible?'none':'';});</script>
<?php require 'footer.php'; ?>
