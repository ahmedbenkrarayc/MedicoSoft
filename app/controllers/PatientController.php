<?php

namespace App\Controllers;

use App\Services\PatientService;
use Core\View;

class PatientController{
    private PatientService $patientService;

    public function __construct(){
        $this->patientService = new PatientService();
    }

    public function reservations(){
        $reservations = $this->patientService->reservations() ?? [];
        return View::make('patient/reservations', ['reservations' => $reservations]);
    }
}