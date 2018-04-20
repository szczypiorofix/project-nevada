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
    
    private static $errorMsg = '';
    private static $db;
    private static $error = false;
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
            self::$db = new \PDO($dsn, $db_user, $db_pass, $opt);
        } catch (\PDOException $exc) {
            self::$error = true;
            $fe = new FrameworkException("Błąd PDO podczas inicjowania połączenia z bazą danych !!!", $exc->getMessage());
            $fe->showError();
            self::$errorMsg = $fe->getErrorMsg();
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DBConnection();
        }
        return array(
            'db' => self::$db,
            'error' => self::$error,
            'errorMsg' => self::$errorMsg
        );
    }
    
}
