<?php

namespace App\Controllers;

use App\Services\DashboardService;
use App\Services\AuthService;
use Core\View;

class DashboardController{
    private DashboardService $dashboardService;
    private AuthService $authService;

    public function __construct(){
        $this->dashboardService = new DashboardService();
        $this->authService = new AuthService();
    }

    public function index(){
        return View::make('doctor/dashboard', ['user' => $this->authService->currentuser(), 'statistics' => $this->dashboardService->statistics()]);
    }
}