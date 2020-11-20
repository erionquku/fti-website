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
        global $en, $sq;
        if($text == null){
            return null;
        }
        $locale = strtolower($_SESSION['auth']->lang ?? 'sq');

        return $$locale[$text] ?? $text;
    }
}
