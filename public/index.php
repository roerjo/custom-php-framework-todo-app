<?php
// don't allow PHP to coerce types
declare(strict_types=1);

// pluging the autoloader
require __DIR__.'/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Routing\Router;
use App\Routing\Request;

// retrieve user specified environment variables
(new Dotenv(__DIR__.'/../'))->load();

// should be turned off for a production environment
if ($_ENV['APP_DEBUG'] === 'false') {
    ini_set('display_errors', 'off');
}

// load the available routes and pass the request to the controller, if able
Router::load('routes.php')->direct(
    Request::path(),
    Request::method(),
    Request::identifier()
);
