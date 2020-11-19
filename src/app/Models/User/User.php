<?php

namespace App\Models\User;

use Core\Models\BaseModel;

class User extends BaseModel
{
    /**
     * @var string default language
     */
    public $lang = 'sq';

    public $mandatory_fields = array('first_name', 'last_name', 'email', 'password', 'faculty', 'year');

}