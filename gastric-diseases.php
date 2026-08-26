<?php require 'includes.php';
$s = settings();
$page_title = 'Gastric Diseases | ' . $s['clinic_name'];
require 'header.php';
$conditions = [
    ['Acidity & GERD', 'Support for heartburn, acid reflux, sour belching, and burning discomfort.'],
    ['Gastritis', 'Personalized care for stomach irritation, pain, nausea, and digestive discomfort.'],
    ['Indigestion', 'Help for heaviness, discomfort after meals, early fullness, and irregular digestion.'],
    ['Constipation', 'Care for infrequent, difficult, or uncomfortable bowel movements.'],
    ['IBS', 'Holistic support for abdominal discomfort, irregular bowel habits, gas, and bloating.'],
    ['Ulcerative Complaints', 'Guidance for recurring stomach pain, burning, and ulcer-related digestive complaints.'],
    ['Bloating & Gas', 'Support for abdominal fullness, excessive gas, and digestive discomfort.'],
    ['Piles & Fissures', 'Compassionate care for pain, bleeding, itching, and discomfort during bowel movements.']
];
?>

<section class="treatment-hero">
    <div class="container treatment-hero-grid">
        <div>
            <div class="eyebrow">Homeopathic Digestive Care</div>
            <h1>Gastric Diseases</h1>
            <p>Digestive problems can affect comfort, energy, sleep, and daily routine. Our personalized approach focuses on your symptoms, food habits, lifestyle, and overall health.</p>
            <div class="actions">
                <a class="btn" href="appointment.php">Book Consultation</a>
                <a class="btn btn-outline" href="contact.php">Consult Doctor</a>
            </div>
            <div class="treatment-badges">
                <?php foreach ($conditions as $condition): ?><span><?= e($condition[0]) ?></span><?php endforeach; ?>
            </div>
        </div>

        <div class="treatment-visual">
            <img src="assets/images/doctor.jpg" onerror="this.src='assets/images/logo.png'" alt="Doctor consultation for gastric diseases">
            <div class="mini-card">
                <strong>Personalized Digestive Care</strong>
                <span>Care that considers your digestive symptoms, routine, food habits, and complete health history.</span>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Digestive Health Care</div>
            <h2>Conditions we support</h2>
            <p>Individualized care for common gastric, intestinal, and bowel concerns.</p>
        </div>
        <div class="feature-list">
            <?php foreach ($conditions as $condition): ?>
                <div class="feature-card">
                    <div class="icon">✚</div>
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
            <div class="eyebrow">Symptoms & Causes</div>
            <h2>Signs to discuss with a doctor</h2>
        </div>
        <div class="two-col-grid">
            <div class="info-panel">
                <h2>Common symptoms include:</h2>
                <ul class="check-list">
                    <li>Heartburn, acidity, or sour taste in the mouth</li>
                    <li>Stomach pain, burning, nausea, or heaviness</li>
                    <li>Bloating, gas, belching, or abdominal discomfort</li>
                    <li>Irregular, hard, or painful bowel movements</li>
                    <li>Loose motions or alternating bowel habits</li>
                    <li>Pain, itching, or bleeding during bowel movements</li>
                </ul>
            </div>
            <div class="info-panel">
                <h2>Possible contributing factors:</h2>
                <ul class="check-list">
                    <li>Irregular meal timings or fast eating</li>
                    <li>Spicy, oily, processed, or trigger foods</li>
                    <li>Stress, poor sleep, or low physical activity</li>
                    <li>Low water or fibre intake</li>
                    <li>Food intolerance or digestive sensitivity</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Our Care Approach</div>
            <h2>A thoughtful path to better digestion</h2>
        </div>
        <div class="steps-grid">
            <div class="step-box"><span>01</span><h3>Detailed Evaluation</h3><p>We understand your symptoms, food habits, lifestyle, medical history, and individual triggers.</p></div>
            <div class="step-box"><span>02</span><h3>Personalized Plan</h3><p>Your care plan is selected according to your unique digestive symptoms and overall health pattern.</p></div>
            <div class="step-box"><span>03</span><h3>Follow-up Support</h3><p>Regular follow-up helps track changes, improve habits, and support steady digestive wellness.</p></div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="faq-list">
            <details open><summary>When should I consult for gastric problems?</summary><p>Consult a doctor when symptoms are frequent, persistent, painful, or affecting your sleep, food intake, or daily routine.</p></details>
            <details><summary>Can lifestyle changes help digestion?</summary><p>Regular meals, adequate water, fibre-rich foods, mindful eating, movement, and proper sleep may support digestive health. Discuss persistent symptoms with a qualified doctor.</p></details>
            <details><summary>Are gastric complaints treated individually?</summary><p>Yes. Digestive symptoms can have different triggers, so evaluation and care should be tailored to the individual.</p></details>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="cta-box">
            <div>
                <div class="eyebrow">Take the first step</div>
                <h2>Ready to feel more comfortable?</h2>
                <p>Discuss your acidity, digestion, bowel, or gastric concerns with our team.</p>
            </div>
            <a class="btn" href="appointment.php">Book an Appointment</a>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>
