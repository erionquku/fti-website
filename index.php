<?php
global $router;

use Core\View;

session_start();

require_once "vendor/autoload.php";
include "api/index.php";

$router->addRoute("GET", '/', function () {
    View::make()
        ->noSidebar()
        ->noFooter()
        ->display("home.php");
}, 'home');


$router->addRoute("GET", '/login/', function () {
    $view = View::make()
        ->noSidebar();

    if (!empty($user = logged_in())) {
        redirect('/home/');
        $view
            ->assign('user', $user)
            ->assign('page', 'home')
            ->display('app/profile.php');
    } else {
        $view->display("login.php");
    }
}, 'login');

$router->addRoute("GET", '/forgot/', function () {
    View::make()
        ->noSidebar()
        ->setTitle("Forgot password")
        ->display("forgot.php");
}, 'forgot_password');


$router->addRoute("GET", '/forgot/:token/', function ($token_str) {
    $token = \App\Controllers\ForgotPwTokenController::getbyToken($token_str);
    validateToken($token);

    $user = (new App\Repositories\Classes\UserRepository)->find($token->user_id);

    (new \Core\View())
        ->make()
        ->noSidebar()
        ->assign("token", $token)
        ->assign('first_name', $user->first_name ?? '')
        ->assign('last_name', $user->last_name ?? '')
        ->setTitle("Reset Password")
        ->display("reset_password.php");

}, 'forgot_password_token');


$router->addRoute("GET", '/register/', function () {
    $view = (new \Core\View())->noSidebar();
    $view->setTitle("Register");
    $view->display("register.php");
}, 'register');



$router->addRoute("GET", '/register/:token/', function ($token_str) {
    $token = \App\Controllers\RegistrationTokenController::getbyToken($token_str);
    validateToken($token);

    $name = substr($token->email, 0, strpos($token->email, "@"));
    if ($pos = strpos($name, '.')) {
        $first_name = strtoupper($name[0]) . strtolower(substr($name, 1, $pos - 1));
        $last_name = strtoupper($name[$pos + 1]) . strtolower(substr($name, $pos + 2));
    }

    (new \Core\View())
        ->make()
        ->noSidebar()
        ->assign("token", $token)
        ->assign('first_name', $first_name ?? '')
        ->assign('last_name', $last_name ?? '')
        ->setTitle("Welcome")
        ->display("welcome.php");

}, 'register_with_token');


$router->addRoute("GET", '/manual_register/', function () {
    (new \Core\View())
        ->make()
        ->noSidebar()
        ->setTitle("Register")
        ->display("manual_register.php");
}, 'manual_register');


//$router->addRoute("GET",'/users/', function(){
//    \App\Controllers\UserController::index();
//});
//
//
//$router->addRoute("GET",'/users/:id', function($id){
//    \App\Controllers\UserController::show($id);
//});
//
//$router->addRoute("GET",'/users/:id', function($id){
//    \App\Controllers\UserController::show($id);
//});

$all_user_pages = array('home', 'courses', 'documents', 'finance', 'links', 'profile', 'attendance', 'faq');
$user_pages = array('courses', 'documents', 'finance', 'links', 'profile', 'attendance', 'faq');
$adm_pages = array('books', 'students');

if (!empty($user = logged_in())) {

    $router->addRoute("GET", '/logout/', function () use ($user) {
        \App\Controllers\UserController::logout($user->id);
        redirect('/home/');
        session_destroy();
    }, 'logout');

    $now = new DateTime();
    if (((array)$now)['date'] < $user->session->expires_at) {

        foreach ($user_pages as $page) {
            $router->addRoute("GET", "/" . $page . '/', function () use ($user, $page) {
                $view = new \Core\View();
                $view->assign('user', $user);
                $view->assign('page', $page);
                $view->display('app/' . $page . '.php');
            }, $page . '_page');
        }

        $router->addRoute("GET", "/profile/:id/", function ($id) {
            dd((new \App\Repositories\Classes\UserRepository())->find($id));
        }, "profile_id");

        $router->addRoute("GET", "/home/", function () use ($user, $page) {
            $view = new \Core\View();
            $view->assign('user', $user);
            $view->assign('page', 'home');
            $view->assign('announcements', \App\Controllers\AnnouncementController::findAll());
            $view->display('app/home.php');
        }, 'home_page');


        $router->addRoute("GET", "/courses/:course_id", function ($course_id) use ($user) {
            \Core\View::make()
                ->assign('user', $user)
                ->assign('course', \App\Controllers\CourseController::findById($course_id))
                ->assign('books', \App\Controllers\BookController::findAllByCourseId($course_id))
                ->assign('grades', \App\Controllers\GradeController::findAllByCourseIdAndStudentId($course_id, $user->id))
                ->display('app/course.php');
        });

        $router->addRoute("GET", "/books/", function () use ($user) {
            $view = new \Core\View();
            $view->assign('page', 'books');
            $view->assign('user', $user);

            $courses = \App\Controllers\CourseController::findAllByClass($user->class_id);
            $view->assign('courses', $courses);

            $books = \App\Controllers\BookController::findAllByCourses($courses);
            $books_general = \App\Controllers\BookController::findAllByCourseId('0');
            $books = array_merge($books, $books_general);

            $view->assign('books', $books);
            $view->display('app/books.php');
        }, 'books_page');

        $router->addRoute("GET", "/books/:id/", function ($id) {
            dd((new \App\Repositories\Classes\BookRepository())->find($id));
        }, "book_id");

        $router->addRoute("GET", '/lockscreen/', function () use ($user) {
            (new \Core\View())
                ->noSidebar()
                ->setTitle("Lockscreen")
                ->assign('user', $user)
                ->display("lockscreen.php");
        }, 'lockscreen');

        $router->addRoute("GET", '/user/', function () use ($user) {
            dd($user);
        });

    } else {
        $router->addRoute("GET", '/lockscreen/', function () use ($user) {
            (new \Core\View())
                ->noSidebar()
                ->setTitle("Lockscreen")
                ->assign('user', $user)
                ->display("lockscreen.php");
        }, 'lockscreen');

        foreach ($all_user_pages as $page) {
            $router->addRoute("GET", "/" . $page . '/', function () {
                redirect('/lockscreen/');
            }, $page . '_page');
        }
    }

    if ($user->role_type_id == '1') {
        foreach ($adm_pages as $page) {
            $router->addRoute("GET", "/adm/" . $page . '/', function () {
                (new \Core\View())
                    ->make()
                    ->noSidebar()
                    ->assign("error_desc", "Missing Permissions")
                    ->assign("error_desc2", "Page you are trying to view is for administrators only!")
                    ->setTitle("Error!")
                    ->display("error/template.php");
            }, $page . '_page');
        }
    } else {

        $router->addRoute("GET", "/adm/students/", function () use ($user) {
            (new \Core\View())
                ->assign('user', $user)
                ->assign('students', \App\Controllers\UserController::getAll())
                ->assign('page', 'adm_students_page')
                ->setTitle("Administration")
                ->display("app/adm/students.php");
        }, 'adm_students_page');

        $router->addRoute("GET", "/adm/books/", function () use ($user) {
            (new \Core\View())
                ->assign('user', $user)
                ->assign('book_borrow', \App\Controllers\BookBorrowController::getAll())
                ->assign('books', \App\Controllers\BookController::getAll())
                ->assign('page', 'adm_books_page')
                ->setTitle("Administration")
                ->display("app/adm/books.php");
        }, 'adm_books_page');

    }

} else {
    foreach (array_merge($all_user_pages, $adm_pages) as $page) {
        $router->addRoute("GET", "/" . $page . '/', function () {
            redirect('/login/');
        }, $page . '_page');
    }
}

$router->doRouting();