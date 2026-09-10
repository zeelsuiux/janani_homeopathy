<?php require 'includes.php';
$s = settings();
$page_title = 'Autoimmune Problems | ' . $s['clinic_name'];
require 'header.php';

$conditions = [
    ['Autoimmune Thyroid Problem', 'Personalized homeopathy care for thyroid-related symptoms, tiredness, energy changes & other thyroid problems.','autoimmune-thyroid-problem'],
    ['Rheumatoid Arthritis', 'Support for joint pain, stiffness, swelling & recurring discomfort.','rheumatoid-arthritis'],
    ['Psoriasis', 'Personalized care for dry, scaly, itchy or inflamed skin problems.','psoriasis'],
    ['Vitiligo', 'Support for white patches & changes in skin colour.','vitiligo'],
    ['SLE', 'Personalized supportive care based on your symptoms, overall health & individual needs.','sle'],
    ['Scleroderma', 'Support for skin changes, stiffness & other related health problems.','scleroderma'],
    ['Dry Eyes & Dry Mouth Syndrome', 'Care for dryness, tiredness, discomfort & overall health concerns.','dry-eyes-dry-mouth-syndrome'],
    ['Other Autoimmune Problems', 'Personalized evaluation & supportive care for other immune-related health problems.','other-autoimmune-problems'],
];
?>

<section class="treatment-hero">
    <div class="container treatment-hero-grid">
        <div>
            <div class="eyebrow">Homeopathy for Autoimmune Problems</div>
            <h1>Autoimmune Problems</h1>
            <p>Autoimmune problems can affect different parts of the body & may change over time. Our personalized homeopathy care understands your symptoms, health history, lifestyle, medical reports & overall health.</p>

            <div class="actions">
                <a class="btn" href="appointment.php">Book Consultation</a>
                <a class="btn btn-outline" href="contact.php">Consult Doctor</a>
            </div>
        </div>

        <div class="treatment-visual">  
            <img src="assets/images/treatments/autoimmune-disorders.png" onerror="this.src='assets/images/doctor.png'" alt="Homeopathy care for autoimmune problems">
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Autoimmune Health Care</div>
            <h2>Problems We Help With</h2>
            <p>Personalized support for thyroid, joint, skin & other immune-related health problems.</p>
        </div>

        <div class="feature-list">
            <?php foreach ($conditions as $conditionIndex => $condition): ?>
                <div class="feature-card">
                    <div class="icon treatment-icon"><img src="assets/images/treatments/<?= e($condition[2] ?? 'autoimmune') ?>.png" alt="<?= e($condition[0]) ?>"></div>
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
            <div class="eyebrow">Symptoms & Possible Causes</div>
            <h2>Common Signs & Possible Reasons</h2>
        </div>

        <div class="two-col-grid">
            <div class="info-panel">
                <h2>Common problems may include:</h2>

                <ul class="check-list">
                    <li>Ongoing tiredness, weakness or low energy</li>
                    <li>Joint pain, stiffness, swelling or difficulty moving</li>
                    <li>Skin rashes, dryness, scaling or changes in skin colour</li>
                    <li>Dry eyes or dry mouth</li>
                    <li>Changes in body temperature, weight or thyroid-related symptoms</li>
                    <li>Recurring symptoms affecting different parts of the body</li>
                </ul>
            </div>

            <div class="info-panel">
                <h2>Possible reasons for these problems:</h2>

                <ul class="check-list">
                    <li>Family history or genetic factors</li>
                    <li>Hormonal, body-related or immune system changes</li>
                    <li>Stress, poor sleep or lifestyle problems</li>
                    <li>Past infections or environmental triggers</li>
                    <li>Other underlying health problems</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Our Care Approach</div>
            <h2>Personalized Care for Your Health</h2>
        </div>

        <div class="steps-grid">
            <div class="step-box">
                <span>01</span>
                <h3>Your Problem</h3>
                <p>We understand your symptoms, diagnosis, medical reports, medicines, health history, lifestyle & overall concerns.</p>
            </div>

            <div class="step-box">
                <span>02</span>
                <h3>Personalized Treatment</h3>
                <p>We provide personalized supportive homeopathy care based on your symptoms & overall health needs.</p>
            </div>

            <div class="step-box">
                <span>03</span>
                <h3>Regular Follow-Up</h3>
                <p>Regular follow-ups help us understand changes in your symptoms & provide ongoing support for your health.</p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="faq-list">

            <details open>
                <summary>What are autoimmune problems?</summary>
                <p>Autoimmune problems happen when the body's immune system reacts against its own cells or tissues. These problems can affect one or different parts of the body.</p>
            </details>

            <details>
                <summary>Should I continue my current medical treatment?</summary>
                <p>Yes. Do not stop or change any prescribed medicine without speaking to your treating doctor. Always discuss any additional treatment with your healthcare professional.</p>
            </details>

            <details>
                <summary>When should I seek urgent medical help?</summary>
                <p>Seek urgent medical help for severe breathing problems, chest pain, sudden weakness, fainting, severe allergic reactions, rapidly increasing swelling or any serious emergency symptoms.</p>
            </details>

        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="cta-box">
            <div>
                <div class="eyebrow">Take the First Step</div>
                <h2>Ready to Talk About Your Health?</h2>
                <p>If thyroid, joint, skin or other autoimmune problems are affecting your daily life, book a consultation for personalized homeopathy care.</p>
            </div>

            <a class="btn" href="appointment.php">Book an Appointment</a>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>