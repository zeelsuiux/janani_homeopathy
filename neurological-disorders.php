<?php require 'includes.php';
$s = settings();
$page_title = 'Neurological Problems | ' . $s['clinic_name'];
require 'header.php';

$conditions = [
    ['Migraine', 'Personalized homeopathy care for recurring headaches, light sensitivity, nausea & migraine problems.'],
    ['Headache', 'Support for recurring headaches, tension headaches & other common headache problems.'],
    ['Vertigo', 'Care for dizziness, spinning sensations, imbalance & related discomfort.'],
    ['Neuralgia', 'Support for sharp, burning or electric-shock-like nerve pain.'],
    ['Neuropathy', 'Personalized care for tingling, numbness, burning or weakness related to nerve problems.'],
    ['Tremors', 'Support for involuntary shaking or trembling that affects daily activities.'],
    ['Sciatica', 'Care for pain, tingling or numbness that travels from the lower back to the leg.'],
    ['Sleep-Related Problems', 'Support for disturbed sleep, restless sleep & nerve-related problems affecting rest.']
];
?>

<section class="treatment-hero">
    <div class="container treatment-hero-grid">
        <div>
            <div class="eyebrow">Homeopathy for Neurological Problems</div>
            <h1>Neurological Problems</h1>
            <p>Nerve & neurological problems can affect movement, comfort, sleep, focus & daily life. Our personalized homeopathy treatment understands your symptoms, possible triggers, health history, lifestyle & overall health.</p>

            <div class="actions">
                <a class="btn" href="appointment.php">Book Consultation</a>
                <a class="btn btn-outline" href="contact.php">Consult Doctor</a>
            </div>
        </div>

        <div class="treatment-visual">
            <img src="assets/images/treatments/neurological-disorders.png" alt="Homeopathy treatment for neurological & nerve problems">
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Neurological Health Care</div>
            <h2>Problems We Help With</h2>
            <p>Personalized homeopathy care for common nerve, pain, balance, movement & sleep-related problems.</p>
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
            <div class="eyebrow">Symptoms & Possible Causes</div>
            <h2>Common Signs & Possible Reasons</h2>
        </div>

        <div class="two-col-grid">
            <div class="info-panel">
                <h2>Common problems include:</h2>

                <ul class="check-list">
                    <li>Recurring headaches, migraine or facial pain</li>
                    <li>Dizziness, spinning sensations or loss of balance</li>
                    <li>Numbness, tingling, burning or nerve pain</li>
                    <li>Involuntary shaking, stiffness or weakness</li>
                    <li>Lower back pain that travels to the leg</li>
                    <li>Sleep problems, tiredness or difficulty focusing</li>
                </ul>
            </div>

            <div class="info-panel">
                <h2>Possible reasons for these problems:</h2>

                <ul class="check-list">
                    <li>Stress, poor sleep or an irregular routine</li>
                    <li>Poor posture, muscle tension or physical strain</li>
                    <li>Injury, illness or pressure on a nerve</li>
                    <li>Other health, nutritional or body-related problems</li>
                    <li>Family history or individual health factors</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Our Care Approach</div>
            <h2>Personalized Care for Nerve Problems</h2>
        </div>

        <div class="steps-grid">
            <div class="step-box">
                <span>01</span>
                <h3>Your Problem</h3>
                <p>We understand your symptoms, possible triggers, health history, medicines & daily routine.</p>
            </div>

            <div class="step-box">
                <span>02</span>
                <h3>Personalized Treatment</h3>
                <p>We provide a personalized homeopathy treatment plan based on your symptoms & overall health.</p>
            </div>

            <div class="step-box">
                <span>03</span>
                <h3>Regular Follow-Up</h3>
                <p>Regular follow-ups help us understand your progress & provide ongoing support for your health.</p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="faq-list">

            <details open>
                <summary>When should I see a doctor for neurological problems?</summary>
                <p>You should consult a doctor if headaches, dizziness, numbness, weakness, shaking, nerve pain or sleep problems happen often, become worse or affect your daily life.</p>
            </details>

            <details>
                <summary>When do neurological symptoms need urgent medical care?</summary>
                <p>Seek urgent medical help for sudden weakness or numbness, difficulty speaking, fainting, seizures, a sudden severe headache, loss of balance or sudden confusion.</p>
            </details>

            <details>
                <summary>Can lifestyle affect nerve & neurological health?</summary>
                <p>Yes. Sleep, stress, posture, water intake, physical activity, food habits & daily routine can affect some symptoms. Persistent or severe problems should be checked by a qualified doctor.</p>
            </details>

        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="cta-box">
            <div>
                <div class="eyebrow">Take the First Step</div>
                <h2>Ready to Talk About Your Symptoms?</h2>
                <p>If headaches, nerve pain, dizziness, balance problems, movement problems or sleep issues are affecting your daily life, book a consultation for personalized homeopathy care.</p>
            </div>

            <a class="btn" href="appointment.php">Book an Appointment</a>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>