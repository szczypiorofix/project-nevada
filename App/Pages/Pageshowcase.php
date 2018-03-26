<?php

/*
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */

namespace Pages;

use Core\ModelClasses\Page, Core\Config;

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
            <div class="container">
                <div class="left-side" id="aboutMe">
                    <div class="title">
                        <h1>Kilka słów o mnie</h1>
                    </div>
                    <img src="images/dog.jpeg" alt="My Skills" />
                    <p>Witaj, nazywam się Piotr.</p>
                    <p>Programowaniem zacząłem zajmować się już w liceum. Tedy były czasy Turbo Pascala 7.0, BASICa i innych żółwików Logo. Potem nastąpiła u mnie kilkuletnia przerwa w przygodnie z programowaniem jednak jakiś czas temu postanowiłem do tego wrócić. Dlaczego? Bo to uwielbiam. Zwłaszcza gdy włożony wysiłek przynosi zamierzone rezultaty. Wszelkie porażki traktuję jako swego rodzaju lekcję i przestrogę na przyszłość. Wszelkie trudnośći jeszcze bardziej mniej motywują. Żółte komunikaty w konsoli przeglądarki podwajają moją czujność a na czerwone jestem wręcz uczulony.</p>
                    <p>Uwielbiam Javę za mocne typowanie, PHP za działanie w ukryciu a JavaScript za szybkie prototypowanie.</p>
                    <p>Chętnie uczę się nowych języków, technik, nowych narzędzi. Uwielbiam API.</p>
                    <div class="skills-button-container">
                        <a href="#" class="cv-download">POBIERZ CV</a>
                        <a href="#contact" class="hire-me scroll-btn">ZATRUDNIJ MNIE</a>
                    </div>
                </div>
                <div class="right-side" id="mySkills">
                    <div class="title">
                        <h1>Umiejętności</h1>
                    </div>
                    <div class="subtitle">
                        <h3>Czyli to czego się nauczyłem...</h3>
                    </div>
                    <div class="skillBox">
                        <p>Java</p>
                        <p>85%</p>
                        <div class="skill">
                            <div class="skill_level java"></div>
                        </div>
                    </div>
                    <div class="skillBox">
                        <p>MySQL</p>
                        <p>80%</p>
                        <div class="skill">
                            <div class="skill_level mysql"></div>
                        </div>
                    </div>
                    <div class="skillBox">
                        <p>PHP</p>
                        <p>80%</p>
                        <div class="skill">
                            <div class="skill_level php"></div>
                        </div>
                    </div>
                    <div class="skillBox">
                        <p>Html</p>
                        <p>80%</p>
                        <div class="skill">
                            <div class="skill_level html5"></div>
                        </div>
                    </div>
                    <div class="skillBox">
                        <p>Css3</p>
                        <p>75%</p>
                        <div class="skill">
                            <div class="skill_level css3"></div>
                        </div>
                    </div>
                    <div class="skillBox">
                        <p>JavaScript</p>
                        <p>75%</p>
                        <div class="skill">
                            <div class="skill_level javascript"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="whatIDo" id="whatIDo">
            <div class="container">
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
                        <i class="fas fa-tachometer-alt"></i>
                        <h3>Max speed</h3>
                        <p>Strona ma wczytywać się szybko.</p>
                    </div>
                    <div class="iDos-part">
                        <i class="fas fa-coffee"></i>
                        <h3>Covfefe</h3>
                        <p>No i kawa ... Kawa sama się nie wypije...</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="numbers" id="numbers">
            <div class="bg"></div>
            <div class="container">
                <div class="numbers-container">
                    <div class="numbers-part">
                        <h3>14</h3>
                        <h4>Ukończonych projektów</h4>
                    </div>
                    <div class="numbers-part">
                        <h3>234</h3>
                        <h4>Zadowolonych klientów</h4>
                    </div>
                    <div class="numbers-part">
                        <h3>546</h3>
                        <h4>kubków kawy</h4>
                    </div>
                    <div class="numbers-part">
                        <h3>256</h3>
                        <h4>kolorów w palecie</h4>
                    </div>
                </div>
            </div>
        </section>

        <section class="portfolio" id="portfolio">
            <div class="container">
                <div class="title">
                    <h1>Portfolio</h1>
                    <h3>Informacje o moich projektach ...</h3>
                </div>
                <div class="portfolio-container">
                    <div class="portfolio-part">
                        <div class="image-div">
                            <img src="images/portfolio/spaceinvaders1.png" />
                            <div class="overlay">
                                <p>Space Invaders</p>
                                <a href="projekt/spaceinvaders/"><i class="far fa-play-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-part">
                        <div class="image-div">
                            <img src="images/portfolio/tequilaplatformer1.png" />
                            <div class="overlay">
                                <p>Tequila Platformer</p>
                                <a href="projekt/tequila/"><i class="far fa-play-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-part">
                        <div class="image-div">
                            <img src="images/portfolio/kanciarz1.png" />
                            <div class="overlay">
                                <p>Kanciarz - kalkulator walut</p>
                                <a href="projekt/kanciarz/"><i class="far fa-play-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-part">
                        <div class="image-div">
                            <img src="images/portfolio/furyroad1.png" />
                            <div class="overlay">
                                <p>Fury Road</p>
                                <a href="projekt/furyroad/"><i class="far fa-play-circle"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="news" id="news">
            <div class="container">
                <div class="title">
                    <h1>Najnowsze informacje</h1>
                    <h3>czyli co w kodzie piszczy...</h3>
                </div>
                <div class="news-container">
                    <div class="news-part">
                        <div class="image-div">
                            <a href="#"><img src="images/portfolio/spaceinvaders1.png" /></a>
                        </div>
                        <a href="#"><h3>Space Invaders update v.3</h3></a>
                        <p>Gra Space Invader otrzymała dzisiaj aktualizację. Changelog : ...</p>
                        <div class="additional-info">
                            <span class="post-date">23 Marzec 2018</span>
                            <span class="post-comments"><i class="far fa-comment-alt"></i> 5</span>
                        </div>
                    </div>
                    <div class="news-part">
                        <div class="image-div">
                            <a href="#"><img src="images/portfolio/tequilaplatformer1.png" /></a>
                        </div>
                        <a href="#"><h3>Tequila Platformer - informacje</h3></a>
                        <p>Aktualizacja bazy danych w toku ...</p>
                        <div class="additional-info">
                            <span class="post-date">23 Marzec 2018</span>
                            <span class="post-comments"><i class="far fa-comment-alt"></i> 3</span>
                        </div>
                    </div>
                    <div class="news-part">
                        <div class="image-div">
                            <a href="#"><img src="images/portfolio/kanciarz1.png" /></a>
                        </div>
                        <a href="#"><h3>Kanciarz - aktualizacja 1.1</h3></a>
                        <p>Aplikacja do przeliczania kursów walut została zaktualizowana do wersji 1.1...</p>
                        <div class="additional-info">
                            <span class="post-date">23 Marzec 2018</span>
                            <span class="post-comments"><i class="far fa-comment-alt"></i> 2</span>
                        </div>
                    </div>
                    <div class="news-part">
                        <div class="image-div">
                            <a href="#"><img src="images/portfolio/furyroad1.png" /></a>
                        </div>
                        <a href="#"><h3>Fury road aktualizacja</h3></a>
                        <p>Gra Fury Road została zaktualizowana do wersji ...</p>
                        <div class="additional-info">
                            <span class="post-date">23 Marzec 2018</span>
                            <span class="post-comments"><i class="far fa-comment-alt"></i> 1</span>
                        </div>
                    </div>
                    <div class="news-part">
                        <div class="image-div">
                            <a href="#"><img src="images/portfolio/kanciarz1.png" /></a>
                        </div>
                        <a href="#"><h3>Kanciarz początek projektu</h3></a>
                        <p>Rozpocząłem nowy projekt pt. Kanciarz. Będzie to kalkulator wymiany walut.</p>
                        <div class="additional-info">
                            <span class="post-date">23 Marzec 2018</span>
                            <span class="post-comments"><i class="far fa-comment-alt"></i> 0</span>
                        </div>
                    </div>
                    <div class="news-part">
                        <div class="image-div">
                            <a href="#"><img src="images/portfolio/furyroad1.png" /></a>
                        </div>
                        <a href="#"><h3>Fury Road - początek projektu</h3></a>
                        <p>Nowy projekt został właśnie rozpoczęty.</p>
                        <div class="additional-info">
                            <span class="post-date">23 Marzec 2018</span>
                            <span class="post-comments"><i class="far fa-comment-alt"></i> 5</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact" id="contact">
            <div class="title">
                <h1>Kontakt</h1>
            </div>
            <div class="container">
                <div class="contact-container">
                    <div class="left-part">
                        <h3 class="title">Skontaktuj się ze mną</h3>
                        <form action="/action_page.php">
                            <input type="text" id="name" name="name" placeholder="Imię...">

                            <input type="email" id="email" name="email" placeholder="E-mail...">

                            <textarea rows="4" cols="50" placeholder="Wiadomość..."></textarea>
                        
                            <input type="submit" value="Wyślij">
                        </form>
                    </div>
                    <div class="right-part">
                        <div class="contact-card-maps">
                            <h3 class="title">Znajdź mnie tutaj</h3>
                            <div id="googlemapscontainer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
HTML;
        
        $this->addCSSFile(['name' => 'NavbarCSSFile', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'MainScript', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'https://code.jquery.com/jquery-1.12.4.min.js']);
        //$this->addJSFile(['name' => 'Google Maps API', 'path' => 'https://maps.googleapis.com/maps/api/js?key='.Config::get("GOOGLE_MAPS_API_KEY").'&callback=showGoogleMaps']);

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
        <!-- <div class="fullscreenbackground"></div> -->
        {$header->getBody()}
        {$pageContent}
        {$ctaButton->getBody()}
        {$footer->getBody()}
    </div>
HTML;
        
        $this->setBody($body);
    }

}
