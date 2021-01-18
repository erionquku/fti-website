<?php

namespace Core;

class Router
{
    private $routes = [];
    private $lock = false;
    private $login = true;

    public function setLoginNeeded($login) {
        $this->login = $login;
    }

    public function setLock($lock) {
        $this->lock = $lock;
    }

    public function addRoute($method, $url, $callback, $name = null, $permission = true)
    {
        $this->routes[] = [
            'method' => $method,
            'url' => $url,
            'callback' => $callback,
            'name' => $name,
            'permission' => $permission
        ];
    }

    public function doRouting()
    {
        $reqUrl = $_SERVER['REQUEST_URI'];
        $reqMet = $_SERVER['REQUEST_METHOD'];


        foreach ($this->routes as $route) {
            // convert urls like '/users/:uid/posts/:pid' to regular expression
            $pattern = "@^" . preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', preg_quote($route['url'])) . "$@D";
            $matches = array();

            // check if the current request matches the expression
            if ($reqMet == $route['method'] && preg_match($pattern, $reqUrl, $matches)) {

                if ($this->login && $route['name'] != 'login') {
                    redirect('/login/');
                }

                if ($this->lock && $route['name'] != 'lockscreen') {
                    redirect('/lockscreen/');
                }

                if (!$route['permission']) {
                    (new \Core\View())
                        ->make()
                        ->noSidebar()
                        ->assign("error_desc", "Missing Permissions")
                        ->assign("error_desc2", "You do not have permissions to view this page!")
                        ->setTitle("Error!")
                        ->display("error/template.php");
                    die();
                }

                // remove the first match
                array_shift($matches);
                // call the callback with the matched positions as params
                return call_user_func_array($route['callback'], $matches);
            }
        }

        (new \Core\View())
            ->make()
            ->noSidebar()
            ->setTitle('404')
            ->assign("error_title", "404")
            ->assign("error_desc", "Page not found!")
            ->assign("error_desc2", "We could not find requested page.")
            ->display("error/template.php");
    }

    public function getRoute($name)
    {
        if ($name === null) {
            return null;
        }
        foreach ($this->routes as $route) {
            if ($route['name'] === $name) {
                return $route['url'];
            }
        }
        return null;
    }

}