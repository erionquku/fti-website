<?php

if (!function_exists('dd')) {
    /**
     * A simple tool we will need later
     * @param mixed ...$values
     */
    function dd(...$values)
    {
        foreach ($values as $value) {
            echo "<pre>";
            var_dump($value);
            echo "</pre>";
        }
        die;
    }
}

if (!function_exists('redirect')) {
    /**
     * @param $url
     * @param bool $external
     */
    function redirect($url, $external = false)
    {
        $base_url = $external ? '' : $_SERVER['SERVER_NAME'] . "/";
        header("Location: $base_url.$url");
    }
}

if (!function_exists('resource')) {

    function resource($name = ''){
        echo "http://".$_SERVER['SERVER_NAME'] . "/resources/" . $name;
    }
}