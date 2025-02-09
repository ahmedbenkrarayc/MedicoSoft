<?php

namespace App\Services;

use App\Repositories\ReservationRepository;
use App\Models\Reservation;
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

    public function createReservation($request, $idmedecin){
        try{
            $user = new Reservation(null, $request['reservation_date'], 'pending', $_SESSION['user_id'], $idmedecin);
            if($this->repository->createReservation($user)){
                return ['success' => true];
            }

            return ['success' => false, 'errors' => ['Something went wrong please try again later !']];
        }catch(InputException $e){
            return ['success' => false, 'errors' => [$e->getMessage()]];
        }
    }
}