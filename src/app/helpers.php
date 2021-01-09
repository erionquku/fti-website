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

if (!function_exists('storage')) {

    function storage($name = '')
    {
        echo "http://" . $_SERVER['SERVER_NAME'] . "/storage/" . $name;
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

function logged_in()
{
    if (!isset($_SESSION['auth']) || empty($_SESSION['auth'])) {
        return null;
    }

    $sessionRepo = new \App\Repositories\Classes\SessionRepository();
    $session = $sessionRepo->findBy('session', $_SESSION['auth']);
//    dd($session);
//    $now = new DateTime();
//    if ($session->expires_at > $now) dd("greater");
//    else if ($session->expires_at < $now) dd("smaller");
//    else dd("else");
//    if (!isset($session->expires_at) || $session->expires_at < $now) {
////        dd("destroying sessions");
////        session_destroy();
//        redirect("/lockscreen/");
//        return null;
//    }

    if (empty($session->user_id)) {
        dd("session of inexistent user");
    }

    if ($session->active == "N") {
        redirect("/lockscreen/");
    }

    $userRepo = new \App\Repositories\Classes\UserRepository();
    $user = $userRepo->find($session->user_id);
    $user->session = $session;
    return $user;
//    return $userRepo->find($session->user_id);
}

function validateToken($token)
{
    if ($token == false) {
        (new \Core\View())
            ->make()
            ->noSidebar()
            ->assign("error_desc", "This token is invalid")
            ->assign("error_desc2", "This token you are using is invalid! Please try again!")
            ->setTitle("Error!")
            ->display("error/template.php");
        die();
    }

    $now = new DateTime();
    if (((array)$now)['date'] > $token->expires_at) {
        (new \Core\View())
            ->make()
            ->noSidebar()
            ->assign("error_desc", "This token has expired")
            ->assign("error_desc2", "This token you are using has expired! Please try again!")
            ->setTitle("Error!")
            ->display("error/template.php");
        die();
    }

    if (($token->used ?? 'N') == 'Y') {
        (new \Core\View())
            ->make()
            ->noSidebar()
            ->assign("error_desc", "This token is used!")
            ->assign("error_desc2", "This token is already used once!<br>Please try again with a new token!<br>")
            ->display("error/template.php");
        die();
    }
}

if (!function_exists('time_elapsed_string'))
{
    function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}

if (!function_exists('fullYN'))
{
    // TODO: Add multilanguage support
    function fullYN($yn)
    {
        if ($yn == 'Y') return "Yes";
        return "No";
    }
}
