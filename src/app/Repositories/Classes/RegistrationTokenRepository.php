<?php


namespace App\Repositories\Classes;


use App\Models\Token\RegistrationToken;
use App\Repositories\Contracts\RegistrationTokenRepositoryInterface;
use Core\Repositories\Classes\BaseRepository;

class RegistrationTokenRepository extends BaseRepository implements RegistrationTokenRepositoryInterface
{

    public function model(): string
    {
        return RegistrationToken::class;
    }

    public function table_name(): string
    {
        return "token_registration";
    }

    public function primary_key(): string
    {
        return "id";
    }

    public function columns(): array
    {
        return array("id", "token", "email", "created_at", "expires_at");
    }
}