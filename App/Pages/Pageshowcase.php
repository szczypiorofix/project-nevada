<?php

/*
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */

namespace Pages;

use Core\ModelClasses\Page;

/**
 * This is showcase of Page
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class Pageshowcase extends Page {
    
    public function defaultmethod($args) {
        
        $pageContent =
<<<HTML
    <main class="content-maindiv">
        <section class="myskills">
            <div class="title">
                <h1>My skills</h1>
            </div>
            <div class="subtitle">
                <h3>This is a subtitle...</h3>
            </div>
            <div class="skill-container">
                <div class="skills html">90%</div>
            </div>
            <div class="skill-container">
                <div class="skills css">80%</div>
            </div>
            <div class="skill-container">
                <div class="skills js">70%</div>
            </div>
            <div class="skill-container">
                <div class="skills php">60%</div>
            </div>
        </section>
    </main>
HTML;
        
        $this->addCSSFile(['name' => 'NavbarCSSFile', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'MainScript', 'path' => 'js/script.js']);
        //$this->addJSFile(['name' => 'Vue.JS', 'path' => 'https://cdn.jsdelivr.net/npm/vue']);

        $metaData = new \Widgets\MetaData();
        $head = $metaData->getBody();
        
        $this->setHead($head);
        
        
        /**
         * http://preview.themeforest.net/item/borderland-a-daring-multiconcept-theme/full_screen_preview/10939025?_ga=2.55963629.714486595.1521158072-400241280.1521158072
         * 
         * http://demo.elated-themes.com/borderland1/
         * 
         * 
         * FAJNY DLA BLOGA:
         * http://demo.elated-themes.com/borderland6/
         * 
         */
        
        
        $logo = new \Widgets\Logo();
        $navbar = new \Widgets\Nav();

        $header = new \Widgets\Header();
        $header->addBody($navbar->getBody().$logo->getBody());

        $footer = new \Widgets\Footer();
        
        $body =
<<<HTML
    <div class="full-page-container" id="mainDiv">
        <div class="fullscreenbackground"></div>
        {$header->getBody()}
        {$pageContent}
        {$footer->getBody()}
    </div>
HTML;
        
        $this->setBody($body);
    }

}
