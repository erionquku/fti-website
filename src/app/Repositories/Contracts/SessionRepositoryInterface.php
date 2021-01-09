<?php


namespace App\Repositories\Contracts;


interface SessionRepositoryInterface extends \Core\Repositories\Contracts\RepositoryInterface
{

    public function store_session($user_id, $session, $expires_at): bool;

    public function disableAllById($user_id);
    
}