<?php

require_once "util/load.php";

$view = new \App\View();
$view->setTitle("Welcome");
$view->display("home.php");