<?php
declare(strict_types=1);

require '../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Routing\Router;
use App\Routing\Request;

(new Dotenv('../'))->load();

if ($_ENV['APP_DEBUG'] === 'false') {
    ini_set('display_errors', 'off');
}

Router::load('routes.php')->direct(
    Request::uri(),
    Request::method(),
    Request::identifier()
);
