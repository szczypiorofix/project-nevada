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
class PageAdmin extends Page {


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

        try {
            $dbConnection = \Core\DBConnection::getInstance();
        } catch (\Core\FrameworkException $fex) {
            $fex->showError();
        }
        
        $this->db = $dbConnection->getDB();
        $this->error = $dbConnection->isError();
        $this->errorMsg = $dbConnection->getErrorMsg();

        $sessionContent = "";
        $isSession = \Core\Session::check($this->db);  
        if ($isSession) {
            $sessionContent = "Użytkownik zalogowany";
        } else {
            $sessionContent = "Użytkownik niezalogowany!";    
        }

        
        if (isset($_POST['loginname']) && isset($_POST['loginpassword'])) {
            $sessionContent = 'Login OK!';
        }
        

        $this->addCSSFile(['name' => 'NavbarCSSFile', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'Main Script', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'https://code.jquery.com/jquery-1.12.4.min.js']);
        
        //$this->addJSFile(['name' => 'External Script', 'path' => 'js/external.js']);
        

        $baseHref = BASE_HREF;
        $pageContent =
<<<HTML
    <main class="content-maindiv">
        <section class="admin-container">
            <h1>ADMIN PAGES</h1>
            <p>TODOs:</p>
            <ul>
                <li>tutaj będzie zarządzanie całym contentem strony</li>
                <li>Sprawdzanie zalogowania przez sesje (ciasteczka?). Jesli nie zalogowany to przerzuca na stronę logowania</li>
                <li>Strony: logowanie, strona panelu admina (odnośniki do: dodaj, edytuj, usuń posty)</li>            
            </ul>
            <h3>Stan sesji: {$sessionContent}</h3>
            <form class="login-container" id="loginAdminForm" method="POST">
                <div class="input-group">
                    <input type="text" placeholder="login" name="loginname" required/>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="hasło" name="loginpassword" required/>
                </div>
                <div class="input-group">
                    <input type="submit" value="Zaloguj" />
                </div>
            </form>

            <div class="admin-panel">
                <div class="add-post-panel">
                    <button class="button">Dodaj post</button>
                </div>
            </div>
        </section>
    </main>
HTML;


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
        <div class="nav-and-logo">
            {$header->getBody()}
        </div>
        <main class="post-card">
            {$pageContent}
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
