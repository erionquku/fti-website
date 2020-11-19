<?php

if (!function_exists("dd")) {
    function dd(...$vars)
    {
        foreach ($vars as $var) {
            echo "<pre>";
            var_dump($var);
            echo "</pre>";
        }
        die();
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
        header("Location: http://$base_url.$url");
    }
}

if (!function_exists('resource')) {

    function resource($name = '')
    {
        echo "http://" . $_SERVER['SERVER_NAME'] . "/resources/" . $name;
    }
}

function route($name): string
{
    global $router;
    return "http://" . $_SERVER['SERVER_NAME'] . $router->getRoute($name);
}

function array_only($array, $fields): array
{
    return array_filter($array, function ($item) use ($fields){
        return in_array($item, $fields);
    });
}