<?php require 'includes.php';
$s = settings();
$page_title = 'Respiratory Problems | ' . $s['clinic_name'];
require 'header.php';
$conditions = [
    ['Asthma', 'Personalized support for wheezing, chest tightness, breathlessness, and recurring asthma symptoms.'],
    ['Allergic Rhinitis', 'Care for sneezing, blocked or runny nose, itching, and allergy-related nasal symptoms.'],
    ['Sinusitis', 'Guidance for sinus pressure, facial discomfort, congestion, and recurring sinus complaints.'],
    ['Recurrent Cold & Cough', 'Support for frequent colds, cough, throat irritation, and recurring respiratory discomfort.'],
    ['Bronchitis', 'Individualized care for persistent cough, mucus, chest discomfort, and bronchial complaints.'],
    ['Tonsillitis', 'Support for recurring throat pain, swollen tonsils, difficulty swallowing, and irritation.'],
    ['Breathing Difficulties', 'Care for recurring breathlessness, chest discomfort, or breathing-related concerns.'],
    ['Recurrent Respiratory Infections', 'Holistic support for frequent infections affecting the nose, throat, or chest.']
];
?>

<section class="treatment-hero">
    <div class="container treatment-hero-grid">
        <div>
            <div class="eyebrow">Homeopathic Respiratory Care</div>
            <h1>Respiratory Problems</h1>
            <p>Breathing and respiratory concerns can affect energy, sleep, work, and daily comfort. Our personalized approach considers your symptoms, triggers, medical history, lifestyle, and overall health.</p>
            <div class="actions"><a class="btn" href="appointment.php">Book Consultation</a><a class="btn btn-outline" href="contact.php">Consult Doctor</a></div>
            <div class="treatment-badges"><?php foreach ($conditions as $condition): ?><span><?= e($condition[0]) ?></span><?php endforeach; ?></div>
        </div>
        <div class="treatment-visual">
            <img src="assets/images/doctor.jpg" onerror="this.src='assets/images/logo.png'" alt="Doctor consultation for respiratory problems">
            <div class="mini-card"><strong>Personalized Respiratory Care</strong><span>Support based on your symptoms, triggers, respiratory history, and individual health needs.</span></div>
        </div>
    </div>
</section>

<section class="section alt"><div class="container"><div class="section-head"><div class="eyebrow">Respiratory Health Care</div><h2>Conditions we support</h2><p>Individualized care for common nose, throat, airway, and chest-related concerns.</p></div><div class="feature-list">
<?php foreach ($conditions as $condition): ?><div class="feature-card"><div class="icon">✚</div><h3><?= e($condition[0]) ?></h3><p><?= e($condition[1]) ?></p></div><?php endforeach; ?>
</div></div></section>

<section class="section"><div class="container"><div class="section-head"><div class="eyebrow">Symptoms &amp; Triggers</div><h2>Signs to discuss with a doctor</h2></div><div class="two-col-grid"><div class="info-panel"><h2>Common symptoms include:</h2><ul class="check-list"><li>Cough, wheezing, or chest tightness</li><li>Breathlessness during activity or rest</li><li>Sneezing, blocked nose, or nasal discharge</li><li>Sinus pressure, facial pain, or headache</li><li>Throat pain, irritation, or difficulty swallowing</li><li>Frequent colds, infections, or slow recovery</li></ul></div><div class="info-panel"><h2>Possible contributing factors:</h2><ul class="check-list"><li>Dust, pollen, smoke, pollution, or weather changes</li><li>Allergies, infections, or seasonal triggers</li><li>Family history and individual sensitivity</li><li>Stress, poor sleep, or lifestyle imbalance</li><li>Workplace or environmental exposure</li></ul></div></div></div></section>

<section class="section alt"><div class="container"><div class="section-head"><div class="eyebrow">Our Care Approach</div><h2>Thoughtful support for easier breathing</h2></div><div class="steps-grid"><div class="step-box"><span>01</span><h3>Detailed Evaluation</h3><p>We understand your symptoms, triggers, reports, medicines, respiratory history, and daily routine.</p></div><div class="step-box"><span>02</span><h3>Personalized Plan</h3><p>Your supportive care plan is selected according to your individual symptoms and overall health needs.</p></div><div class="step-box"><span>03</span><h3>Follow-up Support</h3><p>Regular follow-up helps monitor symptoms, triggers, comfort, and progress over time.</p></div></div></div></section>

<section class="section"><div class="container"><div class="faq-list"><details open><summary>When should I consult for respiratory symptoms?</summary><p>Consult a doctor for recurring cough, wheezing, breathlessness, allergies, sinus symptoms, or infections affecting sleep and daily activities.</p></details><details><summary>When do breathing problems need urgent care?</summary><p>Seek urgent medical attention for severe breathlessness, blue lips, chest pain, confusion, fainting, inability to speak comfortably, or rapidly worsening symptoms.</p></details><details><summary>Can respiratory symptoms have different triggers?</summary><p>Yes. Allergens, infections, pollution, smoke, weather, activity, stress, and other health factors may contribute. Persistent symptoms should be evaluated by a qualified doctor.</p></details></div></div></section>

<section class="section alt"><div class="container"><div class="cta-box"><div><div class="eyebrow">Take the first step</div><h2>Ready to discuss your breathing concerns?</h2><p>Book a consultation for asthma, allergies, sinus, cough, throat, or recurring respiratory concerns.</p></div><a class="btn" href="appointment.php">Book an Appointment</a></div></div></section>

<?php require 'footer.php'; ?>
