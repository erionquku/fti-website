<?php

session_start();

session_unset();

unset($_SESSION["logged"]);
unset($_SESSION["emerPerdoruesi"]);

session_destroy();

header("location:index.php");

exit();

?>