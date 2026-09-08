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
          <a href="<?= e(url('testimonial-videos.php')) ?>">Testimonial Videos</a>
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
<div class="booking-modal" id="bookingModal" aria-hidden="true">
  <div class="booking-modal-backdrop" data-booking-close></div>
  <div class="booking-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="bookingModalTitle">
    <button class="booking-modal-close" type="button" data-booking-close aria-label="Close booking form">&times;</button>
    <div class="booking-modal-content">
      <p class="eyebrow">Personalized care</p>
      <h2 id="bookingModalTitle">Book an Appointment</h2>
      <p>Share your details and our clinic will contact you to confirm your appointment.</p>
      <form method="post" action="<?= e(url('appointment.php')) ?>">
        <div class="booking-modal-grid">
          <div class="field"><label for="bookingName">Patient Name *</label><input id="bookingName" required name="name"></div>
          <div class="field"><label for="bookingAge">Age</label><input id="bookingAge" name="age" inputmode="numeric" min="0"></div>
          <div class="field"><label for="bookingMobile">Mobile Number *</label><input id="bookingMobile" required name="mobile" inputmode="numeric" pattern="[0-9+ ]{8,15}"></div>
          <div class="field"><label for="bookingEmail">Email</label><input id="bookingEmail" type="email" name="email"></div>
          <div class="field booking-modal-full"><label for="bookingMessage">Message / Reason for Visit</label><textarea id="bookingMessage" name="message" rows="3"></textarea></div>
        </div>
        <button class="btn" type="submit">Request Appointment</button>
      </form>
    </div>
  </div>
</div>
<script src="<?= e(url('assets/js/main.js')) ?>"></script>
<script src="<?= e(url('assets/js/booking-popup.js')) ?>"></script>
<script src="<?= e(url('assets/js/file-preview.js')) ?>"></script>
</body>
</html>
