<?php

namespace App\Repositories\Classes;

use App\Repositories\Contracts\SessionRepositoryInterface;
use Core\Repositories\Classes\BaseRepository;

class SessionRepository extends BaseRepository implements SessionRepositoryInterface
{
    public function model(): string
    {
        return \App\Models\User\Session::class;
    }

    public function table_name(): string
    {
        return "token_session";
    }

    public function primary_key(): string
    {
        return "id";
    }

    public function columns(): array
    {
        return array("id", "user_id", "session", "created_at", "expires_at");
    }

    public function store_session($user_id, $session, $expires_at): bool
    {
        $query = "INSERT INTO ". self::table_name() ." (`user_id`, `session`, `expires_at`)
            VALUES ('$user_id', '$session', CAST('". $expires_at ."' AS DATETIME))";
        return execute_query($query);
    }

    public function disableAllById($user_id)
    {
        $query = "UPDATE ". self::table_name() ." SET `active` = 'N' where `user_id` = '". $user_id ."'";
        return execute_query($query);
    }

}