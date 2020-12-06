<?php

namespace App\Controllers;

use App\Models\User\User;
use App\Repositories\Classes\CourseRepository;
use App\Repositories\Classes\UserRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use Core\Controllers\BaseController;

class CourseController extends BaseController
{

    public static function findAllByClass($class)
    {
        $courseRepo = new CourseRepository();
        return $courseRepo->findAllBy('class_id', $class);
    }

    public static function findById($courseId)
    {
        $courseRepo = new CourseRepository();
        return $courseRepo->findBy('id', $courseId);
    }


}