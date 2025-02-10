<?php

namespace App\Services;

use App\Repositories\DoctorRepository;
use App\Repositories\UnavailableRepository;
use App\Models\Medecin;
use App\Exceptions\InputException;

class DoctorService{
    private DoctorRepository $repository;
    private UnavailableRepository $unavailabileRepository;

    public function __construct(){
        $this->repository = new DoctorRepository();
        $this->unavailabileRepository = new UnavailableRepository();
    }

    public function availableDoctors(){
        try{
            return $this->repository->availableDoctors();
        }catch(\Exception $e){
            return [];
        }
    }

    public function doctorById($id){
        try{
            return $this->repository->doctorById($id);
        }catch(\Exception $e){
            return null;
        }
    }

    public function unavailableDates($id){
        try{
            $result = $this->unavailabileRepository->unavailableDates($id);
            $date_start = '';
            $date_end = '';
            if($result){
                $date_start = $result['date_debut'];
                $date_end = $result['date_fin'];
            }

            $date_start_js = $date_start ? (new DateTime($date_start))->format('Y-m-d') : '';
            $date_end_js = $date_end ? (new DateTime($date_end))->format('Y-m-d') : '';
            return ['start' => $date_start_js, 'end' => $date_end_js];
        }catch(\Exception $e){
            return null;
        }
    }
}