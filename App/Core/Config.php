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
        try {
            if (file_exists(CONFIG_FILE) && is_file(CONFIG_FILE)) {
                return true;
            } else {
                throw new FrameworkException("Błąd !!!", "Brak pliku konfiguracyjnego!");
            }
        } catch (FrameworkException $e) {
            $e->showError();
            exit;
        }
    }

    /**
     * Get value from ini config file
     * @param string $key - key
     * @return string - returns value of the key
     */
    public static function get($key) {
        if (!self::configFileExists()) {
            return null;
        }
        if (self::$firstLoad) {
            self::$firstLoad = false;
            self::$configData = parse_ini_file(CONFIG_FILE);
        }
        
        if (isset(self::$configData[$key])) {
           return self::$configData[$key];
        }
        return NULL;
    }
    
    
    public static function set($key, $value) {
        if (!self::configFileExists()) {
            return null;
        }
        if (self::$firstLoad) {
            self::$firstLoad = false;
            self::$configData = parse_ini_file(CONFIG_FILE);
        }
        
        if (!is_null(self::get($key))) {
            if (!$handle = fopen(CONFIG_FILE, 'w')) { 
                return false; 
            }

            $content = '';
            foreach(self::$configData as $k=>$v){
                if ($k === $key) {
                    $v = $value;
                }
                $content .= $k."=".$v."\n"; 
            }
            fwrite($handle, $content);
            fclose($handle);
            return true;
        }
    }
}
