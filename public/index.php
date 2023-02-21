<?php

use App\Exceptions\NotFoundException;
use Router\Router;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

require '../vendor/autoload.php';
require '../connect.php';

define('DEBUG_TIME', microtime(true)); //constante temps actuelle

$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

$router = new Router($_GET['url']);

$router->get('/', 'App\Controllers\MissionController@welcome');
$router->get('/missions', 'App\Controllers\MissionController@index');
$router->get('/missions/:id', 'App\Controllers\MissionController@show');
$router->get('/countries/:id','App\Controllers\MissionController@country');

$router->get('/admin/missions', 'App\Controllers\Admin\AdminMissionController@index');
$router->post('/admin/missions/delete/:id', 'App\Controllers\Admin\AdminMissionController@destroy');
$router->get('/admin/missions/edit/:id', 'App\Controllers\Admin\AdminMissionController@edit');
$router->post('/admin/missions/edit/:id', 'App\Controllers\Admin\AdminMissionController@update');
// TODO match ??

try {
    $router->run();
} catch (NotFoundException $e) {
    return $e->error404();
}