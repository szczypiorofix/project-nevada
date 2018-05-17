<?php
/*
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */
namespace Pages;

use Core\ModelClasses\Page;
use Models\PostAllModel;
/**
 * This is showcase of Page
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class DefaultPage extends Page {
    
    private $allData = [];


    public function __construct() {
        $this->allData = $this->getAllDataFromDatabase();
    }

    private function getAllDataFromDatabase() {
        $dbConnection = \Core\DBConnection::getInstance();
        $postListModel = new PostAllModel($dbConnection);

        // WRZUCENIE WSZYSTKICH DANYCH DO IndexedDB
        // Sprawdzanie danych w IndexedDB - 1) aktualne? - wyświetlanie, 2) nieaktualne lub brak - pobieranie
        // sprawdzanie, czy dane są i czy są aktualne (sprawdzanie wersji danych?)
        // to pobieranie nowych do IndexedDB i do zwrotu do klasy

        return $postListModel->getContent();
    }

    public function post($args) {
        if (!isset($args[0])) {
            $input = '';
         } else {
            $input = $args[0];
         }
         
         
         //var_dump($content);
                 
        //  $pageContent = '';
        //  $defaultImageFile = DIR_UPLOADS_IMAGES."default.jpg";
        //  $imageFile = $defaultImageFile;
        //  $postContent = null;
        //  if (is_array($content) || !is_null($content)) {
        //     if (file_exists(DIR_UPLOADS_IMAGES.$content['image']) && !is_dir(DIR_UPLOADS_IMAGES.$content['image'])) {
        //         $imageFile = DIR_UPLOADS_IMAGES.$content['image'];
        //     } else {
        //         $imageFile = $defaultImageFile;
        //     }
        //     $date = new \DateTime($content['update_date']);
        //     $dateString = $date->format('Y-m-d H:i');

        //     $tagsOfPost = explode(',', $content['tagi']);
        //     $taglist = '';
        //     foreach($tagsOfPost as $tags) {
        //         $taglist .= '<a href="lista/tag/'.$tags.'">'.$tags.'</a>, ';
        //     }
        //     // USUNIĘCIE OSATNIEGO PRZECINKA Z LISTY TAGÓW
        //     $taglist = rtrim($taglist,", ");
            
        //     //$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        //     $actual_link = $this->getCurrentUrl();
            
        //     /**
        //      * https://github.com/erusev/parsedown
        //      */
        //     $parsedown = new \Parsedown();

        //     $postContent = $parsedown->text($content['content']);
        //     //var_dump($postContent);
        //     $pageContent .= 
        //         '<section class="post-content">
        //             <div class="post-title">
        //                 <h1>'.$content['title'].'</h1>
        //             </div>
        //             <div class="post-date">
        //                 <p>'.$dateString.'</p>
        //             </div>
        //             <div class="post-image">
        //                 <img id="imageModalSrc" src="'.$imageFile.'" alt="'.$content['image_description'].'" />
        //                 <div id="imageModalDiv" class="modal">
        //                     <span class="close" id="imageModalClose">&times;</span>
        //                     <img class="modal-content" id="imageModalDest">
        //                     <div id="imageModalCaption"></div>
        //                 </div>
        //             </div>
        //             <div class="post-content"
        //                 <p>'.$postContent.'</p>
        //             </div>
        //             <div class="additional">
        //                 <div class="post-categories">
        //                     <p><strong><i class="fas fa-folder-open"></i></strong>: <a href="lista/kategoria/'.$content['kategorie'].'">'.$content['kategorie'].'</a></p>
        //                 </div>
        //                 <div class="post-tags">
        //                     <p><strong><i class="fas fa-tags"></i></strong>: '.$taglist.'</p>
        //                 </div>
        //                 <div class="pdf-container">
        //                     <a href="post/'.strtolower($content['url']).'/pdf" title="Pobierz ten artykuł jako plik PDF">Pobierz <i class="far fa-file-pdf"></i></a>
        //                 </div>
        //             </div>
        //             <div class="add-this-container">
        //                 <div class="addthis_inline_share_toolbox"></div>
        //             </div>
        //             <div class="disqus-container">
        //                 <div id="disqus_thread"></div>
        //                 <script>
        //                 /**
        //                 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
        //                 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
        //                 /*
        //                 var disqus_config = function () {
        //                     this.page.url = '.$actual_link.';  // Replace PAGE_URL with your pages canonical URL variable
        //                     this.page.identifier = '.$content['id'].'; // Replace PAGE_IDENTIFIER with your pages unique identifier variable
        //                 };
        //                 */
        //                 (function() { // DONT EDIT BELOW THIS LINE
        //                     var d = document, s = d.createElement("script");
        //                     s.src = "https://wroblewskipiotr.disqus.com/embed.js";
        //                     s.setAttribute("data-timestamp", +new Date());
        //                     (d.head || d.body).appendChild(s);
        //                 })();
        //                 </script>
        //                 <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        //             </div>
        //         </section>';
        //         if (isset($args[1])) {
        //             if ($args[1] === 'pdf') {
        //                 \Core\PDFCreator::make('<img src="'.$imageFile.'" alt="'.$content['image_description'].'" />'.$postContent, $content['title']);
        //             }
        //         }         
        // } else {
        //     $pageContent = '<section class="post-content">
        //         <div class="post-not-found">
        //             <h1 class="post-title">404<h1>
        //             <h3 class="post-title">NIE ZNALEZIONO POSTU !!!</h3>
        //         </div>
        //     </section>';
        // }
        $this->addCSSFile(['name' => 'Main CSS file', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'Main Script', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'js/jquery/jquery-1.12.4.min.js']);
        $this->addJSFile(['name' => 'Google Translate Script', 'path' => 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit', 'versioning' => false, 'async' => false]);
        $this->addJSFile(['name' => 'Google Translate Script Starter', 'path' => 'js/translate.js']);
        $this->addJSFile(['name' => 'AddThis Script', 'path' => '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad1f6633ca8b854"']);

        $this->addJSFile(['name' => 'Content Handler Script', 'path' => 'js/content-handler.js']);
        $this->addJS("PageContent.showDefaultList();");

        // image modal script
        $this->addJS('
        var modal = document.getElementById("imageModalDiv");
        var img = document.getElementById("imageModalSrc");
        var modalImg = document.getElementById("imageModalDest");
        var captionText = document.getElementById("imageModalCaption");
        if (img) {
            img.onclick = function() {
                modal.style.display = "block";
                modalImg.src = this.src;
                captionText.innerHTML = this.alt;
            }
        }    
        var span = document.getElementById("imageModalClose");
        if (span) {
            span.onclick = function() { 
                modal.style.display = "none";
            }
        }
        ');
        $imageFullPath = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]".DS.$imageFile;

        $metaData = new \Widgets\MetaData(
        is_null($postContent) ? null : [
            'title' => $content['title'],
            'description' => mb_substr(str_replace(["\n", "\r", "\n\r", "  "], " ", strip_tags($postContent)), 0, 250).'...',
            'author' => 'Wróblewski Piotr',
            'keywords' => $content['tagi'],
            'url' => $actual_link,
            'content' => 'website',
            'twitter-meta-field-left' => $content['title'],
            'twitter-meta-field-left-below' => $dateString,
            'twitter-meta-field-right' => 'Wróblewski Piotr',
            'twitter-meta-field-right-below' => $actual_link,
            'image' => $imageFullPath,
            'domain' => 'https://wroblewskipiotr.pl/',
            'accent-color' => '#333333',
        ]);
        $head = $metaData->getBody();
        $this->setHead($head);
        $logo = new \Widgets\Logo();
        $navbar = new \Widgets\Nav();
        $header = new \Widgets\Header();
        $header->addBody($navbar->getBody().$logo->getBody());
        $footer = new \Widgets\Footer();
        $sideBar = new \Widgets\Aside($dbConnection);
        $ctaButton = new \Widgets\CTAButton();

        $body =
<<<HTML
    <div class="full-page-container" id="mainDiv">
        <header class="nav-and-logo">
            {$header->getBody()}
        </header>
        <main class="post-card">
            <article>
                {$pageContent}
            </article>
            {$sideBar->getBody()}
        </main>
        {$ctaButton->getBody()}
        {$footer->getBody()}
    </div>
HTML;
        
    $this->setBody($body);
    }

    public function admin($args) {
        echo __FUNCTION__.'<br>';
        var_dump($this->allData);
        exit();
    }

    public function lista($args) {
        echo __FUNCTION__.'<br>';
        var_dump($this->allData);
        exit();
    }

    public function test($args) {
        echo __FUNCTION__.'<br>';
        var_dump($this->allData);
        exit();
    }

    public function defaultmethod($args) {
                
        // $this->AllData -> wybór tylko tych danych, które nas interesują.
        //echo __FUNCTION__.'<br>';
        //var_dump($this->allData);
        //exit();
        
        // if (is_null($content)) {
        //     $content = ['posts' => []];
        // }
 
        /**
         * https://github.com/erusev/parsedown
        */
        $parsedown = new \Parsedown();
        
        $defaultImageFile = DIR_UPLOADS_IMAGES."default.jpg";
        $imageFile = $defaultImageFile;
        $pageDynamicContent = '';

        // for ($i = count($content['posts'])-1; $i > count($content['posts'])-7; $i--) {
        //     $row = $content['posts'][$i];
        //     $kategoria = "";
            
        //     for ($a = 0; $a < count($content['categories']); $a++) {
        //         for ($j = 0; $j < count($content['post_categories']); $j++) {
        //             if ($content['categories'][$a]['id'] === $content['post_categories'][$j]['categoryid']
        //             && $content['posts'][$i]['id'] == $content['post_categories'][$j]['id']) {
        //                 $kategoria = $content['categories'][$a]['name'];
        //             }
        //         }
        //     }

        //     if (file_exists(DIR_UPLOADS_IMAGES.$row['image']) && !is_dir(DIR_UPLOADS_IMAGES.$row['image'])) {
        //         $imageFile = DIR_UPLOADS_IMAGES.$row['image'];
        //     } else {
        //         $imageFile = $defaultImageFile;
        //     }
        //     $date = new \DateTime($row['update_date']);
        //     $dateString = $date->format('Y-m-d H:i');
        //     $pageDynamicContent .= '<div class="news-part">
        //                                 <div class="image-div">
        //                                     <a href="post/'.$row['url'].'"><img src="'.$imageFile.'" /></a>
        //                                     <span class="image-caption">'.$kategoria.'</span>
        //                                 </div>
        //                                 <div class="main-post-content">
        //                                     <div class="post-title"><a href="post/'.$row['url'].'"><h3>'.$row['title'].'</h3></a></div>'
        //                                     .mb_substr($parsedown->text($row['content']), 0, 150).'...
        //                                     <div class="additional-info">
        //                                         <span class="post-date">'.$dateString.'</span>
        //                                         <span class="post-comments"><i class="far fa-comment-alt"></i> 1</span>
        //                                     </div>
        //                                     <a class="readmore" href="post/'.$row['url'].'">Czytaj więcej</a>
        //                                 </div>';
        //     $pageDynamicContent .= '</div>';
        // }

        $captchaKey = \Core\Config::get('RECAPTCHA_KEY');
        
        $pageContent =
<<<HTML
    <main class="content-maindiv">
        <section class="myskills">
            <div class="container">
                <div class="left-side" id="omnie">
                    <div class="title">
                        <h1>Kilka słów o mnie</h1>
                    </div>
                    <img src="images/avatar.png" alt="My Skills" />
                    <p>Witaj, jestem Piotr.</p>
                    <p>Programowaniem zacząłem zajmować się już w liceum. Wtedy były czasy Turbo Pascala 7.0, BASICa i innych żółwików Logo. Potem nastąpiła u mnie kilkuletnia przerwa w przygodnie z programowaniem jednak jakiś czas temu postanowiłem do tego wrócić. Dlaczego? Bo to uwielbiam. Zwłaszcza gdy włożony wysiłek przynosi zamierzone rezultaty. Wszelkie porażki traktuję jako swego rodzaju lekcję i przestrogę na przyszłość. Wszelkie trudności jeszcze bardziej mniej motywują. Żółte komunikaty w konsoli przeglądarki podwajają moją czujność a na czerwone jestem wręcz uczulony.</p>
                    <p>Uwielbiam Javę za mocne typowanie, PHP za działanie w ukryciu a JavaScript za szybkie prototypowanie.</p>
                    <p>Chętnie uczę się nowych języków, technik, nowych narzędzi. Uwielbiam API.</p>
                    <div class="skills-button-container">
                        <a href="#" class="cv-download">POBIERZ CV</a>
                        <a href="#contact" class="hire-me scroll-btn">ZATRUDNIJ MNIE</a>
                    </div>
                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                    <div class="addthis_inline_follow_toolbox"></div>
                </div>
                <div class="right-side" id="umiejetnosci">
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
        <section class="whatIDo" id="corobie">
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
        <section class="numbers" id="liczby">
            <div class="bg"></div>
            <div class="container">
                <div class="numbers-container">
                    <div class="numbers-part">
                        <h3 id="num-pro">0</h3>
                        <h4>Ukończonych projektów</h4>
                    </div>
                    <div class="numbers-part">
                        <h3 id="num-cli">0</h3>
                        <h4>Zadowolonych klientów</h4>
                    </div>
                    <div class="numbers-part">
                        <h3  id="num-cof">0</h3>
                        <h4>kubków kawy</h4>
                    </div>
                    <div class="numbers-part">
                        <h3 id="num-col">0</h3>
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
        <section class="news" id="informacje">
            <div class="container">
                <div class="title">
                    <h1>Najnowsze informacje</h1>
                    <h3>czyli co w kodzie piszczy...</h3>
                </div>
                <div class="news-container">
                    <div id="postContent">
                    </div>
                </div>
                <div class="all-posts">
                    <a href="lista">Wszystkie posty...</a>
                </div>
            </div>
        </section>
        <section class="contact" id="kontakt">
            <div class="title">
                <h1>Kontakt</h1>
            </div>
            <div class="container">
                <div class="contact-container">
                    <div class="left-part">
                        <h3 class="title">Skontaktuj się ze mną</h3>
                        <form class="contact-us-form" id="submitMessageForm" method="POST">
                            <input type="text" placeholder="Imię i nazwisko" name="contact-form-name" autocomplete="name" required>
                            <input type="email" placeholder="E-mail" name="contact-form-email" autocomplete="email" required>
                            <textarea rows="12" placeholder="Twoja wiadomość" name="contact-form-message" required></textarea>
                            <div class="g-recaptcha" data-sitekey="{$captchaKey}" data-theme="light"></div>
                            <div class="contact-us-form-actions">
                                <input type="submit" class="button" value="Wyślij"/>
                            </div>
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
        
        $this->addCSSFile(['name' => 'Main CSS file', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'Main Script', 'path' => 'js/script.js']);

        $this->addJS('searchInput("'.\Core\Config::get("BASE_HREF").'");');

        $this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'js/jquery/jquery-1.12.4.min.js']);
        
        $this->addJSFile(['name' => 'External Script', 'path' => 'js/external.js']);
        $this->addJSFile(['name' => 'Google Translate Script', 'path' => 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit', 'versioning' => false, 'async' => false]);
        $this->addJSFile(['name' => 'Google Translate Script Starter', 'path' => 'js/translate.js']);
        //$this->addJSFile(['name' => 'Google Maps API', 'path' => 'https://maps.googleapis.com/maps/api/js?key='.\Core\Config::get("GOOGLE_MAPS_API_KEY").'&callback=showGoogleMaps']);
        $this->addJSFile(['name' => 'AddThis Follow buttons', 'path' => '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad1f6633ca8b854']);
        $this->addJSFile(['name' => 'Showdown markdown parser JS', 'path' => 'js/showdown/showdown.min.js']);
        $this->addJSFile(['name' => 'reCAPTCHA script', 'path' => 'https://www.google.com/recaptcha/api.js', 'async' => true, 'defer' => true]);

        //$this->addJSFile(['name' => 'Service Worker Script', 'path' => 'js/worker.js']);

        $this->addJSFile(['name' => 'Content Handler Script', 'path' => 'js/content-handler.js']);
        $this->addJS("PageContent.showDefaultList();");

        //$this->addJSFile(['name' => 'IndexedDB Script', 'path' => 'js/indexeddb.js']);
        //$this->addJSFile(['name' => 'IndexedDB Script', 'path' => 'js/idb.js']);
        //$this->addJS("iDB.init('postsDB', ".json_encode($content).");");  

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
        <header class="nav-and-logo">
            {$header->getBody()}
        </header>
        {$pageContent}
        {$ctaButton->getBody()}
        {$footer->getBody()}
    </div>
HTML;
        
        $this->setBody($body);
    }
}
