</main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
	const adminMenuToggle = document.querySelector('.admin-mobile-toggle');
	const adminSidebar = document.getElementById('adminSidebar');
	if (adminMenuToggle && adminSidebar) {
		adminMenuToggle.addEventListener('click', () => {
			const open = document.body.classList.toggle('admin-menu-open');
			adminMenuToggle.setAttribute('aria-expanded', String(open));
		});
	}
	document.querySelectorAll('.admin-nav-toggle').forEach((button) => {
		button.addEventListener('click', () => {
			const group = button.closest('.admin-nav-group');
			const open = group.classList.toggle('open');
			button.setAttribute('aria-expanded', String(open));
		});
	});
	document.querySelectorAll('.admin-main table').forEach((table) => {
		const rows = Array.from(table.rows);
		const headerRow = rows.find((row) => row.querySelector('th'));
		if (!headerRow) return;
		const labels = Array.from(headerRow.cells).map((cell) => cell.textContent.trim());
		table.classList.add('admin-card-table');
		rows.forEach((row) => {
			if (row === headerRow) return;
			Array.from(row.cells).forEach((cell, index) => {
				if (cell.colSpan > 1) return;
				cell.dataset.label = labels[index] || '';
			});
		});
	});
	document.querySelectorAll('select[name="treatment"], select[data-searchable]').forEach((select) => {
		const field = select.parentElement;
		const selectedValue = select.querySelector('option[selected]')?.value || '';
		select.value = selectedValue;
		const options = Array.from(select.options).filter((option) => option.value !== '').map((option) => ({ value: option.value, label: option.textContent }));
		select.querySelector('option[value=""]')?.remove();
		const input = document.createElement('input');
		input.type = 'search';
		input.className = 'treatment-combobox';
		input.placeholder = select.dataset.searchPlaceholder || 'Select or search treatment';
		input.autocomplete = 'off';
		input.setAttribute('role', 'combobox');
		input.setAttribute('aria-expanded', 'false');
		const selected = options.find((option) => option.value === selectedValue);
		input.value = selected ? selected.label : '';
		const suggestions = document.createElement('div');
		suggestions.className = 'treatment-suggestions';
		suggestions.setAttribute('role', 'listbox');
		select.hidden = true;
		field.insertBefore(input, select);
		field.insertBefore(suggestions, select);
		const render = () => {
			const query = input.value.trim().toLowerCase();
			suggestions.replaceChildren();
			options.filter((option) => !query || option.label.toLowerCase().includes(query)).forEach((option) => {
				const item = document.createElement('button');
				item.type = 'button';
				item.className = 'treatment-suggestion';
				item.textContent = option.label;
				item.addEventListener('click', () => { select.value = option.value; input.value = option.label; suggestions.classList.remove('show'); input.setAttribute('aria-expanded', 'false'); });
				suggestions.append(item);
			});
			suggestions.classList.toggle('show', suggestions.children.length > 0);
			input.setAttribute('aria-expanded', suggestions.classList.contains('show') ? 'true' : 'false');
		};
		input.addEventListener('focus', render);
		input.addEventListener('input', () => { select.value = ''; render(); });
		input.addEventListener('keydown', (event) => { if (event.key === 'Escape') { suggestions.classList.remove('show'); input.setAttribute('aria-expanded', 'false'); } });
		document.addEventListener('click', (event) => { if (!field.contains(event.target)) { suggestions.classList.remove('show'); input.setAttribute('aria-expanded', 'false'); } });
	});
</script>
<script src="../assets/js/file-preview.js"></script>
</body>

</html>