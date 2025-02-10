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
            $query = 'SELECT u.*, d.* FROM "user" as u, medecin as d WHERE u.id = d.id AND u.id = :id';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        }catch(PDOException $e){
            Logger::error_log($e->getMessage());
            return null;
        }
    }

    public function updateDoctor(Medecin $doctor){
        try{
            if($this->doctorById($doctor->getId())){
                $query = 'UPDATE medecin SET specialite = :specialite, experience = :experience, biographie = :biographie, country = :country, city = :city, address = :address, price = :price WHERE id = :id;';
            }else{
                $query = 'INSERT INTO medecin(id, specialite, experience, biographie, country, city, address, price) VALUES(:id, :specialite, :experience, :biographie, :country, :city, :address, :price)';
            }
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $doctor->getId(), PDO::PARAM_INT);
            $stmt->bindValue(':specialite', htmlspecialchars($doctor->getSpecialite()), PDO::PARAM_STR);
            $stmt->bindValue(':experience', htmlspecialchars($doctor->getExperience()), PDO::PARAM_STR);
            $stmt->bindValue(':biographie', htmlspecialchars($doctor->getBiographie()), PDO::PARAM_STR);
            $stmt->bindValue(':country', htmlspecialchars($doctor->getCountry()), PDO::PARAM_STR);
            $stmt->bindValue(':city', htmlspecialchars($doctor->getCity()), PDO::PARAM_STR);
            $stmt->bindValue(':address', htmlspecialchars($doctor->getAddress()), PDO::PARAM_STR);
            $stmt->bindValue(':price', $doctor->getPrice(), PDO::PARAM_STR);
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