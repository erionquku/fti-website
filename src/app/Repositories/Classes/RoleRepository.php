<?php


namespace App\Repositories\Classes;


use App\Models\User\Role;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Core\Repositories\Classes\BaseRepository;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{

    public function model(): string
    {
        return Role::class;
    }

    public function table_name(): string
    {
        return "role_types";
    }

    public function primary_key(): string
    {
        return "id";
    }

    public function columns(): array
    {
        return array();
    }
}