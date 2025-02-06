<?php

namespace App\Models;
use APP\Exceptions\InputException;

class Unavailable {
    private $id;
    private $idMedecin;
    private $dateDebut;
    private $dateFin;

    public function __construct($id, $idMedecin, $dateDebut, $dateFin) {
        $this->setId($id);
        $this->setIdMedecin($idMedecin);
        $this->setDateDebut($dateDebut);
        $this->setDateFin($dateFin);
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        if($id != null){
            if (!is_int($id) || $id <= 0)
                throw new InputException("Invalid ID");
        }
        $this->id = $id;
    }

    public function getIdMedecin(){
        return $this->idMedecin;
    }

    public function setIdMedecin($idMedecin) {
        if($idMedecin != null){
            if (!is_int($idMedecin) || $idMedecin <= 0)
                throw new InputException("Invalid Medecin ID");
        }
        $this->idMedecin = $idMedecin;
    }

    public function getDateDebut() {
        return $this->dateDebut;
    }

    public function setDateDebut($dateDebut) {
        if($dateDebut != null){
            if (!$this->isValidDate($dateDebut))
                throw new InputException("Invalid start date");
        }
        $this->dateDebut = $dateDebut;
    }

    public function getDateFin() {
        return $this->dateFin;
    }

    public function setDateFin($dateFin) {
        if($dateFin){
            if (!$this->isValidDate($dateFin))
                throw new InputException("Invalid end date");
        }
        $this->dateFin = $dateFin;
    }

    private function isValidDate($date) {
        return (bool) strtotime($date);
    }
}
