<?php

namespace Core;

class View
{
    protected $sidebar = true;

    public static function make()
    {
        return new self;
    }

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
        return $this;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Calls the view file
     *
     * @param $filename
     */
    public function display($filename)
    {
        $this->body = "resources/views/" . $filename;
        include "resources/layout.php";
    }

    /**
     * May be useful for ajax calls
     *
     * @param $filename
     */
    public function textOnly($filename = null)
    {
        if (file_exists($filename)) {
            include $filename;
        } else if (file_exists("resources/views/" . $filename)) {
            include "resources/views/" . $filename;
        }
        die;
    }

    public function noSidebar(): View
    {
        $this->sidebar = false;
        return $this;
    }

    public function noFooter(): View
    {
        $this->footer = false;
        return $this;
    }


}