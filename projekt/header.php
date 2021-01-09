<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width"/>
    <meta name="keywords" content="libri,autori,titulli,viti i botimit"/>
    <link rel="icon" href="bookworm.jpeg" type="image/x-png" />
    <link href="style.css" rel="stylesheet" type="text/css">
   
    </head>
    <body>
        <header>
            <div class="ikona" style=" float:right; left:61.5%; ">
            <?php
             if(isset($_SESSION["logged"]))
             {
                if($_SESSION["logged"]==1&&$_SESSION["emerPerdoruesi"]!='admin')
                {
                    echo"<a href='profili.php' id='element'>".$_SESSION["emerPerdoruesi"]."<img src='Figura/user.jpg' alt='' width='30px' height='30px'></a>";
                    echo"<a href='shporta.php' id='element'>Shporta<img src='Figura/shporta.png' alt=''width='30px' height='30px'></a>";
                    echo"<a href='paguaj.php' id='element'>Paguaj<img src='Figura/paguaj.jpg' alt=''width='30px' height='30px'></a>";
                    echo"<a href='kontakto.php'id='element'>Kontakto<img src='Figura/kontakto.png' alt=''width='25px' height='25px'></a>";
                }
                else 
                {
                    echo"<a href='profili.php' id='element'>".$_SESSION["emerPerdoruesi"]."<img src='Figura/profili.png' alt='' width='40px' height='40px'></a>";
                }
            }
                else
                {
                    echo"<a href='login.php' id='element'>LOG IN/Rregjistrohu<img src='Figura/rregjistrohu.png' alt='' width='30px' height='30px'></a>";
                    echo"<a href='shporta.php' id='element'>Shporta<img src='Figura/shporta.png' alt=''width='30px' height='30px'></a>";
                    echo"<a href='kontakto.php'id='element'>Kontakto<img src='Figura/kontakto.png' alt=''width='30px' height='30px'></a>";
                } 
            ?>
                
                
            <?php    
                if(isset($_SESSION["logged"]))
             {
                if($_SESSION["logged"]==1)
                {
                    echo"<a href='logout.php' id='element'>LOG OUT<img src='Figura/dil.jpg' alt='' width='25px' height='25px'></a>"; 
                }
            }
            ?>
            </div>
        </header>

    <div class="kreu">
            <img src="bookworm.jpeg" height="150px" width="200px" id="logo">

            <form action="shfleto.php" id="kerko" method="get">
                <input type="text" placeholder="Kerko" name="kerko" id=kerko_tekst />
                <img src='Figura/th.png' width='40px' height='40px'  id='butoni_kerkimit'>
                <?php
                if(isset($_GET["kerko"]))
                {
                $kerko=$_GET["kerko"];
                echo"<a href='shfleto.php?kerko=".$kerko."'></a>";
                }
            ?>
            </form>
    </div>  
   