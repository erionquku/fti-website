<?php include "header.php";?>
<title>SHPORTA</title>

<link rel="icon" href="bookworm.jpeg" type="image/x-png" />
    <section style="height:calc(100vh-180px)">
        <img src="Figura/bookshelf.jpg" style="height:100%;width:100%" class="kopertina">
    </section>
<div class="shporta" style="width: 65%">
        <div class="tabelaShporta">
            <table class="tabela_shporta" border="1px">
            <thead>
                <th>TITULLI</th>
                <th>SASIA</th>
                <th>KOSTO TRANSPORTI</th>
                <th>CMIMI</th>
                <th>TOTALI</th>
                <th>FSHI</th>
           </thead>
           <tbody>
            <?php
                if(!empty($_SESSION["shporta"])){
                    $total = 0;
                    $i=1;
                    foreach ($_SESSION["shporta"] as $key => $value) {
                        ?>
                        <tr>
                            <td><?php print_r($value["Titulli"]); ?></td>
                            <td><?php print_r($value["Sasia"]); ?></td>
                            <td><?php if($i==1) echo"50"; else echo"30"; ?> ALL</td>
                            <td><?php print_r($value["Cmimi"]); ?> ALL</td>
                            <?php
                            $cmimiT=0;
                            if($i==1)
                            {
                                $cmimiT=$value["Sasia"] * $value["Cmimi"]+50;
                            }
                            else
                            {
                                $cmimiT=$value["Sasia"] * $value["Cmimi"]+30;
                            }
                            ?>
                            <td>
                                <?php echo number_format($cmimiT, 2); ?> ALL</td>
                            <td><a href="shporta.php?action=fshi&id=<?php echo $value["Nr_Seri"]; ?>"><span
                                        class="text-danger">FSHI</span></a></td>

                        </tr>
                        <?php
                        $total = $total + $cmimiT;
                        $i++;
                    }
                        ?>
                        <tr>
                            <td colspan="4" align="right">Total</td>
                            <th align="right"><?php echo number_format($total, 2); ?>ALL</th>
                            <td></td>
                        </tr>
                        <?php
                    }
                ?>
            <tbody>
            </table>
        </div>
        <div class="linkPaguaj">
        <?php 
        
        if(isset($_SESSION["logged"]))
        {
            if($_SESSION["emerPerdoruesi"]!='admin')
            {
                if(isset($_SESSION["shporta"])){
                  $_SESSION["total"]=$total;  
                }
                
                echo"<a href='paguaj.php'>PAGUAJ</a>";
            }
        }
        else
        {
            echo"Ju duhet te jene i loguar per te bere blerjen!";
            echo"<a href='login.php' >LOG IN</a>";
        }
        ?>
        </div>
    </div>
    <?php include "menu.php";?>

<?php  include "footer.php";?>
    <?php
    if(isset($_GET["action"]))
    {
        if($_GET["action"] == "fshi")
        {
            foreach($_SESSION["shporta"] as $keys => $values)
            {
                if($values["Nr_Seri"] == $_GET["id"])
                {
                    unset($_SESSION["shporta"][$keys]);
                    echo '<script>alert("U hoq nga shporta.")</script>';
                }
            }
        }
    }
?>
<style>
.linkPaguaj
{
    font-family:verdana;
    font-size: 20px;
    position:absolute;
    background-color: #000;
    top:80%;
    text-align:center;
    float:none;
    max-width:200px;
    margin:100px 50px 0px 600px;
    color:#fff;
    
}
</style>