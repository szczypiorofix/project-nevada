<?php

namespace Core;

use \Core\Config, \Core\FrameworkException;

class Environment {

    private function __construct() {}
    private function __clone() {}
    
    public static function set() {
        /* DIRECTORIES */
        define("DS", DIRECTORY_SEPARATOR);
        define("DIR_ROOT", "..".DS);
        define("DIR_APP", DIR_ROOT . 'App' . DS);
        define("DIR_CORE", DIR_APP . 'Core' . DS);
        define("DIR_VENDORS", DIR_APP . 'Vendors' . DS);
        define("DIR_VIEWS", DIR_APP . 'Views' . DS);
        define("DIR_PAGES", DIR_APP . 'Pages' . DS);

        /* OTHERS */
        define("PAGE_VERSION", "1.00.001");
        define("CONFIG_FILE", DIR_ROOT.'.config');
        
        try {
            Config::configFileExists();
        } catch (FrameworkException $ex) {
            $ex->showError();
        }
        
        /* MYSQL SETTINGS */
        define('DB_HOST', Config::get('DB_HOST'));
        define('DB_NAME', Config::get('DB_NAME'));
        define('DB_USER', Config::get('DB_USER'));
        define('DB_PASS', Config::get('DB_PASS'));
        
        /* BASE HREF */
        define('BASE_HREF', Config::get("BASE_HREF"));
    }
}
