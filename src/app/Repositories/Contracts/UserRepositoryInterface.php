<?php


namespace App\Repositories\Contracts;

use Core\Repositories\Contracts\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function attemptLogin($email, $password);
}