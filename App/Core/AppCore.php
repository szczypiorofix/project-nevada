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
            $page->addCSSFile(['name' => 'NavbarCSSFile', 'path' => 'css/style.css']);
            $page->addJSFile(['name' => 'MainScript', 'path' => 'js/script.js']);

            $header =
<<<HTML
    <link rel="icon" type="image/png" sizes="32x32" href="icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="icons/favicon-16x16.png">
    <title>My old-new page!</title>
HTML;
            $page->setHeader($header);
            
            include_once DIR_VIEWS.'index.html';
        }
    }
}
