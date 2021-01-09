<div class="menu">
<nav class="lista">
    <ul>
    <?php
    include("lidhja.php");
            if(isset($_SESSION["logged"]))
            {
                if($_SESSION["logged"]==1&&$_SESSION["emerPerdoruesi"]!='admin')
                {
                    echo"<li class='active'><a href='index.php'>KREU</a></li>";
                    echo"<li><a href='rreth-nesh.php'>RRETH NESH</a></li>";
                    echo"<li><a>KATEGORITE</a>
                            <div class='kategorite'>
                                <ul>";
                                $zgjidh='SELECT * FROM lib_kat';
                                $result=mysqli_query($databaza,$zgjidh);
                                while($row=mysqli_fetch_assoc($result)){
                                    echo"<li><a href='shfleto.php?kategoria=".$row['ID_Kat']."'>".$row['Kategoria']."</a></li>";
                                }
                                echo"</ul>
                            </div>
                        </li>";
                    echo"<li><a href='http://leximtari.al/'>BLOG</a></li>";
                }
                else   
                {
                    echo"<li><a>SHTO</a>
                        <div class='kategorite'>
                            <ul>
                                <li><a href='shtoLibra.php'>LIBRA</a></li>
                                <li><a href='shtoAutore.php'>AUTORE</a></li>
                            </ul>
                        </div>
                        </li>";
                    echo"<li><a>FSHI</a>
                        <div class='kategorite'>
                            <ul>
                                <li><a href='fshiLibra.php'>LIBRA</a></li>
                                <li><a href='fshiAutore.php'>AUTORE</a></li>
                            </ul>
                        </div>
                        </li>";
                    echo"<li><a href='users.php'>USERS</a></li>";
                    echo"<li><a href='porosite.php'>POROSITE</a></li>";
                }
            }
        else{
                echo"<li class='active'><a href='index.php'>KREU</a></li>";
                echo"<li><a href='rreth-nesh.php'>RRETH NESH</a></li>";
                echo"<li><a>KATEGORITE</a>
                    <div class='kategorite'>
                        <ul>";
                        $zgjidh='SELECT * FROM lib_kat';
                        $result=mysqli_query($databaza,$zgjidh);
                        while($row=mysqli_fetch_assoc($result)){
                            echo"<li><a href='shfleto.php?kategoria=".$row['ID_Kat']."'>".$row['Kategoria']."</a></li>";
                        }
                        echo"</ul>
                    </div>
                </li>";
                
                echo"<li><a href='http://leximtari.al/'>BLOG</a></li>";
            }
    ?>
    </ul>
</nav>
</div>
