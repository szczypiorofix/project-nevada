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
                <p>Moim celem jest ...</p>
            </div>
            <div class="right-side">
                <div class="title">
                    <h1>Umiejętności</h1>
                </div>
                <div class="subtitle">
                    <h3>Czyli to czego się nauczyłem...</h3>
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

        <section class="whatIDo">
            <div class="title">
                <h1>Co ja robię</h1>
                <h3>czyli kilka złotych zasad...</h3>
            </div>
            <div class="iDos-container">
                <div class="iDos-part">
                    <i class="fas fa-coffee"></i>
                    <h3>Web Design</h3>
                    <p>Strona sama się nie zrobi...</p>
                </div>
                <div class="iDos-part">
                    <i class="fas fa-coffee"></i>
                    <h3>Web Design</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
                <div class="iDos-part">
                    <i class="fas fa-desktop"></i>
                    <h3>Desktop apps</h3>
                    <p>Aplikacja na desktopy sama się nie zrobi...</p>
                </div>
                <div class="iDos-part">
                    <i class="fas fa-mobile-alt"></i>
                    <h3>Mobile apps</h3>
                    <p>Apka na telefon sama się nie stworzy...</p>
                </div>
                <div class="iDos-part">
                    <i class="fab fa-css3-alt"></i>
                    <h3>Responsive design</h3>
                    <p>Strona ma dobrze wyglądać zarówno na PC, na tablecie jak i na smartfonie...</p>
                </div>
                <div class="iDos-part">
                    <i class="fas fa-coffee"></i>
                    <h3>Covfefe</h3>
                    <p>Kawa sama się nie wypije...</p>
                </div>
            </div>
        </section>

        <section class="numbers">
            <div class="title">
                <h1>Liczby...</h1>
                <h3>Tutaj jakieś info...</h3>
            </div>
            <div class="numbers-container">
                <div class="numbers-part">
                    <i class="fas fa-coffee"></i>
                    <h3>Web Design</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
                <div class="numbers-part">
                    <i class="fas fa-coffee"></i>
                    <h3>Web Design</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
                <div class="numbers-part">
                    <i class="fas fa-desktop"></i>
                    <h3>Desktop apps</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
                <div class="numbers-part">
                    <i class="fas fa-coffee"></i>
                    <h3>Kubki kawy</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
            </div>
        </section>

        <section class="portfolio">
            <div class="title">
                <h1>Moje portfolio...</h1>
                <h3>Tutaj jakieś info...</h3>
            </div>
            <div class="portfolio-container">
                <div class="portfolio-part">
                    <i class="fas fa-coffee"></i>
                    <h3>Web Design</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
                <div class="portfolio-part">
                    <i class="fas fa-coffee"></i>
                    <h3>Web Design</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
                <div class="portfolio-part">
                    <i class="fas fa-desktop"></i>
                    <h3>Desktop apps</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
                <div class="portfolio-part">
                    <i class="fas fa-coffee"></i>
                    <h3>Kubki kawy</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
            </div>
        </section>

        <section class="news">
            <div class="title">
                <h1>Najnowsze informacje...</h1>
                <h3>Tutaj jakieś info...</h3>
            </div>
            <div class="news-container">
                <div class="news-part">
                    <i class="fas fa-coffee"></i>
                    <h3>Web Design</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
                <div class="news-part">
                    <i class="fas fa-coffee"></i>
                    <h3>Web Design</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
                <div class="news-part">
                    <i class="fas fa-desktop"></i>
                    <h3>Desktop apps</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
                <div class="news-part">
                    <i class="fas fa-coffee"></i>
                    <h3>Kubki kawy</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
            </div>
        </section>

        <section class="contact">
            <div class="title">
                <h1>Kontakt...</h1>
                <h3>Tutaj jakieś info...</h3>
            </div>
            <div class="contact-container">
                <div class="contact-part">
                    <i class="fas fa-coffee"></i>
                    <h3>Web Design</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
                <div class="contact-part">
                    <i class="fas fa-coffee"></i>
                    <h3>Web Design</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
                <div class="contact-part">
                    <i class="fas fa-desktop"></i>
                    <h3>Desktop apps</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
                <div class="contact-part">
                    <i class="fas fa-coffee"></i>
                    <h3>Kubki kawy</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
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
         * 
         * http://rajibweb.com/html/collis/index-one.html
         * 
         */
        
        
        $logo = new \Widgets\Logo();
        $navbar = new \Widgets\Nav();

        $header = new \Widgets\Header();
        $header->addBody($navbar->getBody().$logo->getBody());

        $footer = new \Widgets\Footer();

        $ctaButton = new \Widgets\CTAButton();
        
        $body =
<<<HTML
    <div class="full-page-container" id="mainDiv">
        <div class="fullscreenbackground"></div>
        {$header->getBody()}
        {$pageContent}
        {$ctaButton->getBody()}
        {$footer->getBody()}
    </div>
HTML;
        
        $this->setBody($body);
    }

}
