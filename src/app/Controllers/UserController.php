<?php

namespace App\Controllers;

use App\Models\User\User;
use App\Repositories\Classes\UserRepository;
use Core\Controllers\BaseController;

class UserController extends BaseController
{

    public static function index()
    {
        echo "all users";
    }

    public static function create() : User
    {
        $user = new User();
        $user->first_name = $_POST["first_name"];
        $user->last_name = $_POST["last_name"];
        $user->email = $_POST["email"];
        $user->password = $_POST["password"];
        return $user;
    }

    public static function store()
    {
        $user = self::create();
        if (strlen($user->password) < 6) {
            echo json_encode(array("status" => "fail", "message" => "Please enter password with more than 6 characters"));
            return;
        }

        $userRepo = new UserRepository();
        $existing = $userRepo->countBy("email", $user->email);
        if ($existing > 0) {
            echo json_encode(array("status" => "fail", "message" => $existing. " users already registered with this password! Please choose another one! "));
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
        echo "User". $id;
    }


}