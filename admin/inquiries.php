<?php require 'header.php'; $db=db_load(); if($_SERVER['REQUEST_METHOD']==='POST'){foreach($db['inquiries'] as &$i){if($i['id']===post('id'))$i['status']=post('status');}unset($i);db_save($db);redirect('inquiries.php');} ?>
<div class="admin-top"><h1>Inquiries</h1></div>
<div class="table-wrap"><table><tr><th>Date</th><th>Type</th><th>Name</th><th>Mobile</th><th>Email</th><th>Appointment</th><th>Message</th><th>Status</th><th>Action</th></tr>
<?php foreach(array_reverse($db['inquiries']) as $i): ?>
<?php $type=$i['type']??'Contact Inquiry'; ?>
<tr>
<td><?=e(date_fmt($i['created_at']))?></td>
<td><span class="badge"><?=e($type)?></span></td>
<td><?=e($i['name'])?></td>
<td><?=e($i['mobile'])?></td>
<td><?=e($i['email']??'')?></td>
<td><?php if($type==='Appointment Request' && !empty($i['appointment_date'])): ?><?=e(date_fmt($i['appointment_date']))?><br><small><?=e($i['appointment_time']??'')?></small><?php else: ?>-<?php endif; ?></td>
<td><?=e($i['message']??'')?></td>
<td><span class="badge"><?=e($i['status'])?></span></td>
<td><form method="post" class="actions"><input type="hidden" name="id" value="<?=e($i['id'])?>"><select name="status"><option <?=$i['status']==='New'?'selected':''?>>New</option><option <?=$i['status']==='Contacted'?'selected':''?>>Contacted</option><option <?=$i['status']==='Converted'?'selected':''?>>Converted</option><option <?=$i['status']==='Closed'?'selected':''?>>Closed</option></select><button class="btn btn-sm">Update</button><?php if($i['status']!=='Converted'): ?><a class="btn btn-sm btn-outline" href="inquiry-convert.php?id=<?=e($i['id'])?>">Convert to Patient</a><?php endif; ?></form></td>
</tr><?php endforeach; ?></table></div><?php require 'footer.php'; ?>