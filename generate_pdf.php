<?php
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);

require('fpdf/fpdf.php');

// In generate_pdf.php, update the data mapping:

$data = [
    'form_type'      => $_POST['form_type'] ?? 'annexure_l',
    'per_id'         => $_POST['per_id'] ?? 'N/A',
    'per_date'   => isset($_POST['per_date']) ? date("d-m-Y", strtotime($_POST['per_date'])) : '',
    'app_id'         => $_POST['app_id'] ?? 'N/A',
    'app_date'   => isset($_POST['app_date']) ? date("d-m-Y", strtotime($_POST['app_date'])) : '',
    'app_time'       => $_POST['app_time'] ?? '',
    'party'          => $_POST['party'] ?? '',
    'applicant_name' => $_POST['applicant_name'] ?? '',
    'candidate_name' => $_POST['candidate_name'] ?? '',
    'event_date' => isset($_POST['event_date']) ? date("d-m-Y", strtotime($_POST['event_date'])) : '',
    'evts_time'      => $_POST['evts_time'] ?? '',
    'place'          => $_POST['place'] ?? '',
    'end_time'       => $_POST['end_time'] ?? '',
    'venue'          => $_POST['venue'] ?? '',
    'route'          => $_POST['route'] ?? '',
    'flags'          => $_POST['flags'] ?? '0',
    'stickers'       => $_POST['stickers'] ?? '0',
    'ac_name' 		 => $_POST['ac_name'] ?? '',
	'police_station'  => $_POST['police_station'] ?? '',
	'block' 		 => $_POST['block'] ?? '',
];

$pdf = new FPDF('P', 'mm', 'A4');
// CRITICAL: Disable auto page break to keep content on one page
$pdf->SetAutoPageBreak(false); 
$pdf->AddPage();

$template_file = "templates/" . $data['form_type'] . ".php";
if (file_exists($template_file)) {
    include($template_file);
} else {
    $pdf->SetFont('Arial', 'BU', 16);
    $pdf->Cell(0, 10, "Template Not Found", 0, 1);
}

if (ob_get_length()) ob_end_clean();

$filename = strtoupper($data['form_type']) . "_" . $data['app_id'] . ".pdf";
// 'I' sends it to the browser/iframe preview
$pdf->Output('I', $filename);