<?php require 'includes.php';
$s = settings();
$page_title = 'Mental Health Treatment | ' . $s['clinic_name'];
require 'header.php';
?>

<section class="treatment-hero">
    <div class="container treatment-hero-grid">
        <div>
            <div class="eyebrow">Homeopathy for Mental Health</div>
            <h1>Mental Health Problems</h1>
            <p>Stress, anxiety, mood changes & emotional problems can affect your daily life. Our personalized homeopathy treatment focuses on understanding your problems & supporting your overall mental well-being.</p>
            <div class="actions">
                <a class="btn" href="appointment.php">Book Consultation</a>
                <a class="btn btn-outline" href="contact.php">Consult Doctor</a>
            </div>
        </div>
        <div class="treatment-visual">
            <img src="assets/images/treatments/mental-diseases.png" alt="Mental health care">
            <div class="mini-card">
                <strong>Personalized Care</strong>
                <span>Personalized homeopathy treatment based on your mental, emotional & physical health.</span>
            </div>
        </div>
    </div>

</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Mental Health Care</div>
            <h2>Problems We Help With</h2>
            <p>Personalized homeopathy care for stress, anxiety, mood, sleep & emotional problems.</p>
        </div>
        <div class="feature-list">
            <?php foreach (
                [
                    ['Anxiety & Stress', 'Homeopathy support for excessive worry, nervousness, tension & stress that affects daily life.'],
                    ['Depression', 'Support for ongoing sadness, low mood, loss of interest & emotional tiredness.'],
                    ['Phobias & Fears', 'Personalized care for strong fears, anxiety & avoiding certain situations or things.'],
                    ['OCD', 'Support for repeated unwanted thoughts & repetitive actions or habits.'],
                    ['Panic Attacks', 'Care for sudden fear, breathing problems, fast heartbeat & other panic symptoms.'],
                    ['Sleep Problems', 'Support for difficulty sleeping, disturbed sleep, waking up often or an irregular sleep routine.'],
                    ['Mood & Behaviour Problems', 'Personalized care for mood changes, irritability, anger & emotional or behaviour problems.']
                ] as $conditionIndex => $condition
            ): ?>
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
            <div class="eyebrow">About Mental Health Problems</div>
            <h2>Your Mental Health Is Important</h2>
        </div>
        <div class="feature-list">
            <div class="feature-card">
                <div class="icon">✚</div>
                <h3>Understanding the Problem</h3>
                <p>Mental health problems can affect your thoughts, emotions, behaviour & daily life. Problems can be different for every person.</p>
            </div>

            <div class="feature-card">
                <div class="icon">✚</div>
                <h3>Common Problems</h3>
                <p>Anxiety, depression, stress, OCD, mood changes, fears & sleep problems are some common mental health concerns.</p>
            </div>

            <div class="feature-card">
                <div class="icon">✚</div>
                <h3>Personalized Care</h3>
                <p>We understand your symptoms, daily routine, possible triggers, habits & overall health to provide personalized homeopathy care.</p>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Symptoms & Possible Causes</div>
            <h2>Common Signs & Possible Reasons</h2>
        </div>
        <div class="two-col-grid">
            <div class="info-panel">
                <h2>Common symptoms include:</h2>
                <ul class="check-list">
                    <li>Ongoing sadness or low mood</li>
                    <li>Too much worry, fear or nervousness</li>
                    <li>Changes in sleep, appetite or energy</li>
                    <li>Difficulty focusing or remembering things</li>
                    <li>Frequent irritability, anger or emotional outbursts</li>
                    <li>Avoiding people or social activities</li>
                </ul>
            </div>

            <div class="info-panel">
                <h2>Possible reasons for these problems:</h2>
                <ul class="check-list">
                    <li>Stress, emotional pressure or difficult experiences</li>
                    <li>Family history</li>
                    <li>Changes in body or brain function</li>
                    <li>Unhealthy lifestyle or substance use</li>
                    <li>Long-term emotional stress or personal problems</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">Our Care Approach</div>
            <h2>Personalized Homeopathy Care</h2>
        </div>
        <div class="steps-grid">
            <div class="step-box">
                <span>01</span>
                <h3>Your Problem</h3>
                <p>We understand your symptoms, emotions, habits, lifestyle & overall health.</p>
            </div>

            <div class="step-box">
                <span>02</span>
                <h3>Personalized Treatment</h3>
                <p>We provide a personalized homeopathy treatment plan based on your individual symptoms & health needs.</p>
            </div>

            <div class="step-box">
                <span>03</span>
                <h3>Regular Follow-Up</h3>
                <p>Regular follow-ups help us understand your progress & provide ongoing support for your health.</p>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">FAQ</div>
            <h2>Frequently Asked Questions</h2>
        </div>
        <div class="faq-list">
            <details open>
                <summary>What are mental health problems?</summary>
                <p>Mental health problems can affect a person's thoughts, emotions, behaviour & daily life. They can include stress, anxiety, depression, mood problems & other conditions.</p>
            </details>

            <details>
                <summary>Can homeopathy help with mental health problems?</summary>
                <p>Homeopathy treatment is personalized based on your symptoms, emotional health, lifestyle & overall health. It should be taken under the guidance of a qualified doctor.</p>
            </details>

            <details>
                <summary>When should I consult a doctor?</summary>
                <p>You should consult a qualified doctor if stress, anxiety, sadness, fear, mood changes or sleep problems are regularly affecting your daily life.</p>
            </details>

            <details>
                <summary>How long does treatment take?</summary>
                <p>The time required can be different for every person & depends on the type of problem, its severity & individual health condition. Regular follow-ups are important.</p>
            </details>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="cta-box">
            <div>
                <div class="eyebrow">Take the First Step</div>
                <h2>Ready to Talk About Your Mental Health?</h2>
                <p>If stress, anxiety, mood changes or emotional problems are affecting your daily life, book a consultation with our doctor for personalized homeopathy care.</p>
            </div>
            <div class="actions">
                <a class="btn" href="appointment.php">Book an Appointment</a>
            </div>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>