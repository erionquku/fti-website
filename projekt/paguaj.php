<?php include "header.php";?>
<title>SHPORTA</title>
<section style="height:calc(100vh-180px)">
        <img src="Figura/bookshelf.jpg" style="height:100%;width:100%" class="kopertina">
</section> 
<?php    include "menu.php";?>
<?php    include "footer.php";?>
<div class="konfirmo">
<?php
        include "lidhja.php";
        if(isset($_SESSION["logged"])&&$_SESSION["emerPerdoruesi"]!='admin')
        {
            $emerPerdoruesi=$_SESSION["emerPerdoruesi"];
            $query="SELECT * FROM klienti WHERE EmerPerdoruesi='$emerPerdoruesi'"; 
            $result=mysqli_query($databaza,$query);
            while($row=mysqli_fetch_assoc($result))
            {
                echo"KONFIRMO ADRESEN:";
                echo"<form action='paguaj.php' method='post'>";
                echo"Adresa:<input type='text' style='margin-bottom:10px;' name='adresa' value='".$row['Adresa']."'>";
                echo"<input type='submit' name='Ndrysho'  class='buton' value='KONFIRMO'/><br> <br>"; 
                if(isset($_SESSION["shporta"]))
                {
                echo"<a href='paguaj.php?klienti=".$row['ID_Klienti']."'>PAGUAJ</a>";
                }
                echo"</form>";
            }
            echo"<br></br>";
            echo"<a href='historiku.php'>HISTORIKU I BLERJEVE TUAJA</a>";
            if(isset($_POST["Ndrysho"]))
                {
                    $adresa=$_POST["adresa"];
                    
                    $rez=mysqli_query($databaza,"UPDATE klienti SET Adresa='$adresa' WHERE EmerPerdoruesi='$emerPerdoruesi'");
                    if(!$rez)
                    echo "Nuk u ndryshua dot";
                }

        if(isset($_GET["klienti"]))
        {
            $klienti=$_GET["klienti"];
            if(isset($_SESSION["total"])&&isset($_SESSION["shporta"]))
            {
                $total=$_SESSION["total"];
                $data=date("Y-m-d");
                $rez=mysqli_query($databaza,"INSERT INTO porosi (ID_Klient,DatePorosi,Totali) VALUES ('$klienti','$data','$total')");
                $ID_Porosi=mysqli_insert_id($databaza);
                
                $i=0;
                foreach ($_SESSION["shporta"] as $key => $value)
                {
                    $nr_seri=$value["Nr_Seri"];
                    $cmimi=$value["Cmimi"];
                    $sasia=$value["Sasia"];
                
                    $rez=mysqli_query($databaza,"INSERT INTO fleteporosi (ID_Porosi,Nr_Seri,Cmimi,Sasia) VALUES ('$ID_Porosi','$nr_seri','$cmimi','$sasia')");
                    ++$i;
               
                } 
                $_SESSION["numriLibrave"]=$i;
                unset($_SESSION["shporta"]);
                unset($_SESSION["totali"]);
                

                $_SESSION["blerja"]=1;
                header('location:blerja.php');
                
            }
                
         
            
        }   
        }
        
        

    
?>
</div>
   

<style>
    .konfirmo
    {
        position:absolute;
        top:40%;
        left:10%;
        background-color:rgb(245, 204, 94);
        padding:20px;
    }

</style>
