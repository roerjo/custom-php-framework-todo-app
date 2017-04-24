<?php
require 'vendor/vlucas/phpdotenv/src/Loader.php';
require 'vendor/vlucas/phpdotenv/src/Dotenv.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

require 'Router.php';
require 'Request.php';
require 'controllers/TaskController.php';
require 'database/QueryBuilder.php';



