<?php
/**
 * Template: Annexure-P3 (Rally Order) - Corrected & Updated
 */

// --- HEADER SECTION ---
$pdf->SetFont('Arial', 'BU', 14);
$pdf->Cell(0, 10, 'Annexure-P3', 0, 1, 'C');
$pdf->SetFont('Arial', 'BU', 12);
$pdf->Cell(0, 7, 'Permission for Rally/ Procession with/ without Loud Speaker', 0, 1, 'C');
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

// --- SUVIDHA APP ID ---
$pdf->SetFont('Arial', '', 9);
$pdf->Write(7, "SUVIDHA Application ID: ");
$pdf->SetFont('Arial', 'B', 9);
$pdf->Write(7, $data['app_id']);
$pdf->Ln(5);

// --- APPLICANT DETAILS ---
$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, "Sri/Smt. ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, $data['applicant_name']);
$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, " Has applied on behalf of, ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, $data['candidate_name']);
$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, ", Candidate/Election Agent/ Candidate's Representative / Poiltical party's Representative of ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, $data['party']);
$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, " for holding procession/ rally.");
$pdf->Ln(12);

// --- ROUTE & TIME ---
$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, "1. Route of Rally / Procession (AC, Block, PS to be mentioned): ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->MultiCell(0, 7, $data['place'] . " / AC - " . $data['ac_name'] . " / PS - " . $data['police_station'], 0, 'L');
$pdf->Ln(2);

$pdf->SetFont('Arial', '', 9);
// 1. Write the Date label and value (Width of 90mm keeps it on the left)
$pdf->Cell(20, 8, "2. Date: ", 0, 0, 'L'); 
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Cell(70, 8, $data['events_date'], 0, 0, 'L'); 

// 2. Jump to the right side (e.g., 120mm from the left edge)
$pdf->SetX(120); 

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(20, 8, "3. Time: ", 0, 0, 'L');
$pdf->SetFont('Arial', 'BU', 9);

// 3. Format and display the time range
$time_range = date("h:i A", strtotime($data['evts_time'])) . " to " . date("h:i A", strtotime($data['end_time']));
$pdf->Cell(0, 8, $time_range, 0, 1, 'L'); // '1' at the end moves to the next line
$pdf->Ln(5);
// --- OBJECTION SECTION ---
$pdf->SetFont('Arial', '', 9);

// Line for No Objection
$pdf->Cell(0, 7, "[  ] No Objection has been received from the competent Authorities on all relevant points", 0, 1);

// Line for Objection Received
$pdf->Write(7, "[  ] Objection has been received from the following Authority(s):");
$pdf->Ln(7);

$pdf->Write(7, "Authority ");
$pdf->SetFont('Arial', 'B', 9);
// If no objection, this will print dots; otherwise, the authority name
$pdf->Write(7, !empty($data['obj_authority']) ? $data['obj_authority'] : "..................................");

$pdf->SetFont('Arial', '', 9);
$pdf->Write(7, " Reason cited, ");
$pdf->SetFont('Arial', 'B', 9);
$pdf->Write(7, !empty($data['obj_reason']) ? $data['obj_reason'] : "...........................................................................");
$pdf->Ln(10);

// --- PERMISSION ACCORDED STATEMENT ---
$pdf->SetFont('Arial', '', 9);
$pdf->Write(7, "Hence, Permission is accorded to hold the said meeting/rally with/without loudspeaker under following conditions:-");
$pdf->Ln(8);
$conditions = [
    "1. Permission is given to put up " . $data['flags'] . " Nos. of Flags and " . $data['stickers'] . " Nos. of Stickers on Vehicles.",
    "2. In the Rally/ procession convoy will not have more than 10 vehicles.",
    "3. Rally / Procession will be between the permitted time and place following the permitted route to use.",
    "4. Use of loudspeaker is completely prohibited between 10:00 P.M.to 6:00 A.M.",
    "5. Use of loudspeakers will be governed by the guideline issued by the Pollution Control Board, West Bengal.",
    "6. Flags, Banners and other items to be used in the Rally/procession will be as per the specifications issued by the ECI.",
    "7. No one will carry any weapon or intoxicating substance in the rally nor will participate in the intoxicated state.",
    "8. The applicant/ organiser will ensure that no one in the Rally/procession will make any inflammatory speech that will hurt the sentiment and feelings of any religions group or section of society.",
    "9. The model code of conduct issued by the ECI and its clarifications issued from time to time will have to be strictly complied with during the rally/procession.",
    "10. In the event of any aggravation of law and order situation due to the conduct of the rally/procession, the responsibility will be on the applicant/ organiser.",
    "11. Instructions of ECI/rules regarding use of vehicles as well as the Motor Vehicles Act, 1988 and The West Bengal Motor Vehicles Rules, 1989 should be strictly complied by the Applicant/organizer.",
    "12. In case of violation of any of the above conditions the permission/order for holding rally will immediately be deemed to have been withdrawn.",
    "13. Items to be used in the Meeting will be as per the Annexure-D1 submitted with application."
];

foreach ($conditions as $line) {
    $pdf->MultiCell(0, 5, $line);
    $pdf->Ln(1);
}

// --- REJECTION / OR SECTION ---
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 10, "OR", 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(0, 5, "Permission is not accorded to hold the said meeting/rally due to reason(s) stated herein above: " . $data['rejection_reason']);

// --- SIGNATURE BLOCK (RO) ---
$pdf->Ln(4);
$pdf->Cell(100); // Move to right
$pdf->Cell(90, 2, "Signature", 0, 1, 'C');
$pdf->Cell(100);
$pdf->Cell(90, 5, "(RO " . $data['ro_name'] . " )", 0, 1, 'C');
$pdf->Cell(100);
$pdf->Cell(90, 2, "Date: " . $data['per_date'], 0, 1, 'C');

// --- MEMO SECTION ---
$pdf->Ln(1);
// 1. Memo Number (Align Left)
// We give this cell a width (e.g., 140mm) so the next cell starts further right
$pdf->Cell(140, 5, "Memo No. " . $data['per_id'] . " (2)/Suvidha/".  $data['ac_name'], 0 , 0, 'L');

// 2. Date (Align Right)
// 0 means it takes up the remaining width. 1 means move to the next line after this.
$pdf->Cell(0, 5, "Date: " . $data['per_date'], 0, 1, 'R');
$pdf->Ln(2);
$pdf->Cell(0, 5, "1. Copy forwarded to Video Surveillance Team " . $data['ac_name'], 0, 1);
$pdf->Cell(0, 5, "2. Copy forwarded to Flying Squad " . $data['ac_name'], 0, 1);

// Final Signature at Bottom
$pdf->Ln(1);
$pdf->Cell(110);
$pdf->Cell(70, 2, "Signature", 0, 1, 'C');
$pdf->Cell(110);
$pdf->Cell(70, 5, "(RO " . $data['ro_name'] . " )", 0, 1, 'C');
?>