<?php


global $langs;

$langs = [
    'en' => [
        'login' => 'Log In',
        'signup' => 'Sign Up',
        'title' => [
            'home' => 'Home'
        ],
        'sidebar' => [
            'home' => 'Home',
            'menu' => 'Menu',
            'my_profile' => 'My Profile'
        ],
        'home' => [
            'announcements_title' => 'Announcements',
            'announcement_add' => 'Add'
        ]
    ],

    'sq' => [
        'login' => 'Hyr',
        'signup' => 'Regjistrohu',
        'title' => [
            'home' => 'Kryefaqja'
        ],
        'sidebar' => [
            'home' => 'Kryefaqja',
            'menu' => 'Menuja',
            'my_profile' => 'Profili im'
        ],
        'home' => [
            'announcements_title' => 'Lajmerime',
            'announcement_add' => 'Shto'
        ]
    ]
];

if (!function_exists('__')) {
    function __($text = '')
    {
        echo ___($text);
    }
}

if (!function_exists('___')) {
    function ___($text = '')
    {
        $locale = strtolower($_SESSION['lang']->lang ?? 'sq');
        $translation = explode('.', $text);

        $index = null;
        global $langs;
        if (isset($langs[$locale][$translation[0]])) {
            if (is_array($langs[$locale][$translation[0]])) {
                $t = $langs[$locale][$translation[0]][$translation[1]] ?? $text;
            }
        } else {
            $t = $langs[$locale][$translation[0]] ?? $text; # $translation[0];
        }

        if ($text == null) {
            return null;
        }

        return $t ?? $text;
    }
}
