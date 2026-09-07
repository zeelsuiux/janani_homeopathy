<?php require 'includes.php';
$s = settings();
$page_title = 'Gastric Problems | ' . $s['clinic_name'];
require 'header.php';

$conditions = [
    ['Acidity & GERD', 'Homeopathy care for acidity, heartburn, acid reflux, sour belching & burning discomfort.', 'acidity-gerd'],
    ['Gastritis', 'Personalized homeopathy care for stomach irritation, pain, nausea & digestive problems.', 'gastritis'],
    ['Indigestion', 'Support for heaviness after meals, stomach discomfort, feeling full quickly & poor digestion.', 'indigestion'],
    ['Constipation', 'Homeopathy care for hard, difficult or irregular bowel movements.', 'constipation'],
    ['IBS', 'Personalized care for stomach discomfort, irregular bowel movements, gas & bloating.', 'ibs'],
    ['Stomach Ulcer Problems', 'Support for repeated stomach pain, burning & other ulcer-related problems.', 'stomach-ulcer-problems'],
    ['Bloating & Gas', 'Homeopathy care for stomach bloating, gas, fullness & digestive discomfort.', 'bloating-gas'],
    ['Piles & Fissures', 'Support for pain, bleeding, itching & discomfort during bowel movements.', 'piles-fissures']
];
?>

<section class="treatment-hero">
    <div class="container treatment-hero-grid">
        <div>
            <div class="eyebrow">Homeopathy for Digestive Problems</div>
            <h1>Gastric Problems</h1>
            <p>Stomach & digestive problems can affect how you feel every day. They may cause discomfort, low energy, sleep problems & difficulty in your daily routine. Our personalized homeopathy treatment understands your symptoms, food habits, lifestyle & overall health.</p>

            <div class="actions">
                <a class="btn" href="appointment.php">Book Consultation</a>
                <a class="btn btn-outline" href="contact.php">Consult Doctor</a>
            </div>
        </div>

        <div class="treatment-visual">
            <img src="assets/images/treatments/gastric-diseases.png" alt="Homeopathy treatment for gastric & digestive problems">

            <div class="mini-card">
                <strong>Personalized Digestive Care</strong>
                <span>Homeopathy care based on your symptoms, food habits, lifestyle & overall health.</span>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Digestive Health Care</div>
            <h2>Problems We Help With</h2>
            <p>Personalized homeopathy care for common stomach, digestive & bowel problems.</p>
        </div>

        <div class="feature-list">
            <?php foreach ($conditions as $conditionIndex => $condition): ?>
                <div class="feature-card">
                    <div class="icon treatment-icon"><img src="assets/images/treatments/<?= e($condition[2] ?? 'gastric') ?>.png" alt="<?= e($condition[0]) ?>"></div>
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
                    <li>Acidity, heartburn or sour taste in the mouth</li>
                    <li>Stomach pain, burning, nausea or heaviness</li>
                    <li>Bloating, gas, belching or stomach discomfort</li>
                    <li>Hard, irregular or painful bowel movements</li>
                    <li>Loose motions or changing bowel habits</li>
                    <li>Pain, itching or bleeding during bowel movements</li>
                </ul>
            </div>

            <div class="info-panel">
                <h2>Possible reasons for these problems:</h2>

                <ul class="check-list">
                    <li>Irregular meal timings or eating too fast</li>
                    <li>Spicy, oily or unhealthy food</li>
                    <li>Stress, poor sleep or less physical activity</li>
                    <li>Drinking less water or eating less fibre</li>
                    <li>Food sensitivity or other digestive problems</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Our Care Approach</div>
            <h2>Personalized Care for Better Digestion</h2>
        </div>

        <div class="steps-grid">
            <div class="step-box">
                <span>01</span>
                <h3>Your Problem</h3>
                <p>We understand your symptoms, food habits, lifestyle, health history & possible triggers.</p>
            </div>

            <div class="step-box">
                <span>02</span>
                <h3>Personalized Treatment</h3>
                <p>We provide a personalized homeopathy treatment plan based on your digestive problems & overall health.</p>
            </div>

            <div class="step-box">
                <span>03</span>
                <h3>Regular Follow-Up</h3>
                <p>Regular follow-ups help us understand your progress & provide ongoing support for better digestive health.</p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="faq-list">
            <details open>
                <summary>When should I see a doctor for gastric problems?</summary>
                <p>You can consult a doctor if stomach or digestive problems happen often, continue for a long time, cause pain or affect your food, sleep & daily routine.</p>
            </details>

            <details>
                <summary>Can lifestyle affect digestion?</summary>
                <p>Yes. Food habits, meal timings, water intake, stress, sleep & physical activity can affect your digestion. Speak with a qualified doctor if your problems continue.</p>
            </details>

            <details>
                <summary>Can gastric problems be different for different people?</summary>
                <p>Yes. The causes & symptoms can be different for every person. A doctor can understand your individual problems & suggest suitable care.</p>
            </details>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="cta-box">
            <div>
                <div class="eyebrow">Take the First Step</div>
                <h2>Ready to Feel Better?</h2>
                <p>If acidity, stomach pain, digestion problems, gas or bowel problems are affecting your daily life, book a consultation for personalized homeopathy care.</p>
            </div>

            <a class="btn" href="appointment.php">Book an Appointment</a>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>