<?php include "header.php";?>
<title>SHPORTA</title>
<section style="height:calc(100vh-180px)">
        <img src="Figura/bookshelf.jpg" style="height:100%;width:100%" class="kopertina">
</section> 
<div class="konfirmo">
<?php
include "lidhja.php";
    if(isset($_SESSION["blerja"]))
    {
        if(isset($_SESSION["logged"])&&$_SESSION["emerPerdoruesi"]!='admin')
        {
        if(isset($_SESSION["numriLibrave"]))
        {
        $nrLibrave=$_SESSION["numriLibrave"];
        $emerPerdoruesi=$_SESSION["emerPerdoruesi"];
        echo"Blerja u realizua me sukses!<br><BR>";
        echo"<h2>Fatura</h2>";
        echo"<table class='fleteporosi'><thead><tr><td>Titulli</td><td>Cmimi</td><td>Sasia</td></tr></thead><tbody>";
        $query="SELECT lib_pershkrim.Titulli, fleteporosi.Cmimi, fleteporosi.Sasia,klienti.emerPerdoruesi 
                FROM klienti 
                INNER JOIN porosi ON klienti.ID_Klienti=porosi.ID_Klient
                INNER JOIN fleteporosi ON fleteporosi.ID_Porosi=porosi.ID_Porosi
                INNER JOIN lib_pershkrim ON lib_pershkrim.Nr_Seri=fleteporosi.Nr_Seri
                WHERE EmerPerdoruesi='$emerPerdoruesi' ORDER BY fleteporosi.ID_Porosi DESC LIMIT $nrLibrave
                "; 
        $result=mysqli_query($databaza,$query);
        if(!$result)
        echo mysqli_error($databaza);
        while($row=mysqli_fetch_assoc($result))
        {
            echo"<tr>";
            echo"<td>".$row['Titulli']."</td>";
            echo"<td>".$row['Cmimi']."</td>";
            echo"<td>".$row['Sasia']."</td>";
            echo"</tr>";
        }
        echo"</tbody></table>";
        
        $query="SELECT klienti.Adresa, porosi.Totali FROM klienti 
        INNER JOIN porosi ON porosi.ID_Klient=klienti.ID_Klienti
        WHERE EmerPerdoruesi='$emerPerdoruesi' ORDER BY ID_Porosi DESC LIMIT 1";
        $result=mysqli_query($databaza,$query);
        if(!$result)
        {
            echo mysqli_error($databaza);
        }
        
            
            while($row=mysqli_fetch_assoc($result))
            {
                echo "Totali:".$row['Totali'] ."<br><BR>";
                echo "Adresa ku do degohen librat:".$row['Adresa']."<br>";
            
            }
            echo"Numri i librave te blere eshte:".$nrLibrave."<br>";
        
    }
        
    }
    }
    unset($_SESSION["blerja"]);
    unset($_SESSION["numriLibrave"]);
?>
</div>
<?php    include "menu.php";?>
<?php    include "footer.php";?>
<style>
    .konfirmo
    {
        position:absolute;
        top:50%;
        left:40%;
        background-color:rgb(245, 204, 94);
        padding:20px;
    }

</style>