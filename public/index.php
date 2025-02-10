<?php
session_start();
require_once './../vendor/autoload.php';
require __DIR__.'/../app/config/environment.php';

use App\Exceptions\RouteNotFoundException;
use App\Controllers\AuthController;
use App\Controllers\DoctorController;
use App\Controllers\PatientController;

use App\Middlewares\GuestMiddleware;
use App\Middlewares\AuthMiddleware;

$router = new Core\Router;

$router
->get('/', [DoctorController::class, 'home'])
->get('/doctor/list', [DoctorController::class, 'availableDoctors'])
->get('/doctor/profile/{id}', [DoctorController::class, 'profile'])
->get('/doctor/settings', [DoctorController::class, 'editProfile'], [AuthMiddleware::class, 'doctor'])
->post('/doctor/updateprofile', [DoctorController::class, 'updateProfile'], [AuthMiddleware::class, 'doctor'])
->group('/auth', function($group){
    $group->get('/register', [AuthController::class, 'registerGET']);
    $group->post('/register', [AuthController::class, 'registerPOST']);
    $group->get('/login', [AuthController::class, 'loginGET']);
    $group->post('/login', [AuthController::class, 'loginPOST']);
}, [GuestMiddleware::class])
->get('/currentUser', [AuthController::class, 'user'])
->group('/patient', function($group){
    $group->get('/reservations', [PatientController::class, 'reservations']);
    $group->post('/cancelreservation', [ReservationController::class, 'cancelReservation']);
    $group->post('/createreservation/{idmedecin}', [ReservationController::class, 'createReservation']);
}, [AuthMiddleware::class, 'patient']);

try{
    echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));
}catch(RouteNotFoundException $e){
    echo $e->getMessage();
}