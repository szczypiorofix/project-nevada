<?php

namespace Core;

use \Core\FrameworkException;

class Config {

    private static $config_data = [];
    private static $firstLoad = true;

    private function __construct() {}
    private function __clone() {}

    public static function configFileExists() {
        return (file_exists(CONFIG_FILE) && is_file(CONFIG_FILE));
    }

    public static function get($key) {
        if (self::$firstLoad) {
            self::$firstLoad = false;
            self::$config_data = parse_ini_file(CONFIG_FILE);
        }
        
        if (isset(self::$config_data[$key])) {
           return self::$config_data[$key];
        }
        return NULL;
    }
}
