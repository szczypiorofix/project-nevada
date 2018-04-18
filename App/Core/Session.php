<?php

namespace Core;

use PDO;

class Session {
    
    private static $session = false;
    private static $useremail = null;
    private static $error = false;
    private static $errorMsg = '';

    private function __construct() {}
    private function __clone() {}

    public static function isAnyUserRegistered($db) {
        try {
            $query = $db->prepare("SELECT * FROM users");
            $query->execute();
            if ($query->rowCount() > 0) {
                return true;
            }
        } catch (PDOException $exc) {
            self::$errorMsg = \FrameworkException::getMessage($exc->getMessage(), $exc->getFile(), $exc->getLine());
            self::$session = false;
            self::$error = true;
        }
        return false;
    }

    public static function check($db) {
        if (filter_input(INPUT_COOKIE, 'session_id') != null) {
            $sessionid = filter_input(INPUT_COOKIE, 'session_id');
            try {
                $query = $db->prepare("SELECT * FROM `users` WHERE `session_code`=:sessionid");
                $query->bindParam(':sessionid', $sessionid);
                $query->execute();
                if ($query->rowCount() == 1) {
                    $row = $query->fetch();
                    self::$useremail = $row['email'];
                    self::$session = true;
                }
                else {
                    self::$session = false;
                    self::$error = true;
                }
            } catch (PDOException $exc) {
                self::$errorMsg = \FrameworkException::getMessage($exc->getMessage(), $exc->getFile(), $exc->getLine());
                self::$session = false;
                self::$error = true;
            }
        }
        return self::$session;
    }
    
    public static function getUserEmail() {
            return self::$useremail;
    }
    
    public static function isError() {
            return self::$errorMsg;
    }
    
    public static function getErrorMsg() {
            return self::$errorMsg;
    }
    
    public function checkFilters($fields) {
        foreach($fields as $field => $filter) {
            if (filter_input(INPUT_POST, $field, $filter) == null) {
                return false;
            }
        }
        return true;
    }

    public static function encryptIt($p) {
        /**
         * ARGONIANIN MUSI CZEKAĆ ...
         */
        /*
        $options = [
            'memory_cost' => 2048,
            'time_cost' => 4,
            'threads' => 3
        ];
        return password_hash($p, PASSWORD_ARGON2I, $options);
        */
        $options = [
            'cost' => 11
        ];
        return password_hash($p, PASSWORD_BCRYPT, $options);
    }
	
    public static function checkPassword($db, $u, $p) {
        sleep(2);
        try {
            $query = $db->prepare("SELECT `users`.password FROM `users` WHERE email=:useremail");
            $query->bindParam(':useremail', $u, PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetch();
            return password_verify($p, $result['password']);
        } catch (PDOException $exc) {
            self::$errorMsg = \FrameworkException::getMessage($exc->getMessage(), $exc->getFile(), $exc->getLine());
            self::$session = false;
            self::$error = true;
            return false;
        }
    }
}
