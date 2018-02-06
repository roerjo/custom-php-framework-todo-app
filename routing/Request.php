<?php

class Request
{
    public static function uri()
    {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        $idTest = explode('/', $uri);

        if (is_numeric($idTest[count($idTest) - 1])) {
            $uri = strstr($uri, '/', true);
        }

        return $uri;
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function identifier()
    {
        return basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    }
}

