<?php

namespace App\Models\BookBorrow;

use Core\Models\BaseModel;

class BookBorrow extends BaseModel
{
    use RelationsTrait;

    public static $relations = array("user", "lent_user", "return_user", "book");

}