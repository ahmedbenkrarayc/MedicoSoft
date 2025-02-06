<?php

namespace App\Models;
use APP\Exceptions\InputException;

abstract class User {
    protected $id;
    protected $fname;
    protected $lname;
    protected $email;
    protected $password;
    protected $phone;
    protected $photo;
    protected $role;
    protected $created_at;
    protected $updated_at;
    protected $errors = [];
    

    public function __construct($id = null, $fname = null, $lname = null, $email = null, $password = null, $phone = null, $photo = null, $role = null, $created_at = null, $updated_at = null) {
        try{
            $this->setId($id);
            $this->setFname($fname);
            $this->setLname($lname);
            $this->setEmail($email);
            $this->setPassword($password);
            $this->setPhone($phone);
            $this->setPhoto($photo);
            $this->setRole($role);
            $this->created_at = $created_at;
            $this->$updated_at = $updated_at;
        }catch(InputException $e){
            $this->errors[] = $e->getMessage();
        }
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getFname() {
        return $this->fname;
    }

    public function getLname() {
        return $this->lname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function getRole() {
        return $this->role;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    // Setters with validation
    public function setId($id) {
        if($id != null){
            if(!is_int($id))
                throw new InputException("ID must be an integer.");
            if($id <= 0)
                throw new InputException("Id must be a positive number greater than 0 !");
        }
        $this->id = $id;
    }

    public function setFname($fname){
        if($fname != null){
            if(!is_string($fname) || empty($fname))
                throw new InputException("First name must be a non-empty string.");
        }
        $this->fname = $fname;
    }

    public function setLname($lname){
        if($lname != null){
            if(!is_string($lname) || empty($lname))
                throw new InputException("Last name must be a non-empty string.");
        }
        $this->lname = $lname;
    }

    public function setEmail($email){
        if($email != null){
            if(!is_null($email) && !filter_var($email, FILTER_VALIDATE_EMAIL))
                throw new InputException("Invalid email format.");
        }
        $this->email = $email;
    }

    public function setPassword($password){
        if($password != null){
            if(!is_string($password) || strlen($password) < 6)
                throw new InputException("Password must be at least 6 characters long.");
        }

        $this->password = $password;
    }

    public function setPhone($phone){
        if($phone != null){
            if(!is_null($phone) && !preg_match('/^\+?\d{10,15}$/', $phone))
                throw new InputException("Invalid phone number format.");
        }
        $this->phone = $phone;
    }

    public function setPhoto($photo){
        if($photo != null){
            if(!is_null($photo) && !is_string($photo))
                throw new InputException("Photo must be a string.");
        }
        $this->photo = $photo;
    }

    public function setRole($role){
        if($role != null){
            $validRoles = ['patient', 'doctor'];
            if(!in_array($role, $validRoles))
                throw new InputException("Role must be 'patient' or 'doctor'.");
        }
        $this->role = $role;
    }
}