<?php include "header.php";?>
<?php include "server.php";?>
    <title>RREGJISTROHU</title>
    <link rel="icon" href="bookworm.jpeg" type="image/x-png" />

    <section style="height:calc(100vh-180px)">
        <img src="Figura/bookshelf.jpg" style="height:100%;width:100%" class="kopertina">
    </section>

        <div class="format">
          <div class="kreuFormave">
                <h1>KRIJO NJE LLOGARI</h1>
          </div> 

          <form action="rregjistrohu.php" method="post">
             <?php include "validimi.php" ; ?>
                <div>
                    <label>Emri:</label><br>
                    <input type="text" name="emri" >
                    
                </div>
                <div>
                    <label>Mbiemri:</label><br>
                    <input type="text" name="mbiemri">
                    
                </div>
                <div>
                    <label for="emerPerdoruesi">Emri i perdoruesit:</label><br>
                    <input type="text" name="emerPerdoruesi">
                    
                </div>
                <div>
                    <label for="password">Fjalekalimi:</label><br>
                    <input type="password" name="password">
                    
                </div>
                <div>
                    <label for="email">Email:</label><br>
                    <input type="email" name="email">
                    
                </div>
                <div>
                    <label for="adresa">Adresa:</label><br>
                    <input type="text" name="adresa">
                    
                </div>
                <div>
                    <label for="qyteti">Qyteti:</label><br>
                    <input type="text" name="qyteti">
                    
                </div>
                <div>
                    <label for="shteti">Shteti:</label><br>
                    <input type="text" name="shteti">
                    
                </div>
                <div>
                    <label for="kodiPostar">Kodi Postar:</label><br>
                    <input type="text" name="kodiPostar">
                    
                </div>

                <input type="submit" name="rregjistrohu" value="Hyni">
          </form>
         <p>Jeni nje user?<a href="login.php"><b>LOG IN</b></a></p> 
        </div>
        
        <?php include "menu.php";?>
      
    <?php  include "footer.php";?>  


    <style>
        .error 
        {
            position:absolute;
            top:15%;
            left:105%;
            width: 50%; 
            margin: 0px auto; 
            padding: 2px; 
            border: 1px solid #a94442; 
            color: #a94442; 
            background: #f2dede; 
        
            text-align: left;
        }
    </style>


