<?php require 'includes.php';
$s = settings();
$page_title = 'Neurological Disorders | ' . $s['clinic_name'];
require 'header.php';
$conditions = [
    ['Migraine', 'Personalized support for recurring headaches, light sensitivity, nausea, and migraine triggers.'],
    ['Headache', 'Care for recurring tension, sinus-related, or other common headache complaints.'],
    ['Vertigo', 'Guidance for dizziness, spinning sensations, imbalance, and related discomfort.'],
    ['Neuralgia', 'Support for sharp, burning, or electric-shock-like nerve pain.'],
    ['Neuropathy', 'Individualized care for tingling, numbness, burning, or weakness related to nerve concerns.'],
    ['Tremors', 'Assessment and support for involuntary shaking or trembling affecting daily activities.'],
    ['Sciatica', 'Care for pain, tingling, or numbness travelling from the lower back into the leg.'],
    ['Sleep-related Neurological Complaints', 'Support for sleep disturbance, restless sleep, and neurological symptoms affecting rest.']
];
?>

<section class="treatment-hero">
    <div class="container treatment-hero-grid">
        <div>
            <div class="eyebrow">Homeopathic Neurological Care</div>
            <h1>Neurological Disorders</h1>
            <p>Nervous system concerns can affect movement, comfort, sleep, focus, and daily life. Our personalized approach considers your symptoms, triggers, medical history, lifestyle, and overall health.</p>
            <div class="actions">
                <a class="btn" href="appointment.php">Book Consultation</a>
                <a class="btn btn-outline" href="contact.php">Consult Doctor</a>
            </div>
            <div class="treatment-badges">
                <?php foreach ($conditions as $condition): ?><span><?= e($condition[0]) ?></span><?php endforeach; ?>
            </div>
        </div>
        <div class="treatment-visual">
            <img src="assets/images/treatments/neurological.jpg" onerror="this.src='assets/images/doctor.png'" alt="Neurological care">
            <div class="mini-card">
                <strong>Personalized Neurological Care</strong>
                <span>Care based on your symptoms, neurological history, daily routine, and individual health needs.</span>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Neurological Health Care</div>
            <h2>Conditions we support</h2>
            <p>Individualized care for common nerve, pain, balance, movement, and sleep-related concerns.</p>
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
                    <li>Recurring headache, migraine, or facial pain</li>
                    <li>Dizziness, spinning sensations, or imbalance</li>
                    <li>Numbness, tingling, burning, or nerve pain</li>
                    <li>Involuntary shaking, stiffness, or weakness</li>
                    <li>Lower back pain radiating into the leg</li>
                    <li>Sleep disturbance, fatigue, or difficulty concentrating</li>
                </ul>
            </div>
            <div class="info-panel">
                <h2>Possible contributing factors:</h2>
                <ul class="check-list">
                    <li>Stress, poor sleep, or irregular routine</li>
                    <li>Posture, muscle tension, or physical strain</li>
                    <li>Injury, illness, or nerve compression</li>
                    <li>Medical, metabolic, or nutritional conditions</li>
                    <li>Family history and individual health factors</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Our Care Approach</div>
            <h2>Thoughtful care for nervous system wellness</h2>
        </div>
        <div class="steps-grid">
            <div class="step-box"><span>01</span><h3>Detailed Evaluation</h3><p>We understand your symptoms, pattern, triggers, medical history, medicines, and daily routine.</p></div>
            <div class="step-box"><span>02</span><h3>Personalized Plan</h3><p>Your care plan is selected according to your individual symptoms and overall health needs.</p></div>
            <div class="step-box"><span>03</span><h3>Follow-up Support</h3><p>Regular follow-up helps monitor changes and support steady progress in daily comfort and wellbeing.</p></div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="faq-list">
            <details open><summary>When should I consult for neurological symptoms?</summary><p>Consult a doctor for recurring, worsening, or unexplained headaches, dizziness, numbness, weakness, tremors, nerve pain, or sleep-related symptoms.</p></details>
            <details><summary>When do neurological symptoms need urgent care?</summary><p>Seek urgent medical attention for sudden weakness or numbness, difficulty speaking, fainting, seizures, severe sudden headache, loss of balance, or new confusion.</p></details>
            <details><summary>Can lifestyle affect neurological wellness?</summary><p>Sleep, stress, posture, hydration, movement, nutrition, and daily routine can influence symptoms. Persistent or severe concerns should be evaluated by a qualified doctor.</p></details>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="cta-box">
            <div>
                <div class="eyebrow">Take the first step</div>
                <h2>Ready to discuss your symptoms?</h2>
                <p>Book a consultation for headache, nerve, balance, movement, sciatica, or sleep-related concerns.</p>
            </div>
            <a class="btn" href="appointment.php">Book an Appointment</a>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>
