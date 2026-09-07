<?php require 'includes.php';
$s = settings();
$page_title = "Children's Problems | " . $s['clinic_name'];
require 'header.php';

$conditions = [
    ['Recurrent Cold & Cough', 'Support for frequent colds, cough, throat irritation & repeated breathing problems.'],
    ['Tonsillitis & Adenoids', 'Throat & nose problems that can cause repeated infections, swollen tonsils, snoring & breathing difficulties.'],
    ['Allergies', 'Support for repeated skin, nose, eye, food or breathing-related allergy problems.'],
    ['Asthma', 'A breathing problem that can cause wheezing, chest tightness & difficulty breathing.'],
    ['Digestive Problems', 'Support for stomach discomfort, indigestion, gas & other digestion problems.'],
    ['Constipation', 'A problem where passing stool becomes difficult, painful or less frequent.'],
    ['Bedwetting', 'Support for children who pass urine in bed during sleep.'],
    ['Skin Allergies & Eczema', 'Support for itchy, dry, sensitive, irritated or allergy-prone skin.'],
    ['Behavioural & Emotional Concerns', 'Support for emotional changes, fears, attention problems & behaviour-related concerns.'],
    ['Sleep Problems', 'Support for difficulty sleeping, restless sleep, nightmares & irregular sleep routines.'],
    ['Poor Appetite', 'Support for low appetite, fussy eating & eating habits affecting growth and energy.'],
    ['Recurrent Infections', 'Support for children who experience frequent infections or take longer to recover.']
];
?>

<section class="treatment-hero">
    <div class="container treatment-hero-grid">
        <div>
            <div class="eyebrow">Homeopathy for Children's Health</div>
            <h1>Children's Problems</h1>

            <p>Children need special care based on their age, growth, emotions, daily routine & individual health needs. Our personalized homeopathy care understands your child's symptoms, development, habits, family history & overall health.</p>

            <div class="actions">
                <a class="btn" href="appointment.php">Book Consultation</a>
                <a class="btn btn-outline" href="contact.php">Consult Doctor</a>
            </div>
        </div>

        <div class="treatment-visual">
            <img src="assets/images/treatments/childrens-problems.png" onerror="this.src='assets/images/doctor.png'" alt="Homeopathy care for children's health problems">
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Children's Health Care</div>
            <h2>Problems We Help With</h2>
            <p>Personalized homeopathy care for common breathing, digestion, skin, sleep & emotional problems in children.</p>
        </div>

        <div class="feature-list">
            <?php foreach ($conditions as $conditionIndex => $condition): ?>
                <div class="feature-card">
                    <div class="icon treatment-icon"><img src="assets/images/treatments/<?= e($condition[2] ?? 'children') ?>.jpg" alt="<?= e($condition[0]) ?>"></div>
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
            <div class="eyebrow">Common Child Health Problems</div>
            <h2>Signs to Discuss With a Doctor</h2>
        </div>

        <div class="two-col-grid">
            <div class="info-panel">
                <h2>Common problems include:</h2>

                <ul class="check-list">
                    <li>Frequent colds, cough, allergies or breathing problems</li>
                    <li>Repeated throat infections or swollen tonsils</li>
                    <li>Stomach problems, constipation or poor appetite</li>
                    <li>Itchy skin, eczema, rashes or skin allergies</li>
                    <li>Bedwetting, sleep problems or nightmares</li>
                    <li>Emotional, behaviour, attention or development concerns</li>
                </ul>
            </div>

            <div class="info-panel">
                <h2>Important things we consider:</h2>

                <ul class="check-list">
                    <li>Sleep routine, physical activity & screen time</li>
                    <li>Food habits, water intake & digestion</li>
                    <li>School, family & emotional environment</li>
                    <li>Allergies, infections & seasonal triggers</li>
                    <li>Growth, development & family health history</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Our Care Approach</div>
            <h2>Personalized Care for Growing Children</h2>
        </div>

        <div class="steps-grid">

            <div class="step-box">
                <span>01</span>
                <h3>Understanding Your Child's Problem</h3>
                <p>We understand your child's symptoms, growth, daily routine, habits, health history & family concerns.</p>
            </div>

            <div class="step-box">
                <span>02</span>
                <h3>Personalized Care</h3>
                <p>Care is planned according to your child's age, individual symptoms & overall health needs.</p>
            </div>

            <div class="step-box">
                <span>03</span>
                <h3>Regular Follow-Up</h3>
                <p>Regular follow-ups help us understand changes in symptoms, routine, growth & overall wellbeing.</p>
            </div>

        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="faq-list">

            <details open>
                <summary>When should I see a doctor for my child's health problem?</summary>
                <p>Consult a doctor if your child's symptoms happen often, continue for a long time, affect sleep or school, limit daily activities or cause concerns about growth & overall health.</p>
            </details>

            <details>
                <summary>When does a child need urgent medical help?</summary>
                <p>Seek urgent medical help for severe difficulty breathing, blue lips, unresponsiveness, seizures, severe dehydration, sudden weakness, serious injury or symptoms that get worse quickly.</p>
            </details>

            <details>
                <summary>How can parents support a child's health?</summary>
                <p>A regular sleep routine, healthy food, enough water, physical activity, emotional support & proper medical guidance can help support healthy growth & development.</p>
            </details>

        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="cta-box">
            <div>
                <div class="eyebrow">Take the First Step</div>
                <h2>Ready to Talk About Your Child's Health?</h2>
                <p>If your child has repeated breathing, digestion, skin, sleep, emotional or other health problems, book a consultation for personalized homeopathy care.</p>
            </div>

            <a class="btn" href="appointment.php">Book an Appointment</a>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>