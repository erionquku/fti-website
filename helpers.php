<?php

if (!function_exists('dd')) {
    /**
     * A simple tool we will need later
     * @param mixed ...$values
     */
    function dd(...$values)
    {
        foreach($values as $value) {
            echo "<pre>";
            var_dump($value);
            echo "</pre>";
        }
        die;
    }
}