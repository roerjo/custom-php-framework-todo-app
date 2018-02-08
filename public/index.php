<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require '../vendor/autoload.php';

require '../bootstrap.php';

Router::load('routes.php')->direct(
    Request::uri(),
    Request::method(),
    Request::identifier()
);
