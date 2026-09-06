<?php
require 'header.php';

$db = db_load();
$canEdit = current_admin_can('edit');
$canDelete = current_admin_can('delete');
$allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

if ($canEdit && $_SERVER['REQUEST_METHOD'] === 'POST' && post('action') === 'edit_gallery') {
    $oldName = trim(post('old_name'));
    $galleryName = trim(post('name'));
    $removeIds = array_map('strval', (array)($_POST['remove_ids'] ?? []));
    $files = $_FILES['images'] ?? null;

    if ($oldName !== '' && $galleryName !== '') {
        foreach ($db['gallery'] as $index => $galleryImage) {
            if (($galleryImage['name'] ?? '') !== $oldName) continue;
            if (in_array((string)($galleryImage['id'] ?? ''), $removeIds, true)) {
                unset($db['gallery'][$index]);
            } else {
                $db['gallery'][$index]['name'] = $galleryName;
            }
        }

        $root = __DIR__ . '/../uploads';
        if (!is_dir($root)) mkdir($root, 0775, true);

        if ($files && isset($files['name']) && is_array($files['name'])) {
            foreach ($files['name'] as $i => $originalName) {
                if (($files['error'][$i] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) continue;
                $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
                if (!in_array($ext, $allowed, true) || (int)($files['size'][$i] ?? 0) > 5 * 1024 * 1024) continue;
                try {
                    $random = bin2hex(random_bytes(8));
                } catch (Exception $e) {
                    $random = uniqid();
                }
                $filename = date('YmdHis') . '_' . $random . '.' . $ext;
                if (move_uploaded_file($files['tmp_name'][$i] ?? '', $root . '/' . $filename)) {
                    $db['gallery'][] = [
                        'id' => make_id(),
                        'name' => $galleryName,
                        'image' => 'uploads/' . $filename,
                        'created_at' => now_iso()
                    ];
                }
            }
        }

        $db['gallery'] = array_values($db['gallery']);
        db_save($db);
    }

    redirect('gallery.php');
    exit;
}

if ($canEdit && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $galleryName = trim(post('name'));
    $files       = $_FILES['images'] ?? null;

    /*
    |--------------------------------------------------------------------------
    | Validate Gallery Name
    |--------------------------------------------------------------------------
    */

    if ($galleryName === '') {
        redirect('gallery.php');
        exit;
    }

    /*
    |--------------------------------------------------------------------------
    | Validate Files
    |--------------------------------------------------------------------------
    */

    if (
        !$files ||
        !isset($files['name']) ||
        !is_array($files['name'])
    ) {
        redirect('gallery.php');
        exit;
    }

    /*
    |--------------------------------------------------------------------------
    | Upload Folder
    |--------------------------------------------------------------------------
    */

    $root = __DIR__ . '/../uploads';

    if (!is_dir($root)) {
        mkdir($root, 0775, true);
    }

    /*
    |--------------------------------------------------------------------------
    | Make sure gallery array exists
    |--------------------------------------------------------------------------
    */

    if (!isset($db['gallery']) || !is_array($db['gallery'])) {
        $db['gallery'] = [];
    }

    /*
    |--------------------------------------------------------------------------
    | Upload Multiple Images
    |--------------------------------------------------------------------------
    */

    $count = count($files['name']);

    for ($i = 0; $i < $count; $i++) {

        $error = $files['error'][$i] ?? UPLOAD_ERR_NO_FILE;

        if ($error !== UPLOAD_ERR_OK) {
            continue;
        }

        $tmpName = $files['tmp_name'][$i] ?? '';
        $originalName = $files['name'][$i] ?? '';

        if ($tmpName === '' || $originalName === '') {
            continue;
        }

        /*
        |--------------------------------------------------------------------------
        | File Extension
        |--------------------------------------------------------------------------
        */

        $ext = strtolower(
            pathinfo($originalName, PATHINFO_EXTENSION)
        );

        if (!in_array($ext, $allowed, true)) {
            continue;
        }

        /*
        |--------------------------------------------------------------------------
        | Maximum 5MB
        |--------------------------------------------------------------------------
        */

        $fileSize = (int)($files['size'][$i] ?? 0);

        if ($fileSize > (5 * 1024 * 1024)) {
            continue;
        }

        /*
        |--------------------------------------------------------------------------
        | Generate Unique Filename
        |--------------------------------------------------------------------------
        */

        try {

            $random = bin2hex(random_bytes(8));

        } catch (Exception $e) {

            $random = uniqid();

        }

        $filename =
            date('YmdHis') .
            '_' .
            $random .
            '.' .
            $ext;

        $destination = $root . '/' . $filename;

        /*
        |--------------------------------------------------------------------------
        | Move File
        |--------------------------------------------------------------------------
        */

        if (move_uploaded_file($tmpName, $destination)) {

            /*
            |--------------------------------------------------------------------------
            | Save Image Record
            |--------------------------------------------------------------------------
            */

            $db['gallery'][] = [
                'id'         => make_id(),
                'name'       => $galleryName,
                'image'      => 'uploads/' . $filename,
                'created_at' => now_iso()
            ];
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Save Database
    |--------------------------------------------------------------------------
    */

    db_save($db);

    redirect('gallery.php');
    exit;
}


/*
|--------------------------------------------------------------------------
| GROUP GALLERIES
|--------------------------------------------------------------------------
*/

$groups = [];

foreach (($db['gallery'] ?? []) as $g) {

    if (!is_array($g)) {
        continue;
    }

    $name = trim($g['name'] ?? '');

    if ($name === '') {
        $name = 'Untitled Gallery';
    }

    if (!isset($groups[$name])) {
        $groups[$name] = [];
    }

    $groups[$name][] = $g;
}


/*
|--------------------------------------------------------------------------
| Sort Galleries
|--------------------------------------------------------------------------
*/

uksort($groups, function ($a, $b) {
    return strcasecmp($a, $b);
});

?>

<style>

.gallery-page-head {
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:20px;
    margin-bottom:28px;
}

.gallery-page-head h1 {
    margin:0;
}

.gallery-add-btn {
    display:inline-flex;
    align-items:center;
    gap:8px;
}

.gallery-card {
    display:flex;
    flex-direction:column;
    height:100%;
    min-width:0;
}

.gallery-list {
    display:grid;
    grid-template-columns:repeat(3, minmax(0, 1fr));
    grid-auto-rows:1fr;
    gap:20px;
}

.gallery-card-head {
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:16px;
    margin-bottom:18px;
}

.gallery-card-head h2 {
    margin:0;
    color:var(--dark);
    font-size:18px;
    line-height:1.3;
}

.gallery-count {
    color:#6b7d77;
    font-size:14px;
    margin-top:4px;
    display:block;
}

.gallery-preview {
    position: relative;
    overflow: hidden;
    border-radius: 16px;
    background: #edf6f2;
}

.gallery-preview-track {
    display: flex;
    transition: transform .3s ease;
}

.gallery-preview-slide {
    flex: 0 0 100%;
    height: 240px;
    object-fit: cover;
}

.gallery-preview-arrow {
    position: absolute;
    top: 50%;
    width: 38px;
    height: 38px;
    border: 0;
    border-radius: 50%;
    background: rgba(255,255,255,.92);
    color: var(--p);
    cursor: pointer;
    transform: translateY(-50%);
    box-shadow: 0 4px 12px rgba(0,0,0,.12);
}

.gallery-preview-arrow:hover {
    background: var(--p);
    color: #fff;
}

.gallery-preview-prev { left: 14px; }
.gallery-preview-next { right: 14px; }

.gallery-preview-index {
    position: absolute;
    right: 14px;
    bottom: 14px;
    padding: 5px 9px;
    border-radius: 999px;
    background: rgba(3,44,33,.78);
    color: #fff;
    font-size: 12px;
    font-weight: 700;
}

.gallery-card-actions {
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    margin-top: auto;
    padding-top: 14px;
}

.gallery-card-actions .btn {
    flex:1;
    text-align:center;
}


/* ==========================================
   GALLERY GRID
   ========================================== */

.gallery-grid {
    display:grid;
    grid-template-columns:repeat(4, minmax(0, 1fr));
    gap:18px;
}

.gallery-grid-item {
    background:#fff;
    border:1px solid #e6eeeb;
    border-radius:14px;
    padding:10px;
    overflow:hidden;
}

.gallery-grid-item img {
    width:100%;
    height:220px;
    object-fit:cover;
    display:block;
    border-radius:10px;
}

.gallery-delete {
    margin-top:10px;
}


/* ==========================================
   MODAL
   ========================================== */

.gallery-modal {
    position:fixed;
    inset:0;
    z-index:9999;
    display:none;
    align-items:center;
    justify-content:center;
    padding:24px;
    background:rgba(3,91,64,.48);
    backdrop-filter:blur(5px);
}

.gallery-modal.show {
    display:flex;
}

.gallery-modal-box {
    width:min(720px,100%);
    background:#fff;
    border-radius:20px;
    box-shadow:0 24px 70px rgba(0,0,0,.20);
    overflow:hidden;
    animation:galleryModalIn .18s ease-out;
}

@keyframes galleryModalIn {

    from {
        opacity:0;
        transform:translateY(12px) scale(.98);
    }

    to {
        opacity:1;
        transform:translateY(0) scale(1);
    }

}

.gallery-modal-head {
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:22px 24px;
    border-bottom:1px solid #e8efec;
}

.gallery-modal-head h2 {
    margin:0;
    color:var(--dark);
    font-size:21px;
}

.gallery-modal-close {
    border:0;
    background:#f0f5f3;
    width:36px;
    height:36px;
    border-radius:50%;
    cursor:pointer;
    font-size:22px;
    line-height:1;
    color:var(--dark);
}

.gallery-modal-body {
    padding:24px;
}

.gallery-modal-actions {
    display:flex;
    justify-content:flex-end;
    gap:10px;
    margin-top:22px;
}

.gallery-file-box {
    border:1.5px dashed #b8ccc4;
    border-radius:14px;
    padding:18px;
    background:#f8fbfa;
}

.gallery-file-box input[type=file] {
    width:100%;
}

.gallery-file-help {
    display:block;
    color:#6b7d77;
    font-size:13px;
    margin-top:8px;
}

.gallery-edit-images {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
    max-height: 330px;
    overflow: auto;
    margin-top: 10px;
}

.gallery-edit-image {
    position: relative;
    overflow: hidden;
    border: 1px solid #dcebe5;
    border-radius: 10px;
}

.gallery-edit-image img {
    display: block;
    width: 100%;
    height: 130px;
    object-fit: cover;
}

.gallery-edit-image button {
    display:block;
    width:calc(100% - 16px);
    margin:8px;
    padding:6px;
    border:0;
    border-radius:7px;
    background:#ffe7e7;
    color:#9b2727;
    cursor:pointer;
    font-size:12px;
    font-weight:700;
}

.gallery-edit-image.is-removed {
    opacity:.45;
}

.gallery-edit-image.is-removed button {
    background:#eaf5f1;
    color:var(--p);
}

.gallery-edit-image label {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px;
    color: #9b2727;
    font-size: 12px;
    font-weight: 700;
}


/* ==========================================
   MOBILE
   ========================================== */

@media (max-width:1000px) {

    .gallery-list {
        grid-template-columns:repeat(2, minmax(0, 1fr));
    }

}

@media (max-width:700px) {

    .gallery-page-head {
        align-items:flex-start;
    }

    .gallery-page-head .btn {
        white-space:nowrap;
    }

    .gallery-grid-item img {
        height:180px;
    }

    .gallery-edit-images {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

}

@media (max-width:450px) {

    .gallery-list {
        grid-template-columns:1fr;
    }

    .gallery-grid-item img {
        height:240px;
    }

    .gallery-edit-images {
        grid-template-columns:1fr;
    }

}

</style>


<!-- ==========================================
     PAGE HEADER
========================================== -->

<div class="gallery-page-head">

    <h1>Gallery</h1>

    <div class="list-toolbar">
        <div class="list-search"><input type="search" id="gallerySearch" placeholder="Search galleries..." autocomplete="off" aria-label="Search galleries"></div>
        <button type="button" class="btn gallery-add-btn" id="openGalleryModal">

        <span style="font-size:18px;line-height:1">+</span>

        Add New Gallery

        </button>
    </div>

</div>


<!-- ==========================================
     GALLERY LIST
========================================== -->

<?php if (empty($groups)): ?>

    <div class="empty">
        No galleries created yet.
    </div>

<?php else: ?>

    <div class="gallery-list">
    <?php foreach ($groups as $name => $images): ?>

        <div class="form-card gallery-card" data-search="<?= e(strtolower($name)) ?>">

            <div class="gallery-card-head">

                <div>

                    <h2>
                        <?= e($name) ?>
                    </h2>

                    <span class="gallery-count">

                        <?= count($images) ?>

                        image<?= count($images) === 1 ? '' : 's' ?>

                    </span>

                </div>

                <?php if ($canEdit): ?><button type="button" class="btn btn-sm gallery-add-image" data-gallery-name="<?= e($name) ?>">
                    + Add Image
                </button><?php endif; ?>

            </div>


            <div class="gallery-preview" data-gallery-slider>
                <div class="gallery-preview-track">
                    <?php foreach ($images as $g): ?>
                        <img class="gallery-preview-slide" src="../<?= e($g['image']) ?>" alt="<?= e($name) ?>" loading="lazy">
                    <?php endforeach; ?>
                </div>
                <?php if (count($images) > 1): ?>
                    <button type="button" class="gallery-preview-arrow gallery-preview-prev" data-gallery-prev aria-label="Previous image">&#10094;</button>
                    <button type="button" class="gallery-preview-arrow gallery-preview-next" data-gallery-next aria-label="Next image">&#10095;</button>
                <?php endif; ?>
                <span class="gallery-preview-index" data-gallery-index>1 / <?= count($images) ?></span>
            </div>

            <div class="gallery-card-actions">
                <?php if ($canEdit): ?><button type="button" class="btn btn-light gallery-edit-btn" data-gallery-name="<?= e($name) ?>">Edit Gallery</button><?php endif; ?>
            </div>

        </div>

    <?php endforeach; ?>
    </div>

<?php endif; ?>


<!-- ==========================================
     ADD GALLERY MODAL
========================================== -->

<div
    class="gallery-modal"
    id="galleryModal"
    aria-hidden="true"
>

    <div
        class="gallery-modal-box"
        role="dialog"
        aria-modal="true"
        aria-labelledby="galleryModalTitle"
    >

        <div class="gallery-modal-head">

            <h2 id="galleryModalTitle">
                Add New Gallery
            </h2>

            <button
                type="button"
                class="gallery-modal-close"
                id="closeGalleryModal"
                aria-label="Close"
            >
                &times;
            </button>

        </div>


        <form
            method="post"
            enctype="multipart/form-data"
        >

            <div class="gallery-modal-body">

                <div class="field">

                    <label for="galleryName">
                        Gallery Name
                    </label>

                    <input
                        id="galleryName"
                        required
                        type="text"
                        name="name"
                        placeholder="e.g. Clinic Event"
                        autocomplete="off"
                    >

                </div>


                <div
                    class="field"
                    style="margin-top:18px"
                >

                    <label for="galleryImages">
                        Gallery Photos
                    </label>

                    <div class="gallery-file-box">

                        <input
                            id="galleryImages"
                            required
                            type="file"
                            name="images[]"
                            accept="image/jpeg,image/png,image/webp,image/gif"
                            multiple
                        >

                        <span class="gallery-file-help">
                            You can select multiple images.
                            Maximum 5 MB per image.
                        </span>

                    </div>

                </div>


                <div class="gallery-modal-actions">

                    <button
                        type="button"
                        class="btn btn-outline"
                        id="cancelGalleryModal"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="btn"
                    >
                        Create Gallery
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<!-- EDIT GALLERY MODAL -->
<div class="gallery-modal" id="galleryEditModal" aria-hidden="true">
    <div class="gallery-modal-box" role="dialog" aria-modal="true" aria-labelledby="galleryEditModalTitle">
        <div class="gallery-modal-head">
            <h2 id="galleryEditModalTitle">Edit Gallery</h2>
            <button type="button" class="gallery-modal-close" id="closeGalleryEditModal" aria-label="Close">&times;</button>
        </div>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="edit_gallery">
            <input type="hidden" name="old_name" id="editGalleryOldName">
            <div class="gallery-modal-body">
                <div class="field">
                    <label for="editGalleryName">Gallery Title</label>
                    <input id="editGalleryName" required type="text" name="name" autocomplete="off">
                </div>
                <div class="field" style="margin-top:18px">
                    <label>Existing Images</label>
                    <div class="gallery-edit-images" id="editGalleryImages"></div>
                    <span class="gallery-file-help">Click Remove below an image to delete it.</span>
                </div>
                <div class="field" style="margin-top:18px">
                    <label for="editGalleryNewImages">Add New Images</label>
                    <div class="gallery-file-box">
                        <input id="editGalleryNewImages" type="file" name="images[]" accept="image/jpeg,image/png,image/webp,image/gif" multiple>
                        <span class="gallery-file-help">Maximum 5 MB per image.</span>
                    </div>
                </div>
                <div class="gallery-modal-actions">
                    <button type="button" class="btn btn-outline" id="cancelGalleryEditModal">Cancel</button>
                    <button type="submit" class="btn">Save Gallery</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>

(function () {

    const modal = document.getElementById('galleryModal');

    const openBtn = document.getElementById('openGalleryModal');

    const closeBtn = document.getElementById('closeGalleryModal');

    const cancelBtn = document.getElementById('cancelGalleryModal');

    const nameInput = document.getElementById('galleryName');

    const modalTitle = document.getElementById('galleryModalTitle');

    const addImageButtons = document.querySelectorAll('.gallery-add-image');

    const gallerySearch = document.getElementById('gallerySearch');

    const galleryCards = Array.from(document.querySelectorAll('.gallery-card'));


    function openModal() {

        if (!modal) return;

        modal.classList.add('show');

        modal.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.style.overflow = 'hidden';

        setTimeout(function () {

            if (nameInput) {
                nameInput.focus();
            }

        }, 80);

    }


    function openExistingGalleryModal(name) {

        if (!modal || !nameInput) return;

        nameInput.value = name;

        if (modalTitle) {
            modalTitle.textContent = 'Add Image to ' + name;
        }

        openModal();

    }

    if (gallerySearch) {
        gallerySearch.addEventListener('input', function () {
            const query = this.value.trim().toLowerCase();
            galleryCards.forEach(function (card) {
                card.style.display = !query || card.dataset.search.includes(query) ? '' : 'none';
            });
        });
    }


    function closeModal() {

        if (!modal) return;

        modal.classList.remove('show');

        modal.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.style.overflow = '';

    }


    if (openBtn) {
        openBtn.addEventListener(
            'click',
            function () {

                if (nameInput) nameInput.value = '';

                if (modalTitle) modalTitle.textContent = 'Add New Gallery';

                openModal();

            }
        );
    }


    addImageButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            openExistingGalleryModal(button.dataset.galleryName || '');

        });

    });


    if (closeBtn) {
        closeBtn.addEventListener(
            'click',
            closeModal
        );
    }


    if (cancelBtn) {
        cancelBtn.addEventListener(
            'click',
            closeModal
        );
    }


    if (modal) {

        modal.addEventListener(
            'click',
            function (event) {

                if (event.target === modal) {
                    closeModal();
                }

            }
        );

    }


    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                modal &&
                modal.classList.contains('show')
            ) {

                closeModal();

            }

        }
    );

})();

</script>

<script>
(function () {
    const galleryData = <?= json_encode($groups, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;

    document.querySelectorAll('[data-gallery-slider]').forEach(function (slider) {
        const track = slider.querySelector('.gallery-preview-track');
        const slides = Array.from(slider.querySelectorAll('.gallery-preview-slide'));
        const index = slider.querySelector('[data-gallery-index]');
        let current = 0;

        function showSlide(next) {
            if (!slides.length) return;
            current = (next + slides.length) % slides.length;
            track.style.transform = 'translateX(-' + (current * 100) + '%)';
            if (index) index.textContent = (current + 1) + ' / ' + slides.length;
        }

        const previous = slider.querySelector('[data-gallery-prev]');
        const next = slider.querySelector('[data-gallery-next]');
        if (previous) previous.addEventListener('click', function () { showSlide(current - 1); });
        if (next) next.addEventListener('click', function () { showSlide(current + 1); });
    });

    const editModal = document.getElementById('galleryEditModal');
    const editName = document.getElementById('editGalleryName');
    const editOldName = document.getElementById('editGalleryOldName');
    const editImages = document.getElementById('editGalleryImages');
    const closeEdit = function () {
        if (!editModal) return;
        editModal.classList.remove('show');
        editModal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    };

    document.querySelectorAll('.gallery-edit-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            const name = button.dataset.galleryName || '';
            const images = galleryData[name] || [];
            editName.value = name;
            editOldName.value = name;
            editImages.innerHTML = '';

            images.forEach(function (image) {
                const item = document.createElement('div');
                item.className = 'gallery-edit-image';
                const preview = document.createElement('img');
                preview.src = '../' + image.image;
                preview.alt = name;
                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.textContent = 'Remove';
                removeButton.addEventListener('click', function () {
                    const existingInput = item.querySelector('input[name="remove_ids[]"]');
                    if (existingInput) {
                        existingInput.remove();
                        item.classList.remove('is-removed');
                        removeButton.textContent = 'Remove';
                        return;
                    }
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'remove_ids[]';
                    input.value = image.id;
                    item.appendChild(input);
                    item.classList.add('is-removed');
                    removeButton.textContent = 'Undo';
                });
                item.append(preview, removeButton);
                editImages.appendChild(item);
            });

            editModal.classList.add('show');
            editModal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            editName.focus();
        });
    });

    document.getElementById('closeGalleryEditModal')?.addEventListener('click', closeEdit);
    document.getElementById('cancelGalleryEditModal')?.addEventListener('click', closeEdit);
    editModal?.addEventListener('click', function (event) {
        if (event.target === editModal) closeEdit();
    });
})();
</script>


<?php require 'footer.php'; ?>