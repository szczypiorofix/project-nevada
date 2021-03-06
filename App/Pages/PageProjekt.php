<?php
/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Pages;

use Core\ModelClasses\Page;
use Models\ProjectModel;

/**
 * This is a controller class for project-type post.
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class PageProjekt extends Page {
    
    
    public function __construct($data = []) {}
    
    public function __toString() {
        return get_class($this);
    }
    
    public function defaultmethod($args) {

        $dbConnection = \Core\DBConnection::getInstance();

        // GET TEQUILA PLATFORMER RESULTS
        if (isset($args[1]) && $args[0] == 'tequila') {
            if ($args[1] == 'getresults') {
                $query = $dbConnection['db']->prepare("SELECT * FROM `tequilabestscores` ORDER BY `score` DESC");
                $query->execute();
                echo json_encode($query->fetchAll());
                exit;
            }
        }
        

        if (!isset($args[0])) {
           $input = '';
        } else {
           $input = $args[0];
        }
                
        $postModel = new ProjectModel($input);
        $content = $postModel->getContent();
          
        //var_dump($content);
        //exit;
                
        $pageContent = '';
        $defaultImageFile = DIR_UPLOADS_IMAGES."default.jpg";
        $imageFile = $defaultImageFile;
        $postContent = null;
        
        if (is_array($content) || !is_null($content)) {
            if (file_exists(DIR_UPLOADS_IMAGES.$content['image']) && !is_dir(DIR_UPLOADS_IMAGES.$content['image'])) {
                $imageFile = DIR_UPLOADS_IMAGES.$content['image'];
            } else {
                $imageFile = $defaultImageFile;
            }
            $date = new \DateTime($content['update_date']);
            $dateString = $date->format('Y-m-d H:i');

            $tagsOfPost = explode(',', $content['tagi']);
            $taglist = '';
            foreach($tagsOfPost as $tags) {
                $taglist .= '<a href="lista/tag/'.$tags.'">'.$tags.'</a>, ';
            }
            // USUNIĘCIE OSATNIEGO PRZECINKA Z LISTY TAGÓW
            $taglist = rtrim($taglist,", ");
            
            $actual_link = $this->getCurrentUrl();
            
            /**
             * https://github.com/erusev/parsedown
             */
            $parsedown = new \Parsedown();

            $postContent = $parsedown->text($content['content']);
            //var_dump($postContent);
            $pageContent .= 
                '<section class="post-content">
                    <div class="post-title">
                        <h1>'.$content['title'].'</h1>
                    </div>
                    <div class="post-date">
                        <p>'.$dateString.'</p>
                    </div>
                    <div class="post-image">
                        <img id="imageModalSrc" src="'.$imageFile.'" alt="'.$content['image_description'].'" />
                        <div id="imageModalDiv" class="modal">
                            <span class="close" id="imageModalClose">&times;</span>
                            <img class="modal-content" id="imageModalDest">
                            <div id="imageModalCaption"></div>
                        </div>
                    </div>
                    <div class="post-content"
                        <p>'.$postContent.'</p>
                    </div>
                    <div class="additional">
                        <div class="post-categories">
                            <p><strong><i class="fas fa-folder-open"></i></strong>: <a href="lista/kategoria/'.$content['kategorie'].'">'.$content['kategorie'].'</a></p>
                        </div>
                        <div class="post-tags">
                            <p><strong><i class="fas fa-tags"></i></strong>: '.$taglist.'</p>
                        </div>
                        <div class="pdf-container">
                            <a href="projekt/'.strtolower($content['url']).'/pdf" title="Pobierz ten artykuł jako plik PDF">Pobierz <i class="far fa-file-pdf"></i></a>
                        </div>
                    </div>
                    <div class="add-this-container">
                        <div class="addthis_inline_share_toolbox"></div>
                    </div>
                    <div>
                        <p>Powiązane posty:</p>
                        <p>Lista postów które posiadają w kategorii "projekty" oraz są powiązane z danym projektem</p>
                    </div>
                </section>';
                if (isset($args[1])) {
                    if ($args[1] === 'pdf') {
                        \Core\PDFCreator::make('<img src="'.$imageFile.'" alt="'.$content['image_description'].'" />'.$postContent, $content['title']);
                    }
                }         
        } else {
            $pageContent = '<section class="post-content">
                <div class="post-not-found">
                    <h1 class="post-title">404<h1>
                    <h3 class="post-title">NIE ZNALEZIONO PROJEKTU !!!</h3>
                </div>
            </section>';
        }
        
        $this->addCSSFile(['name' => 'NavbarCSSFile', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'Main Script', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'js/jquery/jquery-1.12.4.min.js']);
        $this->addJSFile(['name' => 'Google Translate Script', 'path' => 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit', 'versioning' => false, 'async' => false]);
        $this->addJSFile(['name' => 'Google Translate Script Starter', 'path' => 'js/translate.js']);
        $this->addJSFile(['name' => 'AddThis Script', 'path' => '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad1f6633ca8b854"']);
        
        // http://ashleighy.github.io/emoji.js/
        //$this->addJSFile(['name' => 'Emojii', 'path' => 'js/emoji/emoji.js.js']);

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


    // https://www.ag-grid.com/javascript-getting-started/



        // PROJECT SPECIFIC SCRIPTS
        foreach($content['js'] as $script) {
            $this->addJSFile(['name' => 'Project Script', 'path' => $script]);
        }
        
        // PROJECT SPECIFIC HEADER SCRIPTS
        foreach($content['headjs'] as $script) {
            $this->addJSHeadFile(['name' => 'Project HeadScript', 'path' => $script]);
        }

        // PROJECT SPECIFIC CSSs
        foreach($content['css'] as $script) {
            $this->addCssFile(['name' => 'Project Style Sheet', 'path' => $script]);
        }

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
            'domain' => 'https://www.wroblewskipiotr.pl/',
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
        <div id="notificationsPanel">
            <span id="notificationsContent"></span>
        </div>
    </div>
HTML;
        
        $this->setBody($body);
    }

}
