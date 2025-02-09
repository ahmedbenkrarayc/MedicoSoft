<?php

namespace Core;

use APP\Exceptions\EnvException;
use Core\Logger;
use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct(){
        try{
            $this->validate();
            $this->pdo = new PDO(
                'pgsql:host='.$_ENV['DB_HOST'].';port='.$_ENV['DB_PORT'].';dbname='.$_ENV['DB_NAME'],
                $_ENV['DB_USER'], 
                $_ENV['DB_PASS']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (EnvException $e) {
            Logger::error_log($e->getMessage());
        } catch (PDOException $e) {
            Logger::error_log($e->getMessage());
        }
    }

    public static function getInstance(){
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnection(){
        return $this->pdo;
    }

    private function validate(){
        if (!isset($_ENV['DB_HOST']) || empty($_ENV['DB_HOST'])) {
            throw new EnvException('Host doesn\'t exist in env!');
        }

        if (!isset($_ENV['DB_PORT']) || empty($_ENV['DB_PORT'])) {
            throw new EnvException('Port doesn\'t exist in env!');
        }

        if (!isset($_ENV['DB_NAME']) || empty($_ENV['DB_NAME'])) {
            throw new EnvException('Database doesn\'t exist in env!');
        }

        if (!isset($_ENV['DB_USER']) || empty($_ENV['DB_USER'])) {
            throw new EnvException('Username doesn\'t exist in env!');
        }

        if (!isset($_ENV['DB_PASS']) || $_ENV['DB_PASS'] === '') {
            throw new EnvException('Password doesn\'t exist in env!');
        }
    }
}
