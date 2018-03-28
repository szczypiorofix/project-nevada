<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Pages;

use Core\ModelClasses\Page, Models\PostModel;

/**
 * This is a controller class for single post.
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class Pagepost extends Page {
    
    
    public function __construct($data = []) {}
    
    public function __toString() {
        return get_class($this);
    }
    
    public function defaultmethod($args) {
        if (!isset($args[0])) {
           $input = '';
        }
        else {
           $input = $args[0];
        }
        
        try {
            $dbConnection = \Core\DBConnection::getInstance();
        } catch (\Core\FrameworkException $fex) {
            $fex->showError();
        }
        
        $this->db = $dbConnection->getDB();
        $this->error = $dbConnection->isError();
        $this->errorMsg = $dbConnection->getErrorMsg();
        
        $postModel = new PostModel($dbConnection, $input);
        $content = $postModel->getContent();
          
        //var_dump($content);
        
        //\Core\SitemMapXML::create($this->db);
        
        $pageContent = '<div class="maincontent-div">';
        $defaultImageFile = DIR_UPLOADS_IMAGES."default.jpg";
        $imageFile = $defaultImageFile;

        if (is_array($content) || !is_null($content)) {
            if (file_exists(DIR_UPLOADS_IMAGES.$content['image']) && !is_dir(DIR_UPLOADS_IMAGES.$content['image'])) {
                $imageFile = DIR_UPLOADS_IMAGES.$content['image'];
            } else {
                $imageFile = $defaultImageFile;
            }
            $pageContent .= 
                '<section class="post-content">'.
                    '<h1><a href="post/'.$content['url'].'">'.$content['title'].'</a>'.
                    '</h1>'.
                    '<p>'.$content['update_date'].'</p>'.
                    '<div>'.
                        '<img src="'.$imageFile.'" alt="'.$content['image_description'].'"/>'.
                        '<p>'.$content['content'].'</p>'.
                    '</div>'.
                    '<p>Kategoria: '.$content['kategorie'].'</p>'.
                    '<p>Tagi: '.$content['tagi'].'</p>'.
                '</section>';  
        } else {
            $pageContent = '<div><h1>404<h1><h3>NIE ZNALEZIONO POSTU !!!</h3></div>';
        }
             
        
        $pageContent .= "</div>";
        
        $this->addCSSFile(['name' => 'NavbarCSSFile', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'Main Script', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'https://code.jquery.com/jquery-1.12.4.min.js']);
        
        //$this->addJSFile(['name' => 'External Script', 'path' => 'js/external.js']);

        $metaData = new \Widgets\MetaData();
        $head = $metaData->getBody();
        
        $this->setHead($head);

        $logo = new \Widgets\Logo();
        $navbar = new \Widgets\Nav();

        $header = new \Widgets\Header();
        $header->addBody($navbar->getBody().$logo->getBody());

        $footer = new \Widgets\Footer();

        $sideBar = new \Widgets\Aside();

        $ctaButton = new \Widgets\CTAButton();
        
        $body =
<<<HTML
    <div class="full-page-container" id="mainDiv">
        <!-- <div class="fullscreenbackground"></div> -->
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
