<?php

namespace App\Controllers;

use App\Services\UnavailableService;
use App\Services\AuthService;
use Core\View;

class UnavailableController{
    private UnavailableService $unavailableService;
    private AuthService $authService;

    public function __construct(){
        $this->unavailableService = new UnavailableService();
        $this->authService = new AuthService();
    }

    public function index(){
        return View::make('doctor/unavailable', ['user' => $this->authService->currentuser()]);
    }

    public function create(){
        $this->unavailableService->createUnavailable($_POST);
        header('Location: /doctor/dashboard');
    }
}