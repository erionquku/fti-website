<?php

namespace App;

class View
{

    public function assign($key, $value)
    {
        $this->$key = $value;
    }

    public function display($filename)
    {
        $this->body = "resources/views/" . $filename;
        include "layout.php";
    }

}