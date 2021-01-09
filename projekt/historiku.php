<?php include "header.php";?>
<title>SHPORTA</title>
<section style="height:calc(100vh-180px)">
        <img src="Figura/bookshelf.jpg" style="height:100%;width:100%" class="kopertina">
</section> 
<div class="historiku">
<?php
        include "lidhja.php";
        if(isset($_SESSION["logged"])&&$_SESSION["emerPerdoruesi"]!='admin')
        {
            echo"<table border='1px' class='porosite'>";
            echo"<thead>";
            echo"<tr>";
            echo"<th>DatePorosi</th>";
            echo"<th>Totali</th>";
            echo"</tr>";
            $emerPerdoruesi=$_SESSION["emerPerdoruesi"];
            $query="SELECT porosi.DatePorosi, porosi.Totali, klienti.EmerPerdoruesi 
            FROM klienti
            INNER JOIN porosi ON klienti.ID_Klienti=porosi.ID_Klient
            WHERE EmerPerdoruesi='$emerPerdoruesi' ORDER BY DatePorosi"; 
            $result=mysqli_query($databaza,$query);
            if(!$result)
            {
                echo mysqli_error($databaza);
            }
            while($row=mysqli_fetch_assoc($result))
            {
                echo "<tr><td>" . $row['DatePorosi'] . "</td>";
                echo "<td>" . $row['Totali'] . "</td></tr>";
            }
        }
?>
<?php    include "menu.php";?>
<?php    include "footer.php";?>