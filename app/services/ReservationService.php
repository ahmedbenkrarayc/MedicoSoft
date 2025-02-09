<?php

namespace App\Services;

use App\Repositories\ReservationRepository;
use App\Models\Medecin;
use App\Exceptions\InputException;

class ReservationService{
    private ReservationRepository $repository;

    public function __construct(){
        $this->repository = new ReservationRepository();
    }

    public function updateReservationStatus($id, $status){
        try{
            return $this->repository->updateReservationStatus($id, $status);
        }catch(\Exception $e){
            return false;
        }
    }
}