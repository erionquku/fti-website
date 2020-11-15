<?php

require_once "vendor/autoload.php";

$router = new \Core\Router();

$router->addRoute("GET",'/', function(){
    $view = new \Core\View();
    $view->display("home.php");
});

$router->addRoute("GET",'/login/', function(){
    $view = new \Core\View();
    $view->display("login.php");
});

$router->addRoute("POST",'/login', function(){
    \App\Controllers\UserController::show();
});

$router->addRoute("GET",'/register/', function(){
    $view = new \Core\View();
    $view->display("register.php");
});

$router->addRoute("GET",'/users/', function(){
    \App\Controllers\UserController::index();
});

$router->addRoute("GET",'/users/create', function(){
    \App\Controllers\UserController::create();
});

$router->addRoute("POST",'/users/create', function(){
    \App\Controllers\UserController::store();
});

$router->addRoute("GET",'/users/:id', function($id){
    \App\Controllers\UserController::show($id);
});

$router->addRoute("GET",'/users/:id', function($id){
    \App\Controllers\UserController::show($id);
});

$router->doRouting();
