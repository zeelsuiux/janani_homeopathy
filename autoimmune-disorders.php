<?php require 'includes.php';
$s = settings();
$page_title = 'Autoimmune Disorders | ' . $s['clinic_name'];
require 'header.php';
$conditions = [
    ['Hashimoto&apos;s Thyroiditis', 'Support for thyroid-related symptoms, energy changes, and autoimmune thyroid concerns.'],
    ['Rheumatoid Arthritis', 'Personalized care for joint pain, stiffness, swelling, and recurring inflammatory discomfort.'],
    ['Psoriasis', 'Guidance for recurring scaly, itchy, or inflamed skin associated with immune-related concerns.'],
    ['Vitiligo', 'Support for changes in skin pigmentation and the appearance of white patches.'],
    ['SLE', 'Holistic support while considering the individual symptoms and systemic nature of lupus.'],
    ['Scleroderma', 'Individualized supportive care for skin changes, stiffness, and related health concerns.'],
    ['Sjögren&apos;s Syndrome', 'Care focused on dryness, fatigue, discomfort, and the person&apos;s overall health pattern.'],
    ['Other Autoimmune Conditions', 'Personalized evaluation and supportive care for other immune-related complaints.']
];
?>

<section class="treatment-hero">
    <div class="container treatment-hero-grid">
        <div>
            <div class="eyebrow">Homeopathic Immune Health Care</div>
            <h1>Autoimmune Disorders</h1>
            <p>Autoimmune conditions can affect different parts of the body and may change over time. Our personalized approach considers your symptoms, medical history, lifestyle, investigations, and overall health.</p>
            <div class="actions">
                <a class="btn" href="appointment.php">Book Consultation</a>
                <a class="btn btn-outline" href="contact.php">Consult Doctor</a>
            </div>
            <div class="treatment-badges">
                <?php foreach ($conditions as $condition): ?><span><?= e(html_entity_decode($condition[0], ENT_QUOTES, 'UTF-8')) ?></span><?php endforeach; ?>
            </div>
        </div>
        <div class="treatment-visual">
            <img src="assets/images/doctor.jpg" onerror="this.src='assets/images/logo.png'" alt="Doctor consultation for autoimmune disorders">
            <div class="mini-card">
                <strong>Personalized Immune Care</strong>
                <span>Respectful, supportive care based on your symptoms, health history, investigations, and individual needs.</span>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Autoimmune Health Care</div>
            <h2>Conditions we support</h2>
            <p>Individualized support for thyroid, joint, skin, systemic, and immune-related concerns.</p>
        </div>
        <div class="feature-list">
            <?php foreach ($conditions as $condition): ?>
                <div class="feature-card">
                    <div class="icon">✚</div>
                    <h3><?= e(html_entity_decode($condition[0], ENT_QUOTES, 'UTF-8')) ?></h3>
                    <p><?= e(html_entity_decode($condition[1], ENT_QUOTES, 'UTF-8')) ?></p>
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
                <h2>Common symptoms may include:</h2>
                <ul class="check-list">
                    <li>Persistent tiredness, weakness, or low energy</li>
                    <li>Joint pain, stiffness, swelling, or reduced movement</li>
                    <li>Skin rashes, dryness, scaling, or pigmentation changes</li>
                    <li>Unusual dryness of the eyes or mouth</li>
                    <li>Temperature sensitivity, weight, or thyroid-related changes</li>
                    <li>Recurring flare-ups or symptoms affecting multiple body systems</li>
                </ul>
            </div>
            <div class="info-panel">
                <h2>Possible contributing factors:</h2>
                <ul class="check-list">
                    <li>Family history and genetic susceptibility</li>
                    <li>Hormonal, metabolic, or immune-related factors</li>
                    <li>Stress, poor sleep, or lifestyle imbalance</li>
                    <li>Past infections or environmental triggers</li>
                    <li>Other underlying health conditions</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Our Care Approach</div>
            <h2>Care that looks at the complete picture</h2>
        </div>
        <div class="steps-grid">
            <div class="step-box"><span>01</span><h3>Detailed Evaluation</h3><p>We review your symptoms, diagnosis, reports, medicines, medical history, lifestyle, and health concerns.</p></div>
            <div class="step-box"><span>02</span><h3>Personalized Plan</h3><p>Your supportive care plan is selected according to your individual symptoms and overall health needs.</p></div>
            <div class="step-box"><span>03</span><h3>Follow-up Support</h3><p>Regular follow-up helps monitor changes and coordinate responsible ongoing care.</p></div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="faq-list">
            <details open><summary>What are autoimmune disorders?</summary><p>Autoimmune disorders occur when the immune system mistakenly reacts against the body&apos;s own cells or tissues. They can affect one or several parts of the body.</p></details>
            <details><summary>Should I continue my current medical treatment?</summary><p>Do not stop or change prescribed medicines without speaking to your treating doctor. Supportive care should be discussed with your healthcare team.</p></details>
            <details><summary>When should I seek urgent medical care?</summary><p>Seek prompt medical attention for severe breathing difficulty, chest pain, sudden weakness, fainting, severe allergic symptoms, rapidly worsening swelling, or any emergency symptom.</p></details>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="cta-box">
            <div>
                <div class="eyebrow">Take the first step</div>
                <h2>Ready to discuss your health concerns?</h2>
                <p>Book a consultation for thyroid, joint, skin, systemic, or other autoimmune concerns.</p>
            </div>
            <a class="btn" href="appointment.php">Book an Appointment</a>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>
