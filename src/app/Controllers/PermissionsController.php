<?php


namespace App\Controllers;


use App\Repositories\Classes\PermissionsRepository;
use App\Repositories\Classes\RoleRepository;
use Core\Controllers\BaseController;

class PermissionsController extends BaseController
{
    public static function update($request)
    {
        $roleRepo = new RoleRepository();
        $permissionRepo = new PermissionsRepository();

        $allRoles = $roleRepo->all();

        $newPermissions = [];
        for ($i = 1; $i <= count($allRoles); $i++) {
            $newPermissions[$i] = [];
            if ($allRoles[$i-1]->name == 'admin')
                continue;

            foreach ((new PermissionsRepository())->columns() as $p)
                $newPermissions[$i][$p] = 0;

            foreach ($request as $key => $value) {
                if (substr($key, 0, 1) == $i)
                    $newPermissions[$i][substr($key, 2)] = 1;
            }

            $permissionRepo->update($newPermissions[$i], $i);
        }

        redirect('/adm/permissions/');
    }

    public static function getAll()
    {
        $permissionRepo = new PermissionsRepository();
        return $permissionRepo->all();
    }

    public static function getPermissions()
    {
        $permissionRepo = new PermissionsRepository();
        return $permissionRepo->columns();
    }
}