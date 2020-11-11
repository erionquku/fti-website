<?php

require_once "load.php";

$view = new \App\View();
$view->setTitle("Welcome");
$view->display("home.php");