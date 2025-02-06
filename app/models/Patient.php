<?php
namespace App\Models;
use APP\Exceptions\InputException;

class Patient extends User {
    public function __construct($id = null, $fname = null, $lname = null, $email = null, $password = null, $phone = null) {
        parent::__construct($id, $fname, $lname, $email, $password, $phone, $photo, 'patient');
    }
}
