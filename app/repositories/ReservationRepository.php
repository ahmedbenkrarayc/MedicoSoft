<?php

namespace App\Repositories;

use App\Models\Reservation;
use Core\Database;
use PDO;
use PDOException;
use Core\Logger;

class ReservationRepository{
    private PDO $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function updateReservationStatus($id, $status){
        try{
            $query = 'UPDATE reservation SET status = :status WHERE id = :id;';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':status', $id, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $res = $stmt->execute();
            if($res){
                return true;
            }
            return false;
        }catch(PDOException $e){
            Logger::error_log($e->getMessage());
            return false;
        }
    }
}