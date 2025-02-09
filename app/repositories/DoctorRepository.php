<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Medecin;
use Core\Database;
use PDO;
use PDOException;
use Core\Logger;

class DoctorRepository{
    private PDO $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function availableDoctors(){
        try{
            $query = '
                SELECT 
                    "user".*, 
                    medecin.*, 
                    CONCAT("user".fname, \' \', "user".lname) AS full_name 
                FROM 
                    "user" 
                JOIN 
                    medecin 
                ON 
                    "user".id = medecin.id 
                WHERE 
                    "user".role = \'doctor\';
            ';
        
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll() ?? [];
        }catch(PDOException $e){
            Logger::error_log($e->getMessage());
            return [];
        }
    }

    public function doctorById($id){
        try{
            $query = 'SELECT u.*, l.* FROM "user" as u, doctor as d WHERE u.id = d.id AND u.id = :id';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        }catch(PDOException $e){
            Logger::error_log($e->getMessage());
            return null;
        }
    }
}