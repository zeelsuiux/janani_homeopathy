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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/app.js"></script>
<script src="assets/js/main.js"></script>
</body>

</html>