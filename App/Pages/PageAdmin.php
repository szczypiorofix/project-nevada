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
use PDO;
use Core\Session;
use Core\DBConnection;
use Core\FrameworkException;

/**
 * This is admin panel page.
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class PageAdmin extends Page {

    public function __toString() {
        return get_class($this);
    }

    public function newpost($args) {
        
        $dbConnection = DBConnection::getInstance();
        
        if (!Session::check($dbConnection)) {
            header("Location: ".BASE_HREF.'admin/');
        }

        $dbConnection['error'] = true;
        try {
            $queryCategories = $dbConnection['db']->prepare("SELECT * FROM `categories`");
            $queryCategories->execute();
            $queryTags = $dbConnection['db']->prepare("SELECT * FROM `tags`");
            $queryTags->execute();
            $dbConnection['error'] = false;
        }
        catch (FrameworkException $exc) {
            $dbConnection['error'] = true;
            $dbConnection['errorMsg'] = $exc->getMessage();
        }

        $categoriesList = $queryCategories->fetchAll(PDO::FETCH_ASSOC);
        $categoriesContent = '<div class="categories-list">';
        for($i = 0; $i < count($categoriesList); $i++) {
            $categoriesContent .= '<div class="radio-item"><input type="radio" name="category[]" value="'.$categoriesList[$i]['id'].'" /><label>'.$categoriesList[$i]['name'].'</label></div>';
        }
        $categoriesContent .= '</div>';

        $tagsList = $queryTags->fetchAll(PDO::FETCH_ASSOC);
        $tagsContent = '<div class="tags-list">';
        for($i = 0; $i < count($tagsList); $i++) {
            $tagsContent .= '<div class="checkbox-item"><input type="checkbox" name="tags[]" value="'.$tagsList[$i]['id'].'" /><label>'.$tagsList[$i]['name'].'</label></div>';
        }
        $tagsContent .= '</div>';
        
        $this->addCSSFile(['name' => 'Main CSS file', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'Main Script', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'js/jquery/jquery-1.12.4.min.js']);
        
        // https://github.com/showdownjs/showdown
        $this->addJSFile(['name' => 'Showdown markdown parser JS', 'path' => 'js/showdown/showdown.min.js']);
        $this->addJSFile(['name' => 'Markdown in real time script', 'path' => 'js/markdown.js']);
        
        $this->addJSFile(['name' => 'Admin scripts', 'path' => 'js/admin.js']);
        
        $pageContent =
<<<HTML
    <main class="content-maindiv">
        <section class="admin-container">  
            <h3>NOWY POST</h3>
            <form id="addpostform" class="edit-panel" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <label><strong>Tytuł:</strong></label>
                    <input type="text" name="post-title" required/>
                </div>
                <div class="input-group">
                <label><strong>Podgląd:</strong></label>
                    <div id="parseResults"></div>
                    <label><strong>Treść:</strong></label>
                    <textarea class="tmce" name="post-content" rows="15" cols="40" id="parseSource"></textarea>
                </div>
                <div class="input-group">
                    <label><strong>Kategoria:</strong></label>
                    {$categoriesContent}
                </div>
                <div class="input-group">
                    <label><strong>Tagi:</strong></label>
                    {$tagsContent}
                </div>
                <div class="input-group">
                    <label><strong>Obrazek:</strong></label><br>
                    <input type="file" name="post-file" id="post-file"/>
                    <label for="post-file" id="post-file-label"><i class="fas fa-upload"></i> Wybierz plik</label>
                </div>
                <div class="input-group">
                    <label><strong>Opis obrazka:</strong></label>
                    <input type="text" name="post-imagetitle" required/>
                </div>
                <div class="input-group">
                    <button class="submit" id="addbutton">Dodaj</button>
                    <a class="preview" href="#" target="_blank">Podgląd</a>
                </div>
            </form>
        </section>
    </main>
HTML;

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

    public function edit($args) {
        
        if (filter_input(INPUT_GET, 'postid', FILTER_SANITIZE_NUMBER_INT) !== null) {
            $id = filter_input(INPUT_GET, 'postid', FILTER_SANITIZE_NUMBER_INT);
        } else {
            header("Location: ".BASE_HREF.'admin/');
        }
        
        $dbConnection = DBConnection::getInstance();
        
        if (!Session::check($dbConnection)) {
            header("Location: ".BASE_HREF.'admin/');
        }

        $dbConnection['error'] = true;
        try {
            $query = $dbConnection['db']->prepare("SELECT * FROM `posts` WHERE `id`=:postid");
            $query->bindValue(':postid', $id, PDO::PARAM_INT);
            $query->execute();

            $queryPostCategories = $dbConnection['db']->prepare("SELECT `post_categories`.categoryid FROM `post_categories` WHERE `postid`=:postid");
            $queryPostCategories->bindValue(':postid', $id, PDO::PARAM_INT);
            $queryPostCategories->execute();

            $queryCategories = $dbConnection['db']->prepare("SELECT * FROM `categories`");
            $queryCategories->execute();

            $queryPostTags = $dbConnection['db']->prepare("SELECT `post_tags`.tagid FROM `post_tags` WHERE `postid`=:postid");
            $queryPostTags->bindValue(':postid', $id, PDO::PARAM_INT);
            $queryPostTags->execute();

            $queryTags = $dbConnection['db']->prepare("SELECT * FROM `tags`");
            $queryTags->execute();

            $dbConnection['error'] = false;
        }
        catch (FrameworkException $exc) {
            $dbConnection['error'] = true;
            $dbConnection['errorMsg'] = $exc->getMessage();
        }
        if ($query->rowCount() > 0) {
            $dbConnection['error'] = false;
        }

        $postCategory = $queryPostCategories->fetch();
        $categoriesList = $queryCategories->fetchAll(PDO::FETCH_ASSOC);
        $categoriesContent = '<div class="categories-list">';
        for($i = 0; $i < count($categoriesList); $i++) {
            $checked = "";
            if ($categoriesList[$i]['id'] === $postCategory['categoryid']) {
                $checked = "checked";
            }
            $categoriesContent .= '<div class="radio-item"><input type="radio" name="category[]" value="'.$categoriesList[$i]['id'].'" '.$checked.'/><label>'.$categoriesList[$i]['name'].'</label></div>';
        }
        $categoriesContent .= '</div>';

        $postTags = $queryPostTags->fetchAll(PDO::FETCH_ASSOC);
        $tagsList = $queryTags->fetchAll(PDO::FETCH_ASSOC);
        $tagsContent = '<div class="tags-list">';
        for($i = 0; $i < count($tagsList); $i++) {
            $checked = "";
            for ($j = 0; $j < count($postTags); $j++) {
                if ($tagsList[$i]['id'] === $postTags[$j]['tagid']) {
                    $checked = "checked";
                }
            }
            $tagsContent .= '<div class="checkbox-item"><input type="checkbox" name="tags[]" value="'.$tagsList[$i]['id'].'" '.$checked.'/><label>'.$tagsList[$i]['name'].'</label></div>';
        }
        $tagsContent .= '</div>';
        
        $this->addCSSFile(['name' => 'Main CSS file', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'Main Script', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'js/jquery/jquery-1.12.4.min.js']);
        
        // https://github.com/showdownjs/showdown
        $this->addJSFile(['name' => 'Showdown markdown parser JS', 'path' => 'js/showdown/showdown.min.js']);
        $this->addJSFile(['name' => 'Markdown in real time script', 'path' => 'js/markdown.js']);

        $this->addJSFile(['name' => 'Admin scripts', 'path' => 'js/admin.js']);
                
        $content = $query->fetch();
        //var_dump($content);
        $pageContent =
<<<HTML
    <main class="content-maindiv">
        <section class="admin-container">
            <h3>EDYCJA POSTU</h3>
            <form id="editpostform" class="edit-panel" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <label><strong>Tytuł:</strong></label>
                    <input type="text" value="{$content['title']}" name="post-title" />
                </div>
                <div class="input-group">
                    <label><strong>Podgląd:</strong></label>
                    <div id="parseResults"></div>
                    <label><strong>Treść:</strong></label>
                    <textarea class="tmce" name="post-content" rows="15" cols="40" id="parseSource">{$content['content']}</textarea>
                </div>
                <div class="input-group">
                    <label><strong>Kategoria:</strong></label>
                    {$categoriesContent}
                </div>
                <div class="input-group">
                    <label><strong>Tagi:</strong></label>
                    {$tagsContent}
                </div>
                <div class="input-group">
                    <label><strong>Obrazek:</strong></label><br>
                    <input type="file" name="post-file" id="post-file"/>
                    <label for="post-file" id="post-file-label"><i class="fas fa-upload"></i> Wybierz plik</label>
                </div>
                <div class="input-group">
                    <label><strong>Opis obrazka:</strong></label>
                    <input type="text" name="post-imagetitle" value="{$content['image_description']}" />
                </div>
                <div class="input-group">
                    <input type="hidden" name="postid" value="{$content['id']}">
                    <button class="submit" id="submitbutton">Zapisz</button>
                    <a class="preview" href="#" target="_blank">Podgląd</a>
                </div>
            </form>
        </section>
    </main>
HTML;

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
    
    public function save($args) {
        
        $inputFields = [
            'postid' => FILTER_SANITIZE_NUMBER_INT,
            'post-title' => FILTER_SANITIZE_STRING,
            'post-content' => FILTER_SANITIZE_STRING
        ];

        if ($this->checkFilters($inputFields)) {
            $postId = filter_input(INPUT_POST, 'postid', FILTER_SANITIZE_NUMBER_INT);
            $postTitle = filter_input(INPUT_POST, 'post-title', FILTER_SANITIZE_STRING);
            $postContent = filter_input(INPUT_POST, 'post-content', FILTER_SANITIZE_STRING);
            
            $postImageTitle = '';
            if (filter_input(INPUT_POST, 'post-imagetitle', FILTER_SANITIZE_STRING) !== null) {
                $postImageTitle = filter_input(INPUT_POST, 'post-imagetitle', FILTER_SANITIZE_STRING);
            }

            $postCategory = $_POST['category'][0];
            $postTags = $_POST['tags'];

            $dbConnection = DBConnection::getInstance();
            
            if (!Session::check($dbConnection)) {
                header("Location: ".BASE_HREF.'admin/');
            }

            $fileManager = new \Core\FileManager($dbConnection);
            $fileManager->checkFileToUpload($_FILES['post-file'], $postId);
            
            /**
             * Update post url
             */
            $newUrl = $this->cleanUrl($postTitle);

            $dbConnection['error'] = true;
            try {
                // UPDATE POST
                $query = $dbConnection['db']->prepare("UPDATE `posts` SET `title`=:title, `content`=:content, `url`=:newurl, `image_description`=:postimagetitle, `update_date`=NOW() WHERE `id`=:postid");
                $query->bindValue(':title', $postTitle, PDO::PARAM_STR);
                $query->bindValue(':content', $postContent, PDO::PARAM_STR);
                $query->bindValue(':postimagetitle', $postImageTitle, PDO::PARAM_STR);
                $query->bindValue(':newurl', $newUrl, PDO::PARAM_STR);
                $query->bindValue(':postid', $postId, PDO::PARAM_INT);
                $query->execute();

                // UPDATE POST CATEGORY
                $queryTags = $dbConnection['db']->prepare('UPDATE `post_categories` SET `categoryid`=:catid WHERE `id`=:id');
                $queryTags->bindValue(':id', $postId, PDO::PARAM_INT);
                $queryTags->bindValue(':catid', $postCategory, PDO::PARAM_INT);
                $queryTags->execute();

                // DELETE PREVIOUS DATA ABOUT POST TAGS
                $queryDelTag = $dbConnection['db']->prepare("DELETE FROM `post_tags` WHERE `postid` =:postid");
                $queryDelTag->bindParam(':postid', $postId, PDO::PARAM_INT);
                $queryDelTag->execute();

                // ADD NEW DATA ABOUT POST TAGS
                $insTagRelStmt = "INSERT INTO post_tags (tagid, postid) VALUES ";
                for ($i = 0; $i < count($postTags); $i++) {
                        $insTagRelStmt = $insTagRelStmt.'('.$postTags[$i].', '.$postId.')';
                        if ($i < (count($postTags))-1) {
                            $insTagRelStmt = $insTagRelStmt.', ';
                        }
                }
                $insTagRelStmt = $insTagRelStmt.';';
                $queryUpdateTags = $dbConnection['db']->prepare($insTagRelStmt);
                $queryUpdateTags->execute();

                $dbConnection['error'] = false;
                echo ' Post zapisany.';
            }
            catch (FrameworkException $exc) {
                $dbConnection['error'] = true;
                $dbConnection['errorMsg'] = $exc->getMessage();
            }
        }
        \Core\SitemMapXML::create($dbConnection);
        exit;
    }

    public function add($args) {
        
        $inputFields = [
            'post-title' => FILTER_SANITIZE_STRING,
            'post-content' => FILTER_SANITIZE_STRING
        ];

        if ($this->checkFilters($inputFields)) {
            $postTitle = filter_input(INPUT_POST, 'post-title', FILTER_SANITIZE_STRING);
            $postContent = filter_input(INPUT_POST, 'post-content', FILTER_SANITIZE_STRING);
            
            $postImageTitle = '';
            if (filter_input(INPUT_POST, 'post-imagetitle', FILTER_SANITIZE_STRING) !== null) {
                $postImageTitle = filter_input(INPUT_POST, 'post-imagetitle', FILTER_SANITIZE_STRING);
            }

            $postCategory = $_POST['category'][0];
            $postTags = $_POST['tags'];

            $dbConnection = DBConnection::getInstance();

            if (!Session::check($dbConnection)) {
                header("Location: ".BASE_HREF.'admin/');
            }
            
            $fileManager = new \Core\FileManager($dbConnection);
            $fileManagerMsg = $fileManager->checkFileToUpload($_FILES['post-file'], null);
            $imageFileName = $fileManagerMsg['filename'];

            
            /**
             * Update post url
             */
            $newUrl = $this->cleanUrl($postTitle);
            
            $dbConnection['error'] = true;
            try {
                // ADD POST
                $query = $dbConnection['db']->prepare("INSERT INTO `posts` 
                (`title`, `content`, `url`, `image`, `image_description`, `insert_date`, `update_date`) 
                VALUES (:title, :content, :newurl, :image, :postimagetitle, NOW(), NOW() )");
                $query->bindValue(':title', $postTitle, PDO::PARAM_STR);
                $query->bindValue(':content', $postContent, PDO::PARAM_STR);
                $query->bindValue(':newurl', $newUrl, PDO::PARAM_STR);
                $query->bindValue(':image', $imageFileName, PDO::PARAM_STR);
                $query->bindValue(':postimagetitle', $postImageTitle, PDO::PARAM_STR);
                $query->execute();

                $postId = $dbConnection['db']->lastInsertId();
                
                // ADD POST CATEGORY
                $queryTags = $dbConnection['db']->prepare('INSERT INTO `post_categories` (`categoryid`, `postid`) VALUES (:catid, :postid);');
                $queryTags->bindValue(':postid', $postId, PDO::PARAM_INT);
                $queryTags->bindValue(':catid', $postCategory, PDO::PARAM_INT);
                $queryTags->execute();

                // ADD NEW DATA ABOUT POST TAGS
                $insTagRelStmt = "INSERT INTO post_tags (tagid, postid) VALUES ";
                for ($i = 0; $i < count($postTags); $i++) {
                        $insTagRelStmt = $insTagRelStmt.'('.$postTags[$i].', '.$postId.')';
                        if ($i < (count($postTags))-1) {
                            $insTagRelStmt = $insTagRelStmt.', ';
                        }
                }
                $insTagRelStmt = $insTagRelStmt.';';
                $queryUpdateTags = $dbConnection['db']->prepare($insTagRelStmt);
                $queryUpdateTags->execute();

                $dbConnection['error'] = false;
                echo ' Post dodany.';
            }
            catch (FrameworkException $exc) {
                $dbConnection['error'] = true;
                $dbConnection['errorMsg'] = $exc->getMessage();
            }
        }
        \Core\SitemMapXML::create($dbConnection);
        exit;
    }
    
    public function delete($args) {
        
        $inputFields = [
            'postid' => FILTER_SANITIZE_NUMBER_INT
        ];
        if ($this->checkFilters($inputFields)) {
            
            $id = filter_input(INPUT_POST, 'postid', FILTER_SANITIZE_NUMBER_INT);

            $dbConnection = DBConnection::getInstance();
            
            if (!Session::check($dbConnection)) {
                header("Location: ".BASE_HREF.'admin/');
            }
            
            $dbConnection['error'] = true;

            try {
                $queryDelCat = $dbConnection['db']->prepare("DELETE FROM post_categories WHERE postid=:postid");
                $queryDelCat->bindParam(':postid', $id, PDO::PARAM_INT);
                $queryDelCat->execute();
                
                $queryDelTag = $dbConnection['db']->prepare("DELETE FROM post_tags WHERE postid=:postid");
                $queryDelTag->bindParam(':postid', $id, PDO::PARAM_INT);
                $queryDelTag->execute();
                
                $query = $dbConnection['db']->prepare("DELETE FROM posts WHERE id=:postid");
                $query->bindParam(':postid', $id, PDO::PARAM_INT);
                $query->execute();
                
                if ($query->rowCount() > 0) {
                    $dbConnection['error'];
                    echo 'Post został usunięty.';
                }
            } catch (FrameworkException $exc) {
                $dbConnection['error'] = true;
               $dbConnection['errorMsg'] = $exc->getMessage();
            }
            echo $dbConnection['errorMsg'];
        }
        \Core\SitemMapXML::create($dbConnection);
        exit;
    }

    public function backup($args) {
        $dbConnection = DBConnection::getInstance();
        if (!Session::check($dbConnection)) {
            header("Location: ".BASE_HREF.'admin/');
        }
        \Core\BackupManager::makeBackup();
    }

    public function register($args) {

        $dbConnection = DBConnection::getInstance();

        if (filter_input(INPUT_POST, 'loginname', FILTER_SANITIZE_STRING) != null && filter_input(INPUT_POST, 'loginpassword', FILTER_SANITIZE_STRING)) {
            $dbConnection['error'] = true;
            $loginname = filter_input(INPUT_POST, 'loginname', FILTER_SANITIZE_STRING);
            $loginpassword = Session::encryptIt(filter_input(INPUT_POST, 'loginpassword', FILTER_SANITIZE_STRING));
            $sessionId = md5($loginname);
            
            try {
                $queryRegister = $dbConnection['db']->prepare(
                    "INSERT INTO `users` 
                    (`email`, `password`, `date_registered`, `session_code`) 
                    VALUES (:email, :password, NOW(), :sessionid);"
                );
                $queryRegister->bindValue(':email', $loginname, PDO::PARAM_STR);
                $queryRegister->bindValue(':password', $loginpassword, PDO::PARAM_STR);
                $queryRegister->bindValue(':sessionid', $sessionId, PDO::PARAM_STR);
                $queryRegister->execute();
                $dbConnection['error'] = false;
            }
            catch (FrameworkException $exc) {
                $dbConnection['error'] = true;
                $dbConnection['errorMsg'] = $exc->getMessage();
            }
        }

        if (Session::isAnyUserRegistered($dbConnection)) {
            header("Location: ".BASE_HREF."admin");
        }
        
        $this->addCSSFile(['name' => 'Main CSS file', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'Main Script', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'js/jquery/jquery-1.12.4.min.js']);
        $this->addJSFile(['name' => 'Admin scripts', 'path' => 'js/admin.js']);
                
        $pageContent =
<<<HTML
    <main class="content-maindiv">
        <section class="admin-container">
            <h1>ADMIN REGISTER</h1>
            
            <form class="login-container" id="registerAdminForm" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <input type="email" placeholder="e-mail" name="loginname" required/>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="hasło" name="loginpassword" required/>
                </div>
                <div class="input-group">
                    <input type="submit" id="registerAdminButton" value="Zarejestruj" />
                </div>
            </form>

        </section>
    </main>
HTML;

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

    public function logout($args) {
        setcookie("session_id", "", time() - 3600, "/");
        header("Location: ".BASE_HREF."admin/");
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

        $dbConnection = DBConnection::getInstance();

        if (!Session::isAnyUserRegistered($dbConnection)) {
            header("Location: ".BASE_HREF."admin/register/");
        }

        $sessionContent = '';

        // ###################### LOGOWANIE ###################### //
        // SPRAWDZANIE HASŁA
        if (filter_input(INPUT_POST, 'loginname', FILTER_SANITIZE_EMAIL) !== null
            && filter_input(INPUT_POST, 'loginpassword', FILTER_SANITIZE_STRING) !== null) {

            if (filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING) !== null) {
                $captcha = $_POST['g-recaptcha-response'];
                $secretKey = \Core\Config::get('RECAPTCHA_SECRET_KEY');
                //$ip = $_SERVER['REMOTE_ADDR'];
                $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha);
                $responseKeys = json_decode($response, true);
                if (intval($responseKeys["success"]) !== 1) {
                    $this->addJS('showNotification("Błędny kod CAPTCHA");');
                } else {
                    $userlogin = filter_input(INPUT_POST, 'loginname', FILTER_SANITIZE_EMAIL);
                    $userpass = filter_input(INPUT_POST, 'loginpassword', FILTER_SANITIZE_STRING);
                    
                    // INICJOWANIE CIASTECZKA
                    if (Session::checkPassword($dbConnection, $userlogin, $userpass)) {
                        try {
                            $queryLogin = $dbConnection['db']->prepare("UPDATE `users` SET `date_login`=NOW() WHERE `email`=:email");
                            $queryLogin->bindValue(':email', $userlogin, PDO::PARAM_STR);
                            $queryLogin->execute();
                            $dbConnection['error'] = false;
                        }
                        catch (FrameworkException $exc) {
                            $dbConnection['error'] = true;
                            $dbConnection['errorMsg'] = $exc->getMessage();
                        }
                        if (!$dbConnection['error']) {
                            $cookieTime = 86400;
                            if ($_POST['rememberme'] !== null) {
                                // set cookie time to 30 days
                                $cookieTime = $cookieTime * 30;
                            }
                            setcookie('session_id', md5($userlogin), time() + $cookieTime, "/");
                        } else {
                            echo 'Błąd: '.$dbConnection['errorMsg'];
                            exit;
                        }
                        header("Location: ".BASE_HREF."admin/");
                    }
                }
            }
        }
        
        // SPRAWDZANIE CIASTECZKA
        if (Session::check($dbConnection)) {
            $sessionContent = '<div class="admin-panel">
                <div class="session">
                    <h3 class="session-login">'.\Core\Session::getUserEmail().'</h3>
                    <a href="admin/logout" class="button-logout">Wyloguj</a>
                </div>
                <div class="backup-container">
                    <button onclick="makeBackup(this)">Backup <i class="fas fa-spinner fa-spin" id="backupSpinner"></i></button>
                </div>
                <div style="padding: 15px 0;"></div>
                <div class="add-post-panel">
                    <a href="admin/newpost" class="button">Dodaj post</a>
                </div>
                <table class="posts-table">
                    <thead id="tablePostsHead"></thead>
                    </thead>
                    <tbody id="tablePostsBody"></tbody>
                </table>
            </div>';
        } else {
            $sessionContent = '<div class="admin-panel">
            <form class="login-container" id="loginAdminForm" method="POST" enctype="multipart/form-data">
                
                <fieldset>
                    <legend>Logowanie</legend>
                    
                    <div class="input-group">
                        <input type="text" placeholder="login" name="loginname" autocomplete="username" required/>
                    </div>
                    <div class="input-group">
                        <input type="password" placeholder="hasło" name="loginpassword" autocomplete="current-password" required/>
                    </div>
                    <div class="g-recaptcha" data-sitekey="'.\Core\Config::get('RECAPTCHA_KEY').'" data-theme="light"></div>
                    <div class="input-group">
                        <label class="rememberme-label">
                            <input type="checkbox" name="rememberme"/>
                            Zapamiętaj mnie
                        </label>
                    </div>
                    <div class="input-group">
                        <input type="submit" value="Zaloguj" />
                    </div>
                </fieldset>
            </form>
            </div>
            ';
        }
        
        $postListModel = new PostListModel(PostListModel::TYPE_ID_SORT, $dbConnection, $type, $pages, PostListModel::GET_ALL_POSTS);
        $content = $postListModel->getContent();
        
        $this->addCSSFile(['name' => 'Main CSS file', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'Main Script', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'js/jquery/jquery-1.12.4.min.js']);
        $this->addJSFile(['name' => 'Admin scripts', 'path' => 'js/admin.js']);
        $this->addJS('tableOfPosts.init('.json_encode($content).'); tableOfPosts.show();');

        $this->addJSFile(['name' => 'reCAPTCHA script', 'path' => 'https://www.google.com/recaptcha/api.js', 'async' => true, 'defer' => true]);
        
        $pageContent =
<<<HTML
    <main class="content-maindiv">
        <section class="admin-container">
            {$sessionContent}
        </section>
    </main>
HTML;

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

    private function cleanUrl($string) {
        $polskie_znaki = array("ą", "ć", "ę", "ł", "ń", "ó", "ś", "ż", "ź", "Ą", "Ć", "Ę", "Ł", "Ń", "Ó", "Ś", "Ż", "Ź");
        $bez_polskich_znakow = array("a", "c", "e", "l", "n", "o", "s", "z", "z", "A", "C", "E", "L", "N", "O", "S", "Z", "Z");
        $string = str_replace(' ', '-', $string);
        $string = str_replace($polskie_znaki, $bez_polskich_znakow, $string);
        $string = strtolower($string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }

}
