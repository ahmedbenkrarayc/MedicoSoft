<?php

namespace App\Middlewares;

use Core\IMiddleware;

class GuestMiddleware implements IMiddleware{
    public function handle($params = null){
        if(isset($_SESSION['user_id'])){
            if($_SESSION['user_role'] == 'doctor'){
                header('Location: /doctor/dashboard');
                exit;
            }

            header('Location: /');
            exit;
        }
    }
}