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
        
        $postModel = new PostModel($dbConnection, $input);
        $content = $postModel->getContent();
        
        //var_dump($content);
        
        
        \Core\SitemMapCreator::makeXML($this->db);
        
        
        $pageContent = "<div>";
        $defaultImageFile = DIR_UPLOADS_IMAGES."default.jpg";
        $imageFile = $defaultImageFile;

        
        if (file_exists(DIR_UPLOADS_IMAGES.$content['image']) && !is_dir(DIR_UPLOADS_IMAGES.$content['image'])) {
            $imageFile = DIR_UPLOADS_IMAGES.$content['image'];
        } else {
            $imageFile = $defaultImageFile;
        }
        $pageContent .= 
            '<section class="postlist postcard">'.
                '<h1><a href="post/'.$content['url'].'">'.$content['title'].'</a><small> '.$content['short_title'].'</small>'.
                '</h1>'.
                '<p>'.$content['update_date'].'</p>'.
                '<div>'.
                    '<img src="'.$imageFile.'" />'.
                    '<p>'.$content['content'].'</p>'.
                '</div>'.
                '<p>Kategoria: '.$content['kategorie'].'</p>'.
                '<p>Tagi: '.$content['tagi'].'</p>'.
                '<a class="btn btn-primary" href="post/'.$content['url'].'"><i class="fas fa-chevron-right"></i> Read more
                </a>'.
            '</section>';       
        
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
        $header->addBody($logo->getBody().$navbar->getBody().'Wywołana klasa: '.$this.', metoda: '.__FUNCTION__.", plik: ".__FILE__.", linia: ".__LINE__."\n");

        $footer = new \Widgets\Footer();

        $a = "<br><br>Arguments: <br>";
        foreach($args as $ar) {
            $a .= $ar.' / ';
        }
        
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
