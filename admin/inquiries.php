<?php
require 'header.php';
$db = db_load();
$statuses = ['New', 'Contacted', 'Converted', 'Old Patient', 'Closed'];
$statusCounts = array_fill_keys($statuses, 0);
$kanban = array_fill_keys($statuses, []);
$errorMessage = trim((string)($_GET['error'] ?? ''));
$canEdit = current_admin_can('edit');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (!$canEdit) { http_response_code(403); exit('Access denied.'); }
	$allowedStatus = in_array(post('status'), $statuses, true) ? post('status') : null;
	if (!$allowedStatus) { http_response_code(422); exit('Invalid inquiry status.'); }
	$result = ['status' => $allowedStatus, 'patient_id' => ''];
	if ($allowedStatus === 'Converted') {
		$result = convert_inquiry_to_patient($db, (string)post('id'));
		if ($result['status'] === 'not_found') { http_response_code(404); exit('Inquiry not found.'); }
	} else {
		foreach ($db['inquiries'] as &$inquiry) {
			if ($inquiry['id'] === post('id')) $inquiry['status'] = $allowedStatus;
		}
		unset($inquiry);
	}
	db_save($db);
	if (($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest') {
		header('Content-Type: application/json');
		echo json_encode(['status' => $result['status'] === 'old_patient' ? 'Old Patient' : $result['status']]);
		exit;
	}
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
			<article class="inquiry-card" draggable="<?= $canEdit ? 'true' : 'false' ?>" data-id="<?= e($i['id']) ?>" data-status="<?= e($status) ?>" data-search="<?= e(strtolower($type . ' ' . ($i['name'] ?? '') . ' ' . ($i['mobile'] ?? '') . ' ' . ($i['email'] ?? '') . ' ' . ($i['message'] ?? '') . ' ' . $status)) ?>">
				<div class="inquiry-card-top"><span class="badge"><?= e($type) ?></span><small><?= e(date_fmt($i['created_at'] ?? '')) ?></small></div>
				<h3><?= e($i['name'] ?? '-') ?></h3>
				<p class="inquiry-card-contact"><?= e($i['mobile'] ?? '-') ?><br><?= e($i['email'] ?? '-') ?></p>
				<?php if ($type === 'Appointment Request' && !empty($i['appointment_date'])): ?><p class="inquiry-card-appointment"><strong>Appointment:</strong> <?= e(date_fmt($i['appointment_date'])) ?> · <?= e($i['appointment_time'] ?? '') ?></p><?php endif; ?>
				<?php if (!empty($i['message'])): ?><p class="inquiry-card-message"><?= e($i['message']) ?></p><?php endif; ?>
				<div class="inquiry-card-actions">
					<?php if (!in_array($status, ['Converted', 'Old Patient'], true)): ?><a class="btn btn-sm btn-outline" href="inquiry-convert.php?id=<?= e($i['id']) ?>">Convert</a><?php endif; ?>
				</div>
			</article>
		<?php endforeach; ?>
		<p class="inquiry-column-empty">No inquiries</p>
		</div>
	</section>
<?php endforeach; ?>
</div>
<script>
(function(){const search=document.getElementById('inquirySearch');const cards=Array.from(document.querySelectorAll('.inquiry-card'));const columns=Array.from(document.querySelectorAll('.inquiry-column'));function filter(){const query=(search?.value||'').trim().toLowerCase();columns.forEach(function(column){let visible=0;column.querySelectorAll('.inquiry-card').forEach(function(card){const match=!query||card.dataset.search.includes(query);card.style.display=match?'':'none';if(match)visible++;});const empty=column.querySelector('.inquiry-column-empty');if(empty)empty.style.display=visible?'none':'';});}search?.addEventListener('input',filter);let draggedCard=null;cards.forEach(function(card){card.addEventListener('dragstart',function(){draggedCard=card;card.classList.add('is-dragging');});card.addEventListener('dragend',function(){card.classList.remove('is-dragging');draggedCard=null;});});columns.forEach(function(column){column.addEventListener('dragover',function(event){if(draggedCard)event.preventDefault();});column.addEventListener('drop',function(event){event.preventDefault();if(!draggedCard)return;const status=column.dataset.statusColumn;if(status===draggedCard.dataset.status)return;const form=new FormData();form.append('id',draggedCard.dataset.id);form.append('status',status);fetch('inquiries.php',{method:'POST',headers:{'X-Requested-With':'XMLHttpRequest'},body:form}).then(function(response){if(!response.ok)throw new Error('Update failed');return response.json();}).then(function(result){const targetStatus=result.status||status;const targetColumn=document.querySelector('[data-status-column="'+targetStatus+'"]');if(!targetColumn)throw new Error('Status column missing');targetColumn.querySelector('.inquiry-column-body').prepend(draggedCard);draggedCard.dataset.status=targetStatus;const select=draggedCard.querySelector('select[name="status"]');if(select)select.value=targetStatus;filter();}).catch(function(){window.location.reload();});});});filter();})();
</script><?php require 'footer.php'; ?>