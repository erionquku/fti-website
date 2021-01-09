<?php 
include "header.php";?>
    <title>BOOKWORM</title>
    <link rel="icon" href="bookworm.jpeg" type="image/x-png" />

   <section style="height:calc(100vh-180px)"><img src="Figura/bookshelf.jpg" style="height:100%;width:100%" class="kopertina"></section>
   <p class="shkrimi">Dhurata më e madhe është pasioni për leximin</p> 
   <?php include "menu.php";?>
   <div class="kuti1">
    <h2>NE JU REKOMANDOJME:</h2>
    <br>
   <?php
   
    include_once("lidhja.php");
    $query=mysqli_query($databaza, "SELECT * FROM lib_pershkrim 
    INNER JOIN lib_aut_klas ON lib_aut_klas.Nr_Seri=lib_pershkrim.Nr_Seri
    INNER JOIN lib_autor On lib_autor.ID_Autor=lib_aut_klas.ID_Autor
    GROUP BY lib_pershkrim.Titulli ORDER BY RAND() LIMIT 3");
    
    while($row=mysqli_fetch_assoc($query))
    {
        echo"<div class='produkt'>";
        echo"<form method='post' action=index.php?action=shto&nr_seri=". $row["Nr_Seri"].">";
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
    ?>
   </div>

   <?php include "footeri.php";?>

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

