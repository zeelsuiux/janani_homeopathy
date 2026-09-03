<?php require 'includes.php';
$s = settings();
$page_title = 'Gynaecological Problems | ' . $s['clinic_name'];
require 'header.php';
$conditions = [
    ['PCOD / PCOS', 'Personalized support for hormonal imbalance, cycle changes, acne, and related concerns.'],
    ['Irregular Periods', 'Care for delayed, early, missed, or unpredictable menstrual cycles.'],
    ['Painful Periods', 'Compassionate support for cramps, pelvic discomfort, back pain, and period-related symptoms.'],
    ['Excessive Bleeding', 'Guidance for unusually heavy, prolonged, or frequent menstrual bleeding.'],
    ['Leucorrhoea', 'Support for unusual vaginal discharge, irritation, discomfort, or recurring concerns.'],
    ['Endometriosis', 'Individualized care for pelvic pain, painful periods, and endometriosis-related complaints.'],
    ['Menopausal Complaints', 'Support for hot flashes, mood changes, sleep concerns, and other menopause symptoms.'],
    ['Infertility Support', 'Holistic support for couples while evaluating menstrual, hormonal, lifestyle, and overall health factors.']
];
?>

<section class="treatment-hero">
    <div class="container treatment-hero-grid">
        <div>
            <div class="eyebrow">Homeopathic Women&apos;s Health Care</div>
            <h1>Gynaecological Problems</h1>
            <p>Women&apos;s health concerns can affect the body, emotions, relationships, and daily life. Our personalized approach considers your symptoms, menstrual history, hormonal pattern, lifestyle, and overall health.</p>
            <div class="actions">
                <a class="btn" href="appointment.php">Book Consultation</a>
                <a class="btn btn-outline" href="contact.php">Consult Doctor</a>
            </div>
            <div class="treatment-badges">
                <?php foreach ($conditions as $condition): ?><span><?= e($condition[0]) ?></span><?php endforeach; ?>
            </div>
        </div>
        <div class="treatment-visual">
            <img src="assets/images/treatments/gynaecological-problems.png" onerror="this.src='assets/images/doctor.png'" alt="Women's health care">
            <div class="mini-card">
                <strong>Personalized Women&apos;s Care</strong>
                <span>Private, respectful care based on your symptoms, cycle history, lifestyle, and individual health needs.</span>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Women&apos;s Health Care</div>
            <h2>Conditions we support</h2>
            <p>Individualized care for menstrual, hormonal, reproductive, and menopausal concerns.</p>
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
            <div class="eyebrow">Symptoms &amp; Health Factors</div>
            <h2>Concerns to discuss with a doctor</h2>
        </div>
        <div class="two-col-grid">
            <div class="info-panel">
                <h2>Common symptoms include:</h2>
                <ul class="check-list">
                    <li>Irregular, delayed, missed, or painful periods</li>
                    <li>Heavy or prolonged menstrual bleeding</li>
                    <li>Pelvic pain, cramps, or lower back discomfort</li>
                    <li>Unusual vaginal discharge or irritation</li>
                    <li>Hot flashes, mood changes, or sleep disturbance</li>
                    <li>Acne, unwanted hair growth, or hair thinning</li>
                </ul>
            </div>
            <div class="info-panel">
                <h2>Possible contributing factors:</h2>
                <ul class="check-list">
                    <li>Hormonal changes or PCOD / PCOS</li>
                    <li>Stress, poor sleep, or lifestyle imbalance</li>
                    <li>Weight changes, diet, or low physical activity</li>
                    <li>Family history and genetic factors</li>
                    <li>Thyroid, metabolic, or other health conditions</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Our Care Approach</div>
            <h2>Respectful, individualised women&apos;s healthcare</h2>
        </div>
        <div class="steps-grid">
            <div class="step-box"><span>01</span><h3>Detailed Evaluation</h3><p>We understand your cycle history, symptoms, medical history, lifestyle, and personal concerns.</p></div>
            <div class="step-box"><span>02</span><h3>Personalized Plan</h3><p>Your care plan is selected according to your individual symptoms and overall health pattern.</p></div>
            <div class="step-box"><span>03</span><h3>Follow-up Support</h3><p>Regular follow-up helps monitor changes and support consistent long-term wellbeing.</p></div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="faq-list">
            <details open><summary>When should I consult for menstrual problems?</summary><p>Consult a doctor when periods are consistently irregular, very painful, unusually heavy, prolonged, or affecting your daily life.</p></details>
            <details><summary>Can lifestyle affect menstrual health?</summary><p>Stress, sleep, nutrition, activity, and weight changes can influence hormonal and menstrual health. Persistent concerns should be evaluated by a qualified doctor.</p></details>
            <details><summary>When should heavy bleeding receive urgent attention?</summary><p>Seek prompt medical care for very heavy bleeding, severe pain, fainting, weakness, pregnancy-related bleeding, or symptoms that feel urgent.</p></details>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="cta-box">
            <div>
                <div class="eyebrow">Take the first step</div>
                <h2>Ready to discuss your health concerns?</h2>
                <p>Book a private consultation for menstrual, hormonal, reproductive, or menopausal concerns.</p>
            </div>
            <a class="btn" href="appointment.php">Book an Appointment</a>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>
