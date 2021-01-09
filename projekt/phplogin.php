<?php

$databaza=mysqli_connect("localhost","root","","libraria");
if(!$databaza)
{
    echo "Nuk u realizua lidhja". mysqli_connect_error();
}
$errors = array(); 
if (isset($_POST['login'])){
$emerPerdoruesi=$_POST["emerPerdoruesi"];
$password=$_POST["password"];

if (empty($emerPerdoruesi)) {
    array_push($errors, "Plotersoni fushen e username-it");
}
if (empty($password)) {
    array_push($errors, "Plotesoni fushen e fjalekalimit");
}

if (count($errors) == 0) {
$query="SELECT * FROM klienti WHERE EmerPerdoruesi='$emerPerdoruesi' AND Fjalekalimi='$password'";
$rezultat=mysqli_query($databaza,$query);
$ekziston=mysqli_num_rows($rezultat);
if($ekziston==1)
{
    if($emerPerdoruesi!='admin')
    {
       header('location:index.php'); 
    }
    else
    {
        header('location:porosite.php'); 
    }
    
    $_SESSION["emerPerdoruesi"]=$emerPerdoruesi;
    $_SESSION["logged"]=1;

}else {
    array_push($errors, "Kombimin i gabur i username-it dhe password-it");
}
}
}

?>