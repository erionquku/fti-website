<?php
global $router;
session_start();

require_once "vendor/autoload.php";
include "api/index.php";

$router->addRoute("GET",'/', function(){
    $view = new \Core\View();
    $view->display("home.php");
});


$router->addRoute("GET",'/login/', function(){
    $view = new \Core\View();

    if (!empty($user = logged_in())) {
        redirect('/home/');
        $view->assign('user', $user);
        $view->display('app/profile.php');
    } else {
        $view->display("login.php");
    }


//    if(!isset($_SESSION['auth'])) {
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

$all_user_pages = array('home', 'courses', 'documents', 'finance', 'links', 'profile', 'attendance', 'faq');
$user_pages = array('courses', 'documents', 'finance', 'links', 'profile', 'attendance', 'faq');
if (!empty($user = logged_in())) {

    foreach ($user_pages as $page) {
        $router->addRoute("GET", "/" . $page . '/', function () use ($user, $page) {
            $view = new \Core\View();
            $view->assign('user', $user);
            $view->assign('page', $page);
            $view->display('app/'.$page.'.php');
        }, $page . '_page');
    }

    $router->addRoute("GET", "/home/", function () use ($user, $page) {
        $view = new \Core\View();
        $view->assign('user', $user);
        $view->assign('page', $page);
        $view->assign('notifications', \App\Controllers\NotificationController::findAll());
        $view->display('app/home.php');
    }, 'home_page');


    $router->addRoute("GET", "/courses/:course_id", function ($course_id) use ($user) {
        $view = new \Core\View();
        $view->assign('user', $user);
        $view->assign('course', \App\Controllers\CourseController::findById($course_id));
        $view->assign('books', \App\Controllers\BookController::findAllByCourseId($course_id));
        $view->assign('grades', \App\Controllers\GradeController::findAllByCourseIdAndStudentId($course_id, $user->id));
        $view->display('app/course.php');
    });

    $router->addRoute("GET", "/books/", function () use ($user) {
        $view = new \Core\View();
        $view->assign('page', 'books');
        $view->assign('user', $user);

        $courses = \App\Controllers\CourseController::findAllByClass('1');
        $view->assign('courses', $courses);

        $books = \App\Controllers\BookController::findAllByCourses($courses);
        $books_general = \App\Controllers\BookController::findAllByCourseId('0');
        $books = array_merge($books, $books_general);

        $view->assign('books', $books);
        $view->display('app/books.php');
    }, 'books_page');

} else {
    foreach ($all_user_pages as $page) {
        $router->addRoute("GET", "/" . $page . '/', function () {
            redirect('/login/');
        }, $page . '_page');
    }

}

$router->doRouting();