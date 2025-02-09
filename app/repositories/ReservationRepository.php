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

    public function createReservation(Reservation $reservation){
        try{
            $query = 'INSERT INTO reservation(id_patient, id_medecin, reservation_date, status) VALUES(:patient, :medecin, :date, :status)';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':patient', $reservation->getIdPatient(), PDO::PARAM_INT);
            $stmt->bindValue(':medecin', $reservation->getIdMedecin(), PDO::PARAM_INT);
            $stmt->bindValue(':date', $reservation->getReservationDate(), PDO::PARAM_STR);
            $stmt->bindValue(':status', $reservation->getStatus(), PDO::PARAM_STR);
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