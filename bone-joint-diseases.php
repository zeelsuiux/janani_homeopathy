<?php require 'includes.php';
$s = settings();
$page_title = 'Bone & Joint Problems | ' . $s['clinic_name'];
require 'header.php';

$conditions = [
    ['Arthritis', 'A joint problem that can cause pain, swelling, stiffness & difficulty moving.','arthritis'],
    ['Osteoarthritis', 'Joint wear & tear that can cause pain, stiffness & difficulty moving.','osteoarthritis'],
    ['Osteoporosis', 'A bone problem that can cause weak bones, fractures & pain.','osteoporosis'],
    ['Back Pain', 'Support for recurring upper or lower back pain, muscle tension & discomfort.','back-pain'],
    ['Cervical Spondylosis', 'A neck problem that can cause neck pain, stiffness & difficulty moving.','cervical-spondylosis'],
    ['Lumbar Spondylosis', 'A lower back problem that can cause pain, stiffness & movement problems.','lumbar-spondylosis'],
    ['Sciatica', 'Pain, tingling or numbness that travels from the lower back to the leg.','sciatica'],
    ['Joint Pain & Stiffness', 'Support for painful, stiff or difficult-to-move joints affecting daily life.','joint-pain-stiffness'],
    ['Gout', 'A joint problem that can cause sudden pain, swelling, redness & tenderness.','gout'],
];
?>

<section class="treatment-hero">
    <div class="container treatment-hero-grid">
        <div>
            <div class="eyebrow">Homeopathy for Bone & Joint Diseases</div>
            <h1>Bone & Joint Problems</h1>

            <p>Bone, joint & muscle problems can affect movement, comfort, work, sleep & daily life. Our personalized homeopathy care understands your symptoms, movement, health history, lifestyle & overall health.</p>

            <div class="actions">
                <a class="btn" href="appointment.php">Book Consultation</a>
                <a class="btn btn-outline" href="contact.php">Consult Doctor</a>
            </div>
        </div>

        <div class="treatment-visual">
            <img src="assets/images/treatments/bone-joint-diseases.png" onerror="this.src='assets/images/doctor.png'" alt="Homeopathy care for bone and joint problems">
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Bone & Joint Health Care</div>
            <h2>Problems We Help With</h2>
            <p>Personalized homeopathy care for common bone, joint, back, spine, muscle & nerve problems.</p>
        </div>

        <div class="feature-list">
            <?php foreach ($conditions as $conditionIndex => $condition): ?>
                <div class="feature-card">
                    <div class="icon treatment-icon"><img src="assets/images/treatments/<?= e($condition[2] ?? 'bone-joint') ?>.png" alt="<?= e($condition[0]) ?>"></div>
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
                    <li>Joint pain, swelling, tenderness or stiffness</li>
                    <li>Morning stiffness or difficulty moving</li>
                    <li>Neck, shoulder or lower back pain</li>
                    <li>Pain, tingling or numbness travelling to the leg</li>
                    <li>Difficulty moving joints or muscle weakness</li>
                    <li>Sudden painful, red or swollen joints</li>
                </ul>
            </div>

            <div class="info-panel">
                <h2>Possible reasons for these problems:</h2>

                <ul class="check-list">
                    <li>Age-related changes or wear & tear of joints</li>
                    <li>Injury, poor posture or repeated physical strain</li>
                    <li>Inflammation or autoimmune problems</li>
                    <li>Weight, lifestyle or low physical activity</li>
                    <li>Family history or other health factors</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Our Care Approach</div>
            <h2>Personalized Care for Better Movement</h2>
        </div>

        <div class="steps-grid">

            <div class="step-box">
                <span>01</span>
                <h3>Your Problem</h3>
                <p>We understand your pain, movement problems, medical reports, health history, lifestyle & daily activities.</p>
            </div>

            <div class="step-box">
                <span>02</span>
                <h3>Personalized Treatment</h3>
                <p>We provide personalized homeopathy care based on your symptoms & overall health needs.</p>
            </div>

            <div class="step-box">
                <span>03</span>
                <h3>Regular Follow-Up</h3>
                <p>Regular follow-ups help us understand changes in your pain, movement & overall progress.</p>
            </div>

        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="faq-list">

            <details open>
                <summary>When should I see a doctor for joint or back pain?</summary>
                <p>Consult a doctor if your pain is frequent, continues for a long time, becomes worse, affects movement, disturbs sleep or affects your daily life.</p>
            </details>

            <details>
                <summary>Can lifestyle affect bone & joint health?</summary>
                <p>Yes. Weight, posture, physical activity, sleep, food habits & repeated physical strain can affect joint comfort. Ongoing problems should be checked by a qualified doctor.</p>
            </details>

            <details>
                <summary>When do bone or joint problems need urgent medical help?</summary>
                <p>Seek urgent medical help after a serious injury, sudden weakness or numbness, loss of bladder or bowel control, a hot swollen joint with fever or severe pain that gets worse quickly.</p>
            </details>

        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="cta-box">
            <div>
                <div class="eyebrow">Take the First Step</div>
                <h2>Ready to Talk About Your Pain?</h2>
                <p>If joint pain, back pain, stiffness, sciatica or movement problems are affecting your daily life, book a consultation for personalized homeopathy care.</p>
            </div>

            <a class="btn" href="appointment.php">Book an Appointment</a>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>