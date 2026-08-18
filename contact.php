<?php
require_once __DIR__ . '/includes/functions.php';
$page_title='Contact Us';$active='contact';
$success='';$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    verify_csrf();
    $name=trim($_POST['name']??'');$email=trim($_POST['email']??'');$phone=trim($_POST['phone']??'');$service=trim($_POST['service']??'');$message=trim($_POST['message']??'');
    if($name===''||$phone===''||$message==='') $error='Please fill in your name, phone and message.';
    elseif($email!==''&&!filter_var($email,FILTER_VALIDATE_EMAIL)) $error='Please enter a valid email address.';
    else{
        $data=db();$data['enquiries'][]=['id'=>next_id($data['enquiries']),'name'=>$name,'email'=>$email,'phone'=>$phone,'service'=>$service,'message'=>$message,'status'=>'new','created_at'=>date('Y-m-d H:i:s')];
        save_db($data);$success='Thank you. Your enquiry has been received.';
    }
}
include __DIR__ . '/includes/header.php';
?>
<section class="page-hero"><div class="container"><div class="breadcrumb"><a href="<?= e(url('index.php')) ?>">Home</a> / Contact</div><span class="eyebrow">Contact Janani</span><h1>Let’s start the conversation.</h1><p style="max-width:720px">Send your details and health concern. The clinic team can use the enquiry to get in touch with you.</p></div></section>
<section class="section"><div class="container contact-grid">
<div class="contact-card"><span class="eyebrow" style="background:rgba(255,255,255,.1);border-color:rgba(255,255,255,.15);color:#fff">Clinic Details</span><h2 style="color:#fff">Janani Homeopathy</h2><p><?= e(setting('tagline')) ?></p><div class="contact-item"><strong>Doctor</strong><?= e(setting('doctor_name')) ?></div><div class="contact-item"><strong>Location</strong><?= e(setting('city')) ?></div><?php if(setting('address')):?><div class="contact-item"><strong>Address</strong><?= e(setting('address')) ?></div><?php endif;?><?php if(setting('phone')):?><div class="contact-item"><strong>Phone</strong><a href="tel:<?= e(setting('phone')) ?>"><?= e(setting('phone')) ?></a></div><?php endif;?><?php if(setting('email')):?><div class="contact-item"><strong>Email</strong><a href="mailto:<?= e(setting('email')) ?>"><?= e(setting('email')) ?></a></div><?php endif;?></div>
<div class="form-card">
<?php if($success):?><div class="alert success"><?= e($success) ?></div><?php endif;?><?php if($error):?><div class="alert error"><?= e($error) ?></div><?php endif;?>
<form method="post"><?= csrf_field() ?><div class="form-grid">
<div class="field"><label for="name">Full Name *</label><input id="name" name="name" required></div>
<div class="field"><label for="phone">Phone *</label><input id="phone" name="phone" required></div>
<div class="field"><label for="email">Email</label><input id="email" type="email" name="email"></div>
<div class="field"><label for="service">Area of Concern</label><select id="service" name="service"><option value="">Select an option</option><?php foreach(['Homeopathy Treatment','Child Care','Women’s Health','Skin Problems','Hair Problems','Allergy Treatment','Lifestyle Disorders','General Consultation'] as $s):?><option><?=e($s)?></option><?php endforeach;?></select></div>
<div class="field full"><label for="message">How can we help? *</label><textarea id="message" name="message" required></textarea></div>
<div class="field full"><button class="btn btn-primary" type="submit">Send Enquiry ↗</button></div>
</div></form>
</div></div></section>
<?php include __DIR__ . '/includes/footer.php'; ?>
