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
}