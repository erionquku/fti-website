<?php


namespace App\Controllers;


use App\Models\Book\BookBorrow;
use App\Repositories\Classes\BookBorrowRepository;
use App\Repositories\Classes\BookRepository;
use App\Repositories\Classes\UserRepository;
use Core\Controllers\BaseController;
use DateTime;

class BookBorrowController extends BaseController
{

    public static function getAll()
    {
        $bbRepo = new BookBorrowRepository();
        return $bbRepo->all();
    }

    public static function update($id, $request, $user)
    {
        if (!isset($request['return_date']) || empty($request['return_date']))
            exit(json_encode(array("success" => false, "message" => "Please fill return date!")));
        if (!isset($request['returned']) || empty($request['returned']))
            exit(json_encode(array("success" => false, "message" => "Please set a return status!")));

        $bbRepo = new BookBorrowRepository();
        $bb = $bbRepo->find($id);
        if (!isset($request['returned']) || empty($request['returned']))
            exit(json_encode(array("success" => false, "message" => "Something went wrong! This BB doesn't exist!")));

        $newData = array(
            "return_date" => $request["return_date"],
            "returned" => $request["returned"],
            "comment" => $request["comment"]
        );

        if ($request['returned'] == "Y") {
            $now = new DateTime();

            $newData['return_user_id'] = $user->id;
            $newData['return_date'] = $now->format('Y-m-d H:i:s');
        }

        if ($bbRepo->update($newData, $id))
            exit(json_encode(array("success" => true, "message" => "Sucessfully saved!")));

        exit(json_encode(array("success" => false, "message" => "Something went wrong!")));
    }

    public static function getLentBook($id)
    {
        if (isset($id) && !empty($id)) {
            $bbRepo = new BookBorrowRepository();
            $bb = $bbRepo->find($id);
            $bb->bootRelations();

            $response = array(
                "borrowing_user" => [
                    "first_name" => $bb->user->first_name,
                    "last_name" => $bb->user->last_name
                ],
                "book_title" => $bb->book->title,
                "lent_user" => [
                    "first_name" => $bb->lent_user->first_name,
                    "last_name" => $bb->lent_user->last_name
                ],
                "to_return_date" => $bb->to_return_date,
                "returned" => $bb->returned,
                "returned_date" => $bb->return_date,
                "return_user" => [
                    "first_name" => $bb->return_user->first_name ?? '',
                    "last_name" => $bb->return_user->last_name ?? ''
                ],
                "comment" => $bb->comment,
                "lent_date" => $bb->borrowed_date
            );
            exit(json_encode($response));
        }
    }

    public static function lend($request, $user)
    {
        if (!isset($request['firstName']) || empty($request['firstName']))
            exit(json_encode(array("success" => false, "message" => "Please enter a first name!")));
        if (!isset($request['lastName']) || empty($request['lastName']))
            exit(json_encode(array("success" => false, "message" => "Please enter a first name!")));
        if (!isset($request['bookId']) || empty($request['bookId']))
            exit(json_encode(array("success" => false, "message" => "Please enter the book title!")));
        if (!isset($request['returnDate']) || empty($request['returnDate']))
            exit(json_encode(array("success" => false, "message" => "Please enter the return date!")));

        $userRepo = new UserRepository();
        $borrowingUser = $userRepo->findAllByData(array("first_name" => $request['firstName'], 'last_name' => $request['lastName']));

        if (!isset($borrowingUser) || $borrowingUser == null)
            exit(json_encode(array("success" => false, "message" => "Student name is not valid!")));

        $bookRepo = new BookRepository();
        $book = $bookRepo->find($request['bookId']);
        if (!isset($book) || empty($book))
            exit(json_encode(array("success" => false, "message" => "This book doesn't exist!")));

        $bb = new BookBorrow();
        $bb->user_id = $borrowingUser[0]->id;
        $bb->book_id = $book->id;
        $bb->to_return_date = $request['returnDate'];
        $bb->lent_user_id = $user->id;
        $bb->comment = $request['comment'];

        $bbRepo = new BookBorrowRepository();
        if ($bbRepo->store((array)$bb))
            exit(json_encode(array("success" => true, "message" => "Book was sucessfully lent!")));
        else
            exit(json_encode(array("success" => false, "message" => "Something went wrong!")));
    }

}