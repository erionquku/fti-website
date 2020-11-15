<?php

namespace Core;

class Router
{
    private $routes = [];

    public function addRoute($method, $url, $callback){
        $this->routes[] = ['method' => $method, 'url' => $url, 'callback' => $callback];
    }

    public function doRouting(){

        $reqUrl = $_SERVER['REQUEST_URI'];
        $reqMet = $_SERVER['REQUEST_METHOD'];

        foreach($this->routes as  $route) {
            // convert urls like '/users/:uid/posts/:pid' to regular expression
            $pattern = "@^" . preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', preg_quote($route['url'])) . "$@D";
            $matches = Array();

            // check if the current request matches the expression
            if($reqMet == $route['method'] && preg_match($pattern, $reqUrl, $matches)) {
                // remove the first match
                array_shift($matches);
                // call the callback with the matched positions as params
                return call_user_func_array($route['callback'], $matches);
            }
        }
    }

}