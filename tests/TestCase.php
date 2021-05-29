<?php

namespace Tests;

use Dotenv\Dotenv;
use App\Routing\Router;
use App\Routing\Request;
use App\Database\QueryBuilder;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();

        (new Dotenv('.', '.env.testing'))->load();

        (new QueryBuilder)->migrate();
    }

    public function request($path, $method = 'GET', $body = [])
    {
        $_SERVER['REQUEST_URI'] = $path;
        $_SERVER['REQUEST_METHOD'] = $method;

        if (isset($body['title'])) {
            $_REQUEST['title'] = $body['title'];
        }
        if (isset($body['description'])) {
            $_REQUEST['description'] = $body['description'];
        }

        return Router::load('routes.php')->direct(
                Request::path(),
                Request::method(),
                Request::identifier()
            );
    }
}
