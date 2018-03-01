<?php

use \Core\Environment, \Core\AppCore, \Core\Config;

class App {

    private function __construct() {}
    private function __clone() {}

    public static function run() {
        Environment::set();
        AppCore::start(Config::configFileExists());
    }
}
