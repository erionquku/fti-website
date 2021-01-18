<?php

namespace App\Repositories\Classes;

use App\Models\User\PersonalData;
use App\Repositories\Contracts\PersonalDataRepositoryInterface;
use Core\Repositories\Classes\BaseRepository;

class PersonalDataRepository extends BaseRepository implements PersonalDataRepositoryInterface
{

    public function model(): string
    {
        return PersonalData::class;
    }

    public function table_name(): string
    {
        return "users_personal";
    }

    public function primary_key(): string
    {
        return "user_id";
    }

    public function columns(): array
    {
        // TODO: Implement columns() method.
    }
}