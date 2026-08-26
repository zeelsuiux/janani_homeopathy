<?php require 'includes.php';
$s = settings();
$db = db_load();
$page_title = $s['clinic_name'];
require 'header.php'; ?>

<?php
function service_icon(string $name): string
{
    $paths = [
        'skin' => '<path d="M12 3c-2 3-6 5-6 9a6 6 0 0 0 12 0c0-4-4-6-6-9Z"/><path d="M9 14c1.5.8 2.5.8 4 0"/>',
        'respiratory' => '<path d="M12 4v16"/><path d="M12 10c-2-3-6-3-7 1l-1 5c-.4 2 1 4 3 4 3 0 5-3 5-7"/><path d="M12 10c2-3 6-3 7 1l1 5c.4 2-1 4-3 4-3 0-5-3-5-7"/>',
        'digestive' => '<path d="M9 4v4c0 2 1 3 3 3s3-1 3-3V4"/><path d="M9 4H7a2 2 0 0 0-2 2v2c0 2 1 3 3 3h1"/><path d="M15 4h2a2 2 0 0 1 2 2v2c0 2-1 3-3 3h-1"/><path d="M12 11v3c0 3 2 4 2 6"/>',
        'joint' => '<circle cx="8" cy="8" r="3"/><circle cx="16" cy="16" r="3"/><path d="m10 10 4 4"/><path d="m5 19 3-3M19 5l-3 3"/>',
        'child' => '<circle cx="12" cy="7" r="3"/><path d="M6 21c.5-4 2.5-6 6-6s5.5 2 6 6"/><path d="M8 13h8"/>',
        'women' => '<circle cx="12" cy="8" r="4"/><path d="M12 12v8M9 17h6"/>',
        'neurological' => '<path d="M9 4a3 3 0 0 0-3 3 3 3 0 0 0-2 5 3 3 0 0 0 2 5 3 3 0 0 0 5 2 3 3 0 0 0 5-2 3 3 0 0 0 2-5 3 3 0 0 0-2-5 3 3 0 0 0-3-3Z"/><path d="M12 5v14M8 9h4M12 13h4"/>',
        'autoimmune' => '<path d="M12 21s8-4 8-10V5l-8-3-8 3v6c0 6 8 10 8 10Z"/><path d="M12 8v6M9 11h6"/>'
    ];
    return '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">' . ($paths[$name] ?? $paths['skin']) . '</svg>';
}
?>

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
        <div><img class="about-img" src="assets/images/doctor.png" onerror="this.src='assets/images/logo.png'" alt="Doctor"></div>
        <div>
            <div class="eyebrow">Best Homeopathy Clinic in Surat</div>
            <h1 class="poppins-bold">Janani Homeopathy</h1>
            <h3><?= e($s['qualification']) ?></h3>
            <p>We focus on understanding each patient's individual needs and providing a structured, personalized approach to homeopathic care. The clinic experience is designed around comfort, continuity and easy follow-up.</p><a class="btn" href="about.php">Know More</a>
        </div>
    </div>
</section>
<section class="section alt services-section">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Our Services</div>
            <h2>Services Designed Around You</h2>
            <p>Personalized homeopathic services for your health, comfort, and long-term wellbeing.</p>
        </div>
        <?php $services = [
            ['title' => 'Skin Care', 'text' => 'Personalized support for skin, scalp, and hair concerns.', 'icon' => 'skin', 'link' => 'skin-diseases.php'],
            ['title' => 'Respiratory Care', 'text' => 'Care for allergies, asthma, sinus, cough, and breathing concerns.', 'icon' => 'respiratory', 'link' => 'respiratory-problems.php'],
            ['title' => 'Digestive Health', 'text' => 'Support for acidity, digestion, constipation, and gastric problems.', 'icon' => 'digestive', 'link' => 'gastric-diseases.php'],
            ['title' => 'Bone & Joint Care', 'text' => 'Support for joint pain, stiffness, back pain, and mobility concerns.', 'icon' => 'joint', 'link' => 'bone-joint-diseases.php'],
            ['title' => 'Child Care', 'text' => 'Gentle care for common childhood health and wellbeing concerns.', 'icon' => 'child', 'link' => 'childrens-problems.php'],
            ['title' => "Women's Health", 'text' => 'Private support for menstrual, hormonal, and gynaecological concerns.', 'icon' => 'women', 'link' => 'gynaecological-problems.php'],
            ['title' => 'Neurological Care', 'text' => 'Personalized support for headache, nerve, balance, and sleep concerns.', 'icon' => 'neurological', 'link' => 'neurological-disorders.php'],
            ['title' => 'Autoimmune Care', 'text' => 'Supportive care for thyroid, joint, skin, and immune-related concerns.', 'icon' => 'autoimmune', 'link' => 'autoimmune-disorders.php']
        ]; ?>
        <div class="cards services-grid"><?php foreach ($services as $service): ?><div class="card">
                    <div class="icon service-icon"><?= service_icon($service['icon']) ?></div>
                    <h3><?= e($service['title']) ?></h3>
                    <p class="service-description"><?= e($service['text']) ?></p>
                    <a class="btn btn-sm" style="margin-top:15px" href="<?= e($service['link']) ?>">View Service</a>
                </div><?php endforeach; ?></div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="stats">
            <div class="stat"><svg class="stat-icon" viewBox="0 0 24 24" aria-hidden="true"><circle cx="9" cy="8" r="3"/><path d="M3 20c.5-4 2.5-6 6-6s5.5 2 6 6"/><path d="M16 5a3 3 0 0 1 0 6M17 14c2.5.5 3.5 2.5 4 6"/></svg><strong>1000+</strong><span>Patient Records</span></div>
            <div class="stat"><svg class="stat-icon" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="8"/><path d="M12 7v5l3 2"/></svg><strong>10+</strong><span>Years Experience</span></div>
            <div class="stat"><svg class="stat-icon" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="8"/><path d="M12 8v8M8 12h8"/></svg><strong>1:1</strong><span>Personalized Care</span></div>
            <div class="stat"><svg class="stat-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5h16v14H4z"/><path d="M8 9h8M8 13h5"/><circle cx="17" cy="17" r="3"/></svg><strong>24/7</strong><span>Inquiry Access</span></div>
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