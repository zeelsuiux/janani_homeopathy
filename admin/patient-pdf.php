<?php
require_once '../includes.php';
admin_required();
$db = db_load();
$id = (string)get('id');
$p = find_item($db['patients'], $id);
if (!$p) {
    http_response_code(404);
    exit('Patient not found.');
}
$aps = array_values(array_filter($db['appointments'], fn($a) => ($a['patient_id'] ?? '') === $p['id']));
$paid = array_sum(array_map(fn($a) => (float)($a['amount'] ?? 0), $aps));
$clinic = $db['settings'] ?? [];
$companyName = $clinic['clinic_name'] ?? 'Clinic';
$doctorName = $clinic['doctor_name'] ?? 'Doctor';
$phone = $clinic['phone'] ?? '';
$email = $clinic['email'] ?? '';
$address = $clinic['address'] ?? '';
header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Patient Report - <?= e($p['name'] ?? 'Patient') ?></title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #1a1a1a;
            margin: 0;
            background: #f7f9f8;
        }
        .page {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px 36px 24px;
            box-sizing: border-box;
        }
        .header {
            background: linear-gradient(135deg, #163f2d 0%, #2a6c52 100%);
            color: #fff;
            padding: 24px 28px;
            border-radius: 16px;
            margin-bottom: 22px;
            box-shadow: 0 8px 18px rgba(22, 63, 45, 0.15);
        }
        .header h1 {
            margin: 0 0 8px;
            font-size: 30px;
            letter-spacing: 0.5px;
        }
        .meta {
            font-size: 13px;
            color: rgba(255,255,255,0.9);
            line-height: 1.6;
        }
        .report-title {
            margin: 0 0 16px;
            font-size: 24px;
            color: #1d3e31;
            border-left: 5px solid #2d6a4f;
            padding-left: 12px;
        }
        .card {
            border: 1px solid #dfeae3;
            border-radius: 14px;
            background: #f9fbfa;
            padding: 18px 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(20, 55, 42, 0.04);
        }
        .grid {
            display: table;
            width: 100%;
            border-spacing: 0 10px;
        }
        .row { display: table-row; }
        .cell {
            display: table-cell;
            width: 50%;
            padding: 8px 10px 8px 0;
            vertical-align: top;
            font-size: 13px;
            color: #2b2b2b;
        }
        .label {
            display: inline-block;
            min-width: 110px;
            color: #4d695f;
            font-weight: bold;
        }
        h3 {
            margin: 0 0 10px;
            font-size: 18px;
            color: #1a3c30;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #dfe7e0;
            padding: 8px 10px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background: #edf6f1;
            color: #214d39;
            font-weight: bold;
        }
        td {
            background: #fff;
        }
        .badge {
            display: inline-block;
            background: #dff5e9;
            color: #1d5f3d;
            padding: 4px 8px;
            border-radius: 14px;
            font-size: 11px;
            font-weight: bold;
        }
        .total-box {
            display: inline-block;
            background: #eaf5ef;
            padding: 8px 12px;
            border-radius: 10px;
            color: #1d5f3d;
            font-weight: bold;
        }
        .no-print {
            margin-top: 20px;
            text-align: right;
        }
        .no-print button {
            background: #1d5f3d;
            color: #fff;
            border: none;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 13px;
            cursor: pointer;
        }
        @media print {
            body { margin: 0; background: #fff; }
            .page { max-width: 100%; padding: 0; }
            .no-print { display:none; }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="header">
            <h1><?= e($companyName) ?></h1>
            <div class="meta">
                <?= e($doctorName) ?><?php if ($phone): ?> | <?= e($phone) ?><?php endif; ?><?php if ($email): ?> | <?= e($email) ?><?php endif; ?><?php if ($address): ?> | <?= e($address) ?><?php endif; ?>
            </div>
        </div>

        <h2 class="report-title">Patient Medical Report</h2>
        <div class="card">
            <div class="grid">
                <div class="row">
                    <div class="cell"><span class="label">Patient Name:</span> <?= e($p['name'] ?? '-') ?></div>
                    <div class="cell"><span class="label">Patient No:</span> <?= e($p['number'] ?? '-') ?></div>
                </div>
                <div class="row">
                    <div class="cell"><span class="label">Mobile:</span> <?= e($p['mobile'] ?? '-') ?></div>
                    <div class="cell"><span class="label">DOB:</span> <?= e(date_fmt($p['dob'])) ?></div>
                </div>
                <div class="row">
                    <div class="cell"><span class="label">Age:</span> <?= e($p['age'] ?? '-') ?></div>
                    <div class="cell"><span class="label">Gender:</span> <?= e($p['gender'] ?? '-') ?></div>
                </div>
                <div class="row">
                    <div class="cell"><span class="label">Blood Group:</span> <?= e($p['blood_group'] ?? '-') ?></div>
                    <div class="cell"><span class="label">Total Paid:</span> <span class="total-box">₹<?= number_format($paid, 2) ?></span></div>
                </div>
                <div class="row">
                    <div class="cell" style="width:100%;"><span class="label">Address:</span> <?= e(($p['address'] ?? '') . ', ' . ($p['city'] ?? '') . ', ' . ($p['state'] ?? '') . ', ' . ($p['country'] ?? '')) ?></div>
                </div>
            </div>
        </div>

        <h3>Appointment History</h3>
        <div class="card">
            <?php if ($aps): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Appointment No</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Medicine</th>
                            <th>Instructions</th>
                            <th>Next Visit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($aps as $a): ?>
                            <tr>
                                <td><?= e($a['number'] ?? '-') ?></td>
                                <td><?= e(date_fmt($a['date'])) ?></td>
                                <td><?= e($a['time'] ?? '-') ?></td>
                                <td><span class="badge"><?= e($a['status'] ?? '-') ?></span></td>
                                <td>₹<?= number_format((float)($a['amount'] ?? 0), 2) ?></td>
                                <td><?= e($a['medicine'] ?? '-') ?></td>
                                <td><?= e($a['instructions'] ?? '-') ?></td>
                                <td><?= e($a['next_date'] ? date_fmt($a['next_date']) . ' ' . ($a['next_time'] ?? '') : '-') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No appointments recorded for this patient.</p>
            <?php endif; ?>
        </div>

        <div class="no-print">
            <button type="button" onclick="window.print();">Print / Save as PDF</button>
        </div>
    </div>
</body>
</html>
