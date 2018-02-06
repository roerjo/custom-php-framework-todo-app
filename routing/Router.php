<?php

class Router
{
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }


    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }


    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function direct($uri, $requestType, $id='')
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
            $action = explode('@', $this->routes[$requestType][$uri]);

            $controller = 'controller/' . $action[0];

            $controller = new $action[0];

            $method = $action[1];

            return $controller->$method($id);
        }

        echo "No such controller or method.";
    }
}

