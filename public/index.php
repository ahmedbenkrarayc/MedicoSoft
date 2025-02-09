<?php
require_once './../vendor/autoload.php';
require __DIR__.'/../app/config/environment.php';

use App\Exceptions\RouteNotFoundException;
use App\Controllers\AuthController;

$router = new Core\Router;

$router
// ->get('/test/register', [AuthController::class, 'registerGET'])
// ->post('/register', [AuthController::class, 'registerPOST']);
->group('/auth', function($group){
    $group->get('/register', [AuthController::class, 'registerGET']);
    $group->post('/register', [AuthController::class, 'registerPOST']);
    $group->get('/login', [AuthController::class, 'loginGET']);

});

try{
    echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));
}catch(RouteNotFoundException $e){
    echo $e->getMessage();
}