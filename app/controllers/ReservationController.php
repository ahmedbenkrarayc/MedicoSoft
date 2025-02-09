<?php

namespace App\Controllers;

use App\Services\ReservationService;
use Core\View;

class ReservationController{
    private ReservationService $reservationService;

    public function __construct(){
        $this->reservationService = new ReservationService();
    }

    public function cancelReservation($id){
        $this->patientService->updateReservationStatus($id, 'cancelled');
        header('Location: /patient/reservations');
    }
}