<?php

if (!function_exists('__')) {
    function __($text = '')
    {
        echo ___($text);
    }
}

if (!function_exists('___')) {
    function ___($text = '')
    {
        if($text == null){
            return null;
        }
        $locale = strtolower($_SESSION['auth']->lang ?? 'sq');
        include "/xampp2/htdocs/fti-website/resources/langs.php";
        return $$locale[$text] ?? $text;
    }
}
