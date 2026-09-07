<?php $s = settings();
$whatsapp_number = preg_replace('/\D+/', '', explode('/', $s['phone'])[0]); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<footer class="footer">
    <div class="container footer-grid">
        <div class="footer-intro">
            <a href="index.php"><img class="footer-logo" src="assets/images/logo.png" alt="<?= e($s['clinic_name']) ?>"></a>
            <p>Searching Homeopathy Clinic in Surat, India?<br>Satyam Homeopathy Clinic is best Homeopathic Clinic near Surat, India. Dr. <?= e($s['doctor_name']) ?> is a homeopathic doctor and counselling psychologist. She has been helping people for over 7 years. She treats many kinds of problems, such as illnesses in children, mental health issues, skin problems, breathing problems, joint pain, hair loss, asthma, diabetes and many other diseases.</p>

        </div>
        <div class="footer-links">
            <h3>Quick Links</h3>
            <a href="index.php">Home</a><a href="about.php">About Us</a><a href="treatments.php">Homeopathy Treatments</a><a href="reviews.php">Reviews</a><a href="gallery.php">Gallery</a><a href="contact.php#faq">FAQ's</a><a href="blog.php">Blog</a><a href="contact.php">Contact Us</a>
        </div>
        <div class="footer-links">
            <h3>Homeopathy Treatments</h3>
            <a href="mental-diseases.php">Mental Diseases</a><a href="gastric-diseases.php">Gastric Diseases</a><a href="skin-diseases.php">Skin Diseases</a><a href="gynaecological-problems.php">Gynaecological Problems</a><a href="neurological-disorders.php">Neurological Disorders</a><a href="autoimmune-disorders.php">Autoimmune Disorders</a><a href="bone-joint-diseases.php">Bone &amp; Joint Diseases</a><a href="respiratory-problems.php">Respiratory Problems</a><a href="childrens-problems.php">Children's Problems</a>
        </div>
        <div class="footer-contact">
            <h3>Contact Us</h3>
            <p><i class="fa-solid fa-location-dot" aria-hidden="true"></i><?= e($s['address']) ?></p>
            <a href="tel:<?= e(preg_replace('/[^0-9+]/', '', $s['phone'])) ?>"><i class="fa-solid fa-phone" aria-hidden="true"></i><?= e($s['phone']) ?></a>
            <a href="mailto:<?= e(trim($s['email'])) ?>"><i class="fa-solid fa-envelope" aria-hidden="true"></i><?= e(trim($s['email'])) ?></a>
            <h3 class="footer-follow-title">Follow Us</h3>
            <div class="footer-socials" aria-label="Social media links">
                <a class="facebook" href="<?= e($s['facebook'] ?? '#') ?>" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a><a class="instagram" href="<?= e($s['instagram'] ?? '#') ?>" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a><a class="youtube" href="<?= e($s['youtube'] ?? '#') ?>" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a><a class="x-twitter" href="<?= e($s['twitter'] ?? '#') ?>" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a><a class="pinterest" href="<?= e($s['pinterest'] ?? '#') ?>" aria-label="Pinterest"><i class="fa-brands fa-pinterest-p"></i></a><a class="linkedin" href="<?= e($s['linkedin'] ?? '#') ?>" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a><a class="whatsapp" href="https://wa.me/<?= e($whatsapp_number) ?>" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
    </div>
    <div class="container copyright">© <?= date('Y') ?> <?= e($s['clinic_name']) ?>. All rights reserved.</div>
</footer>
<div class="mobile-sticky-actions" aria-label="Quick actions">
    <a class="mobile-whatsapp-action" href="https://wa.me/<?= e($whatsapp_number) ?>" target="_blank" rel="noopener">
        <span aria-hidden="true">&#9742;</span> WhatsApp Doctor
    </a>
    <a class="mobile-appointment-action" href="appointment.php">
        <span aria-hidden="true">&#128197;</span> Book Appointment
    </a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/app.js"></script>
<script src="assets/js/main.js"></script>
<script>
    (function() {
        if (!document.querySelector('.admin-main')) return;
        const presets = [{
            value: 'all',
            label: 'All Data'
        }, {
            value: '7',
            label: 'Last 7 Days'
        }, {
            value: '15',
            label: 'Last 15 Days'
        }, {
            value: '30',
            label: 'Last 1 Month'
        }, {
            value: 'current',
            label: 'Current Month'
        }, {
            value: '90',
            label: 'Last 3 Months'
        }, {
            value: '180',
            label: 'Last 6 Months'
        }, {
            value: '365',
            label: 'Last Year'
        }, {
            value: 'custom',
            label: 'Custom Dates'
        }];
        const today = new Date();
        today.setHours(23, 59, 59, 999);
        const toDate = value => {
            const date = new Date(value);
            return Number.isNaN(date.getTime()) ? null : date;
        };
        const parseDate = text => {
            const match = String(text || '').match(/(\d{4})[-/]?(\d{2})[-/]?(\d{2})/);
            if (match) return new Date(+match[1], +match[2] - 1, +match[3]);
            const date = new Date(text);
            return Number.isNaN(date.getTime()) ? null : date;
        };
        document.querySelectorAll('.admin-main table').forEach(function(table) {
            if (table.dataset.dateFilterReady === 'true') return;
            const header = table.querySelector('tr th');
            if (!header) return;
            const headers = Array.from(table.querySelectorAll('tr:first-child th')).map(cell => cell.textContent.trim().toLowerCase());
            const dateIndex = headers.findIndex(label => /date|created|time/.test(label));
            if (dateIndex < 0) return;
            table.dataset.dateFilterReady = 'true';
            const rows = Array.from(table.querySelectorAll('tr')).slice(1).filter(row => row.cells.length > dateIndex && !row.id);
            const wrapper = document.createElement('div');
            wrapper.className = 'admin-date-filter';
            wrapper.innerHTML = '<label>Show <select class="date-preset">' + presets.map(item => '<option value="' + item.value + '">' + item.label + '</option>').join('') + '</select></label><label class="custom-date-field">From <input type="date" class="date-from"></label><label class="custom-date-field">To <input type="date" class="date-to"></label><button type="button" class="btn btn-sm btn-light date-clear">Reset</button>';
            table.parentNode.insertBefore(wrapper, table);
            const preset = wrapper.querySelector('.date-preset'),
                from = wrapper.querySelector('.date-from'),
                to = wrapper.querySelector('.date-to');
            const customFields = wrapper.querySelectorAll('.custom-date-field');

            function filter() {
                let start = new Date(today);
                start.setHours(0, 0, 0, 0);
                let end = new Date(today);
                if (preset.value === 'all') {
                    start = null;
                    end = null;
                } else if (preset.value === 'custom') {
                    start = toDate(from.value) || null;
                    end = toDate(to.value) || null;
                    if (end) end.setHours(23, 59, 59, 999);
                } else if (preset.value === 'current') {
                    start = new Date(today.getFullYear(), today.getMonth(), 1);
                } else {
                    start.setDate(start.getDate() - (Number(preset.value) - 1));
                }
                rows.forEach(row => {
                    const date = parseDate(row.cells[dateIndex].textContent);
                    row.style.display = !date || !start || !end || (date >= start && date <= end) ? '' : 'none';
                });
            }
            preset.addEventListener('change', function() {
                customFields.forEach(field => field.style.display = preset.value === 'custom' ? 'inline-flex' : 'none');
                filter();
            });
            from.addEventListener('change', filter);
            to.addEventListener('change', filter);
            wrapper.querySelector('.date-clear').addEventListener('click', function() {
                preset.value = 'all';
                from.value = '';
                to.value = '';
                customFields.forEach(field => field.style.display = 'none');
                filter();
            });
            customFields.forEach(field => field.style.display = 'none');
            filter();
        });
    })();
</script>
<div id="google_translate_element" aria-hidden="true"></div>
<script>
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,gu,hi',
            autoDisplay: false
        }, 'google_translate_element');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const languageSelect = document.getElementById('language-select');
        if (!languageSelect) return;

        const match = document.cookie.match(/(?:^|; )googtrans=([^;]+)/);
        const currentLanguage = match ? decodeURIComponent(match[1]).split('/').pop() : 'en';
        languageSelect.value = ['en', 'gu', 'hi'].includes(currentLanguage) ? currentLanguage : 'en';
        languageSelect.addEventListener('change', function() {
            const language = languageSelect.value;
            document.cookie = `googtrans=${language === 'en' ? '' : '/en/' + language};path=/;max-age=${language === 'en' ? 0 : 31536000}`;
            window.location.reload();
        });
    });
</script>
<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>

</html>