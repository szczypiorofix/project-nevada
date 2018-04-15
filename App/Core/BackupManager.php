<?php
/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Core;

use ZipArchive;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;


/**
 * This is a class for backing up files on the server.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class BackupManager {
    
    
    private function __construct() {}
    private function __clone() {}    
    
    private static function zipData($source, $destination) {
        if (extension_loaded('zip')) {
            if (file_exists($source)) {
                $zip = new ZipArchive();
                if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
                    $source = realpath($source);
                    if (is_dir($source)) {
                        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST);
                        foreach ($files as $file) {
                            $file = realpath($file);
                            if (is_dir($file)) {
                                if (strpos($file, '.git') === false) {
                                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                                }
                            } else if (is_file($file)) {
                                if (strpos($file, '.git') === false) {
                                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                                }
                            }
                        }
                    } else if (is_file($source)) {                        
                        $zip->addFromString(basename($source), file_get_contents($source));
                    }
                }
                return $zip->close();
            }
        }
        return false;
    }
    
    public static function makeBackup() {
        self::zipData('../', '../backup.zip');
        echo 'Kopia zapasowa plików została wykonana pomyślnie!';
        exit();
    }
}
