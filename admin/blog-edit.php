<?php
require 'header.php';
admin_require_permission('edit');
$db = db_load();
$id = get('id');
$index = null;
foreach ($db['blogs'] as $i => $blog) {
    if (($blog['id'] ?? '') === $id) {
        $index = $i;
        break;
    }
}
if ($index === null) {
    http_response_code(404);
    exit('Blog not found.');
}
$blog = $db['blogs'][$index];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blog['title'] = trim(post('title'));
    $blog['content'] = post('content');
    $image = upload_image('image');
    if ($image) $blog['image'] = $image;
    $blog['updated_at'] = now_iso();
    $db['blogs'][$index] = $blog;
    db_save($db);
    redirect('blogs.php');
}
?>
<div class="admin-top">
    <h1>Edit Blog</h1><a class="btn btn-light" href="blogs.php">Back to Blogs</a>
</div>
<div class="admin-card">
    <form method="post" enctype="multipart/form-data">
        <div class="form-grid">
            <div class="field full"><label for="blogTitle">Blog Title</label><input id="blogTitle" required name="title" value="<?= e($blog['title'] ?? '') ?>"></div>
            <div class="field"><label for="blogImage">Featured Image</label><input id="blogImage" type="file" name="image" accept="image/*"></div>
            <?php if (!empty($blog['image'])): ?><div class="field"><label>Current Image</label><img src="../<?= e($blog['image']) ?>" alt="<?= e($blog['title'] ?? '') ?>" style="width:140px;height:90px;object-fit:cover;border-radius:6px"></div><?php endif; ?>
            <div class="field full"><label for="blogContent">Content</label>
                <div class="toolbar"><button type="button" onclick="cmd('bold')"><b>B</b></button><button type="button" onclick="cmd('italic')"><i>I</i></button><button type="button" onclick="cmd('underline')"><u>U</u></button><span class="font-size-options" role="radiogroup" aria-label="Font size"><button type="button" class="font-size-button" aria-label="Small" aria-pressed="false" onmousedown="event.preventDefault()" onclick="setFontSize('1', this)">Small</button><button type="button" class="font-size-button active" aria-label="Normal" aria-pressed="true" onmousedown="event.preventDefault()" onclick="setFontSize('3', this)">Normal</button><button type="button" class="font-size-button" aria-label="Large" aria-pressed="false" onmousedown="event.preventDefault()" onclick="setFontSize('5', this)">Large</button><button type="button" class="font-size-button" aria-label="Extra large" aria-pressed="false" onmousedown="event.preventDefault()" onclick="setFontSize('7', this)">Extra Large</button></span></div>
                <div id="editor" class="rich" contenteditable="true"><?= ($blog['content'] ?? '') ?></div><textarea hidden name="content" id="content"></textarea>
            </div>
            <div class="field full"><button class="btn" type="submit" onclick="document.getElementById('content').value=document.getElementById('editor').innerHTML">Update Blog</button></div>
        </div>
    </form>
</div>
<script>
    function cmd(command, value) {
        document.execCommand(command, false, value || null);
    }

    function setFontSize(value, button) {
        document.execCommand('fontSize', false, value);
        document.querySelectorAll('.font-size-button').forEach(function(item) {
            item.classList.remove('active');
            item.setAttribute('aria-pressed', 'false');
        });
        button.classList.add('active');
        button.setAttribute('aria-pressed', 'true');
    }
</script>
<?php require 'footer.php'; ?>