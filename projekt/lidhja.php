<?php
$databaza=mysqli_connect("localhost","root","","libraria");
if(!$databaza)
{
    echo "Nuk u realizua lidhja". mysqli_connect_error();
}
?>