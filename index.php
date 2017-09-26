<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require 'bootstrap.php';

Router::load('routes.php')->direct(
    Request::uri(),
    Request::method(),
    Request::identifier()
);
