<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Core;

use \Core\FrameworkException;

/**
 * This is Config class for obtaining data from config (.config) file.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class Config {

    private static $configData = [];
    private static $firstLoad = true;

    private function __construct() {}
    private function __clone() {}

    public static function configFileExists() {
        if (file_exists(CONFIG_FILE) && is_file(CONFIG_FILE)) {
            return true;
        } else {
            throw new FrameworkException("Błąd !!!", "Brak pliku konfiguracyjnego!");
        }
    }

    public static function get($key) {
//        if (!self::configFileExists()) {
//            //return null;
//        }
        if (self::$firstLoad) {
            self::$firstLoad = false;
            self::$configData = parse_ini_file(CONFIG_FILE);
        }
        
        if (isset(self::$configData[$key])) {
           return self::$configData[$key];
        }
        return NULL;
    }
}
