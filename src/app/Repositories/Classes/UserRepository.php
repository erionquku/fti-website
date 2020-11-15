<?php

namespace App\Repositories\Classes;

use App\Models\User\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Core\Repositories\Classes\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function model() : string
    {
        return User::class;
    }

    public function table_name(): string
    {
        return 'users';
    }

    public function primary_key(): string
    {
        return 'username';
    }
}