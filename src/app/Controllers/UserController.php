<?php

namespace App\Controllers;

use App\Models\User\User;
use App\Repositories\Classes\UserRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use Core\Controllers\BaseController;

class UserController extends BaseController
{

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
                exit(json_encode(array('status' => 'fail', 'message' => ___('missing_'.$field))));
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

        //TODO te duhet dhe nje funksion ne repo per login

        $user = $userRepository->findBy('email', $request['email']);

        $_SESSION['auth'] = $user;
    }


}