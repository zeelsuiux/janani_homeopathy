(function () {
    const presets = [{ value: 'all', label: 'All Data' }, { value: '7', label: 'Last 7 Days' }, { value: '15', label: 'Last 15 Days' }, { value: '30', label: 'Last 1 Month' }, { value: 'current', label: 'Current Month' }, { value: '90', label: 'Last 3 Months' }, { value: '180', label: 'Last 6 Months' }, { value: '365', label: 'Last Year' }, { value: 'custom', label: 'Custom Dates' }];
    const today = new Date();
    today.setHours(23, 59, 59, 999);
    const parseDate = function (text) {
        const match = String(text || '').match(/(\d{4})[-/]?(\d{2})[-/]?(\d{2})/);
        if (match) return new Date(+match[1], +match[2] - 1, +match[3]);
        const date = new Date(text);
        return Number.isNaN(date.getTime()) ? null : date;
    };
    document.querySelectorAll('.admin-main table').forEach(function (table) {
        if (table.dataset.dateFilterReady === 'true') return;
        const headers = Array.from(table.querySelectorAll('tr:first-child th')).map(function (cell) { return cell.textContent.trim().toLowerCase(); });
        const dateIndex = headers.findIndex(function (label) { return /date|created|time/.test(label); });
        if (dateIndex < 0) return;
        table.dataset.dateFilterReady = 'true';
        const rows = Array.from(table.querySelectorAll('tr')).slice(1).filter(function (row) { return row.cells.length > dateIndex && !row.id; });
        const wrapper = document.createElement('div');
        wrapper.className = 'admin-date-filter';
        wrapper.innerHTML = '<label>Show <select class="date-preset">' + presets.map(function (item) { return '<option value="' + item.value + '">' + item.label + '</option>'; }).join('') + '</select></label><label class="custom-date-field">From <input type="date" class="date-from"></label><label class="custom-date-field">To <input type="date" class="date-to"></label><button type="button" class="btn btn-sm btn-light date-clear">Reset</button>';
        table.parentNode.insertBefore(wrapper, table);
        const preset = wrapper.querySelector('.date-preset');
        const from = wrapper.querySelector('.date-from');
        const to = wrapper.querySelector('.date-to');
        const customFields = wrapper.querySelectorAll('.custom-date-field');
        function filter() {
            let start = new Date(today);
            start.setHours(0, 0, 0, 0);
            let end = new Date(today);
            if (preset.value === 'all') { start = null; end = null; }
            else if (preset.value === 'custom') {
                start = from.value ? parseDate(from.value) : null;
                end = to.value ? parseDate(to.value) : null;
                if (end) end.setHours(23, 59, 59, 999);
            } else if (preset.value === 'current') {
                start = new Date(today.getFullYear(), today.getMonth(), 1);
            } else {
                start.setDate(start.getDate() - (Number(preset.value) - 1));
            }
            rows.forEach(function (row) {
                const date = parseDate(row.cells[dateIndex].textContent);
                row.style.display = !date || !start || !end || (date >= start && date <= end) ? '' : 'none';
            });
        }
        preset.addEventListener('change', function () { customFields.forEach(function (field) { field.style.display = preset.value === 'custom' ? 'inline-flex' : 'none'; }); filter(); });
        from.addEventListener('change', filter);
        to.addEventListener('change', filter);
        wrapper.querySelector('.date-clear').addEventListener('click', function () { preset.value = 'all'; from.value = ''; to.value = ''; customFields.forEach(function (field) { field.style.display = 'none'; }); filter(); });
        customFields.forEach(function (field) { field.style.display = 'none'; });
        filter();
    });
    document.querySelectorAll('.admin-main [data-date]').forEach(function (card) {
        if (card.dataset.dateFilterReady === 'true') return;
        const cards = Array.from(card.parentElement.querySelectorAll('[data-date]'));
        if (card !== cards[0]) return;
        const wrapper = document.createElement('div');
        wrapper.className = 'admin-date-filter';
        wrapper.innerHTML = '<label>Show <select class="date-preset">' + presets.map(function (item) { return '<option value="' + item.value + '">' + item.label + '</option>'; }).join('') + '</select></label><label class="custom-date-field">From <input type="date" class="date-from"></label><label class="custom-date-field">To <input type="date" class="date-to"></label><button type="button" class="btn btn-sm btn-light date-clear">Reset</button>';
        card.parentElement.parentNode.insertBefore(wrapper, card.parentElement);
        const preset = wrapper.querySelector('.date-preset'), from = wrapper.querySelector('.date-from'), to = wrapper.querySelector('.date-to'), customFields = wrapper.querySelectorAll('.custom-date-field');
        function filterCards() { let start = new Date(today); start.setHours(0, 0, 0, 0); let end = new Date(today); if (preset.value === 'all') { start = null; end = null; } else if (preset.value === 'custom') { start = from.value ? parseDate(from.value) : null; end = to.value ? parseDate(to.value) : null; if (end) end.setHours(23, 59, 59, 999); } else if (preset.value === 'current') start = new Date(today.getFullYear(), today.getMonth(), 1); else start.setDate(start.getDate() - (Number(preset.value) - 1)); cards.forEach(function (item) { const date = parseDate(item.dataset.date); item.style.display = !date || !start || !end || (date >= start && date <= end) ? '' : 'none'; item.dataset.dateFilterReady = 'true'; }); }
        preset.addEventListener('change', function () { customFields.forEach(function (field) { field.style.display = preset.value === 'custom' ? 'inline-flex' : 'none'; }); filterCards(); }); from.addEventListener('change', filterCards); to.addEventListener('change', filterCards); wrapper.querySelector('.date-clear').addEventListener('click', function () { preset.value = 'all'; from.value = ''; to.value = ''; customFields.forEach(function (field) { field.style.display = 'none'; }); filterCards(); }); customFields.forEach(function (field) { field.style.display = 'none'; }); filterCards();
    });
})();
