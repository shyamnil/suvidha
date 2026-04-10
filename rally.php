<?php
/**
 * Template: Annexure-P3 (Rally/Procession) [cite: 40]
 */

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Annexure - P3', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 7, 'Permission for Rally/ Procession with/without Loud Speaker', 0, 1, 'C'); // [cite: 41]
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(100, 6, "Permission No: " . ($data['order_no'] ?? 'N/A'), 0, 0); // [cite: 42]
$pdf->Cell(0, 6, "Date: " . date('d/m/Y'), 0, 1, 'R'); // [cite: 43]
$pdf->Cell(0, 6, "SUVIDHA Application ID: " . $data['app_id'], 0, 1); // [cite: 44]
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 11);
$pdf->MultiCell(0, 6, "Sri/Smt. " . $data['name'] . " has applied on behalf of " . $data['role'] . " of " . $data['party'] . " for holding procession/rally."); // [cite: 45, 46, 48, 49]
$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, "1. Route of Rally / Procession: " . $data['route'], 0, 1); // 
$pdf->Cell(0, 6, "Date: " . $data['date'] . "  Time: " . $data['time'], 0, 1); // [cite: 54, 55]
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, "Permission is accorded under following conditions:", 0, 1); // [cite: 61]
$pdf->SetFont('Arial', '', 9);

$rules = [
    "1. Permission is given to put up " . ($data['flags'] ?? 0) . " Nos. of Flags and " . ($data['stickers'] ?? 0) . " Stickers on Vehicles.", // [cite: 62, 63, 65]
    "2. Convoy will not have more than 10 vehicles.", // 
    "3. Procession will follow the permitted route and time.", // [cite: 66]
    "4. Use of loudspeaker is completely prohibited between 10:00 P.M. to 6:00 A.M.", // [cite: 67]
    "5. No one will carry any weapon or intoxicating substance in the rally.", // 
    "6. Model Code of Conduct (MCC) issued by ECI must be strictly complied with.", // [cite: 72]
    "7. Motor Vehicles Act, 1988 and WB Motor Vehicles Rules, 1989 must be followed." // [cite: 74]
];

foreach ($rules as $rule) {
    $pdf->MultiCell(0, 5, $rule);
}

$pdf->Ln(15);
$pdf->Cell(0, 6, "Signature (RO)", 0, 1, 'R'); // [cite: 79, 80]
$pdf->Cell(0, 6, "Memo No: " . ($data['memo'] ?? '________'), 0, 0); // [cite: 81]
$pdf->Cell(0, 6, "Date: " . date('d/m/Y'), 0, 1, 'R'); // [cite: 82]