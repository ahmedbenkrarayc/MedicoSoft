<?php

namespace App\Models;
use APP\Exceptions\InputException;

class Reservation {
    private $id;
    private $reservationDate;
    private $status;
    private $createdAt;
    private $updatedAt;
    private $idPatient;
    private $idMedecin;
    private $errors = [];

    public function __construct($id = null, $reservationDate = null, $status = null, $idPatient = null, $idMedecin = null, $createdAt = null, $updatedAt = null) {
        try{    
            $this->setId($id);
            $this->setReservationDate($reservationDate);
            $this->setStatus($status);
            $this->setIdPatient($idPatient);
            $this->setIdMedecin($idMedecin);
            $this->createdAt = $createdAt;
            $this->updatedAt = $updatedAt;
        }catch(InputException $e){
            $this->errors[] = $e->getMessage();
        }
    }

    public function setId($id) {
        if (!is_int($id) || $id <= 0) {
            throw new InputException("Invalid ID");
        }
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setReservationDate($reservationDate) {
        if($reservationDate != null){
            if (!strtotime($reservationDate))
                throw new InputException("Invalid reservation date");
        }
        $this->reservationDate = $reservationDate;
    }

    public function getReservationDate() {
        return $this->reservationDate;
    }

    public function setStatus($status) {
        if($status != null){
            $validStatuses = ['pending', 'confirmed', 'canceled'];
            if (!is_string($status) || !in_array($status, $validStatuses))
                throw new InputException("Invalid status");
        }
        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function setIdPatient($idPatient) {
        if($idPatient != null){
            if (!is_int($idPatient) || $idPatient <= 0)
                throw new InputException("Invalid patient ID");
        }
        $this->idPatient = $idPatient;
    }

    public function getIdPatient() {
        return $this->idPatient;
    }

    public function setIdMedecin($idMedecin) {
        if($idMedecin){
            if (!is_int($idMedecin) || $idMedecin <= 0)
                throw new InputException("Invalid medecin ID");
        }
        $this->idMedecin = $idMedecin;
    }

    public function getIdMedecin() {
        return $this->idMedecin;
    }
}
