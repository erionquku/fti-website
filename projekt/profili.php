<?php include "header.php";?>

    <title>PROFILI</title>
    <link rel="icon" href="bookworm.jpeg" type="image/x-png" />

    <section style="height:calc(100vh-180px)">
        <img src="Figura/bookshelf.jpg" style="height:100%;width:100%" class="kopertina">
    </section>

        <?php
            $databaza=mysqli_connect("localhost","root","","libraria");
            if(!$databaza)
            {
                echo "Nuk u realizua lidhja". mysqli_connect_error();
            }
            if(isset($_SESSION["logged"]))
            {
                $emriPerdoruesit=$_SESSION["emerPerdoruesi"];
                echo"<table class='tabela'><thead><tr><td font-weight='bold' colspan='2'>Te Dhenat</td></thead><tbody>";
                $sql = mysqli_query($databaza,"SELECT * FROM klienti WHERE emerPerdoruesi='$emriPerdoruesit'" );
                    while ($row = mysqli_fetch_assoc($sql))
                    {
                        echo "<tr><td font-weight='bold'>Emri</td><td>" . $row['Emri'] . "</td>
                              <td><a href='profili.php?Update=Emri'>NDRYSHO</a></td>
                              </tr>";
                        echo "<tr><td font-weight='bold'>Mbiemri</td><td>" . $row['Mbiemri'] . "</td>
                              <td><a href='profili.php?Update=Mbiemri'>NDRYSHO</a></td>
                             </tr>";
                        echo "<tr><td font-weight='bold'>Emer Perdoruesi</td><td>" .$emriPerdoruesit . "</td>
                              <td><a href='profili.php?Update=emerPerdoruesi'>NDRYSHO</a></td>
                              </tr>";
                        echo "<tr><td font-weight='bold'>Fjalekalimi</td><td>" . $row['Fjalekalimi'] . "</td>
                              <td><a href='profili.php?Update=Fjalekalimi'>NDRYSHO</a></td>
                              </tr>";
                        echo "<tr><td font-weight='bold'>Email</td><td>" . $row['Email'] . "</td>
                              <td><a href='profili.php?Update=Email'>NDRYSHO</a></td>
                              </tr>";
                        echo "<tr><td font-weight='bold'>Adresa</td><td>" . $row['Adresa'] . "</td><td>
                              <a href='profili.php?Update=Adresa'>NDRYSHO</a></td>
                              </tr>";
                        echo "<tr><td font-weight='bold'>Qyteti</td><td>" . $row['Qyteti'] . "</td><td>
                              <a href='profili.php?Update=Qyteti'>NDRYSHO</a></td>
                              </tr>";
                        echo "<tr><td font-weight='bold'>Shteti</td><td>" . $row['Shteti'] . "</td><td>
                              <a href='profili.php?Update=Shteti'>NDYSHO</a></td>
                              </tr>";
                        echo "<tr><td font-weight='bold'>Kodi Postar</td><td>" . $row['Kodi_Postar'] . "</td><td>
                              <a href='profili.php?Update=Kodi_Postar'>NDRYSHO</a></td>
                              </tr>";
                        echo "<tr><td font-weight='bold'><a href='profili.php?fshiId=".$row["ID_Klienti"]."'>FSHI</a></td>
                              </tr>";
                    }
                        }
                if(isset($_GET['fshiId']))
                {
                    $fshiID=$_GET['fshiId'];
                    $sql1="DELETE FROM klienti WHERE ID_Klienti='$fshiID'";
                    $rezultat=mysqli_query($databaza,$sql1);
                    if($rezultat)
                    echo"<script type='text/javascript'> alert('U fshi me sukses'); window.location.href='index.php'</script>";
                    unset($_SESSION["logged"]);
                    unset($_SESSION["emerPerdoruesi"]);
                    session_destroy();
                }
                ?>
                <div class='update'>
                <?php
                if(isset($_GET['Update']))
                {  
                    $update=$_GET['Update'];

                    echo"<form action='profili.php' method='post' >$update
                          <input type='text' name='input1' required>
                          <input type='submit' name='test' value='Ndrysho'></form>";
                    if(isset($_POST['test']))
                    {
                    $ndrysho=mysqli_escape_string($databaza,$_POST['input1']);
                    if(isset($ndrysho))
                    {
                        $sql2="UPDATE klienti SET $update=$ndrysho WHERE EmerPerdoruesi=$emriPerdoruesit";
                        $rezultat1=mysqli_query($databaza,$sql2);
                        if($rezultat1)
                        echo"<script type='text/javascript'> alert('U ndryshua me sukses'); window.location.href='profili.php'</script>";
                    }
                    else
                    {
                        echo"ndodhi nje gabim";
                    }
                    }
                    
                }
        ?></div>
        </tbody>
    </table>
    <?php include "menu.php";?>

<?php include "footer.php";?> 


<style>
.update 
{
    background-color:rgb(238, 232, 170);
    background-color:rgba(238, 232, 170,0.9);
    padding:10px;
    position:absolute; 
    top:105%; 
    left:39%;
}
</style>