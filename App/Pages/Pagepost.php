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
                        
        \Core\SitemMapXML::create($this->db);
        
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
                '<section class="postlist postcard">'.
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
        $this->addJSFile(['name' => 'MainScript', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'Vue.JS', 'path' => 'https://cdn.jsdelivr.net/npm/vue']);

        $metaData = new \Widgets\MetaData();
        $head = $metaData->getBody();
        
        $this->setHead($head);

        $logo = new \Widgets\Logo();
        $navbar = new \Widgets\Nav();

        $header = new \Widgets\Header();
        $header->addBody($logo->getBody().$navbar->getBody());

        $footer = new \Widgets\Footer();
        
        $body =
<<<HTML
    <div class="full-page-container">
        {$header->getBody()}
        {$pageContent}
        {$footer->getBody()}
    </div>
HTML;
        
        $this->setBody($body);
    }

}
