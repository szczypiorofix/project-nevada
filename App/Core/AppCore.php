<?php

namespace Core;
use \Core\FrameworkException, \Pages\HomePage;

class AppCore {

    private $url = null;

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
            
            $url = self::parseUrl();

            //var_dump($url);

            $page = new HomePage();

            $page->addCSSFile(['name' => 'NavbarCSSFile', 'path' => 'css/style.css']);
            $page->addJSFile(['name' => 'MainScript', 'path' => 'js/script.js']);
            

            $header =
<<<HTML
    <link rel="apple-touch-icon" sizes="57x57" href="icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="icons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="icons/favicon-16x16.png">
    <link rel="manifest" href="icons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="icons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>My new homepage!</title>
HTML;
            $header .= $page->getCSSFiles();
            //$header .= $page->getCSS();
            $header .= $page->getJsHeaderFiles();

            $page->setHeader($header);

            $body =
<<<HTML
    <div class="container">
        <h3>Testing ...</h3>
    </div>
HTML;

            $logo = new \Widgets\Logo();
            //$logo->addCss("div {background: red;}");

            $body .= $logo->show();

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
