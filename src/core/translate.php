<?php

if (!function_exists('__')) {
    function __($text = '')
    {
        $locale = strtolower($_SESSION['auth']->lang ?? 'sq');
        include "/xampp2/htdocs/fti-website/resources/langs.php";
        echo $$locale[$text] ?? $text;
    }
}

if (!function_exists('___')) {
    function ___($text = '')
    {
        $locale = strtolower($_SESSION['auth']->lang ?? 'sq');
        include "/xampp2/htdocs/fti-website/resources/langs.php";
        return $$locale[$text] ?? $text;
    }
}
