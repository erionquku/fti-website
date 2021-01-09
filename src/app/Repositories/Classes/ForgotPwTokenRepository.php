<?php


namespace App\Repositories\Classes;


use App\Models\Token\ResetPwToken;
use App\Repositories\Contracts\ForgotPwTokenRepositoryInterface;
use Core\Repositories\Classes\BaseRepository;

class ForgotPwTokenRepository extends BaseRepository implements ForgotPwTokenRepositoryInterface
{

    public function model(): string
    {
        return ResetPwToken::class;
    }

    public function table_name(): string
    {
        return "token_reset_pw";
    }

    public function primary_key(): string
    {
        return "id";
    }

    public function columns(): array
    {
        return array("id", "token", "user_id", "created_at", "expires_at");
    }
}