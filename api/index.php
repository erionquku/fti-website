<?php

$router->addRoute("POST",'/api/login', function(){
//    (new \App\Controllers\UserController(new \App\Repositories\Classes\UserRepository(), new \App\Repositories\Classes\SessionRepository()))->login($_POST);
    if (!empty($user = logged_in())) {
        \App\Controllers\UserController::lockscreen_login($_POST, $user);
    } else {
        \App\Controllers\UserController::login($_POST);
    }
}, 'api.login');

$router->addRoute("POST",'/api/register', function() {
//    (new \App\Controllers\UserController(new \App\Repositories\Classes\UserRepository(), new \App\Repositories\Classes\SessionRepository()))->store($_POST);
    \App\Controllers\UserController::store($_POST);
}, 'api.register');

//$router->addRoute("GET",'/api/register/:token', function($token) {
//    \App\Controllers\RegistrationTokenController::getRegistrationToken()
//}, 'api.register');

$router->addRoute("POST",'/api/user/register/token/', function() {
//    dd($_POST);
    \App\Controllers\UserController::welcome($_POST);
}, 'api.register_with_token');

$router->addRoute("POST",'/api/register/token/', function() {
    \App\Controllers\RegistrationTokenController::createToken($_POST['email']);
}, 'api.register_get_token');

$router->addRoute("POST",'/api/forgot/', function() {
    \App\Controllers\ForgotPwTokenController::createToken($_POST['email']);
}, 'api.forgot_get_token');

$router->addRoute("POST",'/api/reset/password/', function() {
    \App\Controllers\UserController::resetPassword($_POST);
}, 'api.reset_password');

if (!empty($user = logged_in())) {

    $router->addRoute("POST", '/api/books/lend', function () use ($user) {
        \App\Controllers\BookBorrowController::lend($_POST, $user);
    }, 'api.books.lend');

    $router->addRoute("GET", '/api/books/lend/:id/', function ($id) {
        \App\Controllers\BookBorrowController::getLentBook($id);
    }, 'api.books.lend_id');

    $router->addRoute("POST", '/api/books/lend/:id/', function ($id) use ($user) {
        \App\Controllers\BookBorrowController::update($id, $_POST, $user);
    }, 'api.books.edit_lend_id');

    $router->addRoute("POST", '/api/books/upload', function () use ($user) {
        \App\Controllers\BookController::upload($_POST, $user);
    }, 'api.books.upload');

    $router->addRoute("GET",'/api/books/download/:id', function($id) {
        \App\Controllers\BookController::download($id);
    }, 'api.books.download');

    $router->addRoute("POST", '/api/announcement/', function () use ($user) {
        \App\Controllers\AnnouncementController::store($_POST, $user);
    }, 'api.announcement.post');

    $router->addRoute("GET", '/api/announcement/:id', function ($id) use ($user) {
        \App\Controllers\AnnouncementController::find($id);
    }, 'api.announcement.get');

    $router->addRoute("GET", '/api/user/', function () use ($user) {
        dd($user);
    });

}


