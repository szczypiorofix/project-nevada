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
            <div class="left-side">
                <img src="images/code.jpeg" alt="My Skills" />
                <p>My goal is ...</p>
            </div>
            <div class="right-side">
                <div class="title">
                    <h1>My skills</h1>
                </div>
                <div class="subtitle">
                    <h3>This is a subtitle...</h3>
                </div>
                <div class="skillBox">
                    <p>Html</p>
                    <p>90%</p>
                    <div class="skill">
                        <div class="skill_level html5"></div>
                    </div>
                </div>
                <div class="skillBox">
                    <p>Css3</p>
                    <p>80%</p>
                    <div class="skill">
                        <div class="skill_level css3"></div>
                    </div>
                </div>
                <div class="skillBox">
                    <p>PHP</p>
                    <p>85%</p>
                    <div class="skill">
                        <div class="skill_level php"></div>
                    </div>
                </div>
                <div class="skillBox">
                    <p>JavaScript</p>
                    <p>75%</p>
                    <div class="skill">
                        <div class="skill_level javascript"></div>
                    </div>
                </div>
                <div class="skillBox">
                    <p>Java</p>
                    <p>85%</p>
                    <div class="skill">
                        <div class="skill_level java"></div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div>
                <p>Lorem ispsum.....</p>
                <p>Lorem ispsum.....</p>
                <p>Lorem ispsum.....</p>
                <p>Lorem ispsum.....</p>
                <p>Lorem ispsum.....</p>
                <p>Lorem ispsum.....</p>
                <p>Lorem ispsum.....</p>
                <p>Lorem ispsum.....</p>

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
