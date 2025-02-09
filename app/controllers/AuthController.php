<?php

namespace App\Controllers;

use App\Services\AuthService;
use Core\View;

class AuthController{
    private AuthService $authService;

    public function __construct(){
        $this->authService = new AuthService();
    }

    public function registerGET(){
        return View::make('auth/register');
    }

    public function registerPOST(){
        $result = $this->authService->register($_POST);
        if($result['success'] === true){
            return View::make('auth/register', ['success' => true]);
        }

        return View::make('auth/register', ['errors' => $result['errors']]);
    }

    public function loginGET(){
        return View::make('auth/login');
    }

    public function loginPOST(){
        $result = $this->authService->login($_POST);
        if($result['success'] === true){
            header('Location: /auth/login');
            exit;
        }

        return View::make('auth/login', ['errors' => $result['errors']]);
    }

    public function logout(){
        $this->authService->logout();
    }

    public static function user(){
        return $this->authService->currentUser();
    }
}