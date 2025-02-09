<?php

namespace App\Middlewares;

use Core\IMiddleware;

class GuestMiddleware implements IMiddleware{
    public function handle(){
        if($_SESSION['user_id']){
            header('Location: /');
            exit;
        }
    }
}