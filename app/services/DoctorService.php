<?php

namespace App\Services;

use App\Repositories\DoctorRepository;
use App\Models\Medecin;
use App\Exceptions\InputException;

class DoctorService{
    private DoctorRepository $repository;

    public function __construct(){
        $this->repository = new DoctorRepository();
    }

    public function availableDoctors(){
        try{
            return $this->repository->availableDoctors();
        }catch(\Exception $e){
            return [];
        }
    }
}