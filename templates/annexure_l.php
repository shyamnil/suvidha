<?php
/**
 * Template: Annexure-L (Loudspeaker Order)
 */

// --- HEADER SECTION ---
$pdf->SetFont('Arial', 'BU', 18);
$pdf->Cell(0, 10, 'Annexure-L', 0, 1, 'C');
$pdf->SetFont('Arial', 'BU', 14);
$pdf->Cell(0, 7, 'Order for use of loudspeaker', 0, 1, 'C');
$pdf->Ln(5);

// --- ORDER NO & DATED LINE ---
$pdf->SetFont('Arial', '', 11);
$pdf->Write(7, "Order No. ");
$pdf->SetFont('Arial', 'BU', 11);
$pdf->Write(7, $data['per_id']);
$pdf->SetFont('Arial', '', 11);

$pdf->SetX(-70); // Align Dated to the right side
$pdf->Write(7, "Dated: ");
$pdf->SetFont('Arial', 'BU', 11);
$pdf->Write(7, $data['per_date']);
$pdf->SetFont('Arial', '', 11);
$pdf->Ln(10);

// --- TRIPLE ALIGNMENT LINE (Application ID | Date | Time) ---
$w_third = 63;

// Application ID (Left)
$pdf->Write(7, "Application ID: ");
$pdf->SetFont('Arial', 'BU', 11);
$pdf->Write(7, $data['app_id']);
$pdf->SetFont('Arial', '', 11);

// Date (Middle - using SetX for precision)
$pdf->SetX(80); 
$pdf->Write(7, "Date: ");
$pdf->SetFont('Arial', 'BU', 11);
$pdf->Write(7, $data['app_date']);
$pdf->SetFont('Arial', '', 11);

// Time (Right)
$pdf->SetX(-85);
$pdf->Write(7, "Time: ");
$pdf->SetFont('Arial', 'BU', 11);
$pdf->Write(7, $data['app_time'] . " (AM/PM)");
$pdf->SetFont('Arial', '', 11);
$pdf->Ln(12);

// --- MAIN BODY PARAGRAPH (With Selective Underlining) ---
$pdf->SetFont('Arial', '', 11);

$pdf->Write(8, "Sri/Smt. ");
$pdf->SetFont('Arial', 'BU', 11);
$pdf->Write(8, $data['applicant_name']);
$pdf->SetFont('Arial', '', 11);

$pdf->Write(8, " (Name), Candidate/Representative of Candidate/Representative of ");
$pdf->SetFont('Arial', 'BU', 11);
$pdf->Write(8, $data['party']);
$pdf->SetFont('Arial', '', 11);

$pdf->Write(8, " Political Party of ");
$pdf->SetFont('Arial', 'BU', 11);
$pdf->Write(8, $data['ac_name']);
$pdf->SetFont('Arial', '', 11);

$pdf->Write(8, " AC is allowed to use loudspeaker on ");
$pdf->SetFont('Arial', 'BU', 11);
$pdf->Write(8, $data['event_date']);
$pdf->SetFont('Arial', '', 11);

$pdf->Write(8, " at ");
$pdf->SetFont('Arial', 'BU', 11);
$pdf->Write(8, $data['place']);
$pdf->SetFont('Arial', '', 11);

$pdf->Write(8, " (place) from ");
$pdf->SetFont('Arial', 'BU', 11);
$pdf->Write(8, date("h:i A", strtotime($data['evts_time'])));
$pdf->SetFont('Arial', '', 11);

$pdf->Write(8, " to ");
$pdf->SetFont('Arial', 'BU', 11);
$pdf->Write(8, date("h:i A", strtotime($data['end_time'])));
$pdf->SetFont('Arial', '', 11);
$pdf->Write(8, ".");
$pdf->Ln(12);

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
    "7. Permissible Ambient noise levels notified by the competent department and pollution control authorities should be maintained during the use of microphones. During the use of microphone in open air, sound limiter should be attached with amplifier for regulating noise level.",
    "8. In case of violation of any of the above conditions, the permission/order for use of loudspeaker will immediately be deemed to have been withdrawn and proceedings will be started against the applicant/organizer for violation of Model Code of Conduct and or appropriate laws."
];

foreach ($conditions as $line) {
    $pdf->MultiCell(0, 5, $line);
    $pdf->Ln(1);
}

// --- REJECTION REASON ---
$pdf->Ln(4);
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 7, "Order for use of loudspeaker is not issued due to following reason(s): _________________________________", 0, 1);

// --- SIGNATURE SECTION ---
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 6, "Signature of Sub-Divisional / Competent Authority", 0, 1, 'R');
$pdf->Cell(0, 6, "SUBDIVISION/DISTRICT: ",0, 1, 'L');
?>