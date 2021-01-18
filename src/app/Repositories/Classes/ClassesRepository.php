<?php


namespace App\Repositories\Classes;


use App\Models\StudentClass\StudentClass;
use App\Repositories\Contracts\ClassesRepositoryInterface;
use Core\Repositories\Classes\BaseRepository;

class ClassesRepository extends BaseRepository implements ClassesRepositoryInterface
{

    public function model(): string
    {
        return StudentClass::class;
    }

    public function table_name(): string
    {
        return "classes";
    }

    public function primary_key(): string
    {
        return "id";
    }

    public function columns(): array
    {
        // TODO: Implement columns() method.
    }
}