<?php

namespace App\Repositories\Contracts;

use Core\Repositories\Contracts\RepositoryInterface;

interface SessionRepositoryInterface extends RepositoryInterface
{

    public function store_session($user_id, $session, $expires_at): bool;

    public function disableAllById($user_id);
    
}