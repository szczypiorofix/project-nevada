<?php

namespace Core;

class AutoLoader {
    
    const DIR_CLASSES = 'App';
    private static $debug_mode = false;

    private function __construct() {}

    private function __clone() {}

    public static function run($debug_mode = false) {
        self::$debug_mode = $debug_mode;
        self::autoload();
    }

    private static function autoload() {
        spl_autoload_register(array(self::class, 'loadClass'));
    }

    public static function loadClass($className) {
        $classFile = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        $classFileName = sprintf('%s%s%s.php', '..'.DIRECTORY_SEPARATOR.self::DIR_CLASSES, DIRECTORY_SEPARATOR, $classFile);
        if (file_exists($classFileName)) {
            if (self::$debug_mode) {
                echo "<script>console.log('Class ".$className." loaded.');</script>";
                echo "Class ".$classFileName." loaded.<br>";
            }
            include($classFileName);
        }
        else {
            throw new \RuntimeException(sprintf('Brak pliku %s dla klasy %s', $classFileName, $className));
        }
    }
}
