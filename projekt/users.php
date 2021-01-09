<?php include "header.php";?>
    <title>USERS</title>
    <link rel="icon" href="bookworm.jpeg" type="image/x-png" />
        
        <section style="height:calc(100vh-180px)">
            <img src="Figura/bookshelf.jpg" style="height:100%;width:100%" class="kopertina">
        </section>

       <?php
               $databaza=mysqli_connect("localhost","root","","libraria");
                if(!$databaza)
                {
                    echo "Nuk u realizua lidhja". mysqli_connect_error();
                }
                if(isset($_SESSION["logged"])&&$_SESSION["emerPerdoruesi"]=='admin')
               {
                    echo"<table border='1px' class='users'>";
                    echo"<thead>";
                    echo"<tr>";
                    echo"<th>ID</th>";
                    echo"<th>Emri</th>";
                    echo"<th>Mbiemri</th>";
                    echo"<th>Emer Perdoruesi</th>";
                    echo"<th>Email</th>";
                    echo"<th>Adresa</th>";
                    echo"<th>Qyteti</th>";
                    echo"<th>Shteti</th>";
                    echo"<th>Kodi Postar</th>";
                    $listo = mysqli_query($databaza,"SELECT * FROM klienti" );
                    while ($row = mysqli_fetch_assoc($listo))
                    {
                        echo "<tr><td>" . $row['ID_Klienti'] . "</td>";
                        echo "<td>" . $row['Emri'] . "</td>";
                        echo "<td>" . $row['Mbiemri'] . "</td>";
                        echo "<td>" .$row['EmerPerdoruesi']. "</td>";
                        echo "<td>" . $row['Email'] . "</td>";
                        echo "<td>" . $row['Adresa'] . "</td>";
                        echo "<td>" . $row['Qyteti'] . "</td>";
                        echo "<td>" . $row['Shteti'] . "</td>";
                        echo "<td>" . $row['Kodi_Postar'] ."</td></tr>";
                    }
               }
                    
        ?>
        </tbody>
    </table>
    <?php include "menu.php";?>
  
    <?php  include "footer.php";?>  
