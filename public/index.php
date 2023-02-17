<?php

use Router\Router;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

require '../vendor/autoload.php';

$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);


$router = new Router($_GET['url']);

$router->get('/', 'App\Controllers\MissionController@welcome');
$router->get('/missions', 'App\Controllers\MissionController@index');
$router->get('/missions/:id', 'App\Controllers\MissionController@show');

$router->run();