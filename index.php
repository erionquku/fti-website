<?php

require_once "load.php";

$view = new \App\View();
$view->assign('name', 'User');
$view->display("home.php");