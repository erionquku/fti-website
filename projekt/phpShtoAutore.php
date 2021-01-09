<?php
 include("lidhja.php");

    $emri=$_POST["emri"];
    $mbiemri=$_POST["mbiemri"];

        $insert="INSERT INTO lib_autor (Emri,Mbiemri) 
        VALUES('$emri','$mbiemri');";
        $uFut=mysqli_query($databaza,$insert);
        if($uFut)
        {
            echo "<script> alert('Libri u shtua me sukses');</script>";
        }
        header('location:shtoAutore.php');
        
?>