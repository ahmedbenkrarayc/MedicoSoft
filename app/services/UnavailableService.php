<?php

namespace App\Services;

use App\Repositories\UnavailableRepository;
use App\Models\Unavailable;
use App\Exceptions\InputException;

class UnavailableService{
    private UnavailableRepository $repository;

    public function __construct(){
        $this->repository = new UnavailableRepository();
    }

    public function createUnavailable($request){
        try{
            $errors = [];
            $nullvalue = false;
            if(!isset($request['start']) || empty($request['start'])){
                $errors[] = 'Start date is required !';
                $nullvalue = true;
            }
    
            if(!isset($request['end']) || empty($request['end'])){
                $errors[] = 'End date is required !';
                $nullvalue = true;
            }
    
            if($nullvalue)
                return ['success' => false, 'errors' => $errors];
    
            $unavailable = new Unavailable(null, $_SESSION['user_id'], $request['start'], $request['end']);
            if($this->repository->createUnavailable($unavailable)){
                return ['success' => true];
            }

            return ['success' => false, 'errors' => ['Something went wrong please try again later !']];
        }catch(InputException $e){
            return ['success' => false, 'errors' => [$e->getMessage()]];
        }
    }
}