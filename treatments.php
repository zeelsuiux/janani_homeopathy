<?php require 'includes.php';
$s = settings();
$page_title = 'Treatments | ' . $s['clinic_name'];
require 'header.php';
$items = [
    ['title' => 'Mental Wellness', 'link' => 'mental-diseases.php'],
    ['title' => 'Skin Diseases', 'link' => 'skin-diseases.php'],
    ['title' => 'Respiratory Diseases', 'link' => 'respiratory-problems.php'],
    ['title' => 'Gastrointestinal Diseases', 'link' => 'gastric-diseases.php'],
    ['title' => 'Neurological Disorders', 'link' => 'neurological-disorders.php'],
    ['title' => 'Autoimmune Disorders', 'link' => 'autoimmune-disorders.php'],
    ['title' => 'Joint Diseases', 'link' => 'bone-joint-diseases.php'],
    ['title' => 'Child Care', 'link' => 'childrens-problems.php'],
    ['title' => 'Male & Female Wellness', 'link' => 'gynaecological-problems.php'],
    ['title' => 'Kidney & Lifestyle Care', 'link' => 'appointment.php']
]; ?><section class="page-head">
    <div class="container">
        <h1 class="font-bold">Our Treatments</h1>
        <p>Personalized care across a range of health concerns.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/mental-diseases.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Mental Diseases</h3>
                    <p>
                        Emotional imbalance, persistent stress, mood swings, and anxiety can deeply aff...
                    </p>
                    <a class="btn" style="margin-top:15px" href="mental-diseases.php">View Service</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/gastric-diseases.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Gastric Diseases</h3>
                    <p>
                        Digestive problems can affect comfort, energy, sleep, and daily routine.
                    </p>
                    <a class="btn" style="margin-top:15px" href="gastric-diseases.php">View Service</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/skin-diseases.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Skin Diseases</h3>
                    <p>
                        Healthy skin reflects the well-being of the whole person.
                    </p>
                    <a class="btn" style="margin-top:15px" href="skin-diseases.php">View Service</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/gynaecological-problems.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Gynaecological Problems</h3>
                    <p>
                        Women's health concerns can affect the body, emotions, relationships, and daily life.
                    </p>
                    <a class="btn" style="margin-top:15px" href="gynaecological-problems.php">View Service</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/neurological-disorders.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Neurological Disorders</h3>
                    <p>
                        Nervous system concerns can affect movement, comfort, sleep, focus, and d...
                    </p>
                    <a class="btn" style="margin-top:15px" href="neurological-disorders.php">View Service</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/autoimmune-disorders.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Autoimmune Disorders</h3>
                    <p>
                        Autoimmune conditions can affect different parts of the body and may change over ...
                    </p>
                    <a class="btn" style="margin-top:15px" href="autoimmune-disorders.php">View Service</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/bone-joint-diseases.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Bone & Joint Diseases</h3>
                    <p>
                        Bone, joint, and muscle concerns can affect movement, comfort, work, and sleep
                    </p>
                    <a class="btn" style="margin-top:15px" href="bone-joint-diseases.php">View Service</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/respiratory-problems.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Respiratory Problems</h3>
                    <p>
                        Breathing and respiratory concerns can affect energy, sleep, work, & daily comfort.
                    </p>
                    <a class="btn" style="margin-top:15px" href="respiratory-problems.php">View Service</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card mb-4">
                    <div class="holographic-card">
                        <img src="assets/images/treatments/childrens-problems.png" alt="" class="w-100 " style="border-radius: 16px;">
                    </div>
                    <h3>Children's Problems</h3>
                    <p>
                        childhood health concerns can affect growth, development, comfort, and daily life.
                    </p>
                    <a class="btn" style="margin-top:15px" href="childrens-problems.php">View Service</a>
                </div>
            </div>
        </div>
    </div>
</section><?php require 'footer.php'; ?>