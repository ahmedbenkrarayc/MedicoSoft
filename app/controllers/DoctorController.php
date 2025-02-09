<?php

namespace App\Controllers;

use App\Services\DoctorService;
use Core\View;

class DoctorController{
    private DoctorService $doctorService;

    public function __construct(){
        $this->doctorService = new DoctorService();
    }

    public function home(){
        return View::make('patient/home');
    }

    public function availableDoctors(){
        return json_encode(['success' => true, 'data' => $this->doctorService->availableDoctors()]);
    }
}