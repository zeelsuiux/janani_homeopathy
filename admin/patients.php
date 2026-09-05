<?php require 'header.php'; $db=db_load(); $page_title='Patients'; $patients=$db['patients']; $canView=current_admin_can('view'); $canEdit=current_admin_can('edit'); $canDelete=current_admin_can('delete'); ?>
<div class="admin-top patients-toolbar">
    <h1>Patients</h1>
    <div class="patients-actions">
        <div class="patient-search">
            <input type="search" id="patientSearch" placeholder="Search name, patient no or mobile..." autocomplete="off" aria-label="Search patients">
        </div>
        <?php if ($canEdit): ?><a class="btn" href="patient-form.php">+ New Patient</a><?php endif; ?>
    </div>
</div>
<div class="table-wrap">
<table id="patientsTable">
<tr><th>Patient No</th><th>Name</th><th>DOB</th><th>Age</th><th>Mobile</th><th>Total Paid</th><th>Appointments</th><th>Actions</th></tr>
<?php foreach($patients as $p): $aps=array_values(array_filter($db['appointments'],fn($a)=>$a['patient_id']===$p['id'])); $paid=array_sum(array_map(fn($a)=>(float)($a['amount']??0),$aps)); ?>
<tr class="patient-row" data-search="<?=e(strtolower($p['number'].' '.$p['name'].' '.$p['mobile']))?>">
    <td><?=e($p['number'])?></td><td><?=e($p['name'])?></td><td><?=e(date_fmt($p['dob']))?></td><td><?=e($p['age'])?></td><td><?=e($p['mobile'])?></td><td>₹<?=number_format($paid,2)?></td><td><?=count($aps)?></td>
    <td><div class="actions"><?php if ($canView): ?><a class="btn btn-sm" href="patient-view.php?id=<?=e($p['id'])?>">View</a><?php endif; ?><?php if ($canEdit): ?><a class="btn btn-sm btn-outline" href="patient-form.php?id=<?=e($p['id'])?>">Edit</a><?php endif; ?><?php if ($canDelete): ?><a class="btn btn-sm btn-danger" href="patient-delete.php?id=<?=e($p['id'])?>" onclick="return confirm('Delete patient and appointments?')">Delete</a><?php endif; ?></div></td>
</tr>
<?php endforeach; ?>
<tr id="noPatientsFound" style="display:none"><td colspan="8" style="text-align:center;padding:30px">No patients found.</td></tr>
</table>
</div>
<script>
(function(){
    const search = document.getElementById('patientSearch');
    const rows = Array.from(document.querySelectorAll('.patient-row'));
    const empty = document.getElementById('noPatientsFound');
    if (!search) return;

    search.addEventListener('input', function(){
        const query = this.value.trim().toLowerCase();
        let visible = 0;
        rows.forEach(function(row){
            const match = !query || row.dataset.search.includes(query);
            row.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        empty.style.display = visible ? 'none' : '';
    });
})();
</script>
<?php require 'footer.php'; ?>
