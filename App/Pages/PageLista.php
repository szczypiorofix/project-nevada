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
class PageLista extends Page {
    
    public function __construct($data = []) {}
    
    public function __toString() {
        return get_class($this);
    }
    
    private function postsFound($counter) {
        if ($counter === 0) {
            return '<h3>Nie znaleziono postów.</h3>';
        } else {
            return '<h3>Lista postów</h3>';
        }
    }
    
    public function szukaj($args) {

        $type = '';
        $pages = 0;
        if (isset($_GET['q'])) {
            $type = $_GET['q'];
        }
                
        $dbConnection = \Core\DBConnection::getInstance();
        
        $postListModel = new PostListModel(PostListModel::TYPE_SEARCH_SORT, $dbConnection, $type, $pages);
        $content = $postListModel->getContent();

        echo json_encode($content);
        exit;
        
        if (is_null($content)) {
            $content = ['posts' => [], 'postsonsite' => 6, 'maxrecords' => -1];
        }
 
        /**
         * https://github.com/erusev/parsedown
        */
        $parsedown = new \Parsedown();
        
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
            $pageDynamicContent .= '<div class="news-part list">
                                        <div class="image-div">
                                            <a href="post/'.$row['url'].'"><img src="'.$imageFile.'" /></a>
                                            <span class="image-caption">'.$row['kategorie'].'</span>
                                        </div>
                                        <div class="main-post-content">
                                            <a href="post/'.$row['url'].'">
                                                <h3>'.$row['title'].'</h3>
                                            </a>'
                                            .mb_substr($parsedown->text($row['content']), 0, 185).'...
                                            <div class="additional-info">
                                                <span class="post-date">'.$dateString.'</span>
                                                <span class="post-comments"><i class="far fa-comment-alt"></i> 1</span>
                                            </div>
                                        </div>
                                    </div>';
        }

        
        $pageContent =
<<<HTML
    <main class="content-maindiv">
        <section class="news">
            <div class="container">
                <div class="title">
                    {$this->postsFound(count($content['posts']))}
                </div>
                <div class="news-container">
                    {$pageDynamicContent}
                </div>
            </div>
        </section>
    </main>
HTML;
        
        $this->addCSSFile(['name' => 'Main CSS file', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'Main Script', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'js/jquery/jquery-1.12.4.min.js']);
        
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
        
        $pagination = new \Widgets\Pagination(
            ['current' => $pages,
            'linkPrefix' => 'szukaj',
            'type' => $type,
            'max' => $content['maxrecords'],
            'postsonsite' => $content['postsonsite']]
        );

        $body =
<<<HTML
    <div class="full-page-container" id="mainDiv">
        <header class="nav-and-logo">
            {$header->getBody()}
        </header>
        <main class="post-card">
            <article>
                {$pageContent}
                {$pagination->getBody()}
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

    public function kategoria($args) {
        if (!isset($args[0])) {
            $type = 'list';
        } else {
            $type = $args[0];
        }
        if (!isset($args[1])) {
            $pages = 0;
        } else {
            $pages = intval($args[1]);
        }

        $this->dbConnection = \Core\DBConnection::getInstance();  

        $postListModel = new PostListModel(PostListModel::TYPE_CATEGORY_SORT, $this->dbConnection, $type, $pages);
        $content = $postListModel->getContent();
        
        //var_dump($content);
        //exit;
        
        if (is_null($content)) {
            $content = ['posts' => [], 'postsonsite' => 6, 'maxresults' => -1];
        }
 
        /**
         * https://github.com/erusev/parsedown
        */
        $parsedown = new \Parsedown();
        
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
            $pageDynamicContent .= '<div class="news-part list">
                                        <div class="image-div">
                                            <a href="post/'.$row['url'].'"><img src="'.$imageFile.'" /></a>
                                            <span class="image-caption">'.$row['kategorie'].'</span>
                                        </div>
                                        <div class="main-post-content">
                                            <a href="post/'.$row['url'].'">
                                                <h3>'.$row['title'].'</h3>
                                            </a>
                                            '.mb_substr($parsedown->text($row['content']), 0, 185).'...
                                            <div class="additional-info">
                                                <span class="post-date">'.$dateString.'</span>
                                                <span class="post-comments"><i class="far fa-comment-alt"></i> 1</span>
                                            </div>
                                        </div>
                                    </div>';
        }
        
        
        $pageContent =
<<<HTML
    <main class="content-maindiv">
        <section class="news">
            <div class="container">
                <div class="title">
                    {$this->postsFound(count($content['posts']))}
                </div>
                <div class="news-container">
                    {$pageDynamicContent}
                </div>
            </div>
        </section>
    </main>
HTML;
        
        $this->addCSSFile(['name' => 'Main CSS file', 'path' => 'css/style.css']);
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
        $sideBar = new \Widgets\Aside($this->dbConnection);
        $ctaButton = new \Widgets\CTAButton();

        // ŁĄCZNA LICZBA POSTÓW DANEJ KATEGORII
        $maxCountOfCategory = 0;
        foreach($sideBar->getCategoriesResults() as $r) {
            if ($r['name'] === $type) {
                $maxCountOfCategory = $r['post_count'];
            }
        }

        $pagination = new \Widgets\Pagination(
            ['current' => $pages,
            'linkPrefix' => 'kategoria',
            'type' => $type,
            'max' => $maxCountOfCategory,
            'postsonsite' => $content['postsonsite']]
        );
        
        $body =
<<<HTML
    <div class="full-page-container" id="mainDiv">
        <header class="nav-and-logo">
            {$header->getBody()}
        </header>
        <main class="post-card">
            <article>
                {$pageContent}
                {$pagination->getBody()}
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

    public function tag($args) {
        
        if (!isset($args[0])) {
            $type = 'list';
        } else {
            $type = $args[0];
        }
        if (!isset($args[1])) {
            $pages = 0;
        } else {
            $pages = intval($args[1]);
        }

        $dbConnection = \Core\DBConnection::getInstance();
        
        $postListModel = new PostListModel(PostListModel::TYPE_TAGS_SORT, $dbConnection, $type, $pages);
        $content = $postListModel->getContent();
        
        //var_dump($content);
        //exit;
        
        if (is_null($content)) {
            $content = ['posts' => [], 'postsonsite' => 6, 'maxresults' => -1];
        }
 
        /**
         * https://github.com/erusev/parsedown
        */
        $parsedown = new \Parsedown();
        
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
            $pageDynamicContent .= '<div class="news-part list">
                                        <div class="image-div">
                                            <a href="post/'.$row['url'].'"><img src="'.$imageFile.'" /></a>
                                            <span class="image-caption">'.$row['kategorie'].'</span>
                                        </div>
                                        <div class="main-post-content">
                                            <a href="post/'.$row['url'].'">
                                                <h3>'.$row['title'].'</h3>
                                            </a>'.mb_substr($parsedown->text($row['content']), 0, 185).'...
                                            <div class="additional-info">
                                                <span class="post-date">'.$dateString.'</span>
                                                <span class="post-comments"><i class="far fa-comment-alt"></i> 1</span>
                                            </div>
                                        </div>
                                    </div>';
        }

        $pageContent =
<<<HTML
    <main class="content-maindiv">
        <section class="news" id="news">
            <div class="container">
                <div class="title">
                    {$this->postsFound(count($content['posts']))}
                </div>
                <div class="news-container">
                    {$pageDynamicContent}
                </div>
            </div>
        </section>
    </main>
HTML;
        
        $this->addCSSFile(['name' => 'Main CSS file', 'path' => 'css/style.css']);
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
        
        // ŁĄCZNA LICZBA POSTÓW DANEJGO TAGA:
        $maxCountOfTag = 0;
        
        foreach($sideBar->getTagsResults() as $r) {
            if (strtolower($r['name']) === $type) {
                $maxCountOfTag = $r['post_count'];
            }
        }

        $pagination = new \Widgets\Pagination(
            ['current' => $pages,
            'linkPrefix' => 'tag',
            'type' => $type,
            'max' => $maxCountOfTag,
            'postsonsite' => $content['postsonsite']]
        );

        $body =
<<<HTML
    <div class="full-page-container" id="mainDiv">
        <header class="nav-and-logo">
            {$header->getBody()}
        </header>
        <main class="post-card">
            <article>
                {$pageContent}
                {$pagination->getBody()}
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

    public function defaultmethod($args) {

        if (!isset($args[0])) {
            $type = 'list';
        } else {
            $type = $args[0];
        }
        if (!isset($args[1])) {
            $pages = 0;
        } else {
            $pages = intval($args[1]);
        }
                
        $dbConnection = \Core\DBConnection::getInstance();
        
        $postListModel = new PostListModel(PostListModel::TYPE_ID_SORT, $dbConnection, $type, $pages);
        $content = $postListModel->getContent();
        
        //var_dump($content);
        //exit;
        
        if (is_null($content)) {
            $content = ['posts' => [], 'postsonsite' => 6, 'maxresults' => -1];
        }
 
        /**
         * https://github.com/erusev/parsedown
        */
        $parsedown = new \Parsedown();
        
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
            $pageDynamicContent .= '<div class="news-part list">
                                        <div class="image-div">
                                            <a href="post/'.$row['url'].'"><img src="'.$imageFile.'" /></a>
                                            <span class="image-caption">'.$row['kategorie'].'</span>
                                        </div>
                                        <div class="main-post-content">
                                            <a href="post/'.$row['url'].'">
                                                <h3>'.$row['title'].'</h3>
                                            </a>
                                            '.mb_substr($parsedown->text($row['content']), 0, 185).'...
                                            <div class="additional-info">
                                                <span class="post-date">'.$dateString.'</span>
                                                <span class="post-comments"><i class="far fa-comment-alt"></i> 1</span>
                                            </div>
                                        </div>
                                    </div>';
        }
        $pageContent =
<<<HTML
    <main class="content-maindiv">
        <section class="news">
            <div class="container">
                <div class="title">
                    {$this->postsFound(count($content['posts']))}
                </div>
                <div class="news-container">
                    {$pageDynamicContent}
                </div>
            </div>
        </section>
    </main>
HTML;
        
        $this->addCSSFile(['name' => 'Main CSS file', 'path' => 'css/style.css']);
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
        
        // ŁĄCZNA LICZBA WSZYSTKICH POSTÓW:
        $maxCountOfTag = $content['maxrecords'];

        $pagination = new \Widgets\Pagination(
            ['current' => $pages,
            'linkPrefix' => false,
            'type' => $type,
            'max' => $maxCountOfTag,
            'postsonsite' => $content['postsonsite']]
        );

        $body =
<<<HTML
    <div class="full-page-container" id="mainDiv">
        <header class="nav-and-logo">
            {$header->getBody()}
        </header>
        <main class="post-card">
            <article>
                {$pageContent}
                {$pagination->getBody()}
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
