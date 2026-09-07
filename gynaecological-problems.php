<?php require 'includes.php';
$s = settings();
$page_title = 'Gynaecological Problems | ' . $s['clinic_name'];
require 'header.php';
$conditions = [
    ['PCOD / PCOS', 'We provide personalized homeopathic treatment for PCOD & PCOS to help with hormone imbalance, irregular periods, acne & other related problems..'],
    ['Irregular Periods', 'Homeopathy care for delayed, early, missed & irregular periods.'],
    ['Painful Periods', 'Homeopathy care for period cramps, pelvic pain, back pain & other period problems.'],
    ['Excessive Bleeding', 'Support for very heavy, long-lasting or frequent periods.'],
    ['Leucorrhoea', 'Homeopathy care for unusual vaginal discharge, irritation & discomfort.'],
    ['Endometriosis', 'Personalized homeopathy care for pelvic pain, painful periods & other related problems.'],
    ['Menopausal Complaints', 'Support for hot flashes, mood changes, sleep problems & other menopause symptoms.'],
    ['Infertility Support', 'Personalized support for couples by understanding period health, hormone changes, lifestyle & overall health.']
];
?>

<section class="treatment-hero">
    <div class="container treatment-hero-grid">
        <div>
            <div class="eyebrow">Women’s Homeopathy Care</div>
            <h1>Gynaecological Problems</h1>
            <p>Women’s health problems can affect your body, emotions, relationships & daily life. At our Homeopathy Clinic in Surat, we understand your symptoms, periods, hormone changes, lifestyle & overall health to provide personalized homeopathic treatment for your needs.</p>
            <div class="actions">
                <a class="btn" href="appointment.php">Book Consultation</a>
                <a class="btn btn-outline" href="contact.php">Consult Doctor</a>
            </div>
        </div>
        <div class="treatment-visual">
            <img src="assets/images/treatments/gynaecological-problems.png" onerror="this.src='assets/images/doctor.png'" alt="Women's health care">
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Women&apos;s Health Care</div>
            <h2>Problems We Help With</h2>
            <p>We provide personalized homeopathy care for period problems, hormone changes, reproductive health & menopause-related concerns.</p>
        </div>
        <div class="feature-list">
            <?php foreach ($conditions as $conditionIndex => $condition): ?>
                <div class="feature-card">
                    <div class="icon treatment-icon"><?= treatment_icon($condition[0], $conditionIndex) ?></div>
                    <h3><?= e($condition[0]) ?></h3>
                    <p><?= e($condition[1]) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Symptoms & Health Concerns</div>
            <h2>Problems You Can Discuss With Our Doctor</h2>
        </div>
        <div class="two-col-grid">
            <div class="info-panel">
                <h2>Common problems include:</h2>
                <ul class="check-list">
                    <li>Irregular, delayed, missed or painful periods</li>
                    <li>Heavy or long-lasting periods</li>
                    <li>Pelvic pain, cramps or lower back pain</li>
                    <li>Unusual vaginal discharge or irritation</li>
                    <li>Hot flashes, mood changes or sleep problems</li>
                    <li>Acne, unwanted hair growth or hair thinning</li>
                </ul>
            </div>
            <div class="info-panel">
                <h2>Possible reasons for these problems:</h2>
                <ul class="check-list">
                    <li>Hormone changes or PCOD / PCOS</li>
                    <li>Stress, poor sleep or an unhealthy lifestyle</li>
                    <li>Weight changes, unhealthy diet or lack of exercise</li>
                    <li>Family history</li>
                    <li>Thyroid or other health problems</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Our Care Approach</div>
            <h2>Personalized Women’s Health Care</h2>
        </div>
        <div class="steps-grid">
            <div class="step-box"><span>01</span>
                <h3>Understanding Your Problem</h3>
                <p>We understand your periods, symptoms, health history, lifestyle & personal concerns.</p>
            </div>
            <div class="step-box"><span>02</span>
                <h3>Personalized Treatment</h3>
                <p>We provide a personalized homeopathy treatment plan based on your symptoms & overall health.</p>
            </div>
            <div class="step-box"><span>03</span>
                <h3>Regular Follow-Up</h3>
                <p>Regular check-ups help us understand your progress & support your long-term health.</p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="faq-list">
            <details open>
                <summary>When should I see a doctor for period problems?</summary>
                <p>You can consult a doctor if your periods are often irregular, very painful, very heavy or affecting your daily life.</p>
            </details>
            <details>
                <summary>Can lifestyle affect period health?</summary>
                <p>Stress, poor sleep, unhealthy food, less physical activity & weight changes can affect your periods & hormone health.</p>
            </details>
            <details>
                <summary>When should I seek urgent help for heavy bleeding?</summary>
                <p>Seek medical help immediately if you have very heavy bleeding, severe pain, fainting, weakness or bleeding during pregnancy.</p>
            </details>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="cta-box">
            <div>
                <div class="eyebrow">Take the first step</div>
                <h2>Ready to Talk About Your Health?</h2>
                <p>Book a private consultation for period problems, hormone issues, reproductive health & menopause concerns.</p>
            </div>
            <a class="btn" href="appointment.php">Book an Appointment</a>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>