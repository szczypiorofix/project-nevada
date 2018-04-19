<?php

/*
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */

namespace Pages;

use Core\ModelClasses\Page;
use Core\Config;

/**
 * This is error 404 Page
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class PageError extends Page {

    public function __toString() {
        return get_class($this);
    }

    public function defaultmethod($args) {
        try {
            $dbConnection = \Core\DBConnection::getInstance();
        } catch (\Core\FrameworkException $fex) {
            $fex->showError();
        }
        $this->db = $dbConnection->getDB();
        $this->error = $dbConnection->isError();
        $this->errorMsg = $dbConnection->getErrorMsg();
        $baseHref = BASE_HREF;
        $pageContent =
<<<HTML
    <main class="content-maindiv">

        <section class="error-container">
            <div class="video-container">
                <div class="video404">
                    <video autoplay muted loop width="320" height="240">
                        <source src="video/r2d2.mp4" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>
                </div>
            </div>
            <div class="error-caption">
                <h1>404</h1>
                <h3>Nie znaleziono strony</h3>
                <p>Spróbuj:</p>
                <ul>
                    <li>użyć wyszukiwarki</li>
                    <li>przejść do <a href="{$baseHref}">strony głównej</a></li>
                    <li>wrócić do poprzedniej <a href="javascript:history.back()">strony</a></li>
                </ul>
            </div>
        </section>
    </main>
HTML;
        
        $this->addCSSFile(['name' => 'NavbarCSSFile', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'Main Script', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'js/jquery/jquery-1.12.4.min.js']);
        
        //$this->addJSFile(['name' => 'External Script', 'path' => 'js/external.js']);
        //$this->addJSFile(['name' => 'Google Maps API', 'path' => 'https://maps.googleapis.com/maps/api/js?key='.Config::get("GOOGLE_MAPS_API_KEY").'&callback=showGoogleMaps']);
        

        $metaData = new \Widgets\MetaData();
        $head = $metaData->getBody();
        
        $this->setHead($head);
        
        
        /**
         * 
         * http://rajibweb.com/html/collis/index-one.html
         * 
         */
        
        
        $metaData = new \Widgets\MetaData();
        $head = $metaData->getBody();
        
        $this->setHead($head);

        $logo = new \Widgets\Logo();
        $navbar = new \Widgets\Nav();

        $header = new \Widgets\Header();
        $header->addBody($navbar->getBody().$logo->getBody());

        $footer = new \Widgets\Footer();

        $sideBar = new \Widgets\Aside($dbConnection);

        $ctaButton = new \Widgets\CTAButton();
        
        $body =
<<<HTML
    <div class="full-page-container" id="mainDiv">
        <header class="nav-and-logo">
            {$header->getBody()}
        </header>
        <main class="post-card">
            <article>
                {$pageContent}
            </article>
            {$sideBar->getBody()}
        </main>
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
