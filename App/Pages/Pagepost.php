<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Pages;

use \Core\ModelClasses\Page;

/**
 * This is a controller class for single post.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class Pagepost extends Page {
    
    
    public function __construct($data = []) {
        
    }
    
    
    public function defaultmethod($args) {
        $this->addCSSFile(['name' => 'NavbarCSSFile', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'MainScript', 'path' => 'js/script.js']);
            

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
            'image' => 'https://www.wroblewskipiotr.pl/avatar.jpg',
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

        $body =
<<<HTML
    <div class="full-page-container">
        {$header->getBody()}
        
        {$footer->getBody()}
    </div>
HTML;

        $this->setBody($body);
    }

}
