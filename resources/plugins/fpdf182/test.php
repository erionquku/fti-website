<?php
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

require_once('fpdf.php');
require_once('../../../vendor/autoload.php');

// initiate FPDI
$pdf = new Fpdi();

// add a page
$pdf->AddPage();

// set the source file
$pdf->setSourceFile('template.pdf');

// import page 1
$tplIdx = $pdf->importPage(1);

// use the imported page and place it at position 10,10 with a width of 100 mm
$pdf->useTemplate($tplIdx, 5, 0, 200);
//$pdf->useTemplate()

// now write some text above the imported page
$pdf->SetFont('Helvetica');
$pdf->SetTextColor(255, 0, 0);
$pdf->SetXY(155, 69);
$pdf->Write(0, 'Diten e sotme');

$pdf->Output('I', 'generated.pdf');