<?php

namespace App\Controllers;

use App\Models\User\User;
use App\Repositories\Classes\CourseRepository;
use App\Repositories\Classes\SessionRepository;
use App\Repositories\Classes\UserRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use Core\Controllers\BaseController;
use DateInterval;
use DateTime;

class UserController extends BaseController
{
    protected static $userRepository;
    protected static $courseRepository;

    public function __construct()
    {
        self::$userRepository = new UserRepository();
        self::$courseRepository = new CourseRepository();
    }

    public static function index()
    {
        echo "all users";
    }

    public static function create()
    {
        // TODO : Shfaq registration form
    }

    public static function store($request)
    {
        header('Content-type:application/json;charset=utf-8');
        $user = new User();

        foreach ($user->mandatory_fields as $field) {
            if (!empty($request[$field]))
                $user->$field = $request[$field];
            else
                exit(json_encode(array('status' => 'fail', 'message' => ___('missing_' . $field))));
        }

        if (strlen($user->password) < 6) {
            echo json_encode(array("status" => "fail", "message" => "Please enter password with more than 6 characters"));
            return;
        }

        $userRepo = new UserRepository();
        $existing = $userRepo->countBy("email", $user->email);

        if ($existing > 0) {
            echo json_encode(array("status" => "fail", "message" => "This email is already registered. You may want to login."));
            return;
        }

        if ($userRepo->store((array)$user)) {
            echo json_encode(array("status" => "success", "message" => "successfully registered"));
        } else {
            echo json_encode(array("status" => "fail", "message" => "user did not register lmao"));
        }
    }


    public static function show($id)
    {
        echo "User" . $id;
    }

    /**
     * TODO Validation
     *
     * @param array $request
     */
    public static function login(array $request)
    {
        $userRepository = new UserRepository();
        $data = [
            'email' => $request['email'],
            'password' => md5($request['password'])
        ];


        if ($user = $userRepository->attemptLogin($data['email'], $data['password'])) {
            $sessionRepo = new SessionRepository();

            $session = bin2hex(random_bytes(32));
            $now = new DateTime();
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


}