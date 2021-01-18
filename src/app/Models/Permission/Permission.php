<?php


namespace App\Models\Permission;

use Core\Models\BaseModel;

class Permission extends BaseModel
{
    use RelationsTrait;

    public static $relations = ["role"];
}