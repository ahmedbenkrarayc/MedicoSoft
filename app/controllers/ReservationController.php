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
        $this->reservationService->updateReservationStatus($id, 'cancelled');
        header('Location: /patient/reservations');
    }

    public function createReservation($idmedecin){
        $this->reservationService->createReservation($_POST, $id_medecin);
        header('Location: /patient/reservations');
    }
}