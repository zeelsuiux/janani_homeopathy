<?php require 'includes.php';
$s = settings();
$page_title = 'Bone & Joint Diseases | ' . $s['clinic_name'];
require 'header.php';
$conditions = [
    ['Arthritis', 'Support for joint pain, swelling, stiffness, and reduced movement.'],
    ['Osteoarthritis', 'Personalized care for wear-and-tear related joint pain and stiffness.'],
    ['Rheumatoid Arthritis', 'Guidance for inflammatory joint pain, swelling, and morning stiffness.'],
    ['Back Pain', 'Care for recurring lower or upper back pain, muscular tension, and discomfort.'],
    ['Cervical Spondylosis', 'Support for neck pain, stiffness, and discomfort related to the cervical spine.'],
    ['Lumbar Spondylosis', 'Individualized care for lower back stiffness, pain, and mobility concerns.'],
    ['Sciatica', 'Support for pain, tingling, or numbness travelling from the lower back into the leg.'],
    ['Joint Pain & Stiffness', 'Care for painful, stiff, or restricted joints affecting daily activities.'],
    ['Gout', 'Guidance for sudden joint pain, tenderness, swelling, and gout-related complaints.']
];
?>

<section class="treatment-hero">
    <div class="container treatment-hero-grid">
        <div>
            <div class="eyebrow">Homeopathic Bone &amp; Joint Care</div>
            <h1>Bone &amp; Joint Diseases</h1>
            <p>Bone, joint, and muscle concerns can affect movement, comfort, work, and sleep. Our personalized approach considers your symptoms, mobility, medical history, lifestyle, and overall health.</p>
            <div class="actions">
                <a class="btn" href="appointment.php">Book Consultation</a>
                <a class="btn btn-outline" href="contact.php">Consult Doctor</a>
            </div>
            <div class="treatment-badges">
                <?php foreach ($conditions as $condition): ?><span><?= e($condition[0]) ?></span><?php endforeach; ?>
            </div>
        </div>
        <div class="treatment-visual">
            <img src="assets/images/treatments/bone-joint.jpg" onerror="this.src='assets/images/doctor.png'" alt="Bone and joint care">
            <div class="mini-card">
                <strong>Personalized Joint Care</strong>
                <span>Support based on your pain pattern, mobility, lifestyle, medical history, and individual needs.</span>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Musculoskeletal Health Care</div>
            <h2>Conditions we support</h2>
            <p>Individualized care for common bone, joint, spine, muscle, and nerve-related concerns.</p>
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
            <div class="eyebrow">Symptoms &amp; Contributing Factors</div>
            <h2>Signs to discuss with a doctor</h2>
        </div>
        <div class="two-col-grid">
            <div class="info-panel">
                <h2>Common symptoms include:</h2>
                <ul class="check-list">
                    <li>Joint pain, swelling, tenderness, or stiffness</li>
                    <li>Morning stiffness or difficulty moving</li>
                    <li>Neck, shoulder, or lower back discomfort</li>
                    <li>Pain, tingling, or numbness travelling into the leg</li>
                    <li>Reduced range of motion or muscle weakness</li>
                    <li>Sudden painful, red, or swollen joints</li>
                </ul>
            </div>
            <div class="info-panel">
                <h2>Possible contributing factors:</h2>
                <ul class="check-list">
                    <li>Age-related changes or joint wear and tear</li>
                    <li>Injury, posture, repetitive strain, or overuse</li>
                    <li>Inflammatory or autoimmune conditions</li>
                    <li>Weight, lifestyle, or low physical activity</li>
                    <li>Family history and metabolic factors</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Our Care Approach</div>
            <h2>Thoughtful support for comfortable movement</h2>
        </div>
        <div class="steps-grid">
            <div class="step-box"><span>01</span><h3>Detailed Evaluation</h3><p>We understand your pain pattern, movement, reports, medical history, lifestyle, and daily activities.</p></div>
            <div class="step-box"><span>02</span><h3>Personalized Plan</h3><p>Your supportive care plan is selected according to your symptoms and overall health needs.</p></div>
            <div class="step-box"><span>03</span><h3>Follow-up Support</h3><p>Regular follow-up helps monitor comfort, movement, and progress over time.</p></div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="faq-list">
            <details open><summary>When should I consult for joint or back pain?</summary><p>Consult a doctor when pain is persistent, recurring, worsening, limiting movement, disturbing sleep, or affecting your daily routine.</p></details>
            <details><summary>Can lifestyle affect joint health?</summary><p>Weight, posture, physical activity, sleep, nutrition, and repetitive strain can influence joint comfort. Persistent symptoms should be evaluated by a qualified doctor.</p></details>
            <details><summary>When do bone and joint symptoms need urgent care?</summary><p>Seek urgent medical attention after a serious injury, for sudden weakness or numbness, loss of bladder or bowel control, a hot swollen joint with fever, or severe rapidly worsening pain.</p></details>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="cta-box">
            <div>
                <div class="eyebrow">Take the first step</div>
                <h2>Ready to discuss your pain or stiffness?</h2>
                <p>Book a consultation for joint, spine, back, sciatica, or mobility concerns.</p>
            </div>
            <a class="btn" href="appointment.php">Book an Appointment</a>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>
