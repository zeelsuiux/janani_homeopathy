<?php require 'includes.php';
$s = settings();
$page_title = 'Reviews | ' . $s['clinic_name'];
$google_review_url = 'https://share.google/qPOwzaxAZ25YDH1Ce';
require 'header.php'; ?>

<section class="reviews-hero">
	<div class="container reviews-summary">
		<div class="eyebrow">Google Patient Reviews</div>
		<h1>What Our Patients Say</h1>
		<p>Live reviews from our Google Business Profile</p>
		<a class="google-review-btn" href="<?= e($google_review_url) ?>" target="_blank" rel="noopener noreferrer">Review us on Google</a>
	</div>
</section>

<section class="section reviews-section">
	<div class="container trustindex-reviews">
		<script defer async src="https://cdn.trustindex.io/loader.js?dec3daf80a6f08588996c821684"></script>
		<div class="ti-widget" data-widget-id="dec3daf80a6f08588996c821684"></div>
	</div>
</section>

<?php require 'footer.php'; ?>
