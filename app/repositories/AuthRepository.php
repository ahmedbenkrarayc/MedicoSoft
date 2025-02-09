<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Patient;
use App\Models\Medecin;
use Core\Database;
use PDO;
use PDOException;
use Core\Logger;

class AuthRepository{
    private PDO $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function getUserByEmailOrId($value){
        if(is_string($value))
            $emailCheckQuery = 'SELECT * FROM "user" WHERE email = :value';
        else
            $emailCheckQuery = 'SELECT * FROM "user" WHERE id = :value';

        $emailCheckStmt = $this->db->prepare($emailCheckQuery);
        $emailCheckStmt->bindValue(':value', $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        $emailCheckStmt->execute();
        $user = $emailCheckStmt->fetch();
        return $user;
    }

    public function register(User $user){
        try{
            $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);    
            $query = 'INSERT INTO "user"(fname, lname, email, password, phone, role) VALUES(:fname, :lname, :email, :password, :phone, :role)';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':fname', htmlspecialchars($user->getFname()), PDO::PARAM_STR);
            $stmt->bindValue(':lname', htmlspecialchars($user->getLname()), PDO::PARAM_STR);
            $stmt->bindValue(':email', htmlspecialchars($user->getEmail()), PDO::PARAM_STR);
            $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindValue(':phone', htmlspecialchars($user->getPhone()), PDO::PARAM_STR);
            $stmt->bindValue(':role', htmlspecialchars($user->getRole()), PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
    
            return false;
        }catch(PDOException $e){
            Logger::error_log($e->getMessage());
            return false;
        }
    }

    public function login(User $user){
        $query = 'SELECT id, role, password FROM user WHERE email = :email';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->execute();
        $user1 = $stmt->fetch();

        if($user1){
            //email found
            if(password_verify($this->password, $user1['password'])){
                //correct password
                // $_SESSION['user_id'] = $user1['id'];
                // $_SESSION['user_role'] = $user1['role'];
                return ['success' => true, 'user' => $user1];
            }else{
                //wrong password
                return ['success' => false, 'message' => 'Wrong password'];
            }
        }else{
            //email notfound
            return ['success' => false, 'message' => 'Email not found'];
        }
    }
}