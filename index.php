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
    <div class="hero-banner hero-slider" data-slider>
        <div class="hero-slides">
            <img class="hero-slide is-active" src="assets/images/home/homeopaty.png" alt="Homeopathy clinic">
            <img class="hero-slide" src="assets/images/doctor.png" alt="Homeopathy doctor consultation">
            <img class="hero-slide" src="assets/images/treatments/gastric.jpg" alt="Digestive health care">
            <img class="hero-slide" src="assets/images/treatments/children.jpg" alt="Children's health care">
        </div>
        <button class="slider-arrow slider-prev" type="button" data-slider-prev aria-label="Previous image">&#10094;</button>
        <button class="slider-arrow slider-next" type="button" data-slider-next aria-label="Next image">&#10095;</button>
        <div class="slider-dots" aria-label="Slider navigation">
            <button class="slider-dot is-active" type="button" data-slide-to="0" aria-label="Show image 1"></button>
            <button class="slider-dot" type="button" data-slide-to="1" aria-label="Show image 2"></button>
            <button class="slider-dot" type="button" data-slide-to="2" aria-label="Show image 3"></button>
            <button class="slider-dot" type="button" data-slide-to="3" aria-label="Show image 4"></button>
        </div>
    </div>
</section>
<section class="section">
    <div class="container about-grid">
        <div><img class="about-img" src="assets/images/doctor.png" onerror="this.src='assets/images/logo.png'" alt="Doctor"></div>
        <div>
            <div class="designation-tag" style="width:fit-content">
                <div class="px-3 py-1 d-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-graduation-cap w-4 h-4 text-[]" aria-hidden="true">
                        <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"></path>
                        <path d="M22 10v6"></path>
                        <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"></path>
                    </svg>
                    <p class="m-0 ms-2" style="color: var(--primary);">Founder & Chief Physician</p>
                </div>
            </div>
            <h2 class="my-4 font-heading font-bold">
                Dr. Chirag Patel
            </h2>
            <div class="d-flex">
                <p class="px-2">
                    <span class="me-1">
                        <svg aria-hidden="true" width="18" height="18" class="e-font-icon-svg e-fas-check-circle" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="var(--primary)">
                            <path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
                        </svg> </span>BHMS
                </p>
                <p class="px-2">
                    <span class="me-1">
                        <svg aria-hidden="true" width="18" height="18" class="e-font-icon-svg e-fas-check-circle" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="var(--primary)">
                            <path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
                        </svg>
                    </span>
                    CCPH
                </p>
                <p class="px-2">
                    <span class="me-1">
                        <svg aria-hidden="true" width="18" height="18" class="e-font-icon-svg e-fas-check-circle" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="var(--primary)">
                            <path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
                        </svg>
                    </span>
                    SCPH
                </p>
                <p class="px-2">
                    <span class="me-1">
                        <svg aria-hidden="true" width="18" height="18" class="e-font-icon-svg e-fas-check-circle" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="var(--primary)">
                            <path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
                        </svg>
                    </span>
                    Consulting Homoeopath
                </p>
            </div>
            <div class="font-regular-italic" style="color:var(--muted)">
                <p>Dr. Chirag Patel is a <b>dedicated and experienced Homeopathic Doctor</b> practicing in <b>Surat</b>. With <b>over a decade of clinical experience</b>, he is committed to providing <b>personalized and holistic homoeopathic care</b>.</p>
                <p>
                    He completed his <b>BHMS</b> and has further enhanced his expertise through specialized training in Predictive Homoeopathy. Dr. Patel believes in <b>detailed case evaluation and regular follow-ups</b> to provide individualized care for every patient.
                </p>
            </div>
        </div>
    </div>
</section>
<section class="section alt services-section">
    <div class="container">
        <div class="row text-center">
            <div class="eyebrow">Our Treatment</div>
            <h2 class="font-heading font-bold">Evidence Based Homeopathic Treatments</h2>
            <p style="color:var(--muted)">Explore our specialized treatment programs for chronic and complex health conditions in Surat
            </p>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/mental-diseases.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Mental Diseases</h3>
                    <p>
                        Emotional imbalance, persistent stress, mood swings, and anxiety can deeply aff...
                    </p>
                    <a class="btn" style="margin-top:15px" href="<?= e($service['link']) ?>">View Service</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/gastric-diseases.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Gastric Diseases</h3>
                    <p>
                        Digestive problems can affect comfort, energy, sleep, and daily routine.
                    </p>
                    <a class="btn" style="margin-top:15px" href="<?= e($service['link']) ?>">View Service</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/skin-diseases.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Skin Diseases</h3>
                    <p>
                        Healthy skin reflects the well-being of the whole person.
                    </p>
                    <a class="btn" style="margin-top:15px" href="<?= e($service['link']) ?>">View Service</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/gynaecological-problems.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Gynaecological Problems</h3>
                    <p>
                        Women's health concerns can affect the body, emotions, relationships, and daily life.
                    </p>
                    <a class="btn" style="margin-top:15px" href="<?= e($service['link']) ?>">View Service</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/neurological-disorders.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Neurological Disorders</h3>
                    <p>
                        Nervous system concerns can affect movement, comfort, sleep, focus, and d...
                    </p>
                    <a class="btn" style="margin-top:15px" href="<?= e($service['link']) ?>">View Service</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/autoimmune-disorders.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Autoimmune Disorders</h3>
                    <p>
                        Autoimmune conditions can affect different parts of the body and may change over ...
                    </p>
                    <a class="btn" style="margin-top:15px" href="<?= e($service['link']) ?>">View Service</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/bone-joint-diseases.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Bone & Joint Diseases</h3>
                    <p>
                        Bone, joint, and muscle concerns can affect movement, comfort, work, and sleep
                    </p>
                    <a class="btn" style="margin-top:15px" href="<?= e($service['link']) ?>">View Service</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/respiratory-problems.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Respiratory Problems</h3>
                    <p>
                        Breathing and respiratory concerns can affect energy, sleep, work, & daily comfort.
                    </p>
                    <a class="btn" style="margin-top:15px" href="<?= e($service['link']) ?>">View Service</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/childrens-problems.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Children's Problems</h3>
                    <p>
                        childhood health concerns can affect growth, development, comfort, and daily life.
                    </p>
                    <a class="btn" style="margin-top:15px" href="<?= e($service['link']) ?>">View Service</a>
                </div>
            </div>

        </div>
</section>
<section class="section">
    <div class="container">
        <div class="stats">
            <div class="stat"><svg class="stat-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="9" cy="8" r="3" />
                    <path d="M3 20c.5-4 2.5-6 6-6s5.5 2 6 6" />
                    <path d="M16 5a3 3 0 0 1 0 6M17 14c2.5.5 3.5 2.5 4 6" />
                </svg><strong>1000+</strong><span>Patient Records</span></div>
            <div class="stat"><svg class="stat-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="8" />
                    <path d="M12 7v5l3 2" />
                </svg><strong>10+</strong><span>Years Experience</span></div>
            <div class="stat"><svg class="stat-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="8" />
                    <path d="M12 8v8M8 12h8" />
                </svg><strong>1:1</strong><span>Personalized Care</span></div>
            <div class="stat"><svg class="stat-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M4 5h16v14H4z" />
                    <path d="M8 9h8M8 13h5" />
                    <circle cx="17" cy="17" r="3" />
                </svg><strong>24/7</strong><span>Inquiry Access</span></div>
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