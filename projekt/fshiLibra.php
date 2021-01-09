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
            <table border="1px" class="tabela_fshiLibra"><thead><tr><td>Nr Seri</td><TD>Titulli</td><td>Cmimi</td><td>Tirazhi</td><td>Nr Faqeve</td><td>Fshi</td></tr></thead>
            <tbody>
    <?php
        $sql = mysqli_query($databaza,"SELECT * FROM lib_pershkrim" );
        while ($row = $sql->fetch_assoc())
        {
            echo "<tr><td>" . $row['Nr_Seri'] . "</td>";
            echo "<td>" . $row['Titulli'] . "</td>";
            echo "<td>" . $row['Cmimi'] . "</td>";
            echo "<td>" . $row['Tirazhi'] . "</td>";
            echo "<td>" . $row['Nr_Faqeve'] . "</td>";
            echo "<td><a href='fshiLibra.php?fshiId=".$row["Nr_Seri"]."'>Fshi</a></td>
                  </tr>";
        }
        if(isset($_GET['fshiId'])){
            $fshiID=$_GET['fshiId'];
            $sql1="DELETE FROM lib_pershkrim WHERE Nr_Seri='$fshiID'";
            $rezultat=mysqli_query($databaza,$sql1);
            if($rezultat)
            echo"<script type='text/javascript'>alert('U fshi me sukses'); window.location.href='fshiLibra.php'</script>";
        }
    ?>
</tbody>
</table>
        <?php
        }
        ?>
        <?php include "menu.php";?>

    <?php  include "footer.php";?>  
