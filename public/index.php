<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require '../vendor/autoload.php';

(new Dotenv\Dotenv('../'))->load();

Router::load('routes.php')->direct(
    Request::uri(),
    Request::method(),
    Request::identifier()
);
