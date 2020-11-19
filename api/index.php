<?php

require_once "../vendor/autoload.php";
global $router;

$router->addRoute("POST",'/api/login', function(){
    \App\Controllers\UserController::login($_POST);
}, 'api.login.post');

$router->addRoute("POST",'/api/register', function() {
    \App\Controllers\UserController::store($_POST);
}, 'api.register.post');

$router->addRoute("GET",'/api/register', function() {
    echo "api.login.post route is: ";
    global $router;
    dd($router->getRoute('api.login.post'));
}, 'api.register.post2');

$router->addRoute("GET", '/api/test/', function (){
    echo "TESTING";
    dd("TEST");
});

$router->doRouting();
