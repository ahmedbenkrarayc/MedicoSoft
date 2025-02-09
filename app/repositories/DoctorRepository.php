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
    }
}