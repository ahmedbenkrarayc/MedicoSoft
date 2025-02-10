<?php

namespace App\Repositories;

use App\Models\Unavailable;
use Core\Database;
use PDO;
use PDOException;
use Core\Logger;

class UnavailableRepository{
    private PDO $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function unavailableDates($id){
        try{
            $query = 'SELECT date_debut, date_fin FROM unavailable WHERE id_medecin = :id AND date_fin >= CURRENT_DATE;';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        }catch(PDOException $e){
            Logger::error_log($e->getMessage());
            return null;
        }
    }

    public function createUnavailable(Unavailable $unavailable){
        try{
            $query = 'INSERT INTO unavailable(id_medecin, date_debut, date_fin) VALUES(:medecin, :start, :end)';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':medecin', $unavailable->getIdMedecin(), PDO::PARAM_INT);
            $stmt->bindValue(':start', $unavailable->getDateDebut(), PDO::PARAM_STR);
            $stmt->bindValue(':end', $unavailable->getDateFin(), PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }catch(PDOException $e){
            Logger::error_log($e->getMessage());
            return false;
        }
    }
}