<?php
require 'header.php';
$db = db_load();
$canEdit = current_admin_can('edit');
$canDelete = current_admin_can('delete');
$finance = is_array($db['finance'] ?? null) ? $db['finance'] : [];
$categories = array_values(array_unique(array_filter(array_map('trim', (array)($finance['categories'] ?? [])))));
$entries = is_array($finance['entries'] ?? null) ? $finance['entries'] : [];
$loginAdmins = array_values(array_filter($db['admins'] ?? [], fn($admin) => ($admin['role'] ?? 'subadmin') === 'subadmin' && trim((string)($admin['username'] ?? '')) !== '' && !empty($admin['password'])));
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!$canEdit && post('action') !== 'delete_entry') { http_response_code(403); exit('Access denied.'); }
    $action = post('action');
    if ($action === 'add_category') {
        $category = trim(post('category'));
        if ($category !== '') $categories[] = $category;
        $categories = array_values(array_unique($categories));
    } elseif ($action === 'delete_category') {
        if (!$canDelete) { http_response_code(403); exit('Access denied.'); }
        $category = trim(post('category'));
        $categories = array_values(array_filter($categories, fn($item) => $item !== $category));
    } elseif ($action === 'delete_entry') {
        if (!$canDelete) { http_response_code(403); exit('Access denied.'); }
        $entryId = post('id');
        $entries = array_values(array_filter($entries, fn($entry) => (string)($entry['id'] ?? '') !== (string)$entryId));
    } elseif ($action === 'add_entry') {
        $amount = (float)post('amount');
        $date = post('date') ?: date('Y-m-d');
        $type = post('type') === 'income' ? 'income' : 'expense';
        if ($amount <= 0 || trim(post('title')) === '') {
            $error = 'Please enter a name and a valid amount.';
        } else {
            $entries[] = ['id' => make_id(), 'type' => $type, 'title' => trim(post('title')), 'category' => trim(post('category')), 'amount' => $amount, 'method' => post('method') === 'online' ? 'online' : 'cash', 'person' => trim(post('person')), 'note' => trim(post('note')), 'date' => $date, 'created_at' => now_iso(), 'created_by' => (string)($_SESSION['admin_username'] ?? 'admin')];
        }
    }
    if ($error === '') {
        $db['finance'] = ['categories' => $categories, 'entries' => $entries];
        db_save($db);
        redirect('finance.php');
    }
}

$totalIncome = 0; $totalExpense = 0; $cashBalance = 0; $onlineBalance = 0;
foreach ($entries as $entry) {
    if (!finance_entry_is_realized($entry)) continue;
    $amount = (float)($entry['amount'] ?? 0);
    $multiplier = ($entry['type'] ?? '') === 'income' ? 1 : -1;
    if ($multiplier === 1) $totalIncome += $amount; else $totalExpense += $amount;
    if (($entry['method'] ?? 'cash') === 'online') $onlineBalance += $amount * $multiplier; else $cashBalance += $amount * $multiplier;
}
$balance = $totalIncome - $totalExpense;
$daily = [];
foreach ($entries as $entry) {
    if (!finance_entry_is_realized($entry)) continue;
    $date = $entry['date'] ?? '';
    if (!isset($daily[$date])) $daily[$date] = ['income' => 0, 'expense' => 0];
    $daily[$date][$entry['type'] === 'income' ? 'income' : 'expense'] += (float)($entry['amount'] ?? 0);
}
ksort($daily);
$visibleEntries = array_values(array_filter($entries, fn($entry) => (string)($entry['date'] ?? '') <= date('Y-m-d')));
$sortedEntries = array_reverse($visibleEntries);
?>
<div class="admin-top"><div><span class="profile-eyebrow">Accounts</span><h1>Income &amp; Expenses</h1></div></div>
<?php if ($error !== ''): ?><div class="notice danger"><?= e($error) ?></div><?php endif; ?>
<div class="dash-cards finance-summary"><div class="dash-card"><span>Total Income</span><strong>₹<?= number_format($totalIncome, 2) ?></strong></div><div class="dash-card"><span>Total Expense</span><strong>₹<?= number_format($totalExpense, 2) ?></strong></div><div class="dash-card"><span>Available Balance</span><strong>₹<?= number_format($balance, 2) ?></strong></div><div class="dash-card"><span>Cash / Online Balance</span><strong>₹<?= number_format($cashBalance, 2) ?> / ₹<?= number_format($onlineBalance, 2) ?></strong></div></div>
<nav class="finance-tabs" role="tablist" aria-label="Finance sections"><button type="button" class="finance-tab active" data-finance-tab="entry" role="tab" aria-selected="true">Add Entry</button><button type="button" class="finance-tab" data-finance-tab="statement" role="tab" aria-selected="false">Day-wise Statement</button><button type="button" class="finance-tab" data-finance-tab="entries" role="tab" aria-selected="false">All Entries</button><button type="button" class="finance-tab" data-finance-tab="categories" role="tab" aria-selected="false">Manage Categories</button></nav>
<div class="finance-layout">
<section class="form-card"><h2>Add Income / Expense</h2><form method="post"><input type="hidden" name="action" value="add_entry"><div class="form-grid"><div class="field"><label>Type</label><div class="gender-options"><label><input type="radio" name="type" value="income" checked> Income</label><label><input type="radio" name="type" value="expense"> Expense</label></div></div><div class="field"><label>Date</label><input type="date" name="date" value="<?= e(date('Y-m-d')) ?>" required></div><div class="field"><label>Name / Description</label><input name="title" required placeholder="e.g. Consultation or Rent"></div><div class="field"><label>Amount</label><input type="number" name="amount" min="0.01" step="0.01" required></div><div class="field"><label>Category</label><select name="category"><option value="">Select category</option><?php foreach ($categories as $category): ?><option value="<?= e($category) ?>"><?= e($category) ?></option><?php endforeach; ?></select></div><div class="field"><label>Cash / Online</label><div class="gender-options"><label><input type="radio" name="method" value="cash" checked> Cash</label><label><input type="radio" name="method" value="online"> Online</label></div></div><div class="field"><label>Given To / Received From</label><input name="person" list="financeLoginAdmins" placeholder="Search subadmin or enter vendor"><datalist id="financeLoginAdmins"><?php foreach ($loginAdmins as $admin): ?><option value="<?= e($admin['name'] ?? $admin['username']) ?>"><?= e($admin['username']) ?></option><?php endforeach; ?></datalist></div><div class="field full"><label>Note</label><textarea name="note" rows="2"></textarea></div><div class="field full"><button class="btn" type="submit">Save Entry</button></div></div></form></section>
<section class="form-card"><h2>Manage Expense Names</h2><form method="post" class="finance-category-form"><input type="hidden" name="action" value="add_category"><input name="category" required placeholder="e.g. Internet Bill"><button class="btn" type="submit">Add Name</button></form><div class="finance-category-list"><?php foreach ($categories as $category): ?><span><?= e($category) ?><?php if ($canDelete): ?><form method="post"><input type="hidden" name="action" value="delete_category"><input type="hidden" name="category" value="<?= e($category) ?>"><button type="submit" aria-label="Delete <?= e($category) ?>">&times;</button></form><?php endif; ?></span><?php endforeach; ?></div></section>
</div>
<section class="form-card finance-statement"><h2>Day-wise Statement</h2><div class="table-wrap"><table><tr><th>Date</th><th>Income</th><th>Expense</th><th>Net</th></tr><?php foreach (array_reverse($daily, true) as $date => $totals): ?><tr><td><?= e(date_fmt($date)) ?></td><td>₹<?= number_format($totals['income'], 2) ?></td><td>₹<?= number_format($totals['expense'], 2) ?></td><td>₹<?= number_format($totals['income'] - $totals['expense'], 2) ?></td></tr><?php endforeach; ?><?php if (!$daily): ?><tr><td colspan="4">No financial entries yet.</td></tr><?php endif; ?></table></div></section>
<section class="form-card"><h2>All Entries</h2><div class="table-wrap"><table><tr><th>Date</th><th>Type</th><th>Name</th><th>Category</th><th>Amount</th><th>Method</th><th>Given To / Received From</th><th>Action</th></tr><?php foreach ($sortedEntries as $entry): ?><tr><td><?= e(date_fmt($entry['date'] ?? '')) ?></td><td><span class="badge <?= e($entry['type'] ?? '') ?>"><?= e(ucfirst($entry['type'] ?? '')) ?></span></td><td><?= e($entry['title'] ?? '') ?><br><small><?= e($entry['note'] ?? '') ?></small></td><td><?= e($entry['category'] ?? '-') ?></td><td>₹<?= number_format((float)($entry['amount'] ?? 0), 2) ?></td><td><?= e(ucfirst($entry['method'] ?? 'cash')) ?></td><td><?= e($entry['person'] ?? '-') ?></td><td><?php if ($canDelete): ?><form method="post" onsubmit="return confirm('Delete this entry?')"><input type="hidden" name="action" value="delete_entry"><input type="hidden" name="id" value="<?= e($entry['id']) ?>"><button class="btn btn-sm btn-danger">Delete</button></form><?php endif; ?></td></tr><?php endforeach; ?><?php if (!$sortedEntries): ?><tr><td colspan="8">No financial entries yet.</td></tr><?php endif; ?></table></div></section>
<script>
(function () {
    const tabs = Array.from(document.querySelectorAll('.finance-tab'));
    const panels = Array.from(document.querySelectorAll('.finance-layout > section, .finance-layout + section, .finance-layout ~ section')).filter(function (panel) { return panel.querySelector('h2'); });
    const names = ['entry', 'categories', 'statement', 'entries'];
    panels.forEach(function (panel, index) { panel.classList.add('finance-panel'); panel.dataset.financePanel = names[index] || 'entry'; });
    function showPanel(name) { tabs.forEach(function (tab) { const active = tab.dataset.financeTab === name; tab.classList.toggle('active', active); tab.setAttribute('aria-selected', active ? 'true' : 'false'); }); panels.forEach(function (panel) { panel.classList.toggle('active', panel.dataset.financePanel === name); }); }
    tabs.forEach(function (tab) { tab.addEventListener('click', function () { showPanel(tab.dataset.financeTab); }); });
    showPanel('entry');
})();
</script>
<?php require 'footer.php'; ?>
