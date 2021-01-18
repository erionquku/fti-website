<?php

namespace App\Models\User;

use App\Repositories\Classes\BookBorrowRepository;
use App\Repositories\Classes\BookRepository;
use App\Repositories\Classes\ClassesRepository;
use App\Repositories\Classes\GradeRepository;
use App\Repositories\Classes\PermissionsRepository;
use App\Repositories\Classes\PersonalDataRepository;
use App\Repositories\Classes\RoleRepository;
use App\Repositories\Classes\SessionRepository;

trait RelationsTrait
{
    public function sessions()
    {
        $this->sessions = (new SessionRepository())->findAllByData(array('user_id' => $this->id, "active" => "Y"));
    }

    public function books()
    {
        $this->uploaded_books = (new BookRepository())->findAllByData(array(
            "deleted" => "N",
            "uploader_id" => $this->id
        ));
//        $this->uploaded_books->boot_relations();
    }

    public function borrowed_books()
    {
        $this->borrowed_books = (new BookBorrowRepository())->findAllByData(array(
            "deleted" => "N",
            "user_id" => $this->id
        ));
        foreach ($this->borrowed_books as $book)
            $book->bootRelations();
    }

    public function lent_books()
    {
        $this->lent_books = (new BookBorrowRepository())->findAllByData(array(
            "deleted" => "N",
            "lent_user_id" => $this->id
        ));
        foreach ($this->lent_books as $book)
            if (isset($book))
                $book->bootRelations();
    }

    public function grades()
    {
        $this->grades = (new GradeRepository())->findAllByData(array(
            "deleted" => "N",
            "student_id" => $this->id
        ));
        foreach($this->grades as $grade)
            if (isset($grade))
                $grade->bootRelations();
    }

    public function role()
    {
        $this->role = (new RoleRepository())->find($this->role_type_id);
    }

    public function class()
    {
        $this->class = (new ClassesRepository)->find($this->class_id);
    }

    public function personal()
    {
        $this->personal = (new PersonalDataRepository())->find($this->id);
    }

    public function permissions()
    {
        $this->permissions = (new PermissionsRepository())->find($this->role_type_id);
    }


}