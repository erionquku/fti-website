<?php


namespace App\Controllers;

use App\Repositories\Classes\BookRepository;
use App\Repositories\Classes\GradeRepository;
use Core\Controllers\BaseController;

class GradeController extends BaseController
{

    public static function findAllByCourseIdAndStudentId($courseId, $studentId)
    {
        $gradeRepo = new GradeRepository();
        return $gradeRepo->findAllByData(array('course_id' => $courseId, 'student_id' => $studentId));
    }

}