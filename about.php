<?php require 'includes.php';
$s = settings();
$page_title = 'About Us | ' . $s['clinic_name'];
require 'header.php'; ?><section class="page-head">
    <div class="container">
        <h1 class="font-bold heading">About Us</h1>
        <p><?= e($s['tagline']) ?></p>
    </div>
</section>
<section class="section">
    <div class="container about-grid">
        <div><img class="about-img" src="assets/images/doctor.png" onerror="this.src='assets/images/logo.png'" alt="Doctor"></div>
        <div>
            <div class="designation-tag" style="width:fit-content">
                <div class="px-3 py-1 d-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-graduation-cap w-4 h-4 text-[]" aria-hidden="true">
                        <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"></path>
                        <path d="M22 10v6"></path>
                        <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"></path>
                    </svg>
                    <p class="m-0 ms-2" style="color: var(--primary);">Founder & Chief Physician</p>
                </div>
            </div>
            <h2 class="my-4 font-heading font-bold">
                Dr. Chirag Patel
            </h2>
            <div class="d-flex">
                <p class="px-2">
                    <span class="me-1">
                        <svg aria-hidden="true" width="18" height="18" class="e-font-icon-svg e-fas-check-circle" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="var(--primary)">
                            <path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
                        </svg> </span>BHMS
                </p>
                <p class="px-2">
                    <span class="me-1">
                        <svg aria-hidden="true" width="18" height="18" class="e-font-icon-svg e-fas-check-circle" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="var(--primary)">
                            <path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
                        </svg>
                    </span>
                    CCPH
                </p>
                <p class="px-2">
                    <span class="me-1">
                        <svg aria-hidden="true" width="18" height="18" class="e-font-icon-svg e-fas-check-circle" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="var(--primary)">
                            <path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
                        </svg>
                    </span>
                    SCPH
                </p>
                <p class="px-2">
                    <span class="me-1">
                        <svg aria-hidden="true" width="18" height="18" class="e-font-icon-svg e-fas-check-circle" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="var(--primary)">
                            <path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
                        </svg>
                    </span>
                    Consulting Homoeopath
                </p>
            </div>
            <div class="font-regular-italic" style="color:var(--muted)">
                <p>Dr. Chirag Patel is a <b>dedicated and experienced Homeopathic Doctor</b> practicing in <b>Surat</b>. With <b>over a decade of clinical experience</b>, he is committed to providing <b>personalized and holistic homoeopathic care</b>.</p>
                <p>
                    He completed his <b>BHMS</b> and has further enhanced his expertise through specialized training in Predictive Homoeopathy. Dr. Patel believes in <b>detailed case evaluation and regular follow-ups</b> to provide individualized care for every patient.
                </p>
            </div>
        </div>
    </div>
</section>
<?php require 'footer.php'; ?>