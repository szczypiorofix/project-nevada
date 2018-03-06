<?php

namespace Core;
use \Core\FrameworkException, \Pages\HomePage;

class AppCore {

    private $url = null;

    private function __construct() {}
    private function __clone() {}

    public static function start($status) {
        if ($status) {
            /*  try {
                \Core\Open::go();
            }
            catch(FrameworkException $exc) {
                echo $exc->showError();
            }
            $url = self::parseUrl();
            var_dump($url); */

            $page = new HomePage();

            $page->addCSSFile(['name' => 'NavbarCSSFile', 'path' => 'css/style.css']);
            $page->addJSFile(['name' => 'MainScript', 'path' => 'js/script.js']);
            

            $metaData = new \Widgets\MetaData(); 
            $head = $metaData->getBody();            

            $head .= $page->getCSSFiles();
            $head .= $page->getJsHeadFiles();

            $page->setHead($head);
            
            $logo = new \Widgets\Logo();
            $navbar = new \Widgets\Nav();
            
            $header = new \Widgets\Header();
            $header->addBody($logo->getBody().$navbar->getBody());
            
            $footer = new \Widgets\Footer();
            
            $body =
<<<HTML
    <div class="full-page-container">
        {$header->getBody()}
        <footer>{$footer->getBody()}</footer>
    </div>
HTML;

            $page->setBody($body);
            
            $page->show();

        }
    }

    private static function parseUrl() {
        if (filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING) !== NULL) {
           return explode('/', rtrim(filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING),'/'));
        }
    }

}
