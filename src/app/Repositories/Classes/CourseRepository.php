<?php


namespace App\Repositories\Classes;


use App\Models\Course\Course;
use App\Repositories\Contracts\CourseRepositoryInterface;
use Core\Repositories\Classes\BaseRepository;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    public function model(): string
    {
        return Course::class;
    }

    public function table_name(): string
    {
        return "courses";
    }

    public function primary_key(): string
    {
        return "id";
    }

    public function columns(): array
    {
        return array("id", "name", "description", "teacher_id", "class_id");
    }


}