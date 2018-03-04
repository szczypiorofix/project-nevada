<?php

namespace Core;

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

        /* OTHERS */
        define("PAGE_VERSION", "1.00.001");
        define("CONFIG_FILE", DIR_ROOT.'.config');
    }
}
