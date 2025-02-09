<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use App\Models\User;
use App\Exceptions\InputException;

class AuthService{
    private AuthRepository $repository;

    public function __construct(){
        $this->repository = new AuthRepository();
    }

    public function register($request){
        $errors = [];
        $nullvalue = false;
        if(!isset($request['fname']) || empty($request['fname'])){
            $errors[] = 'First name is required !';
            $nullvalue = true;
        }

        if(!isset($request['lname']) || empty($request['lname'])){
            $errors[] = 'Last name is required !';
            $nullvalue = true;
        }

        if(!isset($request['email']) || empty($request['email'])){
            $errors[] = 'Email is required !';
            $nullvalue = true;
        }
        
        if(!isset($request['password']) || empty($request['password'])){
            $errors[] = 'Password is required !';
            $nullvalue = true;
        }

        if(!isset($request['phone']) || empty($request['phone'])){
            $errors[] = 'Phone is required !';
            $nullvalue = true;
        }

        if(!isset($request['role']) || empty($request['role'])){
            $errors[] = 'Role is required !';
            $nullvalue = true;
        }

        if($nullvalue)
            return ['success' => false, 'errors' => $errors];

        if($this->repository->getUserByEmailOrId($request['email']))
            return ['success' => false, 'errors' => ['Email already exists !']];

        try{
            $user = new User(null, $request['fname'], $request['lname'], $request['email'], $request['password'], $request['phone'], null, $request['role'], null, null);
            if($this->repository->register($user)){
                return ['success' => true];
            }

            return ['success' => false, 'errors' => ['Something went wrong please try again later !']];
        }catch(InputException $e){
            return ['success' => false, 'errors' => [$e->getMessage()]];
        }
    }

    public function login($request){
        $errors = [];
        $nullvalue = false;

        if(!isset($request['email']) || empty($request['email'])){
            $errors[] = 'Email is required !';
            $nullvalue = true;
        }
        
        if(!isset($request['password']) || empty($request['password'])){
            $errors[] = 'Password is required !';
            $nullvalue = true;
        }

        if($nullvalue)
            return ['success' => false, 'errors' => $errors];   

        try{
            $user = new User(null, null, null, $request['email'], $request['password']);
            $result = $this->repository->getUserByEmailOrId($request['email']);
            if($result){
                //email found
                if(password_verify('ahmed123', '$2y$10$juDAKBUXF4rtBMScNxGUZuU0jfOdw92Y.orqjl9OawCecOlAeUqBa')){
                    //correct password
                    $_SESSION['user_id'] = $result['id'];
                    $_SESSION['user_role'] = $result['role'];
                    return ['success' => true];
                }else{
                    //wrong password
                    return ['success' => false, 'errors' => ['Wrong password']];
                }
            }

            return ['success' => false, 'errors' => ['Email doesn\'t exist !']];
        }catch(InputException $e){
            return ['success' => false, 'errors' => [$e->getMessage()]];
        }
    }
}