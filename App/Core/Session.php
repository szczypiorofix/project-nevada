<?php

namespace core;

class Session {
    
    public static $session = false;
    public static $useremail = '';
    public static $error = false;
    public static $errorMsg = '';

    private function __construct() {}
    private function __clone() {}

    public static function check($db)
    {
        if (isset($_COOKIE['session_id']))
        {
            $sessionid = $_COOKIE['session_id'];
            try {
                $query = $db->prepare("SELECT * FROM users WHERE session_code=:sessionid");
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
            }
            catch (PDOException $exc) {
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
}
