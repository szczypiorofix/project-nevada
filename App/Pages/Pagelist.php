<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Pages;

use Core\ModelClasses\Page, Models\PostListModel;


/**
 * This is a controller class for list of posts.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class Pagelist extends Page {

    
    private $db = null;
    private $error = false;
    private $errorMsg = null;
    
    
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
        
        $postListModel = new PostListModel(PostListModel::TYPE_ID_SORT, $dbConnection, $input, $pages);
        $content = $postListModel->getContent();
        
        if (is_null($content)) {
            $content = [];
        }
        
        //var_dump($content);
        
        $pageContent = "<div>";
        $defaultImageFile = DIR_UPLOADS_IMAGES."default.jpg";
        $imageFile = $defaultImageFile;

        
        foreach($content as $row) {
            if (file_exists(DIR_UPLOADS_IMAGES.$row['image']) && !is_dir(DIR_UPLOADS_IMAGES.$row['image'])) {
                $imageFile = DIR_UPLOADS_IMAGES.$row['image'];
            } else {
                $imageFile = $defaultImageFile;
            }
            $pageContent .= 
                    '<section class="postlist postcard">'.
                        '<h1><a href="post/'.$row['url'].'">'.$row['title'].'</a><small> '.$row['short_title'].'</small>'.
                        '</h1>'.
                        '<p>'.$row['update_date'].'</p>'.
                        '<div>'.
                            '<img src="'.$imageFile.'" />'.
                            '<p>'.$row['abstract'].'</p>'.
                        '</div>'.
                        '<p>Kategoria: '.$row['kategorie'].'</p>'.
                        '<p>Tagi: '.$row['tagi'].'</p>'.
                        '<a class="btn btn-primary" href="post/'.$row['url'].'"><i class="fas fa-chevron-right"></i> Read more
                        </a>'.
                    '</section>';
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
