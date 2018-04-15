<?php
/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Core;

/**
 * This is AutoLoader class.
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class AutoLoader {
    
    const DIR_CLASSES = 'App';

    private function __construct() {}

    private function __clone() {}

    public static function run() {
        self::autoload();
    }

    private static function autoload() {
        spl_autoload_register(array(self::class, 'loadClass'), true, true);
    }

    public static function loadClass($className) {
        $classFile = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        $classFileName = sprintf('%s%s%s.php', '..'.DIRECTORY_SEPARATOR.self::DIR_CLASSES, DIRECTORY_SEPARATOR, $classFile);
        if (file_exists($classFileName)) {
            include($classFileName);
        }
        //else {
        //    throw new \RuntimeException(sprintf('Brak pliku %s dla klasy %s', $classFileName, $className));
        //}
    }
}
