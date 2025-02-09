<?php

namespace App\Services;

use App\Repositories\PatientRepository;
use App\Models\Medecin;
use App\Exceptions\InputException;

class PatientService{
    private PatientRepository $repository;

    public function __construct(){
        $this->repository = new PatientRepository();
    }

    public function reservations(){
        try{
            return $this->repository->reservations();
        }catch(\Exception $e){
            return [];
        }
    }
}