<?php

namespace App\Controllers;

use App\Models\User\User;
use App\Repositories\Classes\CourseRepository;
use App\Repositories\Classes\ForgotPwTokenRepository;
use App\Repositories\Classes\SessionRepository;
use App\Repositories\Classes\UserRepository;
use App\Repositories\Contracts\SessionRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Core\Controllers\BaseController;
use DateInterval;
use DateTime;

class UserController extends BaseController
{
//    protected static $userRepository;
//    protected static $sessionRepository;
//
//    public function __construct(UserRepositoryInterface $userRepository, SessionRepositoryInterface $sessionRepository)
//    {
//        self::$userRepository = $userRepository;
//        self::$sessionRepository = $sessionRepository;
//    }

    public static function getAll()
    {
        return (new UserRepository())->all();
    }

//    public static function create()
//    {
//        // TODO : Shfaq registration form
//    }

    public static function changeLanguage($language, $user)
    {
        $language = strtolower($language);
        if ($language != "sq" && $language != "en" && $language != "it")
            exit(json_encode(array("success" => false, "message" => "Invalid request")));

        $_SESSION['lang'] = $language;

        $userRepo = new UserRepository();
        $status = $userRepo->update(array('lang' => $language), $user->id);

        if ($status)
            exit(json_encode(array("success" => true)));
        else
            exit(json_encode(array("success" => false, "message" => "Something went wrong. Please try again later!")));

    }

    public static function store($request)
    {
        header('Content-type:application/json;charset=utf-8');
        $user = new User();

        $userRepo = new UserRepository();

        foreach (User::$mandatory_fields as $field) {
            if (!empty($request[$field]))
                $user->$field = $request[$field];
            else
                exit(json_encode(array('status' => 'fail', 'message' => ___('missing_' . $field))));
        }

        if (strlen($user->password) < 6) {
            echo json_encode(array("status" => "fail", "message" => "Please enter password with more than 6 characters"));
            return;
        }
        $user_plain_pw = $user->password;
        $user->password = md5($user->password);
        $user->role_type_id = 1;

        $existing = $userRepo->countBy("email", $user->email);

        if ($existing > 0) {
            echo json_encode(array("success" => false, "message" => "This email is already registered. You may want to login."));
            return;
        }

        if ($userRepo->store((array)$user)) {
            UserController::login(array("email" => $user->email, "password" => $user_plain_pw))['success'];
        } else {
            echo json_encode(array("success" => false, "message" => "user did not register lmao"));
        }
    }


    public static function welcome($request)
    {
        $token = RegistrationTokenController::getbyToken($request['token']);

        if ($request['email'] == $token->email)
            UserController::store($request);
        else
            exit(json_encode(array('success' => false, 'message' => ___('Invalid token/email! Please try again later...'))));
    }


    public static function show($id)
    {
        echo "User" . $id;
    }


    public static function logout($user_id)
    {
        $sessionRepo = new SessionRepository();
        $sessionRepo->disableAllById($user_id);
    }

    /**
     *
     *
     * @param array $request
     */
    public static function login(array $request)
    {
        $data = [
            'email' => $request['email'],
            'password' => md5($request['password']),
            "remember" => $request["remember"] ?? false
        ];

        $userRepo = new UserRepository();
        if ($user = $userRepo->attemptLogin($data['email'], $data['password'])) {

            $sessionRepo = new SessionRepository();
            $session = bin2hex(random_bytes(32));

            $now = new DateTime();
            if ($data["remember"])
                $now->add(new DateInterval("PT24H"));
            else
                $now->add(new DateInterval("PT3H"));

            $status = $sessionRepo->store_session($user->id, $session, $now->format('Y-m-d H:i:s'));

            if ($status) {
                $_SESSION['auth'] = $session;
                $_SESSION['lang'] = $user->lang;

                exit(json_encode(array("success" => $status)));
            }
            exit(json_encode(array("success" => false, "message" => "couldn't store session, try again")));
        } else {
            exit(json_encode(array("success" => false, "message" => "wrong email/password")));
        }

    }

    public static function lockscreen_login(array $request, $sessionUser)
    {
        if (isset($request['password']))
            $password = md5($request['password']);
        else
            exit(json_encode(array('success' => false, 'message' => 'please enter a password')));

        $userRepo = new UserRepository();
        if ($userRepo->attemptLogin($sessionUser->email, $password)) {

            $sessionRepo = new SessionRepository();
            $now = new DateTime();
            $now->add(new DateInterval("PT3H"));
            $status = $sessionRepo->update(array('expires_at' => $now->format('Y-m-d H:i:s')), $sessionUser->session->id);
            if ($status) {
//                redirect("/home/");
                exit(json_encode(array("success" => true, "message" => "successfully logged in")));
            } else
                exit(json_encode(array("success" => true, "message" => "couldn't update session, pls try again")));

        } else {
            exit(json_encode(array("success" => false, "message" => "wrong email/password")));
        }

    }

    public static function resetPassword(array $data)
    {
        if (!isset($data) || empty($data))
            exit(json_encode(array('success' => false, 'message' => 'Please enter a password!')));

        if (strlen($data['password']) < 6)
            exit(json_encode(array("success" => false, "message" => "Please use a longer password!")));

        $token = ForgotPwTokenController::getbyToken($data['token']);
        if ($token == false)
            exit(json_encode(array("success" => false, "message" => "This link is invalid! Please try again!")));

        if ($token->used == "Y")
            exit(json_encode(array("success" => false, "message" => "This token has already been used once!")));

        $now = new DateTime();
        if (((array)$now)['date'] > $token->expires_at)
            exit(json_encode(array("success" => false, "message" => "This token has expired!")));

        $userRepo = new UserRepository();
        $user = $userRepo->find($token->user_id);
        if ($userRepo->update(array('password' => md5($data['password'])), $token->user_id)) {
            $tokenRepo = new ForgotPwTokenRepository();
            if ($tokenRepo->update(array("used" => "Y"), $token->id))
                if (UserController::login(array("email" => $user->email, "password" => $data['password']))['success'])
                    exit(json_encode(array('success' => true, 'message' => 'Your password was sucessfully changed!')));
        }
    }


}