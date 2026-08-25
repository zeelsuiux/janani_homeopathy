</main>
<footer class="site-footer">
  <div class="container footer-grid">
    <div>
      <a class="brand footer-brand" href="<?= e(url('index.php')) ?>"><img src="<?= e(url('assets/images/janani-homeopathy-logo.png')) ?>" alt="<?= e(setting('site_name')) ?>"></a>
      <p><?= e(setting('footer_text')) ?></p>
    </div>
    <div>
      <h3>Explore</h3>
      <a href="<?= e(url('about.php')) ?>">About Us</a>
      <a href="<?= e(url('services.php')) ?>">Services</a>
      <a href="<?= e(url('blogs.php')) ?>">Health Blog</a>
      <a href="<?= e(url('contact.php')) ?>">Contact</a>
    </div>
    <div>
      <h3>Contact</h3>
      <p><?= e(setting('city')) ?></p>
      <?php if (setting('phone')): ?><a href="tel:<?= e(setting('phone')) ?>"><?= e(setting('phone')) ?></a><?php endif; ?>
      <?php if (setting('email')): ?><a href="mailto:<?= e(setting('email')) ?>"><?= e(setting('email')) ?></a><?php endif; ?>
      <?php if (setting('linkedin')): ?><a href="<?= e(setting('linkedin')) ?>" target="_blank" rel="noopener">Doctor's LinkedIn ↗</a><?php endif; ?>
    </div>
  </div>
  <div class="container footer-bottom">
    <span>© <?= date('Y') ?> <?= e(setting('site_name')) ?>. All rights reserved.</span>
    <span>Designed for clarity • Built for SEO</span>
  </div>
</footer>
<script src="<?= e(url('assets/js/main.js')) ?>"></script>
</body>
</html>
