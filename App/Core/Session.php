<?php
/*
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */
namespace Core;

use PDO;
/**
 * This is Session class.
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class Session {
    
    private static $session = false;
    private static $useremail = null;

    private function __construct() {}
    private function __clone() {}

    public static function isAnyUserRegistered($dbConnection) {
        try {
            $query = $dbConnection['db']->prepare("SELECT * FROM users");
            $query->execute();
            if ($query->rowCount() > 0) {
                return true;
            }
        } catch (PDOException $exc) {
            self::$errorMsg = \FrameworkException::getMessage($exc->getMessage(), $exc->getFile(), $exc->getLine());
            self::$session = false;
            $dbConnection['error'] = true;
        }
        return false;
    }

    public static function check($dbConnection) {
        if (filter_input(INPUT_COOKIE, 'session_id') != null) {
            $sessionid = filter_input(INPUT_COOKIE, 'session_id');
            try {
                $query = $dbConnection['db']->prepare("SELECT * FROM `users` WHERE `session_code`=:sessionid");
                $query->bindParam(':sessionid', $sessionid);
                $query->execute();
                if ($query->rowCount() == 1) {
                    $row = $query->fetch();
                    self::$useremail = $row['email'];
                    self::$session = true;
                }
                else {
                    self::$session = false;
                }
            } catch (PDOException $exc) {
                self::$errorMsg = \FrameworkException::getMessage($exc->getMessage(), $exc->getFile(), $exc->getLine());
                self::$session = false;
            }
        }
        return self::$session;
    }
    
    public static function getUserEmail() {
            return self::$useremail;
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
        $options = [
            'cost' => 11
        ];
        return password_hash($p, PASSWORD_BCRYPT, $options);
    }
	
    public static function checkPassword($dbConnection, $u, $p) {
        sleep(2);
        try {
            $query = $dbConnection['db']->prepare("SELECT `users`.password FROM `users` WHERE email=:useremail");
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
