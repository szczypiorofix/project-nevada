<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */


namespace Core;

use PDO;
use \Core\FrameworkException;

/**
 * This is class for establishing connection with MySQL database.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class DBConnection {
    
    private $errorMsg = '';
    private $db;
    private $error = false;
    private static $instance = null;
    
    
    private function __construct() {
        $db_host = DB_HOST;
        $db_name = DB_NAME;
        $db_user = DB_USER;
        $db_pass = DB_PASS;
        try {
            $dsn = "mysql:host=$db_host;port=3306;dbname=$db_name;charset=UTF8;";
            $opt = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
            $this->db = new \PDO($dsn, $db_user, $db_pass, $opt);
        } catch (\PDOException $exc) {
            $this->error = true;
            throw new FrameworkException("Błąd PDO!!!", $exc->getMessage());
        }
    }
    
    public function getErrorMsg() {
        return $this->errorMsg;
    }
    
    public function isError() {
        return $this->error;
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DBConnection();
        }
        return self::$instance;
    }
    
    public function getDB() {
        return $this->db;
    }
    
}
