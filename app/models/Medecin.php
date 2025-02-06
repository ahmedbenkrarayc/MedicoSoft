<?php
namespace App\Models;
use APP\Exceptions\InputException;

class Medecin extends User {
    private $specialite;
    private $experience;
    private $biographie;
    private $country;
    private $city;
    private $address;
    private $price;
    private $errors = [];

    public function __construct($id = null, $fname = null, $lname = null, $email = null, $password = null, $phone = null, $photo = null, 
                                $specialite= null, $experience= null, $biographie= null, $country= null, $city= null, $address= null, $price= null) {
        parent::__construct($id, $fname, $lname, $email, $password, $phone, $photo, 'doctor');
        try{
            $this->setSpecialite($specialite);
            $this->setExperience($experience);
            $this->setBiographie($biographie);
            $this->setCountry($country);
            $this->setCity($city);
            $this->setAddress($address);
            $this->setPrice($price);
        }catch(InputException $e){
            $this->errors[] = $e->getMessage();
        }
    }

    public function setSpecialite($specialite) {
        if($specialite != null){
            if(!is_string($specialite) || empty($specialite))
                throw new InputException("Invalid specialite");
        }
        $this->specialite = $specialite;
    }

    public function getSpecialite(){
        return $this->specialite;
    }

    public function setExperience($experience) {
        if($experience != null){
            if(!is_string($experience) || empty($experience))
                throw new InputException("Invalid experience");
        }
        $this->experience = $experience;
    }

    public function getExperience(){
        return $this->experience;
    }

    public function setBiographie($biographie){
        if($biographie){
            if (!is_string($biographie))
                throw new InputException("Invalid biographie");
        }
        $this->biographie = $biographie;
    }

    public function getBiographie() {
        return $this->biographie;
    }

    public function setCountry($country) {
        if($country){
            if (!is_string($country) || empty($country))
                throw new InputException("Invalid country");
        }
        $this->country = $country;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCity($city) {
        if($city != null){
            if(!is_string($city) || empty($city))
                throw new InputException("Invalid city");
        }
        $this->city = $city;
    }

    public function getCity() {
        return $this->city;
    }

    public function setAddress($address) {
        if($address != null){
            if (!is_string($address) || empty($address))
                throw new InputException("Invalid address");
        }
        $this->address = $address;
    }

    public function getAddress(){
        return $this->address;
    }

    public function setPrice($price){
        if($price != null){
            if(!is_numeric($price) || $price < 0)
                throw new InputException("Invalid price");
        }
        $this->price = (float)$price;
    }

    public function getPrice(){
        return $this->price;
    }
}
