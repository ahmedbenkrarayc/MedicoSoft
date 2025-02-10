<?php

namespace App\Repositories;

use Core\Database;
use PDO;
use PDOException;
use Core\Logger;

class DashboardRepository{
    private PDO $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function pendingReservations(){
        try{
            $query = "SELECT COUNT(*) as number FROM reservation WHERE STATUS = 'pending' AND id_medecin = :id;";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchColumn() ?? 0;
        }catch(PDOException $e){
            Logger::error_log($e->getMessage());
            return 0;
        }
    }

    public function confirmedTodayReservations(){
        try{
            $query = "SELECT COUNT(*) as number FROM reservation WHERE reservation_date = CURRENT_DATE AND STATUS = 'confirmed' AND id_medecin = :id;";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchColumn() ?? 0;
        }catch(PDOException $e){
            Logger::error_log($e->getMessage());
            return 0;
        }
    }

    public function confirmedTmrwReservations(){
        try{
            $query = "SELECT COUNT(*) AS number FROM reservation WHERE reservation_date = CURRENT_DATE + INTERVAL '1 day' AND status = 'confirmed' AND id_medecin = :id;";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchColumn() ?? 0;
        }catch(PDOException $e){
            Logger::error_log($e->getMessage());
            return 0;
        }
    }

    public function pendingReservationsToday(){
        try{
            $query = 'SELECT r.*, u.fname, u.lname, u.phone, u.email FROM reservation r JOIN "user" u ON r.id_patient = u.id JOIN "user" l ON r.id_medecin = l.id WHERE r.id_medecin = :id AND r.status = \'pending\' AND r.reservation_date = CURRENT_DATE;';
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