<?php

require_once __DIR__ . '/../includes/functions.php';

$page_title = 'Homeopathy Treatment | Janani Homeopathy';

$page_description =
    'Learn about personalised homeopathy treatment and consultation at Janani Homeopathy with Dr. Chirag Patel.';

$active = 'services';

include __DIR__ . '/../includes/header.php';

?>

<!-- SERVICE HERO -->
<section class="service-detail-hero">

    <div class="container">

        <span class="eyebrow">
            OUR SERVICE
        </span>

        <h1>
            Homeopathy Treatment
        </h1>

        <p>
            Personalised homeopathic consultation focused on
            understanding your individual health concerns,
            history and lifestyle.
        </p>

        <div class="hero-actions">

            <a href="<?= e(url('contact.php')) ?>" class="btn btn-primary">
                Book a Consultation
            </a>

            <a href="<?= e(url('services.php')) ?>" class="btn btn-outline">
                View All Services
            </a>

        </div>

    </div>

</section>


<!-- INTRODUCTION -->
<section class="section">

    <div class="container service-content">

        <div class="service-main">

            <span class="eyebrow">
                ABOUT THE SERVICE
            </span>

            <h2>
                Personalised care that starts
                with understanding.
            </h2>

            <p>
                At Janani Homeopathy, every consultation
                begins with understanding the individual.
                We take time to discuss your concerns,
                health history, lifestyle, routine and
                other relevant factors.
            </p>

            <p>
                The purpose of the consultation is to
                understand your situation clearly and
                discuss an appropriate way forward based
                on your individual needs.
            </p>

        </div>


        <div class="service-highlight-card">

            <h3>
                Why choose our approach?
            </h3>

            <div class="highlight-item">
                <span>✓</span>
                <p>
                    Individualised consultation
                </p>
            </div>

            <div class="highlight-item">
                <span>✓</span>
                <p>
                    Detailed health history
                </p>
            </div>

            <div class="highlight-item">
                <span>✓</span>
                <p>
                    Lifestyle discussion
                </p>
            </div>

            <div class="highlight-item">
                <span>✓</span>
                <p>
                    Follow-up consultation
                </p>
            </div>

        </div>

    </div>

</section>


<!-- WHAT WE DISCUSS -->
<section class="section section-soft">

    <div class="container">

        <div class="section-head">

            <div>

                <span class="eyebrow">
                    CONSULTATION
                </span>

                <h2>
                    What we discuss
                </h2>

            </div>

        </div>


        <div class="service-feature-grid">

            <div class="feature-card">

                <div class="feature-number">
                    01
                </div>

                <h3>
                    Your Main Concern
                </h3>

                <p>
                    Understanding your current
                    symptoms, concerns and how they
                    affect your daily routine.
                </p>

            </div>


            <div class="feature-card">

                <div class="feature-number">
                    02
                </div>

                <h3>
                    Health History
                </h3>

                <p>
                    Discussing relevant health history,
                    previous treatments and other
                    important information.
                </p>

            </div>


            <div class="feature-card">

                <div class="feature-number">
                    03
                </div>

                <h3>
                    Lifestyle
                </h3>

                <p>
                    Understanding sleep, food habits,
                    routine, stress and other relevant
                    lifestyle factors.
                </p>

            </div>


            <div class="feature-card">

                <div class="feature-number">
                    04
                </div>

                <h3>
                    Follow-up
                </h3>

                <p>
                    Reviewing progress and discussing
                    the next appropriate steps.
                </p>

            </div>

        </div>

    </div>

</section>


<!-- CONSULTATION PROCESS -->
<section class="section">

    <div class="container">

        <div class="section-head">

            <div>

                <span class="eyebrow">
                    SIMPLE PROCESS
                </span>

                <h2>
                    What to expect
                </h2>

            </div>

        </div>


        <div class="consultation-steps">

            <div class="consultation-step">

                <span>01</span>

                <h3>
                    Consultation
                </h3>

                <p>
                    Discuss your concerns and health
                    history with the doctor.
                </p>

            </div>


            <div class="consultation-step">

                <span>02</span>

                <h3>
                    Understanding
                </h3>

                <p>
                    Relevant symptoms, routine and
                    lifestyle factors are discussed.
                </p>

            </div>


            <div class="consultation-step">

                <span>03</span>

                <h3>
                    Care Plan
                </h3>

                <p>
                    Appropriate next steps are
                    discussed based on your situation.
                </p>

            </div>


            <div class="consultation-step">

                <span>04</span>

                <h3>
                    Follow-up
                </h3>

                <p>
                    Progress can be reviewed during
                    subsequent consultations.
                </p>

            </div>

        </div>

    </div>

</section>


<!-- FAQ -->
<section class="section section-soft">

    <div class="container faq-container">

        <span class="eyebrow">
            FAQ
        </span>

        <h2>
            Frequently Asked Questions
        </h2>


        <details class="service-faq">

            <summary>
                What happens during the first consultation?
                <span>+</span>
            </summary>

            <p>
                The first consultation focuses on understanding
                your concerns, health history, lifestyle and
                other relevant information.
            </p>

        </details>


        <details class="service-faq">

            <summary>
                How long does a consultation take?
                <span>+</span>
            </summary>

            <p>
                Consultation duration can vary depending on
                the individual's concerns and the information
                that needs to be discussed.
            </p>

        </details>


        <details class="service-faq">

            <summary>
                Can I bring previous medical reports?
                <span>+</span>
            </summary>

            <p>
                Yes. Relevant reports, prescriptions and
                previous treatment information can help
                provide useful context during consultation.
            </p>

        </details>

    </div>

</section>


<!-- CTA -->
<section class="section">

    <div class="container">

        <div class="service-cta">

            <div>

                <span class="eyebrow">
                    READY TO TALK?
                </span>

                <h2>
                    Have a concern you'd like
                    to discuss?
                </h2>

                <p>
                    Get in touch with Janani Homeopathy
                    to enquire about a consultation.
                </p>

            </div>

            <a href="<?= e(url('contact.php')) ?>" class="btn btn-primary">
                Contact Us →
            </a>

        </div>

    </div>

</section>


<?php

include __DIR__ . '/../includes/footer.php';

?>