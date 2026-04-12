<?php

$pdf->SetFont('Arial', 'B', 11);

// Title
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(0, 8, 'Annexure-P5', 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, 'Permission for Display of Poster / Hoarding / Unipole', 0, 1, 'C');

$pdf->Ln(5);

// Permission No & Date
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(100, 6, 'Permission No: ' . $data['per_id'], 0, 0);
$pdf->Cell(0, 6, 'Dated: ' . $data['per_date'], 0, 1);

// App ID
$pdf->Cell(0, 6, 'SUVIDHA Application ID: ' . $data['app_id'], 0, 1);

$pdf->Ln(5);

// Main Paragraph
$text = "Application for Display of Poster / Hoarding / Unipole from " . 
$data['events_date'] . " to " . $data['evente_date'] . 
" at " . $data['place'] . 
" of Mouza :- " . $data['mouza'] . ", Plot : " . $data['plot'] . 
" under P.S. " . $data['police_station'] . 
" of " . $data['block'] . 
" (Block / Municipality / Corporation ) has been received from Sri / Smt. " . $data['applicant_name'] . 
", Representative of " . $data['party'] . ".";
$pdf->MultiCell(0, 6, $text);

$pdf->Ln(7);

// Compliance
$pdf->MultiCell(0, 6, 
"The applicant has Complied / not complied with the conditions laid down for according permission for Display of Poster/ Hoarding / Unipole."
);

// NOC
$pdf->Ln(7);
$pdf->MultiCell(0, 6, 
"     [   ] Applicant(s) submitted / NOT submitted NOC from owner of the land / property or authorized entity managing the property"
);
$pdf->Ln(5);
// Expenditure
$pdf->MultiCell(0, 6, 
"     [   ] Applicant(s) submitted/NOT submitted the probable Expenditure statement for the campaign in Annexure-D1"
);
$pdf->Ln(5);

// Main Paragraph
$pdf->MultiCell(0, 6, "Hence permission is accorded for Display of Poster/ Hoarding/Unipole for the period from " . 
$data['events_date'] . " to " . $data['evente_date'] . 
" with condition that in the event of any violation of ECI’s MCC guidelines or other instructions, this permission will stand cancelled with immediate effect."
);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 11);
// Permission Decision
if (strtolower($data['flags']) == '1') {
    $pdf->MultiCell(0, 6, 
    "Hence permission is accorded for Display of Poster / Hoarding / Unipole for the period from " . 
    $data['events_date'] . " to " . $data['evente_date'] . 
    " with condition that in the event of any violation of ECI’s MCC guidelines or other instructions, this permission will stand cancelled with immediate effect."
    );
} else {
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(0, 10, "OR", 0, 1, 'C');
	$pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, 
    "Permission is not accorded for Display of Poster/ Hoarding/ Unipole due to reason(s) stated herein above "
    );
	$pdf->MultiCell(0, 6, 
    "Recommended/ Not Recommended : "
    );
}

$pdf->Ln(10);

// --- SIGNATURE BLOCK (RO) ---
$pdf->Ln(4);
$pdf->Cell(100); // Move to right
$pdf->Cell(90, 2, "Signature", 0, 1, 'C');
$pdf->Cell(100);
$pdf->Cell(90, 5, "(RO " . $data['ro_name'] . " )", 0, 1, 'C');
$pdf->Cell(100);
$pdf->Cell(90, 2, "Date: " . $data['per_date'], 0, 1, 'C');

// --- MEMO SECTION ---
$pdf->Ln(6);
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