<?php require 'header.php'; $db=db_load(); $id=get('id'); $inq=find_item($db['inquiries'],$id); if(!$inq) redirect('inquiries.php');
$nameKey = strtolower(preg_replace('/\s+/', ' ', trim((string)($inq['name'] ?? ''))));
$mobileKey = preg_replace('/\D+/', '', (string)($inq['mobile'] ?? ''));
foreach (($db['patients'] ?? []) as $patient) {
    $existingNameKey = strtolower(preg_replace('/\s+/', ' ', trim((string)($patient['name'] ?? ''))));
    $existingMobileKey = preg_replace('/\D+/', '', (string)($patient['mobile'] ?? ''));
    if ($nameKey !== '' && $mobileKey !== '' && $nameKey === $existingNameKey && $mobileKey === $existingMobileKey) {
        redirect('inquiries.php?error=' . urlencode('Patient already exists with same name and mobile number. Conversion not allowed.'));
    }
}
$patientId=make_id();
$p=['id'=>$patientId,'number'=>next_number($db['patients'],'PAT-'),'name'=>$inq['name'],'dob'=>$inq['dob']??'','age'=>(int)($inq['age']??0),'city'=>$inq['city']??'','state'=>$inq['state']??'','country'=>$inq['country']??'India','address'=>$inq['address']??'','mobile'=>$inq['mobile'],'gender'=>$inq['gender']??'','blood_group'=>$inq['blood_group']??'','created_at'=>now_iso(),'source_inquiry_id'=>$id];
$db['patients'][]=$p;
if(($inq['type']??'Contact Inquiry')==='Appointment Request' && !empty($inq['appointment_date'])){
  $db['appointments'][]=['id'=>make_id(),'number'=>next_number($db['appointments'],'APT-'),'patient_id'=>$patientId,'date'=>$inq['appointment_date'],'time'=>$inq['appointment_time']??'','status'=>'Scheduled','amount'=>0,'medicine'=>'','instructions'=>'','next_date'=>'','created_at'=>now_iso(),'source_inquiry_id'=>$id];
}
foreach($db['inquiries'] as &$i){if($i['id']===$id)$i['status']='Converted';}unset($i); db_save($db); redirect('patient-form.php?id='.$patientId);
