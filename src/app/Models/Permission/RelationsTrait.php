<?php

namespace App\Models\Permission;

use App\Repositories\Classes\RoleRepository;

trait RelationsTrait
{
    public function role()
    {
        $this->role = (new RoleRepository())->find($this->role_id);
    }
}