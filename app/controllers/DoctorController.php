<?php

namespace App\Controllers;

use App\Services\DoctorService;
use App\Services\AuthService;
use Core\View;

class DoctorController{
    private DoctorService $doctorService;
    private AuthService $authService;

    public function __construct(){
        $this->doctorService = new DoctorService();
        $this->authService = new AuthService();
    }

    public function home(){
        return View::make('patient/home');
    }

    public function availableDoctors(){
        return json_encode(['success' => true, 'data' => $this->doctorService->availableDoctors()]);
    }

    public function profile($id){
        $doctor = $this->doctorService->doctorById($id);
        if(!$doctor){
            header('Location: /'); 
            exit;
        }
        
        return View::make('doctor/profile', ['doctor' => $doctor, 'availability' => $this->doctorService->unavailableDates($id)]);
    }

    public function editProfile(){
        $doctor = $this->doctorService->doctorById($_SESSION['user_id']);
        $user = $this->authService->currentUser();
        if(!$user){
            header('Location: /');
        }

        return View::make('doctor/editprofile', ['user' => $user, 'doctor' => $doctor]);
    }

    public function updateProfile(){
        $this->doctorService->updateDoctor($_POST);
        header('Location: /doctor/editprofile');
        exit;
    }
}