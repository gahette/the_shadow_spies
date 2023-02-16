<?php

use Router\Router;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

require '../vendor/autoload.php';

$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();


$router = new Router($_GET['url']);

$router->get('/', 'App\Controllers\MissionsController@index');
$router->get('/mission/:id', 'App\Controllers\MissionsController@show');

$router->run();