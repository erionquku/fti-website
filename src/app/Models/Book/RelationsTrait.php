<?php

namespace App\Models\Book;

use App\Repositories\Classes\CourseRepository;
use App\Repositories\Classes\UserRepository;

trait RelationsTrait
{
    public function uploader()
    {
        $this->uploader = (new UserRepository())->find($this->uploader_id);
    }

    public function course()
    {
        $this->course = (new CourseRepository())->find($this->course_id);
    }
}