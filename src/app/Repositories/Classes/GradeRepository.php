<?php


namespace App\Repositories\Classes;


use App\Models\Grade\Grade;
use App\Repositories\Contracts\GradeRepositoryInterface;
use Core\Repositories\Classes\BaseRepository;

class GradeRepository extends BaseRepository implements GradeRepositoryInterface
{
    public function model(): string
    {
        return Grade::class;
    }

    public function table_name(): string
    {
        return "grades";
    }

    public function primary_key(): string
    {
        return "id";
    }

    public function columns(): array
    {
        return array("id", "student_id", "course_id", "grade_type_id", "grade", "description", "created_at", "updated_at");
    }

}