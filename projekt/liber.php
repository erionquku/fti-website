<?php include "header.php";?>
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
        if (isset($_POST["shto_ne_shporte"])){
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
<title>SHFLETO</title>
<link rel="icon" href="bookworm.jpeg" type="image/x-png" />

<section style="height:calc(100vh-180px)">
    <img src="Figura/bookshelf.jpg" style="height:100%;width:100%" class="kopertina">
</section>


    <div class="kuti">

    <?php
    include("lidhja.php");
   if(isset($_GET["liber"]))
   {
    $Nr_Seri=$_GET["liber"];
    $query1="SELECT * FROM lib_pershkrim 
    INNER JOIN lib_aut_klas ON lib_aut_klas.Nr_Seri=lib_pershkrim.Nr_Seri
    INNER JOIN lib_autor On lib_autor.ID_Autor=lib_aut_klas.ID_Autor
    WHERE lib_pershkrim.Nr_Seri='$Nr_Seri'";

    $res1=mysqli_query($databaza,$query1);
    while($row=mysqli_fetch_assoc($res1))
    {
        echo"<div class='produkt1'>";
        echo"<form method='post' action=liber.php?action=shto&nr_seri=". $row["Nr_Seri"].">";
        echo "<img src='".$row["Foto"]."'width='250px' height='300px'/>"."<br/>";
        echo "<h1>Titulli:".$row["Titulli"]."</h1><br/>";
        echo "<p>".$row["Emri"]." ".$row["Mbiemri"]."</p><br/>";
        echo "<p>Pershkrimi:".$row["Pershkrimi"]."</p><br/>";
        echo "<p class='cmimi'>".$row["Cmimi"]."</p><br/>";
        echo "<p>Publikimi:".$row["Publikimi"]."</p><br/>";
        echo "<p>Tirazhi:".$row["Tirazhi"]."</p><br/>";
        echo "<p>Nr_Faqeve:".$row["Nr_Faqeve"]."</p><br/>";
        echo"Sasia:<input type='number' style='margin-bottom:10px;' name='sasia' value='1'><br>";
        echo"<input type='hidden' name='hidden_titulli' value='". $row["Titulli"]."' >";
        echo"<input type='hidden' name='hidden_cmimi' value='".$row["Cmimi"]."'>";
        echo"<input type='submit' name='shto_ne_shporte'  class='buton' value='SHTO'/>";
        echo"</form>";
        echo "</div>";
    }

   }
    ?>
</div>

   <?php include "menu.php";?>

<?php  include "footer.php";?>



