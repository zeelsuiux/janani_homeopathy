<?php
require_once '../includes.php';
admin_require_permission('view');

$collectionLabels = [
    'all' => 'All operational data',
    'patients' => 'Patients',
    'appointments' => 'Appointments',
    'inquiries' => 'Inquiries',
    'blogs' => 'Blogs',
    'gallery' => 'Gallery',
    'before_after' => 'Before & After',
    'testimonial_videos' => 'Testimonial Videos',
    'finance' => 'Finance',
    'activities' => 'Activity Log',
    'results' => 'Legacy Results',
];
$exportCollections = array_keys($collectionLabels);

function export_date(array $record, string $collection): string
{
    if ($collection === 'finance') return (string)($record['date'] ?? $record['created_at'] ?? '');
    if ($collection === 'appointments') return (string)($record['date'] ?? $record['created_at'] ?? '');
    if ($collection === 'inquiries') return (string)($record['appointment_date'] ?? $record['created_at'] ?? '');
    return (string)($record['created_at'] ?? '');
}
function export_flatten(array $record, string $prefix = '', string $collection = ''): array
{
    $flat = [];
    foreach ($record as $key => $value) {
        $keyName = strtolower((string)$key);
        if (preg_match('/(^|_)(path|image|video|photo)(_|$)/', $keyName) || in_array($keyName, ['updated_at', 'deleted_at', 'permanent_first_seen_at', 'permanent_updated_at'], true) || ($keyName === 'created_at' && $collection !== 'activities')) continue;
        $name = $prefix === '' ? (string)$key : $prefix . '.' . $key;
        if (is_array($value)) $flat += export_flatten($value, $name, $collection);
        else $flat[$name] = is_bool($value) ? ($value ? 'Yes' : 'No') : (string)$value;
    }
    if ($collection === 'activities' && $prefix === '' && !empty($record['created_at'])) {
        $timestamp = strtotime((string)$record['created_at']);
        if ($timestamp !== false) {
            $flat['activity_date'] = date('Y-m-d', $timestamp);
            $flat['activity_time'] = date('H:i:s', $timestamp);
        }
    }
    return $flat;
}
function export_csv_content(array $rows): string
{
    $headers = [];
    foreach ($rows as $row) foreach (array_keys($row) as $key) if (!in_array($key, $headers, true)) $headers[] = $key;
    if (!$headers) $headers = ['message'];
    $stream = fopen('php://temp', 'w+');
    fwrite($stream, "\xEF\xBB\xBF");
    $output = $stream;
    fputcsv($output, $headers);
    foreach ($rows as $row) {
        $line = [];
        foreach ($headers as $header) $line[] = $row[$header] ?? '';
        fputcsv($output, $line);
    }
    rewind($stream);
    $content = stream_get_contents($stream);
    fclose($stream);
    return $content;
}
function export_csv(array $rows, string $filename): never
{
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    echo export_csv_content($rows);
    exit;
}
function export_json(array $rows, string $filename): never
{
    header('Content-Type: application/json; charset=UTF-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    echo json_encode(array_values($rows), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL;
    exit;
}
function export_zip(array $files, string $filename): never
{
    $zipPath = tempnam(sys_get_temp_dir(), 'clinic-export-');
    $zip = new ZipArchive();
    if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) exit('Unable to create export archive.');
    foreach ($files as $name => $rows) $zip->addFromString($name . '.csv', export_csv_content($rows));
    $zip->close();
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    readfile($zipPath);
    @unlink($zipPath);
    exit;
}
function export_json_zip(array $files, string $filename): never
{
    $zipPath = tempnam(sys_get_temp_dir(), 'clinic-json-');
    $zip = new ZipArchive();
    if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) exit('Unable to create JSON archive.');
    foreach ($files as $name => $rows) $zip->addFromString($name . '.json', json_encode(array_values($rows), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL);
    $zip->close();
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    readfile($zipPath);
    @unlink($zipPath);
    exit;
}
function xlsx_xml(string $value): string
{
    $value = iconv('UTF-8', 'UTF-8//IGNORE', $value) ?: '';
    $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F]/u', '', $value) ?? '';
    return htmlspecialchars($value, ENT_XML1 | ENT_COMPAT, 'UTF-8');
}
function xlsx_column(int $number): string
{
    $column = '';
    while ($number > 0) {
        $remainder = ($number - 1) % 26;
        $column = chr(65 + $remainder) . $column;
        $number = intdiv($number - 1, 26);
    }
    return $column;
}
function xlsx_sheet(array $rows): string
{
    $headers = [];
    foreach ($rows as $row) foreach (array_keys($row) as $key) if (!in_array($key, $headers, true)) $headers[] = $key;
    if (!$headers) $headers = ['message'];
    if (!$rows) $rows[] = ['message' => 'No records found for this date range.'];
    $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main"><sheetData>';
    $allRows = [array_combine($headers, $headers), ...$rows];
    foreach ($allRows as $rowNumber => $row) {
        $xml .= '<row r="' . ($rowNumber + 1) . '">';
        $columnNumber = 1;
        foreach ($headers as $header) {
            $cell = (string)($row[$header] ?? '');
            $reference = xlsx_column($columnNumber++) . ($rowNumber + 1);
            $xml .= '<c r="' . $reference . '" t="inlineStr"><is><t>' . xlsx_xml($cell) . '</t></is></c>';
        }
        $xml .= '</row>';
    }
    return $xml . '</sheetData></worksheet>';
}
function export_xlsx(array $files, array $labels, string $filename): never
{
    $zipPath = tempnam(sys_get_temp_dir(), 'clinic-xlsx-');
    $zip = new ZipArchive();
    if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) exit('Unable to create Excel workbook.');
    $workbookSheets = '';
    $workbookRelations = '';
    $contentTypes = '<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types"><Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/><Default Extension="xml" ContentType="application/xml"/><Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>';
    $index = 1;
    foreach ($files as $collection => $rows) {
        $sheetName = str_replace(['\\', '/', ':', '*', '?', '[', ']'], '', (string)($labels[$collection] ?? $collection));
        $sheetName = substr($sheetName ?: 'Sheet' . $index, 0, 31);
        $workbookSheets .= '<sheet name="' . xlsx_xml($sheetName) . '" sheetId="' . $index . '" r:id="rId' . $index . '"/>';
        $workbookRelations .= '<Relationship Id="rId' . $index . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet' . $index . '.xml"/>';
        $contentTypes .= '<Override PartName="/xl/worksheets/sheet' . $index . '.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>';
        $zip->addFromString('xl/worksheets/sheet' . $index . '.xml', xlsx_sheet($rows));
        $index++;
    }
    $contentTypes .= '</Types>';
    $zip->addFromString('[Content_Types].xml', $contentTypes);
    $zip->addFromString('_rels/.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/></Relationships>');
    $zip->addFromString('xl/workbook.xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"><sheets>' . $workbookSheets . '</sheets></workbook>');
    $zip->addFromString('xl/_rels/workbook.xml.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">' . $workbookRelations . '</Relationships>');
    $zip->close();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    readfile($zipPath);
    @unlink($zipPath);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && post('action') === 'export') {
    $selectedCollection = (string)post('collection', 'all');
    $format = (string)post('format', 'xlsx');
    $from = trim((string)post('from_date'));
    $to = trim((string)post('to_date'));
    if (!in_array($selectedCollection, $exportCollections, true)) $selectedCollection = 'all';
    $db = db_load();
    $collections = $selectedCollection === 'all' ? array_values(array_diff($exportCollections, ['all'])) : [$selectedCollection];
    $exportFiles = [];
    foreach ($collections as $collection) {
        $rows = [];
        $records = $collection === 'finance' ? ($db['finance']['entries'] ?? []) : ($db[$collection] ?? []);
        if (!is_array($records)) continue;
        foreach ($records as $record) {
            if (!is_array($record)) continue;
            $recordDate = substr(export_date($record, $collection), 0, 10);
            if ($from !== '' && ($recordDate === '' || $recordDate < $from)) continue;
            if ($to !== '' && ($recordDate === '' || $recordDate > $to)) continue;
            $rows[] = export_flatten($record, '', $collection);
        }
        $exportFiles[$collection] = $rows;
    }
    $suffix = ($from ?: 'all') . '-to-' . ($to ?: 'all');
    if (!in_array($format, ['xlsx', 'csv', 'json'], true)) $format = 'xlsx';
    if ($selectedCollection === 'all' && $format === 'xlsx') export_xlsx($exportFiles, $collectionLabels, 'clinic-data-' . $suffix . '.xlsx');
    if ($selectedCollection === 'all' && $format === 'json') export_json_zip($exportFiles, 'clinic-data-' . $suffix . '-json.zip');
    if ($format === 'json') export_json($exportFiles[$selectedCollection] ?? [], 'clinic-' . $selectedCollection . '-' . $suffix . '.json');
    export_csv($exportFiles[$selectedCollection] ?? [], 'clinic-' . $selectedCollection . '-' . $suffix . '.csv');
}

$page_title = 'Export Data | Admin';
require 'header.php';
?>
<div class="gallery-page-head"><h1>Export Data</h1></div>
<div class="form-card export-card">
    <p class="eyebrow">Excel-compatible export</p>
    <h2>Choose data and date range</h2>
    <p class="export-help">Choose Excel or JSON. All operational data creates separate collection sheets/files, while a single data type downloads one file. Date filters are inclusive.</p>
    <form method="post">
        <input type="hidden" name="action" value="export">
        <div class="export-fields">
            <div class="field"><label for="exportCollection">Data</label><select id="exportCollection" name="collection" data-searchable="true" data-search-placeholder="Search data..."><?php foreach ($collectionLabels as $value => $label): ?><option value="<?= e($value) ?>" <?= $value === 'all' ? 'selected' : '' ?>><?= e($label) ?></option><?php endforeach; ?></select></div>
            <div class="export-date-fields"><div class="field"><label for="exportFrom">From date</label><input id="exportFrom" type="date" name="from_date"></div><div class="field"><label for="exportTo">To date</label><input id="exportTo" type="date" name="to_date"></div></div>
        </div>
        <div class="export-actions"><button class="btn" type="submit" name="format" value="xlsx">Download Excel</button><button class="btn btn-outline" type="submit" name="format" value="json">Download JSON</button></div>
    </form>
</div>
<?php require 'footer.php'; ?>
