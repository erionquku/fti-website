<?php

$router->addRoute("POST",'/api/login', function(){
    \App\Controllers\UserController::login($_POST);
}, 'api.login');

$router->addRoute("POST",'/api/register', function() {
    \App\Controllers\UserController::store($_POST);
}, 'api.register');

if (!empty($user = logged_in())) {
    $router->addRoute("POST", '/api/books/upload', function () use ($user) {
        \App\Controllers\BookController::upload($_POST, $user);
    }, 'api.books.upload');
} else {
//    exit(json_encode(array("success" => false, "message" => "You are not logged in")));
}

if (!empty($user = logged_in())) {
    $router->addRoute("GET", '/api/notification/:id', function ($id) use ($user) {
        \App\Controllers\NotificationController::find($id);
    }, 'api.notification');
} else {
//    exit(json_encode(array("success" => false, "message" => "You are not logged in")));
}

$router->addRoute("GET",'/api/books/download/:id', function($id) {
    \App\Controllers\BookController::download($id);
}, 'api.books.download');

//$router->addRoute("GET",'/api/findall', function() {
//    dd(\App\Controllers\GradeController::findAllByCourseIdAndStudentId('2', '20'), "test");
//}, 'api.register.post2');
