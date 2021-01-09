<?php


namespace App\Repositories\Contracts;

interface BookRepositoryInterface
{

    public function findAllByClassId($classId);

}