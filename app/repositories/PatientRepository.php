<?php

namespace App\Repositories;

use App\Models\Patient;
use Core\Database;
use PDO;
use PDOException;
use Core\Logger;

class PatientRepository{
    private PDO $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function reservations(){
        try{
            $query = '
                SELECT r.*, m.*, r.id AS id_res FROM reservation as r, "user" as u, medecin as m
                WHERE r.id_patient = u.id AND r.id_medecin = m.id AND u.id = :id
            ';
        
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll() ?? [];
        }catch(PDOException $e){
            Logger::error_log($e->getMessage());
            return [];
        }
    }
}