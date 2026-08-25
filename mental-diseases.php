<?php require 'includes.php';
$s = settings();
$page_title = 'Mental Diseases | ' . $s['clinic_name'];
require 'header.php';
?>

<section class="treatment-hero">
    <div class="container treatment-hero-grid">
        <div>
            <div class="eyebrow">Homeopathic Psychiatric Care</div>
            <h1>Mental Diseases</h1>
            <p>Emotional imbalance, persistent stress, mood swings, and anxiety can deeply affect daily life. Our homeopathic approach focuses on understanding the root cause and supporting long-term emotional well-being.</p>
            <div class="actions">
                <a class="btn" href="appointment.php">Book Consultation</a>
                <a class="btn btn-outline" href="contact.php">Consult Doctor</a>
            </div>
            <div class="treatment-badges">
                <span>Anxiety</span>
                <span>Depression</span>
                <span>PTSD</span>
                <span>Bipolar</span>
                <span>OCD</span>
            </div>
        </div>

        <div class="treatment-visual">
            <img src="assets/images/doctor.jpg" onerror="this.src='assets/images/logo.png'" alt="Doctor consultation for mental diseases">
            <div class="mini-card">
                <strong>Personalized Care</strong>
                <span>Natural, gentle homeopathic treatment with a holistic view of mind and body.</span>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">What Are Mental Diseases?</div>
            <h2>When the mind needs care, healing should be compassionate and complete.</h2>
        </div>

        <div class="feature-list">
            <div class="feature-card">
                <div class="icon">✚</div>
                <h3>Understanding the Condition</h3>
                <p>Mental diseases include disorders that affect thoughts, emotions, behavior, and daily functioning. These conditions can range from mild stress and anxiety to deeper mood or behavioral disorders.</p>
            </div>

            <div class="feature-card">
                <div class="icon">✚</div>
                <h3>Common Examples</h3>
                <p>Anxiety disorders, depression, bipolar disorder, obsessive-compulsive disorder, and trauma-related conditions are among the most common mental health concerns seen in practice.</p>
            </div>

            <div class="feature-card">
                <div class="icon">✚</div>
                <h3>Holistic Recovery</h3>
                <p>With careful evaluation of the individual’s symptoms, life patterns, triggers, and habits, homeopathy aims to support balance and long-term emotional stability.</p>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Symptoms & Causes</div>
            <h2>Signs to watch for</h2>
        </div>

        <div class="two-col-grid">
            <div class="info-panel">
                <h2>Common symptoms include:</h2>
                <ul class="check-list">
                    <li>Persistent sadness, hopelessness, or low mood</li>
                    <li>Excessive worry, fear, or nervousness</li>
                    <li>Changes in sleep, appetite, or energy</li>
                    <li>Difficulty concentrating or remembering</li>
                    <li>Frequent irritability, anger, or emotional outbursts</li>
                    <li>Withdrawal from relationships or social activities</li>
                </ul>
            </div>

            <div class="info-panel">
                <h2>Possible causes may include:</h2>
                <ul class="check-list">
                    <li>Stress, trauma, or emotional pressure</li>
                    <li>Family history and genetic predisposition</li>
                    <li>Biological or chemical imbalances</li>
                    <li>Substance use or lifestyle imbalance</li>
                    <li>Long-term unresolved emotional issues</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">How Homeopathy Works</div>
            <h2>Gentle treatment with a root-cause approach</h2>
        </div>

        <div class="steps-grid">
            <div class="step-box">
                <span>01</span>
                <h3>Detailed Evaluation</h3>
                <p>Every person is assessed individually, including emotional patterns, triggers, habits, and physical health history.</p>
            </div>

            <div class="step-box">
                <span>02</span>
                <h3>Personalized Remedy</h3>
                <p>Homeopathic remedies are selected based on the patient’s unique symptom profile rather than a one-size-fits-all treatment.</p>
            </div>

            <div class="step-box">
                <span>03</span>
                <h3>Supportive Recovery</h3>
                <p>The goal is to improve emotional stability, restore balance, and reduce the intensity of recurring mental health symptoms.</p>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">FAQ</div>
            <h2>Frequently asked questions</h2>
        </div>

        <div class="faq-list">
            <details open>
                <summary>What are mental diseases?</summary>
                <p>Mental diseases are disorders that affect a person’s thinking, emotions, behavior, and overall functioning. They can range from anxiety and depression to more severe psychiatric conditions.</p>
            </details>

            <details>
                <summary>How can homeopathy help with mental health issues?</summary>
                <p>Homeopathy looks at the whole person, including emotional, mental, and physical symptoms. It aims to strengthen the body’s natural balance and address the underlying cause.</p>
            </details>

            <details>
                <summary>Are homeopathic treatments safe?</summary>
                <p>Homeopathic medicines are generally considered gentle and individualized. They are selected carefully and should be taken under professional guidance.</p>
            </details>

            <details>
                <summary>How long does treatment take?</summary>
                <p>Response time varies depending on the condition, its severity, and the individual. Consistent follow-up and personalized care are important for better outcomes.</p>
            </details>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="cta-box">
            <div>
                <div class="eyebrow">Take the first step</div>
                <h2>Ready to take control of your mental well-being?</h2>
                <p>If stress, anxiety, mood swings, or emotional imbalance are affecting your life, support is available through a careful and compassionate homeopathic consultation.</p>
            </div>
            <div class="actions">
                <a class="btn" href="appointment.php">Book an Appointment</a>
            </div>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>
