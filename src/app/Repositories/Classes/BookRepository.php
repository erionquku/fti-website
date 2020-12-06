<?php


namespace App\Repositories\Classes;


use App\Controllers\CourseController;
use App\Models\Book\Book;
use App\Repositories\Contracts\BookRepositoryInterface;
use Core\Repositories\Classes\BaseRepository;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{

    public function findAllByClassId($classId)
    {
        $courses = CourseController::findAllByClass($classId);
        foreach ($courses as $course) {
            $courseBooks = $this->findAllBy('course_id', $course->id);
            foreach ($courseBooks as $book) {
                $books[] = $book;
            }
        }

        return $books;
    }

    public function model(): string
    {
        return Book::class;
    }

    public function table_name(): string
    {
        return "books";
    }

    public function primary_key(): string
    {
        return "id";
    }

    public function columns(): array
    {
        return array("id", "title", "description", "author", "page_no", "course_id",
            "uploader_id", "path", "deleted", "created_at", "updated_at");
    }

}