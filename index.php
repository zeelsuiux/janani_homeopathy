<?php require 'includes.php';
$s = settings();
$db = db_load();
$page_title = $s['clinic_name'];
require 'header.php'; ?>

<section class="hero">
    <div class="container hero-grid">
        <div>
            <div class="eyebrow">Personalized Homeopathic Care</div>
            <h1><?= e($s['hero_title']) ?></h1>
            <p><?= e($s['hero_text']) ?></p>
            <div class="actions"><a class="btn" href="appointment.php">Book an Appointment</a><a class="btn btn-outline" href="contact.php">Contact Clinic</a></div>
        </div>
        <div class="hero-card"><img src="assets/images/home/homeopaty.png" onerror="this.src='assets/images/logo.png'" alt="Homeopathy clinic"></div>
    </div>
</section>
<section class="section">
    <div class="container about-grid">
        <div><img class="about-img" src="assets/images/doctor.jpg" onerror="this.src='assets/images/logo.png'" alt="Doctor"></div>
        <div>
            <div class="eyebrow">Best Homeopathy Clinic in Surat</div>
            <h1 class="poppins-bold">Janani Homeopathy</h1>
            <h3><?= e($s['qualification']) ?></h3>
            <p>We focus on understanding each patient's individual needs and providing a structured, personalized approach to homeopathic care. The clinic experience is designed around comfort, continuity and easy follow-up.</p><a class="btn" href="about.php">Know More</a>
        </div>
    </div>
</section>
<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Our Treatment Areas</div>
            <h2>Care Designed Around You</h2>
            <p>Explore the key areas where our clinic provides personalized homeopathic consultation.</p>
        </div>
        <div class="cards"><?php foreach (['Skin Care', 'Respiratory Care', 'Digestive Health', 'Joint & Lifestyle Care', 'Child Care', 'Women’s Wellness', 'Men’s Wellness', 'Chronic Care'] as $i => $t): ?><div class="card">
                    <div class="icon">✚</div>
                    <h3><?= e($t) ?></h3>
                    <p>Personalized consultation and follow-up based on your individual health journey.</p>
                </div><?php endforeach; ?></div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="stats">
            <div class="stat"><strong>1000+</strong><span>Patient Records</span></div>
            <div class="stat"><strong>10+</strong><span>Years Experience</span></div>
            <div class="stat"><strong>1:1</strong><span>Personalized Care</span></div>
            <div class="stat"><strong>24/7</strong><span>Inquiry Access</span></div>
        </div>
    </div>
</section>
<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Latest From Our Clinic</div>
            <h2>Health Articles & Updates</h2>
        </div>
        <div class="blog-grid"><?php $blogs = array_slice(array_reverse($db['blogs']), 0, 3);
                                if (!$blogs): ?><div class="card" style="grid-column:1/-1">
                    <div class="empty">Blogs will appear here after the doctor adds them from the admin panel.</div>
                </div><?php else: foreach ($blogs as $b): ?><article class="blog-card"><img src="<?= e($b['image'] ?: 'assets/images/logo.png') ?>" alt="<?= e($b['title']) ?>">
                        <div class="blog-body"><small><?= e(date_fmt($b['created_at'])) ?></small>
                            <h3><?= e($b['title']) ?></h3>
                            <p><?= e(substr(strip_tags($b['content']), 0, 130)) ?>...</p><a class="btn btn-sm" href="blog-detail.php?id=<?= e($b['id']) ?>">Read More</a>
                        </div>
                    </article><?php endforeach;
                                endif; ?></div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="form-card" style="display:flex;justify-content:space-between;align-items:center;gap:20px;flex-wrap:wrap">
            <div>
                <div class="eyebrow">Ready to Begin?</div>
                <h2 style="margin:5px 0">Book Your Consultation</h2>
                <p style="margin:0;color:var(--muted)">Choose a convenient date and time for your appointment.</p>
            </div><a class="btn" href="appointment.php">Book Appointment</a>
        </div>
    </div>
</section>
<?php require 'footer.php'; ?>