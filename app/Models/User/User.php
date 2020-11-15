<?php

namespace App\Models\User;

use Models\DbTable;

class User extends DbTable
{

    public function set($key, $value)
    {
        $this->$key = $value;
    }


}