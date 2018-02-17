<?php

namespace App\Routing;

/**
 * Class: Request
 *
 */
class Request
{
    /**
     * Extracts the URI from the URL
     *
     * return string
     */
    public static function uri(): string
    {
        // remove leading and trailing slashes from the URI
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        // break the URI into an array
        $idTest = explode('/', $uri);

        // check if the last part of the URI is a resource id
        if (is_numeric($idTest[count($idTest) - 1])) {
            // set the URI equal to everthing before the resource id
            $uri = strstr($uri, '/', true);
        }

        return $uri;
    }

    /**
     * Retrieves the Http method
     *
     * return string
     */
    public static function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Retrieves the last portion of the URI, which should be the
     * resource id.
     *
     * return string
     */
    public static function identifier(): string
    {
        return basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    }
}

