<?php include "header.php";?>
<title>FSHI AUTORE</title>
<link rel="icon" href="bookworm.jpeg" type="image/x-png" />

<section style="height:calc(100vh-180px)">
    <img src="Figura/bookshelf.jpg" style="height:100%;width:100%" class="kopertina">
</section>

        <?php
        include("lidhja.php");
        if(isset($_SESSION["logged"])&&$_SESSION["emerPerdoruesi"]=='admin')
        {
        ?>

<table border="1px" class="tabela_fshiAutore"><thead><tr><td>ID</td><TD>Emri</td><td>Mbiemri</td><td>Fshi</td></tr></thead>
<tbody>

        <?php
        $sql = mysqli_query($databaza,"SELECT * FROM lib_autor" );
        while ($row = $sql->fetch_assoc())
        {
            echo "<tr><td>" . $row['ID_Autor'] . "</td>";
            echo "<td>" . $row['Emri'] . "</td>";
            echo "<td>" . $row['Mbiemri'] . "</td>";
            echo "<td><a href='fshiAutore.php?fshiId=".$row["ID_Autor"]."'>Fshi</a></td>
                  </tr>";
        }
        if(isset($_GET['fshiId'])){
            $fshiID=$_GET['fshiId'];
            $sql1="DELETE FROM lib_autor WHERE ID_Autor='$fshiID'";
            $rezultat=mysqli_query($databaza,$sql1);
            if($rezultat)
            echo"<script type='text/javascript'>alert('U fshi me sukses'); window.location.href='fshiAutore.php'</script>";
        }
    ?>
</tbody>
</table>
        <?php
        }
        ?>
        <?php include "menu.php";?>

    <?php  include "footer.php";?>  