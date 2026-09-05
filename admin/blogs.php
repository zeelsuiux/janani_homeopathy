<?php
require 'header.php';
$db = db_load();
$canEdit = current_admin_can('edit');
$canDelete = current_admin_can('delete');
if ($canEdit && $_SERVER['REQUEST_METHOD'] === 'POST') {
	$img = upload_image('image');
	$db['blogs'][] = ['id' => make_id(), 'title' => trim(post('title')), 'image' => $img, 'content' => post('content'), 'created_at' => now_iso()];
	db_save($db);
	redirect('blogs.php');
}
?>
<div class="admin-top"><h1>Blogs</h1><div class="list-toolbar"><div class="list-search"><input type="search" id="blogSearch" placeholder="Search blogs..." autocomplete="off" aria-label="Search blogs"></div><?php if ($canEdit): ?><button class="btn" type="button" id="openBlogModal">+ New Blog</button><?php endif; ?></div></div>
<?php if ($canEdit): ?><div class="blog-modal" id="blogModal" aria-hidden="true"><div class="blog-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="blogModalTitle"><div class="blog-modal-header"><h2 id="blogModalTitle">Add New Blog</h2><button class="blog-modal-close" type="button" id="closeBlogModal" aria-label="Close">&times;</button></div><form method="post" enctype="multipart/form-data"><div class="form-grid"><div class="field full"><label>Blog Title</label><input required name="title"></div><div class="field"><label>Featured Image</label><input type="file" name="image" accept="image/*"></div><div class="field full"><label>Content</label><div class="toolbar"><button type="button" onclick="cmd('bold')"><b>B</b></button><button type="button" onclick="cmd('italic')"><i>I</i></button><button type="button" onclick="cmd('underline')"><u>U</u></button></div><div id="editor" class="rich" contenteditable="true"></div><textarea hidden name="content" id="content"></textarea></div><div class="field full"><button class="btn" type="submit" onclick="document.getElementById('content').value=document.getElementById('editor').innerHTML">Publish Blog</button></div></div></form></div></div><?php endif; ?>
<div class="table-wrap"><table id="blogsTable"><tr><th>Image</th><th>Title</th><th>Date</th><th>Action</th></tr><?php foreach (array_reverse($db['blogs']) as $b): ?><tr class="blog-row" data-search="<?=e(strtolower(($b['title']??'').' '.($b['content']??'')))?>"><td><?php if ($b['image']): ?><img src="../<?=e($b['image'])?>" style="width:70px;height:45px;object-fit:cover;border-radius:6px"><?php endif; ?></td><td><?=e($b['title'])?></td><td><?=e(date_fmt($b['created_at']))?></td><td><?php if ($canDelete): ?><a class="btn btn-sm btn-danger" href="blog-delete.php?id=<?=e($b['id'])?>" onclick="return confirm('Delete blog?')">Delete</a><?php else: ?>- <?php endif; ?></td></tr><?php endforeach; ?><tr id="noBlogsFound" style="display:none"><td colspan="4" style="text-align:center;padding:30px">No blogs found.</td></tr></table></div>
<script>
function cmd(command) { document.execCommand(command, false, null); }
const blogSearch = document.getElementById('blogSearch');
const blogRows = Array.from(document.querySelectorAll('.blog-row'));
const noBlogsFound = document.getElementById('noBlogsFound');
blogSearch.addEventListener('input', function () { const query = this.value.trim().toLowerCase(); let visible = 0; blogRows.forEach(function (row) { const match = !query || row.dataset.search.includes(query); row.style.display = match ? '' : 'none'; if (match) visible++; }); noBlogsFound.style.display = visible ? 'none' : ''; });
const blogModal = document.getElementById('blogModal');
document.getElementById('openBlogModal').addEventListener('click', () => { blogModal.classList.add('show'); blogModal.setAttribute('aria-hidden', 'false'); });
document.getElementById('closeBlogModal').addEventListener('click', () => { blogModal.classList.remove('show'); blogModal.setAttribute('aria-hidden', 'true'); });
blogModal.addEventListener('click', (event) => { if (event.target === blogModal) document.getElementById('closeBlogModal').click(); });
document.addEventListener('keydown', (event) => { if (event.key === 'Escape' && blogModal.classList.contains('show')) document.getElementById('closeBlogModal').click(); });
</script>
<?php require 'footer.php'; ?>
