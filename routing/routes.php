<?php

$router->get('', 'TaskController@index');
$router->post('new', 'TaskController@add');
$router->post('complete', 'TaskController@update');
$router->post('delete', 'TaskController@delete');
