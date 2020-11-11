<?php

if (!function_exists('__')) {
    include "resources/langs.php";
    function __($text = '', $locale = 'en')
    {
        echo $$locale[$text] ?? $text;
    }
}
