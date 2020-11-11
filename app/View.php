<?php

namespace App;

class View
{
    /**
     * Assigns a variable to the view
     * can be accessed by $this -> (name of variable) on the view file
     *
     * @param $key
     * @param $value
     */
    public function assign($key, $value)
    {
        $this->$key = $value;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Calls the view file
     *
     * @param $filename
     */
    public function display($filename)
    {
        $this->body = "resources/views/" . $filename;
        include "layout.php";
    }

    /**
     * May be useful for ajax calls
     *
     * @param $filename
     */
    public function textOnly($filename = null){
        if (file_exists($filename)) {
            include $filename;
        } else if (file_exists("resources/views/" . $filename)){
            include "resources/views/" . $filename;
        }
        die;
    }

}