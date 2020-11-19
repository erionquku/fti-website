<?php

require_once "vendor/autoload.php";
session_start();
global $router;

$router->addRoute("GET",'/', function(){
    $view = new \Core\View();
    $view->display("home.php");
});

//TODO beje thjesht qe te shfaqe formin e logimit, se ate do e rreg
$router->addRoute("GET",'/login', function(){
    $view = new \Core\View();
//    if(!isset($_SESSION['auth'])) {
        $view->display("login.php");
//    } else {
//        redirect("/");
//    }
});


//TODO
$router->addRoute("GET",'/register/', function(){
    $view = new \Core\View();
    $view->setTitle("Register");
    $view->display("register.php");
}, 'register');



$router->addRoute("GET",'/users/', function(){
    \App\Controllers\UserController::index();
});


$router->addRoute("GET",'/users/:id', function($id){
    \App\Controllers\UserController::show($id);
});

$router->addRoute("GET",'/users/:id', function($id){
    \App\Controllers\UserController::show($id);
});

$router->addRoute("GET",'/api/asdf', function($id){
    echo "REQUEST IS GETTING HERE";
});

$router->doRouting();