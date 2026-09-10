<?php require 'includes.php';
$s = settings();
$db = db_load();
$homeDoctors = array_values(array_filter($db['admins'] ?? [], fn($admin) => !empty($admin['is_doctor']) && !empty($admin['show_on_home'])));
$treatments = treatment_options();
$beforeAfterByTreatment = latest_by_treatment($db['before_after'] ?? []);
$testimonialVideosByTreatment = latest_by_treatment($db['testimonial_videos'] ?? []);
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
    <div class="container hero-grid" data-slider>
        <div class="hero-content">
            <div class="hero-copy is-active" data-slide-content>
                <div class="eyebrow"><?= e($s['clinic_name']) ?></div>
                <h1><?= e($s['hero_title']) ?></h1>
                <p><?= e($s['hero_text']) ?></p>
                <div class="hero-actions">
                    <a class="btn" href="appointment.php">Book Appointment</a>
                    <a class="btn btn-outline" href="treatments.php">Explore Treatments</a>
                </div>
            </div>
            <div class="hero-copy" data-slide-content>
                <div class="eyebrow">Personalized Care</div>
                <h1>Gentle Support for Better Health</h1>
                <p>Understand your health concerns with detailed consultation and a care plan designed around your needs.</p>
                <div class="hero-actions">
                    <a class="btn" href="appointment.php">Book Appointment</a>
                    <a class="btn btn-outline" href="about.php">Meet Our Doctor</a>
                </div>
            </div>
            <div class="hero-copy" data-slide-content>
                <div class="eyebrow">Holistic Treatment</div>
                <h1>Care for Chronic Health Concerns</h1>
                <p>Explore supportive homeopathic treatment for digestive health, lifestyle concerns and long-term wellness.</p>
                <div class="hero-actions">
                    <a class="btn" href="appointment.php">Book Appointment</a>
                    <a class="btn btn-outline" href="gastric-diseases.php">View Treatment</a>
                </div>
            </div>
            <div class="hero-copy" data-slide-content>
                <div class="eyebrow">Care for Every Age</div>
                <h1>Natural Care for Growing Families</h1>
                <p>Patient-first guidance for children and families with thoughtful follow-ups and personalized support.</p>
                <div class="hero-actions">
                    <a class="btn" href="appointment.php">Book Appointment</a>
                    <a class="btn btn-outline" href="childrens-problems.php">Child Care</a>
                </div>
            </div>
        </div>
        <button class="slider-arrow slider-prev" type="button" data-slider-prev aria-label="Previous image">&#10094;</button>
        <div class="hero-banner hero-slider">
            <div class="hero-slides">
                <img class="hero-slide is-active" src="assets/images/home/homeopaty.png" alt="Homeopathy clinic">
                <img class="hero-slide" src="assets/images/doctor.png" alt="Homeopathy doctor consultation">
                <img class="hero-slide" src="assets/images/treatments/gastric.jpg" alt="Digestive health care">
                <img class="hero-slide" src="assets/images/treatments/children.jpg" alt="Children's health care">
            </div>
        </div>
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
        <div class="holographic-card">
            <img class="about-img" src="assets/images/doctor.png" onerror="this.src='assets/images/logo.png'" alt="Doctor">
        </div>
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

<?php if ($homeDoctors): ?><section class="section">
        <div class="container">
            <div class="row text-center">
                <div class="eyebrow">Our Doctors</div>
                <h2 class="font-heading font-bold">Meet Our Homeopathic Doctors</h2>
            </div>
            <div class="doctor-card-grid"><?php foreach ($homeDoctors as $doctor): ?><article class="doctor-card">
                        <div class="doctor-card-photo"><?php if (!empty($doctor['photo'])): ?><img src="<?= e($doctor['photo']) ?>" alt="<?= e($doctor['name'] ?? 'Doctor') ?>"><?php else: ?><span><?= e(strtoupper(substr($doctor['name'] ?? 'D', 0, 1))) ?></span><?php endif; ?></div>
                        <h3><?= e($doctor['name'] ?? '') ?></h3>
                        <p class="doctor-card-designation"><?= e($doctor['designation'] ?? 'Homeopathic Doctor') ?></p>
                        <p><?= e($doctor['degree'] ?? '') ?></p>
                    </article><?php endforeach; ?></div>
        </div>
    </section><?php endif; ?>
<section class="section alt services-section">
    <div class="container">
        <div class="row text-center">
            <div class="eyebrow">Our Treatment</div>
            <h2 class="font-heading font-bold">Evidence Based Homeopathic Treatments</h2>
            <p style="color:var(--muted)">Explore Our Special Treatments for Long-Term & Serious Health Problems in Surat
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
                        Emotional problems, ongoing stress, mood changes & anxiety can affect your daily life. Our homeopathic treatment helps us understand the main cause of your problem and supports better emotional health for the long term.
                    </p>
                    <div class="service-actions">
                        <a class="btn" href="mental-diseases.php">View Service</a>
                        <a class="btn btn-appointment" href="appointment.php">Book Appointment</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/gastric-diseases.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Gastric Diseases</h3>
                    <p>
                        Stomach & digestive problems can affect how you feel every day. They may cause discomfort, low energy & problems with sleep or your daily routine. We understand your symptoms, food habits, lifestyle & overall health to provide treatment that suits your needs.

                    </p>
                    <div class="service-actions">
                        <a class="btn" href="gastric-diseases.php">View Service</a>
                        <a class="btn btn-appointment" href="appointment.php">Book Appointment</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/skin-diseases.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Skin Diseases</h3>
                    <p>
                        Healthy skin is important for feeling good & confident. Skin problems can be linked to many things, including your lifestyle & overall health. We understand your skin problems, possible triggers, lifestyle, medical history & overall health to provide treatment that suits your needs.

                    </p>
                    <div class="service-actions">
                        <a class="btn" href="skin-diseases.php">View Service</a>
                        <a class="btn btn-appointment" href="appointment.php">Book Appointment</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/gynaecological-problems.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Gynaecological Problems</h3>
                    <p>
                        Women’s health problems can affect your body, emotions, relationships & daily life. We understand your symptoms, periods, hormone changes, lifestyle & overall health to provide treatment that suits your needs.
                    </p>
                    <div class="service-actions">
                        <a class="btn" href="gynaecological-problems.php">View Service</a>
                        <a class="btn btn-appointment" href="appointment.php">Book Appointment</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/neurological-disorders.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Neurological Disorders</h3>
                    <p>
                        Nervous system problems can affect your movement, comfort, sleep, focus & daily life. We understand your symptoms, possible causes, medical history, lifestyle & overall health to provide treatment that suits your needs.
                    </p>
                    <div class="service-actions">
                        <a class="btn" href="neurological-disorders.php">View Service</a>
                        <a class="btn btn-appointment" href="appointment.php">Book Appointment</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/autoimmune-disorders.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Autoimmune Disorders</h3>
                    <p>
                        Autoimmune problems can affect different parts of your body & may change over time. We understand your symptoms, medical history, lifestyle, test reports & overall health to provide treatment that suits your needs.
                    </p>
                    <div class="service-actions">
                        <a class="btn" href="autoimmune-disorders.php">View Service</a>
                        <a class="btn btn-appointment" href="appointment.php">Book Appointment</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/bone-joint-diseases.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Bone & Joint Diseases</h3>
                    <p>
                        Bone, joint & muscle problems can make it difficult to move, work, sleep & feel comfortable. We understand your symptoms, movement problems, medical history, lifestyle & overall health to provide treatment that suits your needs.
                    </p>
                    <div class="service-actions">
                        <a class="btn" href="bone-joint-diseases.php">View Service</a>
                        <a class="btn btn-appointment" href="appointment.php">Book Appointment</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/respiratory-problems.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Respiratory Diseases</h3>
                    <p>
                        Breathing problems can affect your energy, sleep, work & daily comfort. We understand your symptoms, possible causes, medical history, lifestyle & overall health to provide treatment that suits your needs.
                    </p>
                    <div class="service-actions">
                        <a class="btn" href="respiratory-problems.php">View Service</a>
                        <a class="btn btn-appointment" href="appointment.php">Book Appointment</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/childrens-problems.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Children's Diseases</h3>
                    <p>
                        Children need special care for their age, growth, emotions & daily routine. We understand their symptoms, growth, habits, family history & overall health to provide treatment that suits their needs.
                    </p>
                    <div class="service-actions">
                        <a class="btn" href="childrens-problems.php">View Service</a>
                        <a class="btn btn-appointment" href="appointment.php">Book Appointment</a>
                    </div>
                </div>
            </div>
        </div>
</section>
<section class="section">
    <div class="container">
        <div class="stats">
            <div class="stat">
                <svg class="stat-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="9" cy="8" r="3" />
                    <path d="M3 20c.5-4 2.5-6 6-6s5.5 2 6 6" />
                    <path d="M16 5a3 3 0 0 1 0 6M17 14c2.5.5 3.5 2.5 4 6" />
                </svg>
                <strong>1000+</strong>
                <span>Patient Records</span>
            </div>
            <div class="stat"><svg class="stat-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="8" />
                    <path d="M12 7v5l3 2" />
                </svg>
                <strong>12+</strong>
                <span>Years Experience</span>
            </div>
            <div class="stat">
                <svg class="stat-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="8" />
                    <path d="M12 8v8M8 12h8" />
                </svg>
                <strong>1:1</strong>
                <span>Personalized Care</span>
            </div>
        </div>
    </div>
</section>

<?php if ($beforeAfterByTreatment): ?>
    <section class="section before-after-section" aria-labelledby="before-after-title">
        <div class="container">
            <div class="section-head result-section-head">
                <div>
                    <div class="eyebrow">Patient Results</div>
                    <h2>Before &amp; After</h2>
                </div><a class="btn btn-outline" href="before-after.php">View All</a>
            </div>
            <div class="before-after-grid">
                <?php foreach ($beforeAfterByTreatment as $treatment => $item): ?>
                    <article class="before-after-card col-12 col-md-6 col-lg-4">
                        <div class="before-after-compare" data-before-after>
                            <div class="before-after-image"><img src="<?= e($item['after_image']) ?>" alt="<?= e($item['title']) ?> after"></div>
                            <div class="before-after-image before-after-before"><img src="<?= e($item['before_image']) ?>" alt="<?= e($item['title']) ?> before"></div>
                            <span class="before-after-label before-label">Before</span><span class="before-after-label after-label">After</span>
                            <span class="before-after-handle" aria-hidden="true">&#10094; &#10095;</span>
                            <input class="before-after-range" type="range" min="0" max="100" value="50" aria-label="Compare before and after images">
                        </div>
                        <div class="result-media-body"><small><?= e($treatments[$treatment] ?? $treatment) ?></small>
                            <h3><?= e($item['title']) ?></h3>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ($testimonialVideosByTreatment): ?>
    <section class="section testimonial-reels-section">
        <div class="container">
            <div class="section-head result-section-head">
                <div>
                    <div class="eyebrow">Patient Stories</div>
                    <h2>Testimonial Reels</h2>
                </div><a class="btn btn-outline" href="testimonial-videos.php">View All</a>
            </div>
            <div class="testimonial-reel-slider" data-reel-slider>
                <div class="testimonial-reel-track"><?php foreach ($testimonialVideosByTreatment as $treatment => $item): ?><article class="testimonial-video-card"><button class="testimonial-video-trigger" type="button" data-video-src="<?= e($item['video']) ?>" data-video-title="<?= e($item['title']) ?>"><video src="<?= e($item['video']) ?>" muted loop autoplay playsinline preload="metadata"></video><span class="testimonial-play" aria-hidden="true">&#9654;</span></button>
                            <div class="result-media-body"><small><?= e($treatments[$treatment] ?? $treatment) ?></small>
                                <h3><?= e($item['title']) ?></h3>
                            </div>
                        </article><?php endforeach; ?></div>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Latest Updates From Our Clinic</div>
            <h2>Health Tips & Updates</h2>
        </div>
        <div class="blog-grid"><?php $blogs = array_slice(array_reverse($db['blogs']), 0, 3);
                                if (!$blogs): ?><div class="card" style="grid-column:1/-1">
                    <div class="empty">New health articles & updates will appear here when the doctor adds them..</div>
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
                <div class="eyebrow">Ready to Start Your Treatment?</div>
                <h2 style="margin:5px 0">Book Your Appointment</h2>
                <p style="margin:0;color:var(--muted)">Choose a date & time that is convenient for you.</p>
            </div><a class="btn" href="appointment.php">Book Appointment</a>
        </div>
    </div>
</section>
<?php require 'footer.php'; ?>