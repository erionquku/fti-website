<?php include "header.php";?>

        <title>SHTO LIBRA</title>
        <link rel="icon" href="bookworm.jpeg" type="image/x-png" />

        <section style="height:calc(100vh-180px)">
            <img src="Figura/bookshelf.jpg" style="height:100%;width:100%" class="kopertina">
        </section>

        <?php
        if(isset($_SESSION["logged"])&&$_SESSION["emerPerdoruesi"]=='admin')
        {
        ?>
        <form action="phpShtoLibra.php" method="post" class="shtoLibra">
            <h1>SHTO LIBRA:</h1>
            <div>
                <label>Titulli:</label><br>
                <input type="text" name="titulli"required>
            </div>
            <div>
                <label for="pershkrimi">Pershkrimi:</label><br>
                <input type="text" name="pershkrimi"required>
            </div>
            <div>
                <label for="cmimi">Cmimi:</label><br>
                <input type="text" name="cmimi"required>
            </div>
            <div>
                <label for="botuesi">Botuesi:</label><br>
                <input type="text" name="botuesi"required>
            </div>
            <div>
                <label for="publikimi">Publikimi:</label><br>
                <input type="date" name="publikimi"required>
            </div>
            <div>
                <label for="tirazhi">Tirazhi:</label><br>
                <input type="text" name="tirazhi"required>
            </div>
            <div>
                <label for="nr_faqeve">Numri Faqeve:</label><br>
                <input type="text" name="nr_faqeve" required>
            </div>
            <div>
                <label for="foto">Foto:</label><br>
                <input type="file" name="foto" >
            </div>

            <input type="submit" value="SHTO">
        </form>
        <?php
        }
        ?>
        <?php include "menu.php";?>

    <?php  include "footer.php";?>  
