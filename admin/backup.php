<?php
require 'header.php';
master_admin_required();

$deletedDir = __DIR__ . '/../database/deleted/';
$backup = [];
$collections = ['patients', 'appointments', 'inquiries', 'blogs', 'gallery', 'results', 'enquiries', 'testimonials'];
foreach ($collections as $collection) {
    $deletedFile = $deletedDir . $collection . '.json';
    $items = is_file($deletedFile) ? json_decode(file_get_contents($deletedFile) ?: '', true) : [];
    $backup[$collection] = is_array($items) ? $items : [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $collection = post('collection');
    $id = (string)post('id');
    $action = post('action');
    if (in_array($collection, $collections, true) && $id !== '') {
        $db = db_load();
        $backupItems = $backup[$collection] ?? [];
        foreach ($backupItems as $index => $record) {
            if ((string)($record['id'] ?? '') !== $id) continue;

            if ($action === 'delete') {
                array_splice($backupItems, $index, 1);
                $backup[$collection] = $backupItems;
                file_put_contents($deletedDir . $collection . '.json', json_encode($backupItems, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL, LOCK_EX);
                break;
            }

            $recordToRestore = $record;
            unset($recordToRestore['deleted_at']);
            if (!isset($db[$collection]) || !is_array($db[$collection])) $db[$collection] = [];
            $currentIds = array_map(fn($item) => (string)($item['id'] ?? ''), $db[$collection]);
            if (!in_array($id, $currentIds, true)) $db[$collection][] = $recordToRestore;
            db_save($db);
            array_splice($backupItems, $index, 1);
            $backup[$collection] = $backupItems;
            file_put_contents($deletedDir . $collection . '.json', json_encode($backupItems, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL, LOCK_EX);
            break;
        }
    }
    redirect('backup.php');
}

$total = 0;
foreach ($collections as $collection) $total += count($backup[$collection] ?? []);
?>
<div class="admin-top backup-page-head">
    <h1>Backup</h1>
    <div class="list-toolbar">
        <div class="list-search"><input type="search" id="backupSearch" placeholder="Search backup records..." autocomplete="off" aria-label="Search backup records"></div>
    </div>
</div>
<div class="backup-tabs" role="tablist" aria-label="Backup collections"><button type="button" class="backup-tab active" data-collection="all">All <span><?= e((string)$total) ?></span></button><?php foreach ($collections as $collection): ?><button type="button" class="backup-tab" data-collection="<?= e($collection) ?>"><?= e(ucfirst($collection)) ?> <span><?= e((string)count($backup[$collection] ?? [])) ?></span></button><?php endforeach; ?></div>
<div class="backup-summary">Deleted records: <strong><?= e((string)$total) ?></strong></div>
<?php if ($total === 0): ?>
    <div class="empty-state">No deleted records in backup.</div>
<?php else: ?>
    <div class="table-wrap">
        <table class="backup-table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Record</th>
                    <th>Details</th>
                    <th>Deleted Date &amp; Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($collections as $collection): foreach (($backup[$collection] ?? []) as $record):
                        $summary = $record['title'] ?? $record['name'] ?? $record['number'] ?? $record['id'] ?? 'Deleted record';
                        $searchText = strtolower($collection . ' ' . $summary . ' ' . ($record['review'] ?? '') . ' ' . ($record['email'] ?? '') . ' ' . ($record['mobile'] ?? ''));
                ?>
                        <tr class="backup-row" data-collection="<?= e($collection) ?>" data-search="<?= e($searchText) ?>">
                            <td><span class="backup-collection"><?= e(ucfirst($collection)) ?></span></td>
                            <td><strong><?= e((string)$summary) ?></strong><?php if (!empty($record['image'])): ?><img src="../<?= e($record['image']) ?>" alt="<?= e((string)$summary) ?>" class="backup-thumbnail"><?php endif; ?></td>
                            <td><?= e($record['mobile'] ?? $record['email'] ?? $record['review'] ?? $record['message'] ?? '-') ?></td>
                            <td><?= e($record['deleted_at'] ?? '-') ?></td>
                            <td>
                                <form method="post" class="actions"><input type="hidden" name="collection" value="<?= e($collection) ?>"><input type="hidden" name="id" value="<?= e((string)($record['id'] ?? '')) ?>"><button type="submit" name="action" value="restore" class="btn btn-sm" onclick="return confirm('Restore this deleted record?')">Restore</button><button type="submit" name="action" value="delete" class="btn btn-sm btn-danger" onclick="return confirm('Delete this backup record permanently?')" style="margin-left:8px;">Delete</button></form>
                            </td>
                        </tr>
                <?php endforeach;
                endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="empty-state" id="noBackupFound" style="display:none">No matching backup records.</div>
<?php endif; ?>
<script>
    (function() {
        const search = document.getElementById('backupSearch');
        const rows = Array.from(document.querySelectorAll('.backup-row'));
        const tabs = Array.from(document.querySelectorAll('.backup-tab'));
        const empty = document.getElementById('noBackupFound');
        let collection = 'all';

        function update() {
            const query = (search?.value || '').trim().toLowerCase();
            let visible = 0;
            rows.forEach(function(row) {
                const match = (!query || row.dataset.search.includes(query)) && (collection === 'all' || row.dataset.collection === collection);
                row.style.display = match ? '' : 'none';
                if (match) visible++;
            });
            if (empty) empty.style.display = visible ? 'none' : '';
        }
        search?.addEventListener('input', update);
        tabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                collection = tab.dataset.collection;
                tabs.forEach(function(item) {
                    item.classList.toggle('active', item === tab);
                });
                update();
            });
        });
    })();
</script>
<?php require 'footer.php'; ?>