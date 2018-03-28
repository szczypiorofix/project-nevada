<?php

/*
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */

namespace Pages;

use Core\ModelClasses\Page, Core\Config;

/**
 * This is error 404 Page
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class PagesError extends Page {


    private $db = null;
    private $error = false;
    private $errorMsg = null;

    public function __toString() {
        return get_class($this);
    }

    public function defaultmethod($args) {
        
        if (!isset($args[0])) {
            $type = 'list';
        }
        else {
            $type = $args[0];
        }
        if (!isset($args[1])) {
            $pages = 0;
        }
        else {
            $pages = intval($args[1]);
        }

        $pageContent =
<<<HTML
    <main class="content-maindiv">

        <section>
            <h1>ERROR 404</h1>
        </section>
    </main>
HTML;
        
        $this->addCSSFile(['name' => 'NavbarCSSFile', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'Main Script', 'path' => 'js/script.js']);
        //$this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'https://code.jquery.com/jquery-1.12.4.min.js']);
        
        $this->addJSFile(['name' => 'External Script', 'path' => 'js/external.js']);
        //$this->addJSFile(['name' => 'Google Maps API', 'path' => 'https://maps.googleapis.com/maps/api/js?key='.Config::get("GOOGLE_MAPS_API_KEY").'&callback=showGoogleMaps']);
        

        $metaData = new \Widgets\MetaData();
        $head = $metaData->getBody();
        
        $this->setHead($head);
        
        
        /**
         * 
         * http://rajibweb.com/html/collis/index-one.html
         * 
         */
        
        
        $logo = new \Widgets\Logo();
        $navbar = new \Widgets\Nav();

        $header = new \Widgets\Header();
        $header->addBody($navbar->getBody().$logo->getBody());

        $footer = new \Widgets\Footer();

        $ctaButton = new \Widgets\CTAButton();
        
        $body =
<<<HTML
    <div class="full-page-container" id="mainDiv">
        <div class="nav-and-logo">
            {$header->getBody()}
        </div>
        {$pageContent}
        {$ctaButton->getBody()}
        {$footer->getBody()}
        <div id="notificationsPanel">
            <span id="notificationsContent"></span>
        </div>
    </div>
HTML;
        
        $this->setBody($body);
    }

}
