<?php include "header.php";?>
<?php include "phplogin.php";?>

<title>LOG IN</title>
<link rel="icon" href="bookworm.jpeg" type="image/x-png" />

    <section style="height:calc(100vh-180px)">
        <img src="Figura/bookshelf.jpg" style="height:100%;width:100%" class="kopertina">
    </section>

        <div class="permbajtja">
            <div class="kreuFormave">
                    <h1>Log In</h1>
            </div> 
            <br>
            <form action="login.php" method="post">
            <?php include "validimi.php"; ?>
                <div>
                    <label for="emerPerdoruesi">Emri i Perdoruesit:</label> <br> 
                    <input type="text" name="emerPerdoruesi">
                </div>
                <br>
                <div>
                    <label for="password">Fjalekalimi:</label> <br>
                    <input type="password" name="password">
                </div>
                <div>

                </div>
                <input type="submit" name="login" value="Hyni">
            </form>
            <br>
            <p>Doni te rregjistroheni?<a href="rregjistrohu.php"><b>RREGJISTROHU</b></a></p> 
        </div>
        <?php include "menu.php";?>

        <?php include "footer.php";?>
