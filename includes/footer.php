</main>
<footer class="site-footer">
  <div class="container">
    <div class="footer-shell">
      <div class="footer-grid">
        <div class="footer-intro">
          <a class="brand footer-brand" href="<?= e(url('index.php')) ?>"><img src="<?= e(url('assets/images/janani-homeopathy-logo.png')) ?>" alt="<?= e(setting('site_name')) ?>"></a>
          <p><?= e(setting('footer_text', 'Personalized homeopathic care with a patient-first approach for your long-term wellness.')) ?></p>
        </div>
        <div>
          <h3>Quick Links</h3>
          <a href="<?= e(url('index.php')) ?>">Home</a>
          <a href="<?= e(url('about.php')) ?>">About Us</a>
          <a href="<?= e(url('services.php')) ?>">Homeopathy Treatments</a>
          <a href="<?= e(url('reviews.php')) ?>">Reviews</a>
          <a href="<?= e(url('gallery.php')) ?>">Gallery</a>
          <a href="<?= e(url('blog.php')) ?>">Blog</a>
          <a href="<?= e(url('contact.php')) ?>">Contact Us</a>
        </div>
        <div>
          <h3>Homeopathy Treatments</h3>
          <a href="<?= e(url('childrens-problems.php')) ?>">Children's Problems</a>
          <a href="<?= e(url('mental-diseases.php')) ?>">Mental Diseases</a>
          <a href="<?= e(url('skin-diseases.php')) ?>">Skin Diseases</a>
          <a href="<?= e(url('respiratory-problems.php')) ?>">Respiratory Problems</a>
          <a href="<?= e(url('gynaecological-problems.php')) ?>">Gynaecological Problems</a>
          <a href="<?= e(url('bone-joint-diseases.php')) ?>">Bone &amp; Joint Diseases</a>
        </div>
        <div class="footer-contact">
          <h3>Contact Us</h3>
          <?php if (setting('address')): ?><p><span class="footer-contact-icon" aria-hidden="true">⌖</span><?= e(setting('address')) ?></p><?php endif; ?>
          <?php if (setting('phone')): ?><a href="tel:<?= e(preg_replace('/[^0-9+]/', '', setting('phone'))) ?>"><span class="footer-contact-icon" aria-hidden="true">☎</span><?= e(setting('phone')) ?></a><?php endif; ?>
          <?php if (setting('email')): ?><a href="mailto:<?= e(trim(setting('email'))) ?>"><span class="footer-contact-icon" aria-hidden="true">✉</span><?= e(trim(setting('email'))) ?></a><?php endif; ?>
          <h3 class="footer-follow-title">Follow Us</h3>
          <div class="footer-socials">
            <a href="mailto:<?= e(trim(setting('email'))) ?>" aria-label="Email us">✉</a>
            <?php if (setting('linkedin')): ?><a href="<?= e(setting('linkedin')) ?>" target="_blank" rel="noopener" aria-label="LinkedIn">in</a><?php endif; ?>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <span>© <?= date('Y') ?> <?= e(setting('site_name')) ?>. All rights reserved.</span>
        <span>Designed for clarity • Built for SEO</span>
      </div>
    </div>
  </div>
</footer>
<script src="<?= e(url('assets/js/main.js')) ?>"></script>
</body>
</html>
