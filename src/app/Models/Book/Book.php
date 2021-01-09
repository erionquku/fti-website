<?php


namespace App\Models\Book;


use Core\Models\BaseModel;

class Book extends BaseModel
{
    public static $fillable = array("title", "description", "author", "page_no", "course_id");

}