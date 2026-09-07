<?php require 'includes.php';
$s = settings();
$page_title = 'Skin Problems | ' . $s['clinic_name'];
require 'header.php';

$conditions = [
    ['Vitiligo', 'Personalized homeopathy care for white patches & changes in skin colour.', 'vitiligo'],
    ['Psoriasis', 'Support for dry, scaly, itchy, red or irritated skin & recurring flare-ups.', 'psoriasis'],
    ['Eczema', 'Gentle care for itchy, dry, sensitive, irritated or inflamed skin.', 'eczema'],
    ['Urticaria', 'Support for recurring hives, itchy patches, redness & swelling of the skin.', 'urticaria'],
    ['Acne', 'Personalized homeopathy care for pimples, blackheads, whiteheads & acne problems.', 'acne'],
    ['Warts', 'Support for common, recurring or uncomfortable skin warts.', 'warts'],
    ['Fungal Infections', 'Care for itching, redness, scaling & recurring fungal skin problems.', 'fungal-infections'],
    ['Hair Fall & Alopecia', 'Support for excessive hair fall, hair thinning, patchy hair loss & scalp problems.', 'hair-fall-alopecia']
];
?>

<section class="treatment-hero">
    <div class="container treatment-hero-grid">
        <div>
            <div class="eyebrow">Homeopathy for Skin Problems</div>
            <h1>Skin Problems</h1>
            <p>Skin problems can affect your comfort, confidence & daily life. Our personalized homeopathy treatment understands your skin symptoms, possible triggers, lifestyle, health history & overall health.</p>

            <div class="actions">
                <a class="btn" href="appointment.php">Book Consultation</a>
                <a class="btn btn-outline" href="contact.php">Consult Doctor</a>
            </div>
        </div>

        <div class="treatment-visual">
            <img src="assets/images/treatments/skin-diseases.png" alt="Homeopathy treatment for skin & hair problems">
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Skin Health Care</div>
            <h2>Problems We Help With</h2>
            <p>Personalized homeopathy care for common skin, scalp & hair problems.</p>
        </div>

        <div class="feature-list">
            <?php foreach ($conditions as $conditionIndex => $condition): ?>
                <div class="feature-card">
                    <div class="icon treatment-icon"><img src="assets/images/treatments/<?= e($condition[2] ?? 'skin') ?>.png" alt="<?= e($condition[0]) ?>"></div>
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
            <div class="eyebrow">Symptoms & Possible Causes</div>
            <h2>Common Signs & Possible Reasons</h2>
        </div>

        <div class="two-col-grid">
            <div class="info-panel">
                <h2>Common problems include:</h2>

                <ul class="check-list">
                    <li>Itching, dryness, redness or skin irritation</li>
                    <li>White patches or changes in skin colour</li>
                    <li>Dry, scaly, cracked or swollen skin</li>
                    <li>Pimples, blackheads, whiteheads or acne</li>
                    <li>Recurring rashes, hives or other skin problems</li>
                    <li>Excessive hair fall, thinning or patchy hair loss</li>
                </ul>
            </div>

            <div class="info-panel">
                <h2>Possible reasons for these problems:</h2>

                <ul class="check-list">
                    <li>Allergies, infections or environmental factors</li>
                    <li>Stress, poor sleep or hormonal changes</li>
                    <li>Family history or genetic factors</li>
                    <li>Skin care products or chemical irritation</li>
                    <li>Diet, lifestyle or other health problems</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Our Care Approach</div>
            <h2>Personalized Care for Your Skin</h2>
        </div>

        <div class="steps-grid">
            <div class="step-box">
                <span>01</span>
                <h3>Your Problem</h3>
                <p>We understand your skin problems, symptoms, health history, lifestyle & possible triggers.</p>
            </div>

            <div class="step-box">
                <span>02</span>
                <h3>Personalized Treatment</h3>
                <p>We provide a personalized homeopathy treatment plan based on your symptoms & overall health.</p>
            </div>

            <div class="step-box">
                <span>03</span>
                <h3>Regular Follow-Up</h3>
                <p>Regular follow-ups help us understand your progress & provide ongoing support for your skin health.</p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="faq-list">

            <details open>
                <summary>When should I see a doctor for a skin problem?</summary>
                <p>You can consult a doctor if your skin problem continues for a long time, happens again, spreads, causes pain or affects your confidence & daily life.</p>
            </details>

            <details>
                <summary>Can different things cause skin problems?</summary>
                <p>Yes. Allergies, infections, stress, hormones, skin products, lifestyle & family history can affect your skin.</p>
            </details>

            <details>
                <summary>Can the same skin problem be different for different people?</summary>
                <p>Yes. Symptoms & possible triggers can be different for every person. A doctor can understand your individual problem & suggest suitable care.</p>
            </details>

        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="cta-box">
            <div>
                <div class="eyebrow">Take the First Step</div>
                <h2>Ready to Care for Your Skin?</h2>
                <p>If skin problems, itching, acne, hair fall or other concerns are affecting your daily life, book a consultation for personalized homeopathy care.</p>
            </div>

            <a class="btn" href="appointment.php">Book an Appointment</a>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>