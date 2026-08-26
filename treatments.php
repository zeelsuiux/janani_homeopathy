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
        <h1>Our Treatments</h1>
        <p>Personalized care across a range of health concerns.</p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="cards"><?php foreach ($items as $x): ?><div class="card">
                    <div class="icon">✚</div>
                    <h3><?= e($x['title']) ?></h3>
                          <p>Consult with the doctor for an individualized assessment and treatment plan.</p><a class="btn btn-sm" style="margin-top:15px" href="<?= e($x['link']) ?>"><?= $x['link'] !== 'appointment.php' ? 'View Details' : 'Book Consultation' ?></a>
                </div><?php endforeach; ?></div>
    </div>
</section><?php require 'footer.php'; ?>