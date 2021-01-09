<?php
//session_start();
$databaza=mysqli_connect("localhost","root","","libraria");
if(!$databaza)
{
    echo "Nuk u realizua lidhja". mysqli_connect_error();
}
$errors = array(); 
if(isset($_POST["rregjistrohu"]))
{
        $emri=$_POST['emri'];
        $mbiemri=$_POST['mbiemri'];
        $email=$_POST['email'];
        $emerPerdoruesi=$_POST['emerPerdoruesi'];
        $password=$_POST['password'];
        $adresa=$_POST['adresa'];
        $qyteti=$_POST['qyteti'];
        $shteti=$_POST['shteti'];
        $kodi_postar=$_POST['kodiPostar'];
    
        if (empty($emri)) { array_push($errors, "Plotesoni fushen e emrit"); }
        if (empty($mbiemri)) { array_push($errors, "Plotesoni fushen e mbiemrit"); }
        if (empty($emerPerdoruesi)) { array_push($errors, "Plotesoni fushen e emerPerdoruesit"); }
        if (empty($password)) { array_push($errors, "Plotesoni fushen e fjalekalimit"); }
        if (empty($adresa)) { array_push($errors, "Plotesoni fushen e adreses"); }
        if (empty($qyteti)) { array_push($errors, "Plotesoni fushen e qytetit"); }
        if (empty($shteti)) { array_push($errors, "Plotesoni fushen e shtetit"); }
        if (empty($kodi_postar)) { array_push($errors, "Plotesoni fushen e kodit postar"); }


        $query="SELECT * FROM klienti WHERE EmerPerdoruesi='$emerPerdoruesi' LIMIT 1";
        $rezultat=mysqli_query($databaza,$query);
        $perdoruesi = mysqli_fetch_assoc($rezultat);
        if ($perdoruesi) { // if user exists
            if ($perdoruesi['EmerPerdoruesi'] === $emerPerdoruesi) {
              array_push($errors, "Ekziston nje account me kte emerPerdoruesi");
            }
        
          }
          if (count($errors) == 0)
          {
            $insert="INSERT INTO klienti (Emri,Mbiemri,Email,Adresa,Qyteti,Shteti,Kodi_Postar,EmerPerdoruesi,Fjalekalimi)
            VALUES ('$emri','$mbiemri','$email','$adresa','$qyteti','$shteti','$kodi_postar','$emerPerdoruesi','$password');";
            $rez=mysqli_query($databaza,$insert);
            $_SESSION["emerPerdoruesi"]=$emerPerdoruesi;
            $_SESSION["logged"]=1;
            if($rez)
            {
                echo "<script>alert('U rregjistrove');</script>";
            }
          }
} 

?>