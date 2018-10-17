<?php

namespace App\Routing;

/**
 * Class: Request
 *
 */
class Request
{
    /**
     * Extracts the path from the URL
     *
     * @return string
     */
    public static function path(): string
    {
        // remove leading and trailing slashes from the URI
        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        // break the path into an array
        $idTest = explode('/', $path);

        // check if the last part of the path is a resource id
        if (is_numeric($idTest[count($idTest) - 1])) {
            // set the path equal to everthing before the resource id
            $path = strstr($path, '/', true);
        }

        return $path;
    }

    /**
     * Retrieves the HTTP method
     *
     * @return string
     */
    public static function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Retrieves the last portion of the URI, which should be the
     * resource id.
     *
     * @return string
     */
    public static function identifier(): string
    {
        return basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    }
}
