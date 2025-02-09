<?php
session_start();
require_once './../vendor/autoload.php';
require __DIR__.'/../app/config/environment.php';

use App\Exceptions\RouteNotFoundException;
use App\Controllers\AuthController;
use App\Middlewares\GuestMiddleware;
use App\Middlewares\AuthMiddleware;

$router = new Core\Router;

$router
->get('/', function(){
    return 'hi';
}, [AuthMiddleware::class, 'doctor'])
->group('/auth', function($group){
    $group->get('/register', [AuthController::class, 'registerGET']);
    $group->post('/register', [AuthController::class, 'registerPOST']);
    $group->get('/login', [AuthController::class, 'loginGET']);
    $group->post('/login', [AuthController::class, 'loginPOST']);

}, [GuestMiddleware::class])
->post('/logout', [AuthController::class, 'logout']);

try{
    echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));
}catch(RouteNotFoundException $e){
    echo $e->getMessage();
}