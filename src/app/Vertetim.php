<?php

namespace App;

use mikehaertl\pdftk\XfdfFile;

class Vertetim
{

    public static function generate($type, $user)
    {
        $pdftk = '"C:\Program Files (x86)\PDFtk\bin\pdftk.exe"';
        $baseDir = 'C:\xampp2\htdocs\fti-website\\';
        $tempDir = $baseDir . 'resources\temp\\';
        $xfdfFile = $tempDir . 'vertetim_data_' . $user->id . '.xfdf';
        $input = $baseDir . 'resources\pdf\vertetim.pdf';
        $output = $tempDir . 'vertetim_' . $user->id . '.pdf';

        $xfdf = new XfdfFile([
            'date' => 'Tiranë, më ' . date('d-m-Y', time()),
            'name' => 'Z. ' . $user->first_name . ' ' . $user->last_name,
            'date_of_birth' => $user->personal->date_of_birth,
            'academic_year' => '2020-2021',
            'description' => "është student në vitin e dytë - Cilki i parë Bachelor, në Inxhinieri Informatike, \n\n"
                . "në Fakultetin e Teknologjisë së Informacionit. ",
            'secretary' => '_________________',
            'main_secretary' => '_________________',
            'dean' => '_________________'
        ]);

        $xfdf->saveAs($xfdfFile);

        $command = "$pdftk $input fill_form $xfdfFile output $output flatten drop_xfa";
        exec($command);

        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="vertetim_' . $user->id . '.pdf"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($output));
        header('Accept-Ranges: bytes');
        readfile($output);

    }
}

// C:\\xampp2\\htdocs\\fti-website\\resources\\pdf\\filled.pdf flatten

//$command = "pdftk $input fill_form $xfdfFile output $output flatten drop_xfa";
//dd($command);
//$comm = 'pdftk "A"="C:\\xampp2\\htdocs\\fti-website\\resources\\pdf\\date.pdf" "fill_form" "C:\\xampp2\\htdocs\\fti-website\\resources\\temp\\data2.xfdf" "output" "C:\\xampp2\\htdocs\\fti-website\\resources\\pdf\\filled.pdf" flatten';
//exec($comm . " 2>&1", $output);
//print_r($output);

//echo $comm;

//$pdf = new Pdf("C:\\xampp2\\htdocs\\fti-website\\resources\\pdf\\date.pdf");

// Fill in UTF-8 compliant form data!
//$result = $pdf->fillForm(array("date" => "asdkljaskld"))
//    ->saveAs('filled3.pdf');
//
//// Always check for errors
//if ($result === false) {
//    $error = $pdf->getError();
//    print_r($error);
//}
//
//// Alternatively: Send to browser for download...
//$pdf->send('filled3.pdf');