<?php

//use App\Models\User\User;

class Register {

    public function insert()
    {
        $user = new \App\Models\User\User();
        $user->set("fname", $_POST["fname"]);
        $user->set("lname", $_POST["lname"]);
        $user->email = $_POST["email"];
        $user->pass = $_POST["pass"];

        var_dump($user);
        die();
    }
}


$reg = new Register();
$reg->insert();
