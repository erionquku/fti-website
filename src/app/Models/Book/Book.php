<?php


namespace App\Models\Book;

use Core\Models\BaseModel;

class Book extends BaseModel
{
    use RelationsTrait;

    public static $fillable = array("title", "description", "author", "page_no", "course_id");
    public static $relations = array("uploader", "course");

}