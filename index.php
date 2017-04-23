<?php

require 'bootstrap.php';

Router::load('routes.php')->direct(
    Request::uri(),
    Request::method(),
    Request::identifier()
);




