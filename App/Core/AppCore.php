<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */


namespace Core;

/**
 * This is core application class.
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class AppCore {

    const DEFAULT_CLASS = 'showcase'; // DEFAULT PAGE
    const DEFAULT_METHOD = 'defaultmethod';
    const PAGES_NAME_PREFIX = 'Page';

    private function __construct() {}
    private function __clone() {}

    public static function start($maintenance = false) {
        $class = self::DEFAULT_CLASS;
        $method = self::DEFAULT_METHOD;
        $calledDefaultClass = false;
       
        $url = self::parseUrl();

        if (!$maintenance) {
            if (file_exists(DIR_PAGES.self::PAGES_NAME_PREFIX.$url[0].'.php')) {
                $class = $url[0];
                unset($url[0]);
            }
            else {
               $class = self::DEFAULT_CLASS;
               $calledDefaultClass = true;
            }
        } else { // MAINTENANCE PAGE && AJAX
            if (count($url) === 0) {
                $class = "Maintenance";
            } else {
                if ($url[0] == 'trellocontent') {
                    $class = "TrelloContent";
                }
            }
        }

        //var_dump($url);
        
        $className = "\Pages\\".self::PAGES_NAME_PREFIX.$class;
        $page = new $className();
        

        if ($calledDefaultClass) {
            if (isset($url[0]) && method_exists($page, $url[0])) {
                $method = $url[0];
                unset($url[0]);
            }
        } else {
                if (isset($url[1]) && method_exists($page, $url[1])) {
                $method = $url[1];
                unset($url[1]);
            }
        }

        $params = $url ? array_values($url) : [];
        call_user_func_array([$page, $method], array($params));
        
        $page->integrateCSS();
        $page->integrateJS();
        $page->show();
    }

    private static function parseUrl() {
        if (filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING) !== NULL) {
           return explode('/', rtrim(filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING),'/'));
        }
    }

}
