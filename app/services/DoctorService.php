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

    public function updateDoctor($request){
        $errors = [];
        $nullvalue = false;
        if(!isset($request['speciality']) || empty($request['speciality'])){
            $errors[] = 'Speciality is required !';
            $nullvalue = true;
        }

        if(!isset($request['experience']) || empty($request['experience'])){
            $errors[] = 'Experience is required !';
            $nullvalue = true;
        }

        if(!isset($request['biographie']) || empty($request['biographie'])){
            $errors[] = 'Bio is required !';
            $nullvalue = true;
        }

        if(!isset($request['country']) || empty($request['country'])){
            $errors[] = 'Country is required !';
            $nullvalue = true;
        }

        if(!isset($request['city']) || empty($request['city'])){
            $errors[] = 'City is required !';
            $nullvalue = true;
        }

        if(!isset($request['address']) || empty($request['address'])){
            $errors[] = 'Address is required !';
            $nullvalue = true;
        }

        if(!isset($request['price']) || empty($request['price'])){
            $errors[] = 'Price is required !';
            $nullvalue = true;
        }

        if($nullvalue)
            return ['success' => false, 'errors' => $errors];

        try{
            $user = new Medecin($_SESSION['user_id'], null, null, null, null, null, null, $request['speciality'], $request['experience'], $request['biographie'], $request['country'], $request['city'], $request['address'], $request['price']);
            if($this->repository->updateDoctor($user)){
                return ['success' => true];
            }

            return ['success' => false, 'errors' => ['Something went wrong please try again later !']];
        }catch(InputException $e){
            return ['success' => false, 'errors' => [$e->getMessage()]];
        }
    }
}