<?php
 include("lidhja.php");

    $titulli=$_POST["titulli"];
    $pershkrimi=$_POST["pershkrimi"];
    $cmimi=$_POST["cmimi"];
    $botuesi=$_POST["botuesi"];
    $publikimi=$_POST["publikimi"];
    $tirazhi=$_POST["tirazhi"];
    $nr_faqeve=$_POST["nr_faqeve"];
    $foto=$_POST["foto"];
        $insert="INSERT INTO lib_pershkrim (Titulli,Pershkrimi,Cmimi,Botuesi,Publikimi,Tirazhi,Nr_Faqeve,Foto) 
        VALUES('$titulli','$pershkrimi','$cmimi','$botuesi','$publikimi','$tirazhi','$nr_faqeve','$foto');";
        $uFut=mysqli_query($databaza,$insert);
        if($uFut)
        {
            echo "<script> alert('Libri u shtua me sukses');</script>";
        }
        header('location:shtoLibra.php');

        
?>