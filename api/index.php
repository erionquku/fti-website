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
    $user->permissions();

    $router->addRoute("POST", "/api/permissions/", function () use ($user) {
        \App\Controllers\PermissionsController::update($_POST);
    }, 'api.permission.update', $user->permissions->adm_permissions_edit ?? false);

    $router->addRoute("POST", "/api/user/language/:lang/", function ($lang) use ($user) {
        \App\Controllers\UserController::changeLanguage($lang, $user);
    }, 'api.language.change');

    $router->addRoute("POST", "/api/user/personal/edit/:id/", function ($id) use ($user) {
        if (($id == $user->id && $user->permissions->can_edit_own_personal_info) || $user->permissions->can_edit_all_personal_info)
            \App\Controllers\PersonalDataController::update($id, $_POST);
    }, 'api.user.personal.edit');

    $router->addRoute("POST", '/api/books/lend/delete/:id/', function ($id) {
        \App\Controllers\BookBorrowController::delete($id);
    }, 'api.books.delete_borrowed', $user->permissions->adm_books_edit ?? false);

    $router->addRoute("POST", '/api/books/lend', function () use ($user) {
        \App\Controllers\BookBorrowController::lend($_POST, $user);
    }, 'api.books.lend', $user->permissions->adm_books_edit ?? false);

    $router->addRoute("GET", '/api/books/lend/:id/', function ($id) {
        \App\Controllers\BookBorrowController::getLentBook($id);
    }, 'api.books.lend_id');

    $router->addRoute("POST", '/api/books/lend/:id/', function ($id) use ($user) {
        \App\Controllers\BookBorrowController::update($id, $_POST, $user);
    }, 'api.books.edit_lend_id', $user->permissions->adm_edit_books ?? false);

    $router->addRoute("POST", '/api/books/upload/', function () use ($user) {
        \App\Controllers\BookController::upload($_POST, $user);
    }, 'api.books.upload', $user->permissions->can_upload_books);

    $router->addRoute("POST", '/api/books/delete/:id/', function ($id) {
        \App\Controllers\BookController::delete($id);
    }, 'api.books.delete', $user->permissions->can_delete_books);

    $router->addRoute("GET",'/api/books/download/:id', function($id) {
        \App\Controllers\BookController::download($id);
    }, 'api.books.download', $user->permissions->can_download_books);


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


