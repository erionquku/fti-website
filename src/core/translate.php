<?php

if (!function_exists('__')) {
    function __($text = '')
    {
        $locale = strtolower($_SESSION['auth']->lang ?? 'sq');
        include "resources/langs.php";
        echo $$locale[$text] ?? $text;
    }
}
