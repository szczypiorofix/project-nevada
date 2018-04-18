<?php
/*
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */

namespace Pages;

use Core\ModelClasses\Page;
use Models\PostListModel;
/**
 * This is showcase of Page
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class PageKategoria extends Page {
    
    public function __construct($data = []) {}
    
    public function __toString() {
        return get_class($this);
    }
    
    public function defaultmethod($args) {

        if (!isset($args[0])) {
            $type = 'list';
        }
        else {
            $type = $args[0];
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
        
        $postListModel = new PostListModel(PostListModel::TYPE_CATEGORY_SORT, $dbConnection, $type, $pages);
        $content = $postListModel->getContent();
        
        //var_dump($content);
        //exit;
        
        if (is_null($content)) {
            $content = [];
        }
 
        /**
         * https://github.com/erusev/parsedown
        */
        $Parsedown = new \Vendors\Parsedown\Parsedown();
        
        $defaultImageFile = DIR_UPLOADS_IMAGES."default.jpg";
        $imageFile = $defaultImageFile;
        $pageDynamicContent = '';
        foreach($content['posts'] as $row) {
            if (file_exists(DIR_UPLOADS_IMAGES.$row['image']) && !is_dir(DIR_UPLOADS_IMAGES.$row['image'])) {
                $imageFile = DIR_UPLOADS_IMAGES.$row['image'];
            } else {
                $imageFile = $defaultImageFile;
            }
            $date = new \DateTime($row['update_date']);
            $dateString = $date->format('Y-m-d H:i');
            $pageDynamicContent .= '<div class="news-part">
                                        <div class="image-div">
                                            <a href="post/'.$row['url'].'"><img src="'.$imageFile.'" /></a>
                                        </div>
                                        <div class="main-content"><a href="post/'.$row['url'].'#disqus_thread"><h3>'.$row['title'].'</h3></a>'.mb_substr($Parsedown->text($row['content']), 0, 185).'...</div>
                                        <div class="additional-info">
                                            <span class="post-date">'.$dateString.'</span>
                                            <span class="post-comments"><i class="far fa-comment-alt"></i> 1</span>
                                        </div>';
            $pageDynamicContent .= '</div>';
        }
        $pageContent =
<<<HTML
    <main class="content-maindiv">
        <section class="news">
            <div class="container">
                <div class="title">
                    <h1>Najnowsze informacje</h1>
                    <h3>czyli co w kodzie piszczy...</h3>
                </div>
                <div class="news-container">
                    {$pageDynamicContent}
                </div>
            </div>
        </section>
    </main>
HTML;
        
        $this->addCSSFile(['name' => 'NavbarCSSFile', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'Main Script', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'https://code.jquery.com/jquery-1.12.4.min.js']);
        
        //$this->addJSFile(['name' => 'External Script', 'path' => 'js/external.js']);
        $this->addJSFile(['name' => 'Google Translate Script', 'path' => 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit', 'versioning' => false, 'async' => false]);
        $this->addJSFile(['name' => 'Google Translate Script Starter', 'path' => 'js/translate.js', 'versioning' => true]);
        //$this->addJSFile(['name' => 'Google Maps API', 'path' => 'https://maps.googleapis.com/maps/api/js?key='.Config::get("GOOGLE_MAPS_API_KEY").'&callback=showGoogleMaps']);
        $this->addJSFile(['name' => 'AddThis Follow buttons', 'path' => '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad1f6633ca8b854']);

        $metaData = new \Widgets\MetaData();
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
