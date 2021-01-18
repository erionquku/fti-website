<?php

namespace App\Models\BookBorrow;

use App\Repositories\Classes\BookRepository;
use App\Repositories\Classes\UserRepository;

trait RelationsTrait
{
    public function user()
    {
        if (isset($this->user_id))
            $this->user = (new UserRepository())->find($this->user_id);
    }

    public function lent_user()
    {
        if (isset($this->lent_user_id))
            $this->lent_user = (new UserRepository())->find($this->lent_user_id);
    }

    public function return_user()
    {
        if (isset($this->return_user_id))
            $this->return_user = (new UserRepository())->find( $this->return_user_id);
    }

    public function book()
    {
        if (isset($this->book_id))
            $this->book = (new BookRepository())->find($this->book_id);
    }

}