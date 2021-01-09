<?php include "header.php";?>

    <title>SHTO AUTORE</title>
    <link rel="icon" href="bookworm.jpeg" type="image/x-png" />
     
    <section style="height:calc(100vh-180px)">
        <img src="Figura/bookshelf.jpg" style="height:100%;width:100%" class="kopertina">
    </section>

        <?php
        if(isset($_SESSION["logged"])&&$_SESSION["emerPerdoruesi"]=='admin')
        {
        ?>
        <form action="phpShtoAutore.php" method="post" class="shtoAutore">
            <h1>SHTO AUTORE:</h1>
            <div>
                <label>Emri:</label><br>
                <input type="text" name="emri"required>
            </div>
            <div>
                <label for="mbiemer">Mbiemri:</label><br>
                <input type="text" name="mbiemri"required>
            </div>

            <input type="submit" value="SHTO">
        </form>
        <?php
        }
        ?>
        <?php include "menu.php";?>
 
    <?php  include "footer.php";?>  
