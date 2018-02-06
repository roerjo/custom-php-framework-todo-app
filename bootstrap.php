<?php
require 'vendor/vlucas/phpdotenv/src/Loader.php';
require 'vendor/vlucas/phpdotenv/src/Dotenv.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

require 'routing/Router.php';
require 'routing/Request.php';
require 'controllers/TaskController.php';
require 'database/QueryBuilder.php';

