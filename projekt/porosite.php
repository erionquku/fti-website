<?php include "header.php";?>
        <title>POROSITE</title>
        <link rel="icon" href="bookworm.jpeg" type="image/x-png" />



       <?php
               $databaza=mysqli_connect("localhost","root","","libraria");
                if(!$databaza)
                {
                    echo "Nuk u realizua lidhja". mysqli_connect_error();
                }
                if(isset($_SESSION["logged"])&&$_SESSION["emerPerdoruesi"]=='admin')
               {
                    echo"<table border='1px' class='porosite'>";
                    echo"<thead>";
                    echo"<tr>";
                    echo"<th>ID Porosise</th>";
                    echo"<th>Emer Perdoruesi</th>";
                    echo"<th>Data Porosise</th>";
                    echo"<th>Tituli Librit</th>";
                    echo"<th>Nr Serie</th>";
                    echo"<th>Sasia</th>";
                    echo"<th>Cmimi</th>";
                    echo"</tr>";
                    $listo = mysqli_query($databaza,"SELECT porosi.ID_Porosi, klienti.EmerPerdoruesi, porosi.DatePorosi,fleteporosi.Nr_Seri,fleteporosi.Cmimi,fleteporosi.Sasia,lib_pershkrim.Titulli
                                                    FROM klienti 
                                                    INNER JOIN porosi ON klienti.ID_Klienti=porosi.ID_Klient
                                                    INNER JOIN fleteporosi ON porosi.ID_Porosi=fleteporosi.ID_Porosi
                                                    INNER JOIN lib_pershkrim ON fleteporosi.Nr_Seri=lib_pershkrim.Nr_Seri
                                                    " );
                    while ($row = mysqli_fetch_assoc($listo))
                    {
                        echo "<tr><td>" . $row['ID_Porosi'] . "</td>";
                        echo "<td>" . $row['EmerPerdoruesi'] . "</td>";
                        echo "<td>" . $row['DatePorosi'] . "</td>";
                        echo "<td>" . $row['Titulli'] . "</td>";
                        echo "<td>" . $row['Nr_Seri'] . "</td>";
                        echo "<td>" . $row['Sasia'] . "</td>";
                        echo "<td>" . $row['Cmimi'] . "</td></tr>";
                    }
               }
                    
        ?>
        </tbody>
    </table>
    <?php include "menu.php";?>
 
