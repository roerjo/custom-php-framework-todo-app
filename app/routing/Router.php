<?php

/**
 * Class: Router
 *
 */
class Router
{
    /**
     * routes
     *
     * @var array
     */
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Load the routes file and return a new Router instance
     *
     * @param string $file
     *
     * @return Router
     */
    public static function load(string $file): Router
    {
        $router = new static;

        require $file;

        return $router;
    }


    /**
     * Load GET routes and controllers into the routes array
     *
     * @param string $uri
     * @param string $controller
     */
    public function get(string $uri, string $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }


    /**
     * Load POST routes and controllers into the routes array
     *
     * @param string $uri
     * @param string $controller
     */
    public function post(string $uri, string $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    /**
     * Handle the incoming request
     *
     * @param string $uri
     * @param string $requestType
     * @param string $id
     */
    public function direct(string $uri, string $requestType, string $id='')
    {
        // if the requested route in the routes array
        if (array_key_exists($uri, $this->routes[$requestType])) {

            // parse the controller@method
            $action = explode('@', $this->routes[$requestType][$uri]);

            $controller = new $action[0];

            $method = $action[1];

            if (method_exists($controller, $method)) {
                $controller->$method($id);
            } else {
                throw new Exception("Routing error");
            }
        } else {
            throw new Exception("Not found");
        }
    }
}

