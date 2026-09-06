<?php
require 'header.php';
$db = db_load();
$statuses = ['New', 'Contacted', 'Converted', 'Closed'];
$statusCounts = array_fill_keys($statuses, 0);
$kanban = array_fill_keys($statuses, []);
$errorMessage = trim((string)($_GET['error'] ?? ''));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	foreach ($db['inquiries'] as &$inquiry) {
		if ($inquiry['id'] === post('id')) $inquiry['status'] = post('status');
	}
	unset($inquiry);
	db_save($db);
	redirect('inquiries.php');
}

foreach (array_reverse($db['inquiries']) as $inquiry) {
	$status = $inquiry['status'] ?? 'New';
	if (!isset($kanban[$status])) $status = 'New';
	$kanban[$status][] = $inquiry;
	$statusCounts[$status]++;
}
?>
<div class="admin-top"><h1>Inquiries</h1><div class="list-toolbar"><div class="list-search"><input type="search" id="inquirySearch" placeholder="Search inquiries..." autocomplete="off" aria-label="Search inquiries"></div></div></div>
<?php if ($errorMessage !== ''): ?><div class="notice danger"><?= e($errorMessage) ?></div><?php endif; ?>
<div class="inquiry-kanban" id="inquiryKanban">
<?php foreach ($statuses as $status): ?>
	<section class="inquiry-column" data-status-column="<?= e($status) ?>">
		<header class="inquiry-column-head"><h2><?= e($status) ?></h2><span class="status-count"><?= e((string)$statusCounts[$status]) ?></span></header>
		<div class="inquiry-column-body">
		<?php foreach ($kanban[$status] as $i): $type = $i['type'] ?? 'Contact Inquiry'; ?>
			<article class="inquiry-card" data-status="<?= e($status) ?>" data-search="<?= e(strtolower($type . ' ' . ($i['name'] ?? '') . ' ' . ($i['mobile'] ?? '') . ' ' . ($i['email'] ?? '') . ' ' . ($i['message'] ?? '') . ' ' . $status)) ?>">
				<div class="inquiry-card-top"><span class="badge"><?= e($type) ?></span><small><?= e(date_fmt($i['created_at'] ?? '')) ?></small></div>
				<h3><?= e($i['name'] ?? '-') ?></h3>
				<p class="inquiry-card-contact"><?= e($i['mobile'] ?? '-') ?><br><?= e($i['email'] ?? '-') ?></p>
				<?php if ($type === 'Appointment Request' && !empty($i['appointment_date'])): ?><p class="inquiry-card-appointment"><strong>Appointment:</strong> <?= e(date_fmt($i['appointment_date'])) ?> · <?= e($i['appointment_time'] ?? '') ?></p><?php endif; ?>
				<?php if (!empty($i['message'])): ?><p class="inquiry-card-message"><?= e($i['message']) ?></p><?php endif; ?>
				<form method="post" class="inquiry-card-actions">
					<input type="hidden" name="id" value="<?= e($i['id']) ?>">
					<select name="status" aria-label="Change inquiry status">
						<?php foreach ($statuses as $option): ?><option value="<?= e($option) ?>" <?= $status === $option ? 'selected' : '' ?>><?= e($option) ?></option><?php endforeach; ?>
					</select>
					<button class="btn btn-sm" type="submit">Update</button>
					<?php if ($status !== 'Converted'): ?><a class="btn btn-sm btn-outline" href="inquiry-convert.php?id=<?= e($i['id']) ?>">Convert</a><?php endif; ?>
				</form>
			</article>
		<?php endforeach; ?>
		<p class="inquiry-column-empty">No inquiries</p>
		</div>
	</section>
<?php endforeach; ?>
</div>
<script>
(function(){const search=document.getElementById('inquirySearch');const cards=Array.from(document.querySelectorAll('.inquiry-card'));const columns=Array.from(document.querySelectorAll('.inquiry-column'));function filter(){const query=(search?.value||'').trim().toLowerCase();columns.forEach(function(column){let visible=0;column.querySelectorAll('.inquiry-card').forEach(function(card){const match=!query||card.dataset.search.includes(query);card.style.display=match?'':'none';if(match)visible++;});const empty=column.querySelector('.inquiry-column-empty');if(empty)empty.style.display=visible?'none':'';});}search?.addEventListener('input',filter);filter();})();
</script><?php require 'footer.php'; ?>