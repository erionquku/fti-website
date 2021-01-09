<?php


namespace App\Repositories\Classes;


use App\Models\Book\BookBorrow;
use App\Repositories\Contracts\BookBorrowRepositoryInterface;
use Core\Repositories\Classes\BaseRepository;

class BookBorrowRepository extends BaseRepository implements BookBorrowRepositoryInterface
{

    public function model(): string
    {
        return BookBorrow::class;
    }

    public function table_name(): string
    {
        return "books_borrow";
    }

    public function primary_key(): string
    {
        return "id";
    }

    public function columns(): array
    {
        return array("id", "user_id", "book_id", "borrowed_date", "lent_user_id", "returned", "return_date", "return_user_id", "comment");
    }
}