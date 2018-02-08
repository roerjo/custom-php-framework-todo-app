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
     * @return object
     */
    public static function load(string $file)
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
     *
     * return mixed
     */
    public function direct(string $uri, string $requestType, string $id='')
    {
        // if the requested route in the routes array
        if (array_key_exists($uri, $this->routes[$requestType])) {

            // parse the controller@method
            $action = explode('@', $this->routes[$requestType][$uri]);

            $controller = new $action[0];

            $method = $action[1];

            // return the result of the controller's method
            return $controller->$method($id);
        }

        // ghetto error handling
        echo "No such controller or method.";
    }
}

