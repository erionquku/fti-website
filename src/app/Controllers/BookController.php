<?php


namespace App\Controllers;

use App\Models\Book\Book;
use App\Repositories\Classes\BookRepository;
use App\Repositories\Classes\UserRepository;
use Core\Controllers\BaseController;

class BookController extends BaseController
{
    const path = 'storage/books/';

    public static function download($bookId)
    {
        if (empty($bookId))
            exit(json_encode(array("success" => false, "message" => "Empty filename!")));

        $bookRepo = new BookRepository();
        $book = $bookRepo->find($bookId);
        $file = BookController::path . $book->path;

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }

    public static function upload($request, $user)
    {
        if (isset($_FILES['file'])) {
            $extensions = ['doc', 'docx', 'pdf'];

            $file_name = $_FILES['file']['name'];
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_type = $_FILES['file']['type'];
            $file_size = $_FILES['file']['size'];
            $array = explode('.', $_FILES['file']['name']);
            $file_ext = strtolower(end($array));

            if (!in_array($file_ext, $extensions)) {
                $error = strtoupper($file_ext) . ' extension not allowed!';
                exit(json_encode(array("success" => false, "message" => $error)));
            }

            $new_file_name = "book_" . self::getMaxId() . "." . $file_ext;
            $file = BookController::path . $new_file_name;

            if ($file_size > 2097152) {
                $error = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
                exit(json_encode(array("success" => false, "message" => $error)));
            }

            if (empty($error)) {
                if (!move_uploaded_file($file_tmp, $file)) {
                    exit(json_encode(array("success" => false, "message" => 'Couldn\'t upload file')));
                }
            }
        }

        $book = new Book();
        foreach (Book::$fillable as $field) {
            if (!empty($request[$field])) $book->$field = $request[$field];
            else exit(json_encode(array('status' => 'fail', 'message' => ___('missing_' . $field))));
        }

        $book->path = $new_file_name;
        $book->uploader_id = $user->id;
        $bookRepo = new BookRepository();
        $success = $bookRepo->store((array)$book);
        exit(json_encode(array("success" => $success)));
    }

    public static function findAllByCourseId($courseId)
    {
        $booksRepo = new BookRepository();
        return self::fillBooksWithUploader($booksRepo->findAllByData(array('course_id' => $courseId, "deleted" => "N")));
    }

    public static function findAllByCourses($courses)
    {
        $booksRepo = new BookRepository();
        $userRepo = new UserRepository();

        foreach ($courses as $course) {

            $courseBooks = $booksRepo->findAllByData(array('course_id' => $course->id, "deleted" => "N"));

            foreach ($courseBooks as $courseBook) {
                $user = $userRepo->find($courseBook->uploader_id);
                $courseBook->uploader = $user;
                $books[] = $courseBook;
            }
        }
        
        return $books;
    }

    public static function findAllByClassId($classId)
    {
        $bookRepo = new BookRepository();
        return $bookRepo->findAllByClassId($classId);
    }

    private static function fillBooksWithUploader($books)
    {
        $userRepo = new UserRepository();
        foreach ($books as $book) {
            if (!empty($book->uploader_id))
                $book->uploader = $userRepo->find($book->uploader_id);
        }
        return $books;
    }

    private static function getMaxId()
    {
        $bookRepo = new BookRepository();
        return $bookRepo->countAll();
    }

}