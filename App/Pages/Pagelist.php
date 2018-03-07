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

    const HOME_PAGE_VIEW_FILE = "index.html";
    private $db = null;
    private $error = false;
    private $errorMsg = null;
    
    
    public function __construct($data = []) {}

    
    public function show() {
        include_once DIR_VIEWS.self::HOME_PAGE_VIEW_FILE;
    }
    
    
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
            echo $fex->showError();
        }
        
        
        $this->db = $dbConnection->getDB();
        $this->error = $dbConnection->isError();
        $this->errorMsg = $dbConnection->getErrorMsg();
        
        $postListModel = new PostListModel(PostListModel::TYPE_ID_SORT, $dbConnection, $input, $pages);
        
        $this->addCSSFile(['name' => 'NavbarCSSFile', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'MainScript', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'Vue.JS', 'path' => 'https://cdn.jsdelivr.net/npm/vue']);


        $metaData = new \Widgets\MetaData([
            'title' => 'This is my new homepage! Hell yeah!',
            'description' => 'This is my new homepage. It\'s build in my own home-made CMS :)',
            'author' => 'Wróblewski Piotr',
            'keywords' => 'JavaScript',
            'url' => 'http://localhost/',
            'content' => 'website',
            'twitter-meta-field-left' => '',
            'twitter-meta-field-left-below' => '',
            'twitter-meta-field-right' => '',
            'twitter-meta-field-right-below' => '',
            'image' => 'https://www.wroblewskipiotr.pl/avatar.png',
            'domain' => 'https://www.wroblewskipiotr.pl/',
            'accent-color' => '#333333',
        ]); 

        $head = $metaData->getBody();
        $head .= $this->getCSSFiles();
        $head .= $this->getJsHeadFiles();

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
        {$postListModel->getContent()}
        {$footer->getBody()}
    </div>
HTML;

        $this->addJS($navbar->getJS());
        $this->setBody($body);
    }
    
}
