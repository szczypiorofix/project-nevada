<?php

namespace Core;


class AppCore {

    const DEFAULT_CLASS = 'list'; // DEFAULT PAGE
    const DEFAULT_METHOD = 'defaultmethod';
    const PAGES_NAME_PREFIX = 'Page';

    private function __construct() {}
    private function __clone() {}

    public static function start() {
        $class = self::DEFAULT_CLASS;
        $method = self::DEFAULT_METHOD;
        $calledDefaultClass = false;

        $url = self::parseUrl();

        if (file_exists(DIR_PAGES.self::PAGES_NAME_PREFIX.$url[0].'.php')) {
            $class = $url[0];
            unset($url[0]);
        }
        else {
           $class = self::DEFAULT_CLASS;
           $calledDefaultClass = true;
        }

        $className = "\Pages\\".self::PAGES_NAME_PREFIX.$class;
        $class = new $className();

        if ($calledDefaultClass) {
            if (isset($url[0]) && method_exists($class, $url[0])) {
                $method = $url[0];
                unset($url[0]);
            }
        } else {
            if (isset($url[1]) && method_exists($class, $url[1])) {
            $method = $url[1];
            unset($url[1]);
            }
        }

        $params = $url ? array_values($url) : [];
        call_user_func_array([$class, $method], array($params));

        $page = $class;
        $page->show();
    }

    private static function parseUrl() {
        if (filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING) !== NULL) {
           return explode('/', rtrim(filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING),'/'));
        }
    }

}
