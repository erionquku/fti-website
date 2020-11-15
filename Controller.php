<?php

require_once "util/load.php";

$url = explode("/", $_GET["path"]);

if ($url[0] == "home") {
    $view = new \App\View();
    $view->setTitle("Welcome");
    $view->display("home.php");
} else {
    var_dump($_GET["path"]);
    die();
}



