<?php include "header.php";?>
    <title>SHFLETO</title>
    <link rel="icon" href="bookworm.jpeg" type="image/x-png" />

<div class="kuti">
   <?php
    include("lidhja.php");
   if(isset($_GET["kategoria"]))
   {
    $ID_Kat=$_GET["kategoria"];
    $query="SELECT DISTINCT * FROM lib_pershkrim
    INNER JOIN lib_klas ON lib_klas.Nr_Seri=lib_pershkrim.Nr_Seri
    INNER JOIN lib_aut_klas ON lib_aut_klas.Nr_Seri=lib_pershkrim.Nr_Seri
    INNER JOIN lib_autor On lib_autor.ID_Autor=lib_aut_klas.ID_Autor
    WHERE lib_klas.ID_Kat='$ID_Kat' AND lib_pershkrim.Tirazhi>0
    ORDER BY lib_pershkrim.Titulli";
    $res=mysqli_query($databaza,$query); 
    while($row=mysqli_fetch_assoc($res))
    {
        echo"<div class='produkt'>";
        echo"<form method='post' action=shfleto.php?action=shto&nr_seri=". $row["Nr_Seri"].">";
        echo "<img src='".$row["Foto"]."' width='150px' height='200px'/><br/>";
        echo "<p>".$row["Titulli"]."</p><br/>";
        echo "<p>".$row["Emri"]." ".$row["Mbiemri"]."</p><br/>";
        echo "<p>".substr($row["Pershkrimi"],0,150)."...<a href='liber.php?liber=".$row['Nr_Seri']."'>Lexo me shume</a>"."</a><br/>";
        echo "<p class='cmimi'>".$row["Cmimi"]."</p><br/>";
        echo"Sasia:<input type='number' style='margin-bottom:10px;' name='sasia' value='1'>";
        echo"<input type='hidden' name='hidden_titulli' value='". $row["Titulli"]."' >";
        echo"<input type='hidden' name='hidden_cmimi' value='".$row["Cmimi"]."'>";
        echo"<input type='submit' name='shto'  class='buton' value='SHTO NE SHPORTE'/>";
        echo"</form>";
        echo "</div>";
    }

   }
   if(isset($_GET['kerko'])){
       $libri = $_GET['kerko'];
       $kerko = "SELECT * FROM lib_pershkrim 
       INNER JOIN lib_klas ON lib_klas.Nr_Seri=lib_pershkrim.Nr_Seri
       INNER JOIN lib_kat ON lib_klas.ID_Kat=lib_kat.ID_Kat
       INNER JOIN lib_aut_klas ON lib_aut_klas.Nr_Seri=lib_pershkrim.Nr_Seri
       INNER JOIN lib_autor On lib_autor.ID_Autor=lib_aut_klas.ID_Autor 
       WHERE Tirazhi>0 AND Titulli LIKE '%".$libri."%'OR Emri LIKE '%".$libri."%'OR Botuesi LIKE '%".$libri."%' OR Pershkrimi LIKE '%".$libri."%' OR Kategoria LIKE '%".$libri."%' ORDER BY Titulli
                ";
       $rez = mysqli_query($databaza, $kerko);
        $rrjeshta = mysqli_num_rows($rez);
        if($rrjeshta> 0){
        echo "<h2 style='color:#000; font-family:Verdana; margin-bottom:20px;'> LIBRA TE LIDHUR ME KERKIMIN: ".$rrjeshta." </h2>";
        while($row = mysqli_fetch_assoc($rez)){
            echo"<div class='produkt'>";
            echo"<form method='post' action=shfleto.php?action=shto&nr_seri=". $row["Nr_Seri"].">";
            echo "<img src='".$row["Foto"]."' width='150px' height='200px'/><br/>";
            echo "<p>".$row["Titulli"]."</p><br/>";
            echo "<p>".$row["Emri"]." ".$row["Mbiemri"]."</p><br/>";
            echo "<p>".substr($row["Pershkrimi"],0,150)."...<a href='liber.php?liber=".$row['Nr_Seri']."'>Lexo me shume</a>"."</a><br/>";
            echo "<p class='cmimi'>".$row["Cmimi"]."</p><br/>";
            echo"Sasia:<input type='number' style='margin-bottom:10px;' name='sasia' value='1'>";
            echo"<input type='hidden' name='hidden_titulli' value='". $row["Titulli"]."' >";
            echo"<input type='hidden' name='hidden_cmimi' value='".$row["Cmimi"]."'>";
            echo"<input type='submit' name='shto'  class='buton' value='SHTO NE SHPORTE'/>";
            echo"</form>";
            echo "</div>";
       }
   }
       else{
           echo "<h2 style='color:#000; font-family:Verdana; margin-bottom:20px;'>NUK U GJET ASNJE REZULTAT</h2>";
       }
   }
?>
</div>

    <?php include "menu.php";?>

<?php 
 
        function array_colum($array, $column_name)
        {
            $output = array();
            foreach($array as $keys => $values)
            {
                $output[] = $values[$column_name];
            }
            return $output;
        }
        if (isset($_POST["shto"])){
            if (isset($_SESSION["shporta"])){
                $libra_array_nrSeri = array_colum($_SESSION["shporta"],"Nr_Seri");
                if (!in_array($_GET["nr_seri"],$libra_array_nrSeri)){
                    $count = count($_SESSION["shporta"]);
                    $libra_array = array(
                        'Nr_Seri' => $_GET["nr_seri"],
                        'Titulli' => $_POST["hidden_titulli"],
                        'Cmimi' => $_POST["hidden_cmimi"],
                        'Sasia' => $_POST["sasia"],
                    );
                    $_SESSION["shporta"][$count] = $libra_array;
                    echo '<script>window.location="shporta.php"</script>';
                }else{
                    echo '<script>alert("Produkti gjendet nje here ne shporte")</script>';
                    echo '<script>window.location="shporta.php"</script>';
                }
            }else{
                $libra_array = array(
                    'Nr_Seri' => $_GET["nr_seri"],
                    'Titulli' => $_POST["hidden_titulli"],
                    'Cmimi' => $_POST["hidden_cmimi"],
                    'Sasia' => $_POST["sasia"],
                );
                $_SESSION["shporta"][0] = $libra_array;
            }
        }

?>




  

