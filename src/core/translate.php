<?php

if (!function_exists('__')) {
    function __($text = '', $locale = 'en')
    {
        include "resources/langs.php";
        echo $$locale[$text] ?? $text;
    }
}
