<?php
require 'includes.php';
$s = settings();
$db = db_load();
$page_title = 'Gallery | ' . $s['clinic_name'];
require 'header.php';

$groups = [];
foreach (($db['gallery'] ?? []) as $g) {
    $name = trim($g['name'] ?? 'Untitled Gallery');
    if ($name === '') $name = 'Untitled Gallery';
    $groups[$name][] = $g;
}
?>
<section class="page-head">
    <div class="container">
        <h1 class="font-bold">Gallery</h1>
        <p>Clinic moments, events and patient-care environment.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php if (!$groups): ?>
            <div class="empty">Gallery images will appear here after upload from the admin panel.</div>
        <?php else: ?>
            <div class="gallery-album-grid">
                <?php $albumIndex = 0;
                foreach ($groups as $name => $images): $albumIndex++; ?>
                    <button type="button" class="gallery-album" onclick="openGallery(<?= e((string)$albumIndex) ?>)" aria-label="Open <?= e($name) ?> gallery">
                        <div class="gallery-cover">
                            <img src="<?= e($images[0]['image']) ?>" alt="<?= e($name) ?>">
                            <span class="gallery-count"><?= count($images) ?> Photos</span>
                        </div>
                        <div class="gallery-album-body">
                            <h3><?= e($name) ?></h3>
                            <p>Click to view slideshow</p>
                        </div>
                    </button>

                    <div class="gallery-data" id="gallery-data-<?= e((string)$albumIndex) ?>">
                        <?php foreach ($images as $g): ?>
                            <button type="button" data-image="<?= e($g['image']) ?>" data-alt="<?= e($name) ?>"></button>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<div class="gallery-modal" id="galleryModal" aria-hidden="true">
    <button class="gallery-close" type="button" onclick="closeGallery()" aria-label="Close">&times;</button>
    <button class="gallery-nav gallery-prev" type="button" onclick="changeGallery(-1)" aria-label="Previous">&#10094;</button>
    <div class="gallery-modal-content">
        <img id="galleryModalImage" src="" alt="">
        <div class="gallery-modal-caption">
            <strong id="galleryModalTitle"></strong>
            <span id="galleryModalCounter"></span>
        </div>
    </div>
    <button class="gallery-nav gallery-next" type="button" onclick="changeGallery(1)" aria-label="Next">&#10095;</button>
</div>

<script>
    let activeGallery = [];
    let activeGalleryIndex = 0;
    let activeGalleryTitle = '';

    function openGallery(id) {
        const box = document.getElementById('gallery-data-' + id);
        if (!box) return;
        activeGallery = Array.from(box.querySelectorAll('button')).map(btn => ({
            image: btn.dataset.image,
            alt: btn.dataset.alt || ''
        }));
        activeGalleryIndex = 0;
        activeGalleryTitle = activeGallery[0]?.alt || '';
        renderGallery();
        const modal = document.getElementById('galleryModal');
        modal.classList.add('show');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function renderGallery() {
        if (!activeGallery.length) return;
        const item = activeGallery[activeGalleryIndex];
        document.getElementById('galleryModalImage').src = item.image;
        document.getElementById('galleryModalImage').alt = item.alt;
        document.getElementById('galleryModalTitle').textContent = activeGalleryTitle;
        document.getElementById('galleryModalCounter').textContent = (activeGalleryIndex + 1) + ' / ' + activeGallery.length;
    }

    function changeGallery(step) {
        if (!activeGallery.length) return;
        activeGalleryIndex = (activeGalleryIndex + step + activeGallery.length) % activeGallery.length;
        renderGallery();
    }

    function closeGallery() {
        const modal = document.getElementById('galleryModal');
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    document.getElementById('galleryModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeGallery();
    });

    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('galleryModal');
        if (!modal.classList.contains('show')) return;
        if (e.key === 'Escape') closeGallery();
        if (e.key === 'ArrowLeft') changeGallery(-1);
        if (e.key === 'ArrowRight') changeGallery(1);
    });
</script>

<style>
    .gallery-album-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px
    }

    .gallery-album {
        padding: 0;
        text-align: left;
        border: 1px solid #e4eee9;
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        cursor: pointer;
        box-shadow: 0 10px 30px rgba(3, 91, 64, .08);
        transition: .2s;
        font: inherit;
        color: inherit
    }

    .gallery-album:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 35px rgba(3, 91, 64, .14)
    }

    .gallery-cover {
        height: 280px;
        position: relative;
        overflow: hidden;
        background: #eef8f4
    }

    .gallery-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform .3s
    }

    .gallery-album:hover .gallery-cover img {
        transform: scale(1.04)
    }

    .gallery-count {
        position: absolute;
        right: 14px;
        bottom: 14px;
        background: rgba(6, 47, 35, .88);
        color: #fff;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700
    }

    .gallery-album-body {
        padding: 18px 20px
    }

    .gallery-album-body h3 {
        margin: 0 0 3px;
        color: var(--dark)
    }

    .gallery-album-body p {
        margin: 0;
        color: var(--muted);
        font-size: 13px
    }

    .gallery-data {
        display: none
    }

    .gallery-modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .88);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 35px
    }

    .gallery-modal.show {
        display: flex
    }

    .gallery-modal-content {
        max-width: min(1100px, 88vw);
        max-height: 90vh;
        text-align: center
    }

    .gallery-modal-content img {
        display: block;
        max-width: 100%;
        max-height: 78vh;
        width: auto;
        height: auto;
        margin: auto;
        border-radius: 12px;
        object-fit: contain
    }

    .gallery-modal-caption {
        color: #fff;
        padding-top: 12px;
        display: flex;
        justify-content: center;
        gap: 18px;
        align-items: center
    }

    .gallery-modal-caption span {
        opacity: .75;
        font-size: 13px
    }

    .gallery-close,
    .gallery-nav {
        position: absolute;
        border: 0;
        background: rgba(255, 255, 255, .12);
        color: #fff;
        cursor: pointer;
        border-radius: 50%;
        width: 48px;
        height: 48px;
        font-size: 28px;
        display: grid;
        place-items: center
    }

    .gallery-close {
        right: 25px;
        top: 22px
    }

    .gallery-prev {
        left: 25px;
        top: 50%;
        transform: translateY(-50%)
    }

    .gallery-next {
        right: 25px;
        top: 50%;
        transform: translateY(-50%)
    }

    .gallery-close:hover,
    .gallery-nav:hover {
        background: rgba(255, 255, 255, .25)
    }

    @media(max-width:900px) {
        .gallery-album-grid {
            grid-template-columns: repeat(2, 1fr)
        }
    }

    @media(max-width:600px) {
        .gallery-album-grid {
            grid-template-columns: 1fr
        }

        .gallery-cover {
            height: 230px
        }

        .gallery-modal {
            padding: 20px
        }

        .gallery-prev {
            left: 10px
        }

        .gallery-next {
            right: 10px
        }

        .gallery-close {
            right: 12px;
            top: 12px
        }

        .gallery-modal-content {
            max-width: 94vw
        }

        .gallery-modal-content img {
            max-height: 72vh
        }
    }
</style>
<?php require 'footer.php'; ?>