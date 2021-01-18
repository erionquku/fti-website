<?php


namespace App\Repositories\Contracts;

use Core\Repositories\Contracts\RepositoryInterface;

interface BookRepositoryInterface extends RepositoryInterface
{

    public function findAllByClassId($classId);

}