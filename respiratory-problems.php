<?php require 'includes.php';
$s = settings();
$page_title = 'Respiratory Problems | ' . $s['clinic_name'];
require 'header.php';

$conditions = [
    ['Asthma', 'A breathing problem that can cause wheezing, chest tightness, breathlessness & repeated breathing problems.'],
    ['Allergic Rhinitis', 'An allergy problem that can cause sneezing, a blocked or runny nose & itching.'],
    ['Sinusitis', 'A sinus problem that can cause facial pressure, headache, blocked nose & discomfort.'],
    ['Recurrent Cold & Cough', 'Support for frequent colds, cough, throat irritation & repeated breathing problems.'],
    ['Bronchitis', 'A chest problem that can cause ongoing cough, mucus & chest discomfort.'],
    ['Tonsillitis', 'A throat problem that can cause throat pain, swollen tonsils & difficulty swallowing.'],
    ['Breathing Difficulties', 'Support for repeated breathlessness, chest discomfort & difficulty breathing.'],
    ['Recurrent Respiratory Infections', 'Support for frequent infections affecting the nose, throat or chest.']
];
?>

<section class="treatment-hero">
    <div class="container treatment-hero-grid">
        <div>
            <div class="eyebrow">Homeopathy for Breathing Problems</div>
            <h1>Respiratory Problems</h1>

            <p>Breathing problems can affect your energy, sleep, work & daily comfort. Our personalized homeopathy care understands your symptoms, possible triggers, health history, lifestyle & overall health.</p>

            <div class="actions">
                <a class="btn" href="appointment.php">Book Consultation</a>
                <a class="btn btn-outline" href="contact.php">Consult Doctor</a>
            </div>
        </div>

        <div class="treatment-visual">
            <img src="assets/images/treatments/respiratory-problems.png" onerror="this.src='assets/images/doctor.png'" alt="Homeopathy care for breathing problems">
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Breathing & Respiratory Care</div>
            <h2>Problems We Help With</h2>
            <p>Personalized homeopathy care for common nose, throat, breathing & chest problems.</p>
        </div>

        <div class="feature-list">
            <?php foreach ($conditions as $conditionIndex => $condition): ?>
                <div class="feature-card">
                    <div class="icon treatment-icon"><img src="assets/images/treatments/<?= e($condition[2] ?? 'respiratory') ?>.jpg" alt="<?= e($condition[0]) ?>"></div>
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
                    <li>Cough, wheezing or chest tightness</li>
                    <li>Difficulty breathing during activity or rest</li>
                    <li>Sneezing, blocked nose or runny nose</li>
                    <li>Sinus pressure, facial pain or headache</li>
                    <li>Throat pain, irritation or difficulty swallowing</li>
                    <li>Frequent colds, infections or slow recovery</li>
                </ul>
            </div>

            <div class="info-panel">
                <h2>Possible reasons for these problems:</h2>

                <ul class="check-list">
                    <li>Dust, pollen, smoke, pollution or weather changes</li>
                    <li>Allergies, infections or seasonal triggers</li>
                    <li>Family history or individual sensitivity</li>
                    <li>Stress, poor sleep or lifestyle problems</li>
                    <li>Workplace or environmental exposure</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Our Care Approach</div>
            <h2>Personalized Care for Better Breathing</h2>
        </div>

        <div class="steps-grid">

            <div class="step-box">
                <span>01</span>
                <h3>Your Problem</h3>
                <p>We understand your symptoms, possible triggers, medical reports, medicines, breathing history & daily routine.</p>
            </div>

            <div class="step-box">
                <span>02</span>
                <h3>Personalized Treatment</h3>
                <p>We provide personalized homeopathy care based on your symptoms & overall health needs.</p>
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
                <summary>When should I see a doctor for breathing problems?</summary>
                <p>Consult a doctor if you have frequent cough, wheezing, difficulty breathing, allergies, sinus problems or repeated infections that affect your sleep or daily life.</p>
            </details>

            <details>
                <summary>When do breathing problems need urgent medical help?</summary>
                <p>Seek urgent medical help for severe difficulty breathing, blue lips, chest pain, confusion, fainting, difficulty speaking because of breathlessness or symptoms that get worse quickly.</p>
            </details>

            <details>
                <summary>Can breathing problems have different triggers?</summary>
                <p>Yes. Dust, pollen, pollution, smoke, weather changes, allergies, infections, stress & other health problems can trigger symptoms. Ongoing problems should be checked by a qualified doctor.</p>
            </details>

        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="cta-box">
            <div>
                <div class="eyebrow">Take the First Step</div>
                <h2>Ready to Talk About Your Breathing Problems?</h2>
                <p>If asthma, allergies, sinus problems, cough, throat problems or breathing difficulties are affecting your daily life, book a consultation for personalized homeopathy care.</p>
            </div>

            <a class="btn" href="appointment.php">Book an Appointment</a>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>