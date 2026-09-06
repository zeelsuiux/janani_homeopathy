<?php $s = settings(); ?><footer class="footer">
    <div class="container footer-grid">
        <div><img class="logo" src="assets/images/logo.png" alt="logo" style="background:#fff;padding:5px;border-radius:8px">
            <p><?= e($s['tagline']) ?></p>
        </div>
        <div>
            <h3>Quick Links</h3><a href="about.php">About Us</a><a href="treatments.php">Treatments</a><a href="gallery.php">Gallery</a><a href="blog.php">Blog</a><a href="contact.php">Contact</a>
        </div>
        <div>
            <h3>Contact</h3>
            <p><?= e($s['address']) ?></p>
            <p><?= e($s['phone']) ?></p>
            <p><?= e($s['email']) ?></p>
        </div>
    </div>
    <div class="container copyright">© <?= date('Y') ?> <?= e($s['clinic_name']) ?>. All rights reserved.</div>
 </footer>
<?php $whatsapp_number = preg_replace('/\D+/', '', explode('/', $s['phone'])[0]); ?>
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
<div id="google_translate_element" aria-hidden="true"></div>
<script>
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,gu,hi',
            autoDisplay: false
        }, 'google_translate_element');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const languageSelect = document.getElementById('language-select');
        if (!languageSelect) return;

        const match = document.cookie.match(/(?:^|; )googtrans=([^;]+)/);
        const currentLanguage = match ? decodeURIComponent(match[1]).split('/').pop() : 'en';
        languageSelect.value = ['en', 'gu', 'hi'].includes(currentLanguage) ? currentLanguage : 'en';
        languageSelect.addEventListener('change', function () {
            const language = languageSelect.value;
            document.cookie = `googtrans=${language === 'en' ? '' : '/en/' + language};path=/;max-age=${language === 'en' ? 0 : 31536000}`;
            window.location.reload();
        });
    });
</script>
<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>

</html>