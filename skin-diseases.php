<?php require 'includes.php';
$s = settings();
$page_title = 'Skin Diseases | ' . $s['clinic_name'];
require 'header.php';
$conditions = [
    ['Vitiligo', 'Personalized support for changes in skin pigmentation and the appearance of white patches.'],
    ['Psoriasis', 'Care for dry, scaly, itchy, or inflamed skin and recurring flare-ups.'],
    ['Eczema', 'Gentle support for itchy, dry, sensitive, irritated, or inflamed skin.'],
    ['Urticaria', 'Guidance for recurring hives, raised itchy patches, redness, and skin swelling.'],
    ['Acne', 'Individualized care for pimples, blackheads, whiteheads, and acne-prone skin.'],
    ['Warts', 'Support for common, recurring, or uncomfortable wart-related skin concerns.'],
    ['Fungal Infections', 'Care for itching, redness, scaling, and recurring fungal skin complaints.'],
    ['Hair Fall & Alopecia', 'Support for excessive hair fall, thinning, patchy loss, and scalp concerns.']
];
?>

<section class="treatment-hero">
    <div class="container treatment-hero-grid">
        <div>
            <div class="eyebrow">Homeopathic Skin Care</div>
            <h1>Skin Diseases</h1>
            <p>Healthy skin reflects the well-being of the whole person. Our personalized approach considers your skin symptoms, triggers, lifestyle, medical history, and overall health.</p>
            <div class="actions">
                <a class="btn" href="appointment.php">Book Consultation</a>
                <a class="btn btn-outline" href="contact.php">Consult Doctor</a>
            </div>
            <div class="treatment-badges">
                <?php foreach ($conditions as $condition): ?><span><?= e($condition[0]) ?></span><?php endforeach; ?>
            </div>
        </div>
        <div class="treatment-visual">
            <img src="assets/images/treatments/skin.jpg" onerror="this.src='assets/images/doctor.png'" alt="Skin care">
            <div class="mini-card">
                <strong>Personalized Skin Care</strong>
                <span>Care that considers your skin pattern, possible triggers, habits, and complete health history.</span>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Skin Health Care</div>
            <h2>Conditions we support</h2>
            <p>Individualized care for common skin, scalp, and hair concerns.</p>
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
            <div class="eyebrow">Symptoms &amp; Triggers</div>
            <h2>Signs to discuss with a doctor</h2>
        </div>
        <div class="two-col-grid">
            <div class="info-panel">
                <h2>Common symptoms include:</h2>
                <ul class="check-list">
                    <li>Itching, dryness, redness, or skin irritation</li>
                    <li>White patches, discolouration, or uneven pigmentation</li>
                    <li>Scaly, cracked, swollen, or inflamed skin</li>
                    <li>Pimples, blackheads, whiteheads, or blemishes</li>
                    <li>Recurring rashes, hives, or skin eruptions</li>
                    <li>Excessive hair fall, thinning, or patchy hair loss</li>
                </ul>
            </div>
            <div class="info-panel">
                <h2>Possible contributing factors:</h2>
                <ul class="check-list">
                    <li>Allergies, infections, or environmental exposure</li>
                    <li>Stress, poor sleep, or hormonal changes</li>
                    <li>Family history and genetic predisposition</li>
                    <li>Skin-care products or chemical irritation</li>
                    <li>Dietary and lifestyle imbalance</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Our Care Approach</div>
            <h2>Thoughtful care for healthier skin</h2>
        </div>
        <div class="steps-grid">
            <div class="step-box"><span>01</span><h3>Detailed Evaluation</h3><p>We understand the skin concern, its duration, triggers, medical history, and personal health pattern.</p></div>
            <div class="step-box"><span>02</span><h3>Personalized Plan</h3><p>Your care plan is selected according to your individual symptoms and overall health needs.</p></div>
            <div class="step-box"><span>03</span><h3>Follow-up Support</h3><p>Regular follow-up helps monitor changes and support consistent, long-term skin wellness.</p></div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="faq-list">
            <details open><summary>When should I consult for a skin problem?</summary><p>Consult a doctor when a skin concern is persistent, recurring, spreading, painful, infected, or affecting your confidence and daily routine.</p></details>
            <details><summary>Can skin problems have different triggers?</summary><p>Yes. Skin symptoms may be influenced by allergies, infections, stress, products, lifestyle, hormones, or family history. A proper evaluation helps identify the right approach.</p></details>
            <details><summary>Is every skin concern treated individually?</summary><p>Yes. The appearance of a skin condition may be similar, but its symptoms and triggers can differ from person to person.</p></details>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="cta-box">
            <div>
                <div class="eyebrow">Take the first step</div>
                <h2>Ready to care for your skin?</h2>
                <p>Discuss your skin, scalp, or hair concerns with our team.</p>
            </div>
            <a class="btn" href="appointment.php">Book an Appointment</a>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>
