<?php

namespace Core;
use \Core\FrameworkException;

class AppCore {

    private function __construct() {}
    private function __clone() {}

    public static function start($status) {
        if ($status) {
/*             try {
                \Core\Open::go();
            }
            catch(FrameworkException $exc) {
                echo $exc->showError();
            } */
            

            $page = new \Pages\HomePage();

            include_once DIR_VIEWS.'index.html';
        }
    }
}
