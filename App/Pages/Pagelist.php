<?php

namespace Pages;

use \Models\Page;

class Pagelist extends Page {

    const HOME_PAGE_VIEW_FILE = "index.html";
    
    
    public function __construct($data = []) {}

    
    public function show() {
        include_once DIR_VIEWS.self::HOME_PAGE_VIEW_FILE;
    }
    
    
    public function __toString() {
        return get_class($this);
    }

    
    public function defaultmethod($args) {
        
        $db = \Core\DBConnection::getInstance();
        
        
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
        {$a}
        {$footer->getBody()}
    </div>
HTML;

        $this->addJS($navbar->getJS());
        $this->setBody($body);
    }
    
}
