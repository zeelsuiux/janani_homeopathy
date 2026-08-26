<?php require_once __DIR__ . '/includes.php'; $d = db_load(); $results = isset($d['results']) && is_array($d['results']) ? $d['results'] : []; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Results</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <?php include __DIR__ . '/header.php'; ?>

  <main class="page-shell">
    <section class="page-hero">
      <div class="container text-center">
        <p class="eyebrow">Patient Results</p>
        <h1>Success Stories & Results</h1>
      </div>
    </section>

    <section class="container section-space">
      <?php if (!$results): ?>
        <div class="empty-state">No result reviews available yet.</div>
      <?php else: ?>
        <div class="result-grid">
          <?php foreach ($results as $item): ?>
            <article class="result-card">
              <?php if (!empty($item['image'])): ?>
                <img src="<?= e($item['image']) ?>" alt="<?= e($item['title']) ?>">
              <?php endif; ?>
              <div class="result-body">
                <h3><?= e($item['title']) ?></h3>
                <p class="result-review collapsed"><?= nl2br(e($item['review'])) ?></p>
                <button type="button" class="result-toggle" data-title="<?= e($item['title']) ?>" data-review="<?= e($item['review']) ?>" data-image="<?= e($item['image'] ?? '') ?>">Read More</button>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>
  </main>

  <div class="result-modal" id="resultModal" hidden>
    <div class="result-modal-backdrop" data-result-close></div>
    <div class="result-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="resultModalTitle">
      <button type="button" class="result-modal-close" data-result-close aria-label="Close review">&times;</button>
      <img class="result-modal-image" id="resultModalImage" alt="" hidden>
      <div class="result-modal-content">
        <h2 id="resultModalTitle"></h2>
        <p id="resultModalReview"></p>
      </div>
    </div>
  </div>

  <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
