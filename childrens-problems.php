<?php require 'includes.php';
$s = settings();
$page_title = "Children's Problems | " . $s['clinic_name'];
require 'header.php';
$conditions = [
    ['Recurrent Cold & Cough', 'Support for frequent colds, cough, throat irritation, and recurring respiratory discomfort.'],
    ['Tonsillitis & Adenoids', 'Care for recurring throat infections, enlarged tonsils, snoring, and related concerns.'],
    ['Allergies', 'Personalized support for recurring skin, nose, eye, food, or respiratory allergy symptoms.'],
    ['Asthma', 'Guidance for wheezing, breathlessness, chest tightness, and recurring asthma symptoms.'],
    ['Digestive Problems', 'Care for stomach discomfort, irregular digestion, gas, and other digestive complaints.'],
    ['Constipation', 'Support for infrequent, hard, painful, or uncomfortable bowel movements.'],
    ['Bedwetting', 'Compassionate guidance for nighttime bedwetting and related childhood concerns.'],
    ['Skin Allergies & Eczema', 'Gentle support for itchy, dry, sensitive, irritated, or allergy-prone skin.'],
    ['Behavioural & Emotional Concerns', 'Respectful care for emotional changes, attention concerns, fears, and behavioural challenges.'],
    ['Sleep Problems', 'Support for restless sleep, difficulty sleeping, nightmares, and irregular sleep routines.'],
    ['Poor Appetite', 'Guidance for low appetite, fussy eating, and concerns affecting healthy growth and energy.'],
    ['Recurrent Infections', 'Holistic support for children experiencing frequent infections or slow recovery.']
];
?>

<section class="treatment-hero">
    <div class="container treatment-hero-grid">
        <div>
            <div class="eyebrow">Homeopathic Child Care</div>
            <h1>Children&apos;s Problems</h1>
            <p>Children need care that respects their age, growth, emotions, routine, and individual constitution. Our personalized approach considers symptoms, development, habits, family history, and overall wellbeing.</p>
            <div class="actions"><a class="btn" href="appointment.php">Book Consultation</a><a class="btn btn-outline" href="contact.php">Consult Doctor</a></div>
            <div class="treatment-badges"><?php foreach ($conditions as $condition): ?><span><?= e($condition[0]) ?></span><?php endforeach; ?></div>
        </div>
        <div class="treatment-visual">
            <img src="assets/images/treatments/childrens-problems.png" onerror="this.src='assets/images/doctor.png'" alt="Children&apos;s health care">
            <div class="mini-card"><strong>Personalized Child Care</strong><span>Gentle, respectful support based on your child&apos;s symptoms, routine, development, and health history.</span></div>
        </div>
    </div>
</section>

<section class="section alt"><div class="container"><div class="section-head"><div class="eyebrow">Child Health Care</div><h2>Problems we support</h2><p>Individualized care for common childhood respiratory, digestive, skin, sleep, and emotional concerns.</p></div><div class="feature-list">
<?php foreach ($conditions as $conditionIndex => $condition): ?><div class="feature-card"><div class="icon treatment-icon"><?= treatment_icon($condition[0], $conditionIndex) ?></div><h3><?= e($condition[0]) ?></h3><p><?= e($condition[1]) ?></p></div><?php endforeach; ?>`
</div></div></section>

<section class="section"><div class="container"><div class="section-head"><div class="eyebrow">Child Health Signs</div><h2>Concerns to discuss with a doctor</h2></div><div class="two-col-grid"><div class="info-panel"><h2>Common concerns include:</h2><ul class="check-list"><li>Frequent colds, cough, allergies, or breathing symptoms</li><li>Recurring throat infections or enlarged tonsils</li><li>Digestive discomfort, constipation, or poor appetite</li><li>Itchy skin, eczema, rashes, or skin allergies</li><li>Bedwetting, sleep disturbance, or nightmares</li><li>Emotional, behavioural, attention, or developmental concerns</li></ul></div><div class="info-panel"><h2>Helpful health factors:</h2><ul class="check-list"><li>Sleep routine, activity, and screen time</li><li>Food habits, hydration, and digestion</li><li>School, family, and emotional environment</li><li>Allergy, infection, and seasonal triggers</li><li>Growth, development, and family history</li></ul></div></div></div></section>

<section class="section alt"><div class="container"><div class="section-head"><div class="eyebrow">Our Care Approach</div><h2>Thoughtful care for growing children</h2></div><div class="steps-grid"><div class="step-box"><span>01</span><h3>Detailed Evaluation</h3><p>We understand your child&apos;s symptoms, development, routine, habits, medical history, and family concerns.</p></div><div class="step-box"><span>02</span><h3>Personalized Plan</h3><p>Care is planned according to the child&apos;s age, individual symptoms, health pattern, and needs.</p></div><div class="step-box"><span>03</span><h3>Follow-up Support</h3><p>Regular follow-up helps monitor symptoms, growth, routine, comfort, and overall wellbeing.</p></div></div></div></section>

<section class="section"><div class="container"><div class="faq-list"><details open><summary>When should I consult for a child&apos;s health concern?</summary><p>Consult a doctor when symptoms are frequent, persistent, affecting sleep or school, limiting activity, or causing concern about growth and wellbeing.</p></details><details><summary>When do children need urgent medical care?</summary><p>Seek urgent medical attention for severe breathing difficulty, blue lips, unresponsiveness, seizures, severe dehydration, sudden weakness, serious injury, or rapidly worsening symptoms.</p></details><details><summary>How can parents support a child&apos;s health?</summary><p>A regular sleep routine, balanced food, hydration, movement, emotional support, and age-appropriate medical guidance can help support healthy development.</p></details></div></div></section>

<section class="section alt"><div class="container"><div class="cta-box"><div><div class="eyebrow">Take the first step</div><h2>Ready to discuss your child&apos;s health?</h2><p>Book a consultation for recurring, digestive, skin, sleep, emotional, or other childhood concerns.</p></div><a class="btn" href="appointment.php">Book an Appointment</a></div></div></section>

<?php require 'footer.php'; ?>
