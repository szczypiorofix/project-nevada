<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Core;

use Core\FrameworkException;


/**
 * This is class for register all newly created object eg. widgets.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class Registry {
    
    static private $store = array();
    
    private function __construct() {}
    private function __clone() {}
    
    static public function add($object, $name = null) {
        $n = (!is_null($name)) ? $name : get_class($object);        
        $return = null;
        if (isset(self::$store[$n])) {
            $return = self::$store[$n];
        }
        self::$store[$n] = $object;
        return $return;
    }
    
    static public function getSize() {
        return count(self::$store);
    }
    
    static public function showList() {
        $r = "";
        foreach(self::$store as $s) {
            $r .= $s.'<br>';
        }
        echo $r;
    }
    
    static public function returnList() {
        return self::$store;
    }
    
    static public function get($name) {
        if (!self::contains($name)) {
            throw new FrameworkException('Brak obiektu!', "Nie znaleziono obiektu ".$name);
        }
        return self::$store[$name];
    }
    
    static public function remove($name) {
        if (!self::contains($name)) {
            throw new FrameworkException('Brak obiektu!', "Nie można usunąć obiektu ".$name.", ponieważ nie ma go w rejestrze!");
        }
        unset(self::$store[$name]);
    }
    
    static public function contains($name) {
        return isset(self::$store[$name]);
    }
    
}
