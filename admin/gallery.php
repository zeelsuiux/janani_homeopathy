<?php
require 'header.php';

$db = db_load();
$canEdit = current_admin_can('edit');
$canDelete = current_admin_can('delete');

if ($canEdit && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $galleryName = trim(post('name'));
    $files       = $_FILES['images'] ?? null;

    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

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
    margin-bottom:22px;
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
}

.gallery-count {
    color:#6b7d77;
    font-size:14px;
    margin-top:4px;
    display:block;
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
    width:min(560px,100%);
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


/* ==========================================
   MOBILE
   ========================================== */

@media (max-width:1000px) {

    .gallery-grid {
        grid-template-columns:repeat(3, minmax(0, 1fr));
    }

}

@media (max-width:700px) {

    .gallery-page-head {
        align-items:flex-start;
    }

    .gallery-page-head .btn {
        white-space:nowrap;
    }

    .gallery-grid {
        grid-template-columns:repeat(2, minmax(0, 1fr));
    }

    .gallery-grid-item img {
        height:180px;
    }

}

@media (max-width:450px) {

    .gallery-grid {
        grid-template-columns:1fr;
    }

    .gallery-grid-item img {
        height:240px;
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


            <div class="gallery-grid">

                <?php foreach ($images as $g): ?>

                    <div class="gallery-grid-item">

                        <img
                            src="../<?= e($g['image']) ?>"
                            alt="<?= e($name) ?>"
                            loading="lazy"
                        >

                        <?php if ($canDelete): ?><div class="gallery-delete">

                            <a
                                class="btn btn-sm btn-danger"
                                href="gallery-delete.php?id=<?= e($g['id']) ?>"
                                onclick="return confirm('Delete this image?')"
                            >
                                Delete
                            </a>

                        </div><?php endif; ?>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    <?php endforeach; ?>

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


<?php require 'footer.php'; ?>