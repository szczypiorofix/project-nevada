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
        
        try {
            $dbConnection = \Core\DBConnection::getInstance();
        } catch (\Core\FrameworkException $fex) {
            $fex->showError();
        }
        
        $this->db = $dbConnection->getDB();
        $this->error = $dbConnection->isError();
        $this->errorMsg = $dbConnection->getErrorMsg();
        
        if (!\Core\Session::check($this->db)) {
            header("Location: ".BASE_HREF.'admin/');
        }

        $this->error = true;
        try {
            $queryCategories = $this->db->prepare("SELECT * FROM `categories`");
            $queryCategories->execute();
            $queryTags = $this->db->prepare("SELECT * FROM `tags`");
            $queryTags->execute();
            $this->error = false;
        }
        catch (FrameworkException $exc) {
           $this->error = true;
           $this->errorMsg = $exc->getMessage();
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
        
        $this->addCSSFile(['name' => 'NavbarCSSFile', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'Main Script', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'https://code.jquery.com/jquery-1.12.4.min.js']);
        //$this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js']);
        $this->addJSFile(['name' => 'Admin scripts', 'path' => 'js/admin.js']);
        
        //$this->addJSFile(['name' => 'External Script', 'path' => 'js/external.js']);
        
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
                    <label><strong>Treść:</strong></label>
                    <textarea class="tmce" name="post-content" rows="15" cols="50" required></textarea>
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
        <div class="nav-and-logo">
            {$header->getBody()}
        </div>
        <main class="post-card">
            {$pageContent}
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
        
        try {
            $dbConnection = \Core\DBConnection::getInstance();
        } catch (\Core\FrameworkException $fex) {
            $fex->showError();
        }
        
        $this->db = $dbConnection->getDB();
        $this->error = $dbConnection->isError();
        $this->errorMsg = $dbConnection->getErrorMsg();
        
        if (!\Core\Session::check($this->db)) {
            header("Location: ".BASE_HREF.'admin/');
        }

        $sessionContent = "";
        $isSession = \Core\Session::check($this->db);

        if ($isSession) {
            $sessionContent = "Użytkownik zalogowany";
        } else {
            $sessionContent = "Użytkownik niezalogowany!";    
        }

        $this->error = true;
        try {
            $query = $this->db->prepare("SELECT * FROM `posts` WHERE `id`=:postid");
            $query->bindValue(':postid', $id, PDO::PARAM_INT);
            $query->execute();

            $queryPostCategories = $this->db->prepare("SELECT `post_categories`.categoryid FROM `post_categories` WHERE `postid`=:postid");
            $queryPostCategories->bindValue(':postid', $id, PDO::PARAM_INT);
            $queryPostCategories->execute();

            $queryCategories = $this->db->prepare("SELECT * FROM `categories`");
            $queryCategories->execute();

            $queryPostTags = $this->db->prepare("SELECT `post_tags`.tagid FROM `post_tags` WHERE `postid`=:postid");
            $queryPostTags->bindValue(':postid', $id, PDO::PARAM_INT);
            $queryPostTags->execute();

            $queryTags = $this->db->prepare("SELECT * FROM `tags`");
            $queryTags->execute();

            $this->error = false;
        }
        catch (FrameworkException $exc) {
           $this->error = true;
           $this->errorMsg = $exc->getMessage();
        }
        if ($query->rowCount() > 0) {
           $this->error = false;
        }
             
        if (isset($_POST['loginname']) && isset($_POST['loginpassword'])) {
            $sessionContent = 'Login OK!';
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
        
        $this->addCSSFile(['name' => 'NavbarCSSFile', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'Main Script', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'https://code.jquery.com/jquery-1.12.4.min.js']);
        //$this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js']);
        $this->addJSFile(['name' => 'Admin scripts', 'path' => 'js/admin.js']);
        
        //$this->addJSFile(['name' => 'External Script', 'path' => 'js/external.js']);
        
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
                    <label><strong>Treść:</strong></label>
                    <textarea class="tmce" name="post-content" rows="15" cols="50">{$content['content']}</textarea>
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
        <div class="nav-and-logo">
            {$header->getBody()}
        </div>
        <main class="post-card">
            {$pageContent}
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
            'post-content' => FILTER_SANITIZE_STRING,
            'post-imagetitle' => FILTER_SANITIZE_STRING
        ];

        if ($this->checkFilters($inputFields)) {
            $postId = filter_input(INPUT_POST, 'postid', FILTER_SANITIZE_NUMBER_INT);
            $postTitle = filter_input(INPUT_POST, 'post-title', FILTER_SANITIZE_STRING);
            $postContent = filter_input(INPUT_POST, 'post-content', FILTER_SANITIZE_STRING);
            $postImageTitle = filter_input(INPUT_POST, 'post-imagetitle', FILTER_SANITIZE_STRING);

            $postCategory = $_POST['category'][0];
            $postTags = $_POST['tags'];

            try {
                $dbConnection = \Core\DBConnection::getInstance();
            } catch (\Core\FrameworkException $fex) {
                $fex->showError();
            }
            $this->db = $dbConnection->getDB();
            $this->error = $dbConnection->isError();
            $this->errorMsg = $dbConnection->getErrorMsg();
            
            if (!\core\Session::check($this->db)) {
                header("Location: ".BASE_HREF.'admin/');
            }

            $fileManager = new \Core\FileManager($this->db);
            $fileManager->checkFileToUpload($_FILES['post-file'], $postId);
            
            /**
             * Update post url
             */
            $newUrl = $this->cleanUrl($postTitle);

            $this->error = true;
            try {
                // UPDATE POST
                $query = $this->db->prepare("UPDATE `posts` SET `title`=:title, `content`=:content, `url`=:newurl, `image_description`=:postimagetitle, `update_date`=NOW() WHERE `id`=:postid");
                $query->bindValue(':title', $postTitle, PDO::PARAM_STR);
                $query->bindValue(':content', $postContent, PDO::PARAM_STR);
                $query->bindValue(':postimagetitle', $postImageTitle, PDO::PARAM_STR);
                $query->bindValue(':newurl', $newUrl, PDO::PARAM_STR);
                $query->bindValue(':postid', $postId, PDO::PARAM_INT);
                $query->execute();

                // UPDATE POST CATEGORY
                $queryTags = $this->db->prepare('UPDATE `post_categories` SET `categoryid`=:catid WHERE `id`=:id');
                $queryTags->bindValue(':id', $postId, PDO::PARAM_INT);
                $queryTags->bindValue(':catid', $postCategory, PDO::PARAM_INT);
                $queryTags->execute();

                // DELETE PREVIOUS DATA ABOUT POST TAGS
                $queryDelTag = $this->db->prepare("DELETE FROM `post_tags` WHERE `postid` =:postid");
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
                $queryUpdateTags = $this->db->prepare($insTagRelStmt);
                $queryUpdateTags->execute();

                $this->error = false;
                echo ' Post zapisany.';
            }
            catch (FrameworkException $exc) {
               $this->error = true;
               $this->errorMsg = $exc->getMessage();
            }
        }
        \Core\SitemMapXML::create($this->db);
        exit;
    }

    public function add($args) {
        
        $inputFields = [
            'post-title' => FILTER_SANITIZE_STRING,
            'post-content' => FILTER_SANITIZE_STRING,
            'post-imagetitle' => FILTER_SANITIZE_STRING
        ];

        if ($this->checkFilters($inputFields)) {
            $postTitle = filter_input(INPUT_POST, 'post-title', FILTER_SANITIZE_STRING);
            $postContent = filter_input(INPUT_POST, 'post-content', FILTER_SANITIZE_STRING);
            $postImageTitle = filter_input(INPUT_POST, 'post-imagetitle', FILTER_SANITIZE_STRING);

            $postCategory = $_POST['category'][0];
            $postTags = $_POST['tags'];

            try {
                $dbConnection = \Core\DBConnection::getInstance();
            } catch (\Core\FrameworkException $fex) {
                $fex->showError();
            }
            $this->db = $dbConnection->getDB();
            $this->error = $dbConnection->isError();
            $this->errorMsg = $dbConnection->getErrorMsg();

            if (!\core\Session::check($this->db)) {
                header("Location: ".BASE_HREF.'admin/');
            }
            
            $fileManager = new \Core\FileManager($this->db);
            $fileManagerMsg = $fileManager->checkFileToUpload($_FILES['post-file'], null);
            $imageFileName = $fileManagerMsg['filename'];

            
            /**
             * Update post url
             */
            $newUrl = $this->cleanUrl($postTitle);
            
            $this->error = true;
            try {
                // ADD POST
                $query = $this->db->prepare("INSERT INTO `posts` 
                (`title`, `content`, `url`, `image`, `image_description`, `insert_date`, `update_date`) 
                VALUES (:title, :content, :newurl, :image, :postimagetitle, NOW(), NOW() )");
                $query->bindValue(':title', $postTitle, PDO::PARAM_STR);
                $query->bindValue(':content', $postContent, PDO::PARAM_STR);
                $query->bindValue(':newurl', $newUrl, PDO::PARAM_STR);
                $query->bindValue(':image', $imageFileName, PDO::PARAM_STR);
                $query->bindValue(':postimagetitle', $postImageTitle, PDO::PARAM_STR);
                $query->execute();

                $postId = $this->db->lastInsertId();
                
                // ADD POST CATEGORY
                $queryTags = $this->db->prepare('INSERT INTO `post_categories` (`categoryid`, `postid`) VALUES (:catid, :postid);');
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
                $queryUpdateTags = $this->db->prepare($insTagRelStmt);
                $queryUpdateTags->execute();

                $this->error = false;
                echo ' Post dodany.';
            }
            catch (FrameworkException $exc) {
               $this->error = true;
               $this->errorMsg = $exc->getMessage();
            }
        }
        \Core\SitemMapXML::create($this->db);
        exit;
    }
    
    public function delete($args) {
        
        $inputFields = [
            'postid' => FILTER_SANITIZE_NUMBER_INT
        ];
        if ($this->checkFilters($inputFields)) {
            
            $id = filter_input(INPUT_POST, 'postid', FILTER_SANITIZE_NUMBER_INT);
            
            try {
                $dbConnection = \Core\DBConnection::getInstance();
            } catch (\Core\FrameworkException $fex) {
                $fex->showError();
            }
            $this->db = $dbConnection->getDB();
            $this->error = $dbConnection->isError();
            $this->errorMsg = $dbConnection->getErrorMsg();
            
            if (!\core\Session::check($this->db)) {
                header("Location: ".BASE_HREF.'admin/');
            }
            
            $db = $dbConnection->getDB();
            $this->error = true;

            try {
                $query = $db->prepare("DELETE FROM post_categories WHERE postid=:postid");
                $query->bindParam(':postid', $id, PDO::PARAM_INT);
                $query->execute();
                
                $query = $db->prepare("DELETE FROM post_tags WHERE postid=:postid");
                $query->bindParam(':postid', $id, PDO::PARAM_INT);
                $query->execute();
                
                $query = $db->prepare("DELETE FROM posts WHERE id=:postid");
                $query->bindParam(':postid', $id, PDO::PARAM_INT);
                $query->execute();
                
                if ($query->rowCount() > 0) {
                    $this->error = false;
                    echo 'Post został usunięty.';
                }
            } catch (FrameworkException $exc) {
               $this->error = true;
               $this->errorMsg = $exc->getMessage();
            }
            echo $this->errorMsg;
        }
        \Core\SitemMapXML::create($this->db);
        exit;
    }

    public function backup($args) {
        try {
            $dbConnection = \Core\DBConnection::getInstance();
        } catch (\Core\FrameworkException $fex) {
            $fex->showError();
        }
        $this->db = $dbConnection->getDB();
        $this->error = $dbConnection->isError();
        $this->errorMsg = $dbConnection->getErrorMsg();

        if (!\core\Session::check($this->db)) {
            header("Location: ".BASE_HREF.'admin/');
        }
        \Core\BackupManager::makeBackup();
    }

    public function register($args) {

        try {
            $dbConnection = \Core\DBConnection::getInstance();
        } catch (\Core\FrameworkException $fex) {
            $fex->showError();
        }
        
        $this->db = $dbConnection->getDB();
        $this->error = $dbConnection->isError();
        $this->errorMsg = $dbConnection->getErrorMsg();

        if (filter_input(INPUT_POST, 'loginname', FILTER_SANITIZE_STRING) != null && filter_input(INPUT_POST, 'loginpassword', FILTER_SANITIZE_STRING)) {
            $this->error = true;
            $loginname = filter_input(INPUT_POST, 'loginname', FILTER_SANITIZE_STRING);
            $loginpassword = \Core\Session::encryptIt(filter_input(INPUT_POST, 'loginpassword', FILTER_SANITIZE_STRING));
            $sessionId = md5($loginname);
            
            try {
                $queryRegister = $this->db->prepare(
                    "INSERT INTO `users` 
                    (`email`, `password`, `date_registered`, `session_code`) 
                    VALUES (:email, :password, NOW(), :sessionid);"
                );
                $queryRegister->bindValue(':email', $loginname, PDO::PARAM_STR);
                $queryRegister->bindValue(':password', $loginpassword, PDO::PARAM_STR);
                $queryRegister->bindValue(':sessionid', $sessionId, PDO::PARAM_STR);
                $queryRegister->execute();
                $this->error = false;
            }
            catch (FrameworkException $exc) {
               $this->error = true;
               $this->errorMsg = $exc->getMessage();
            }
        }

        if (\Core\Session::isAnyUserRegistered($this->db)) {
            header("Location: ".BASE_HREF."admin");
        }
        
        $this->addCSSFile(['name' => 'NavbarCSSFile', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'Main Script', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'https://code.jquery.com/jquery-1.12.4.min.js']);
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

        try {
            $dbConnection = \Core\DBConnection::getInstance();
        } catch (\Core\FrameworkException $fex) {
            $fex->showError();
        }
        
        $this->db = $dbConnection->getDB();
        $this->error = $dbConnection->isError();
        $this->errorMsg = $dbConnection->getErrorMsg();


        if (!\Core\Session::isAnyUserRegistered($this->db)) {
            header("Location: ".BASE_HREF."admin/register/");
        }

        $sessionContent = '';

        // SPRAWDZANIE HASŁA
        if (filter_input(INPUT_POST, 'loginname', FILTER_SANITIZE_EMAIL) !== null
            && filter_input(INPUT_POST, 'loginpassword', FILTER_SANITIZE_STRING) !== null) {

            $userlogin = filter_input(INPUT_POST, 'loginname', FILTER_SANITIZE_EMAIL);
            $userpass = filter_input(INPUT_POST, 'loginpassword', FILTER_SANITIZE_STRING);
            
            // INICJOWANIE CIASTECZKA
            if (\core\Session::checkPassword($this->db, $userlogin, $userpass)) {
                setcookie('session_id', md5($userlogin), time() + (86400), "/");
                header("Location: ".BASE_HREF."admin/");
            }
        }
        
        // SPRAWDZANIE CIASTECZKA
        if (\core\Session::check($this->db)) {
            $sessionContent = '<div class="admin-panel">
                <div class="session">
                    <h3 class="session-login">'.\Core\Session::getUserEmail().'</h3>
                    <a href="admin/logout" class="button-logout">Wyloguj</a>
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
                <div class="backup-container">
                    <button onclick="makeBackup(this)">Backup <i class="fas fa-spinner fa-spin" id="backupSpinner"></i></button>
                </div>
            </div>';
        } else {
            $sessionContent = '<div class="admin-panel">
            <h3>Logowanie:</h3>
            <form class="login-container" id="loginAdminForm" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <input type="text" placeholder="login" name="loginname" required/>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="hasło" name="loginpassword" required/>
                </div>
                <div class="input-group">
                    <input type="submit" value="Zaloguj" />
                </div>
            </form>
            </div>
            ';
        }
        
        $postListModel = new PostListModel(PostListModel::TYPE_ID_SORT, $dbConnection, $type, $pages, PostListModel::GET_ALL_POSTS);
        $content = $postListModel->getContent();
        
        $this->addCSSFile(['name' => 'NavbarCSSFile', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'Main Script', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'https://code.jquery.com/jquery-1.12.4.min.js']);
        $this->addJSFile(['name' => 'Admin scripts', 'path' => 'js/admin.js']);
        $this->addJS('tableOfPosts.init('.json_encode($content).'); tableOfPosts.show();');
        
        //$this->addJSFile(['name' => 'External Script', 'path' => 'js/external.js']);

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
