<?php
/**
 * Template: Annexure-L (Loudspeaker Order)
 * This file is included inside generate_pdf.php
 */

// --- HEADER SECTION ---
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Annexure-L', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 7, 'Order for use of loudspeaker', 0, 1, 'C');
$pdf->Ln(5);

// --- ORDER DETAILS ---
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(100, 7, "Order No. " . $data['order_no'] . " Dated: " . $data['dated'], 0, 1);
$pdf->Cell(100, 7, "Application ID: " . $data['app_id'], 0, 0);
$pdf->Cell(0, 7, "Date: " . $data['date'] . " Time: " . $data['time'], 0, 1, 'R');
$pdf->Ln(8);

// --- DYNAMIC PERMISSION TEXT ---
$pdf->SetFont('Arial', '', 12);

// Construct the main paragraph
$nameStr = "Sri/Smt. " . $data['name'] . " (" . $data['role'] . ") of " . $data['party'];
$acStr = "Political Party of " . $data['ac_name'] . " AC";
$permissionStr = "$nameStr of $acStr is allowed to use loudspeaker on " . $data['use_date'] . 
                 " at " . $data['place'] . " from " . $data['time_from'] . " to " . $data['time_to'] . ".";

$pdf->MultiCell(0, 8, $permissionStr);
$pdf->Ln(5);

// --- CONDITIONS ---
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 8, "Order for use of loud speaker is issued on the following condition:", 0, 1);
$pdf->SetFont('Arial', '', 10);

$conditions = [
    "1. Loudspeaker will only be used between the times allowed.",
    "2. Use of loudspeaker is completely prohibited between 10:00 P.M. to 6:00 A.M.",
    "3. All directions issued by the Pollution Control Board, West Bengal in connection with the use of loudspeaker should be followed strictly.",
    "4. No person should make any inflammatory speech through the use of loudspeaker or otherwise which will hurt the feelings and sentiments of any religious group or section of society.",
    "5. The Model Code of Conduct issued by the ECI and its clarifications issued from time to time will have to be strictly complied with during the use of loud speaker.",
    "6. In case of any violation and disturbance of law and order due to use of the loudspeaker, the applicant/organizer will be held responsible.",
    "7. Permissible Ambient noise levels notified by the competent department and pollution control authorities should be maintained. During open air use, sound limiter should be attached.",
    "8. In case of violation, permission will immediately be deemed withdrawn and legal proceedings will start."
];

foreach ($conditions as $line) {
    $pdf->MultiCell(0, 6, $line);
    $pdf->Ln(1);
}

// --- REJECTION REASON (IF ANY) ---
$pdf->Ln(5);
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 7, "Order for use of loudspeaker is not issued due to following reason(s): ________________", 0, 1);

// --- SIGNATURE SECTION ---
$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 6, "Signature of Sub-Divisional/Competent Authority", 0, 1, 'R');
$pdf->Cell(0, 6, "SUBDIVISION/DISTRICT: " . strtoupper($data['district']), 0, 1, 'R');
?>