<?php
/**
 * Template: Annexure-P1 (Holding Meeting) - Corrected & Updated
 */

// --- HEADER SECTION ---
$pdf->SetFont('Arial', 'BU', 14);
$pdf->Cell(0, 10, 'Annexure-P1', 0, 1, 'C');
$pdf->SetFont('Arial', 'BU', 12);
$pdf->Cell(0, 7, 'Permission for Holding Meeting / Street Cornering with / without Loud Speaker', 0, 1, 'C');
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
$pdf->Write(8, "Application for holding meeting / street corner on . ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, $data['app_date']);
$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, " (date) at , ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, $data['app_time']);
$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, ", (Time) ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, $data['place']);
$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, " (Place) has been received from Sri / Smt . ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, $data['applicant_name']);
$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, ", Candidate/Election Agent/ Candidate's Representative / Poiltical party's Representative of ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, $data['party']);
$pdf->SetFont('Arial', '', 9);
$pdf->Ln(12);

// --- ROUTE & TIME ---
$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, "1. Place of Campaign: ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->MultiCell(0, 7, $data['route'], 'BU'); 
$pdf->Ln(2);

$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, "2. Date: ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, $data['event_date'] . "            ");
$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, "3. Time: ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, date("h:i A", strtotime($data['evts_time'])));
$pdf->SetFont('Arial', 'BU', 9);

$pdf->Write(8, " to ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, date("h:i A", strtotime($data['end_time'])));
$pdf->SetFont('Arial', '', 9);
$pdf->Ln(12);
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
$pdf->Write(7, !empty($data['obj_authority']) ? $data['obj_authority'] : "........................................................");

$pdf->SetFont('Arial', '', 9);
$pdf->Write(7, " Reason cited, ");
$pdf->SetFont('Arial', 'B', 9);
$pdf->Write(7, !empty($data['obj_reason']) ? $data['obj_reason'] : ".........................................................");
$pdf->Ln(10);

// --- PERMISSION ACCORDED STATEMENT ---
$pdf->SetFont('Arial', '', 9);
$pdf->Write(7, "Hence, Permission is accorded to hold the said meeting/rally with/without loudspeaker under following conditions:-");
$pdf->Ln(8);
$conditions = [
    "1. The meeting/rally will be held within the time slot allowed and at the venue specified in the permission.",
    "2. The size and shape of the stage/Dias will be such that road/pathway is not blocked in any manner",
    "3.	Use of loudspeaker is completely prohibited between 10:00 P.M.to 6:00 A.M.",
	"4.	In use of loudspeakers the preconditions laid down by the Pollution Control Board, West Bengal will be strictly followed.",
	"5.	All items like banner, poster etc. to be used in the meeting should be ECI standard Complaint",
	"6.	No participant in the meeting will carry any weapon or intoxicating material in the meeting or participate in the meeting in intoxicated state. The applicant / organiser of the meeting will ensure that.",
	"7.	No person should make any inflammatory speech through the use of loudspeaker or otherwise which will hurt the feelings and sentiments of any religions group or section of society.",
	"8.	The model code of conduct issued by the ECI and its clarifications issued from time to time will have to be strictly complied with during the meeting.",
	"9.	Instruction/ rule regarding use of vehicles as well as the Motor Vehicles Act, 1988 and The West Bengal Motor Vehicles Rules, 1989 during campaigning/meeting/rally should be strictly complied by the applicant/organizer.",
	"10.In case of violation of any of the above conditions the permission/ order for holding meeting will immediately be deemed to have been withdrawn and proceedings will be started against the applicant/ organiser under violation of model code of conduct.",
	"11.Items to be used in the meeting will be as per the Annexure-D1 submitted with application.",
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
$pdf->Cell(140, 5, "Memo No. " . $data['per_id'] . " (2)/Suvidha/"  . $data['ac_name'] , 0 , 0, 'L');

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