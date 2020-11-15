<?php

namespace App\Controllers;

use Core\Controllers\BaseController;

class UserController extends BaseController
{
    public static function index()
    {
        echo "all users";
    }

    public static function create()
    {
        echo "create user";
    }

    public static function store()
    {
    }

    public static function show($id)
    {
        echo "User". $id;
    }


}