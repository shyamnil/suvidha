<?php
/**
 * Template: Annexure-P3 (Rally Order) - Corrected & Updated
 */

// --- HEADER SECTION ---
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Annexure-N1', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);

// Line 1
$pdf->Cell(0, 7, 'No Objection Certificates of OC/IC of the Police Station for holding Meeting with Loudspeaker /Meeting without', 0, 1, 'C');

// Line 2
$pdf->Cell(0, 7, '  Loudspeaker /Street Cornering with Loudspeaker /Street Cornering without Loudspeaker /use of Loudspeaker', 0, 1, 'C');
$pdf->Ln(5);

// --- SUVIDHA APP ID ---
$pdf->SetFont('Arial', '', 9);
$pdf->Write(7, "SUVIDHA Application ID: ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(7, $data['app_id']);
$pdf->Ln(5);

// --- APPLICANT DETAILS ---
$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, "Certified that application has been received from  ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, $data['applicant_name']);
$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, ", Candidate/Election Agent/ Candidate's Representative / Poiltical party's Representative of ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, $data['party']);
$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, " Party for holding Meeting with Loudspeaker/Meeting without Loudspeaker/Street Cornering with Loudspeaker/ Street Cornering without Loudspeaker/ use of Loudspeaker* at ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, $data['place']);
$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, " (Venue) on ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, $data['events_date']);
$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, " (Date) at ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, date("h:i A", strtotime($data['evts_time'])));
$pdf->SetFont('Arial', '', 9);

$pdf->Write(8, " to ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, date("h:i A", strtotime($data['end_time'])));
$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, " in connection with the General Election to the West Bengal Legislative Assembly, 2026.");
$pdf->Ln(12);

$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, "Disruption of Law & Order is apprehended/not apprehended for holding Meeting with Loudspeaker/Meeting without Loudspeaker/Street Cornering with Loudspeaker/ Street Cornering without Loudspeaker/ use of Loudspeaker*. ");
$pdf->Ln(4);

$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, " Hence, NOC for holding Meeting with Loudspeaker/Meeting without Loudspeaker/Street Cornering with Loudspeaker/ Street Cornering without Loudspeaker/ use of Loudspeaker* at ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, $data['place']);
$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, " (Venue) on ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, $data['events_date']);
$pdf->SetFont('Arial', '', 9);
$pdf->Write(8, " (Date) at ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, date("h:i A", strtotime($data['evts_time'])));
$pdf->SetFont('Arial', '', 9);

$pdf->Write(8, " to ");
$pdf->SetFont('Arial', 'BU', 9);
$pdf->Write(8, date("h:i A", strtotime($data['end_time'])));
$pdf->SetFont('Arial', 'B', 9);
$pdf->Write(8, " is hereby is given/not given.");
$pdf->SetFont('Arial', '', 9);
$pdf->Ln(10);

$pdf->Write(7, "Or permission may be issued as modified: ");
$pdf->SetFont('Arial', 'B', 9);
// If no objection, this will print dots; otherwise, the authority name
$pdf->Write(7, !empty($data['obj_authority']) ? $data['obj_authority'] : ".............................................");

$pdf->SetFont('Arial', '', 9);
$pdf->Write(7, " (date) ");
$pdf->SetFont('Arial', 'B', 9);
$pdf->Write(7, !empty($data['obj_reason']) ? $data['obj_reason'] : "...................................................(Time)");
$pdf->Ln(10);
?>