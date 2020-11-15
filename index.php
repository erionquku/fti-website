<?php

require_once "vendor/autoload.php";

$router = new \Core\Router();
$router->addRoute("GET", "/profile/:id", function ($id) {
    echo "this is profile of id: " . $id;
});
$router->doRouting();
