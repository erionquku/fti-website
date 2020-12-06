<?php

namespace App\Repositories\Classes;

use Core\Repositories\Classes\BaseRepository;

class SessionRepository extends BaseRepository implements \App\Repositories\Contracts\BookRepositoryInterface
{
    public function model(): string
    {
        return \App\Models\User\Session::class;
    }

    public function table_name(): string
    {
        return "sessions";
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

}