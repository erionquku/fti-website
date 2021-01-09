<?php

namespace App\Models\User;

use App\Repositories\Classes\SessionRepository;
use Core\Models\BaseModel;

class User extends BaseModel
{
    use RelationsTrait;

    /**
     * @var string default language
     */
    public $lang = 'sq';

    public static $relations = [
        'sessions'
    ];

    public static $mandatory_fields = array('first_name', 'last_name', 'email', 'password');

}