<?php

/*
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */

namespace Pages;

use Core\ModelClasses\Page, Core\Config, Models\PostListModel, PDO;

/**
 * This is error 404 Page
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class PageAdmin extends Page {

   const TextColorMap = '
        textcolor_map: [
            "000000", "Black",
            "993300", "Burnt orange",
            "333300", "Dark olive",
            "003300", "Dark green",
            "003366", "Dark azure",
            "000080", "Navy Blue",
            "333399", "Indigo",
            "333333", "Very dark gray",
            "800000", "Maroon",
            "FF6600", "Orange",
            "808000", "Olive",
            "008000", "Green",
            "008080", "Teal",
            "0000FF", "Blue",
            "666699", "Grayish blue",
            "808080", "Gray",
            "FF0000", "Red",
            "FF9900", "Amber",
            "99CC00", "Yellow green",
            "339966", "Sea green",
            "33CCCC", "Turquoise",
            "3366FF", "Royal blue",
            "800080", "Purple",
            "999999", "Medium gray",
            "FF00FF", "Magenta",
            "FFCC00", "Gold",
            "FFFF00", "Yellow",
            "00FF00", "Lime",
            "00FFFF", "Aqua",
            "00CCFF", "Sky blue",
            "993366", "Red violet",
            "FFFFFF", "White",
            "FF99CC", "Pink",
            "FFCC99", "Peach",
            "FFFF99", "Light yellow",
            "CCFFCC", "Pale green",
            "CCFFFF", "Pale cyan",
            "99CCFF", "Light sky blue",
            "CC99FF", "Plum"
          ]';
    private $db = null;
    private $error = false;
    private $errorMsg = null;

    public function __toString() {
        return get_class($this);
    }
    
    public function edit($args) {
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
        
        
        if (filter_input(INPUT_GET, 'postid', FILTER_SANITIZE_NUMBER_INT) !== null) {
            $id = filter_input(INPUT_GET, 'postid', FILTER_SANITIZE_NUMBER_INT);
        } else {
            header("Location: ".BASE_HREF.'/admin/');
        }
        
        try {
            $dbConnection = \Core\DBConnection::getInstance();
        } catch (\Core\FrameworkException $fex) {
            $fex->showError();
        }
        
        $this->db = $dbConnection->getDB();
        $this->error = $dbConnection->isError();
        $this->errorMsg = $dbConnection->getErrorMsg();

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
            $categoriesContent .= '<div class="radio-item"><input type="radio" name="category[]" value="'.$categoriesList[$i]['name'].'" '.$checked.'/><label>'.$categoriesList[$i]['name'].'</label></div>';
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
            $tagsContent .= '<div class="checkbox-item"><input type="checkbox" name="tags[]" value="'.$tagsList[$i]['name'].'" '.$checked.'/><label>'.$tagsList[$i]['name'].'</label></div>';
        }
        $tagsContent .= '</div>';
        
        $this->addCSSFile(['name' => 'NavbarCSSFile', 'path' => 'css/style.css']);
        $this->addJSFile(['name' => 'Main Script', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'https://code.jquery.com/jquery-1.12.4.min.js']);
        //$this->addJSFile(['name' => 'jQuery 1.12.4', 'path' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js']);
        $this->addJSFile(['name' => 'Admin scripts', 'path' => 'js/admin.js']);
        
        
        // TinyMCE scripts ...
        $tinyMceLoadingScritps = '
        tinymce.init({
            selector: "textarea.tmce",
            height : 350,
            plugins: [
            "advlist autolink lists link image charmap print preview anchor image imagetools",
            "searchreplace visualblocks code codesample fullscreen",
            "insertdatetime media table contextmenu paste imagetools", 
               "advlist autolink link lists image lists charmap print preview table media code textcolor colorpicker wordcount emoticons"],
            toolbar: ["insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
               "emoticons forecolor backcolor codesample"],
            language: "pl"
            ';
        $tinyMceLoadingScritps .= '});';
        
        $this->addJSHeadFile(['name' => 'TinyMCE scripts', 'path' => 'js/tinymce/tinymce.min.js']);
        $this->addJSHead($tinyMceLoadingScritps);
        
        
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
                    <textarea class="tmce" name="post-content">{$content['content']}</textarea>
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
                    <label for="post-file"><i class="fas fa-upload"></i> Wybierz plik</label>
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

        //$sideBar = new \Widgets\Aside($dbConnection);

        $ctaButton = new \Widgets\CTAButton();
        
        $body =
<<<HTML
    <div class="full-page-container" id="mainDiv">
        <div class="nav-and-logo">
            {$header->getBody()}
        </div>
        <main class="post-card">
            {$pageContent}
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
            //$postId = filter_input(INPUT_POST, 'postid', FILTER_SANITIZE_NUMBER_INT);
            //$postTitle = filter_input(INPUT_POST, 'post-title', FILTER_SANITIZE_NUMBER_INT);
            //$postContent = filter_input(INPUT_POST, 'post-content', FILTER_SANITIZE_NUMBER_INT);
            //$postImageTitle = filter_input(INPUT_POST, 'post-imagetitle', FILTER_SANITIZE_NUMBER_INT);
            
            $postId = filter_input(INPUT_POST, 'postid', FILTER_SANITIZE_NUMBER_INT);
            $postTitle = $_POST['post-title'];
            $postContent = $_POST['post-content'];
            $postImageTitle = $_POST['post-imagetitle'];
            
            //var_dump($_POST);
            //var_dump($_FILES);
            echo $postContent;
            //exit;
            
            try {
                $dbConnection = \Core\DBConnection::getInstance();
            } catch (\Core\FrameworkException $fex) {
                $fex->showError();
            }
            
            $this->db = $dbConnection->getDB();
            $this->error = $dbConnection->isError();
            $this->errorMsg = $dbConnection->getErrorMsg();

            $sessionContent = "";
            $isSession = \Core\Session::check($this->db);  
            if ($isSession) {
                $sessionContent = "Użytkownik zalogowany";
            } else {
                $sessionContent = "Użytkownik niezalogowany!";    
            }

            $this->error = true;
            try {
                $query = $this->db->prepare("UPDATE `posts` SET `title`=:title, `content`=:content, `image_description`=:postimagetitle, `update_date`=NOW()  WHERE `id`=:postid");
                $query->bindValue(':title', $postTitle, PDO::PARAM_STR);
                $query->bindValue(':content', $postContent, PDO::PARAM_STR);
                $query->bindValue(':postimagetitle', $postImageTitle, PDO::PARAM_STR);
                $query->bindValue(':postid', $postId, PDO::PARAM_INT);
                $query->execute();

                $this->error = false;
                echo 'Zapisano!';
            }
            catch (FrameworkException $exc) {
               $this->error = true;
               $this->errorMsg = $exc->getMessage();
            }
        }
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
            
            //var_dump($_POST);
        }
        exit;
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

        $sessionContent = "";
        $isSession = \Core\Session::check($this->db);  
        if ($isSession) {
            $sessionContent = "Użytkownik zalogowany";
        } else {
            $sessionContent = "Użytkownik niezalogowany!";    
        }

        
        if (isset($_POST['loginname']) && isset($_POST['loginpassword'])) {
            $sessionContent = 'Login OK!';
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
            <h1>ADMIN PAGES</h1>
            <p>TODOs:</p>
            <ul>
                <li>tutaj będzie zarządzanie całym contentem strony</li>
                <li>Sprawdzanie zalogowania przez sesje (ciasteczka?). Jesli nie zalogowany to przerzuca na stronę logowania</li>
                <li>Strony: logowanie, strona panelu admina (odnośniki do: dodaj, edytuj, usuń posty)</li>            
            </ul>
            <h3>Stan sesji: {$sessionContent}</h3>
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

            <div class="admin-panel">
                <div class="add-post-panel">
                    <button class="button">Dodaj post</button>
                </div>
                <table class="posts-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tytuł</th> 
                            <th>Data publikacji</th>
                            <th>Data aktualizacji</th>
                            <th>Opcje</th>
                        </tr>
                    </thead>
                    <tbody id="tablePostsBody"></tbody>
                </table>
            </div>
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

    private function cleanUrl($string) {
        $polskie_znaki = array("ą", "ć", "ę", "ł", "ń", "ó", "ś", "ż", "ź", "Ą", "Ć", "Ę", "Ł", "Ń", "Ó", "Ś", "Ż", "Ź");
        $bez_polskich_znakow = array("a", "c", "e", "l", "n", "o", "s", "z", "z", "A", "C", "E", "L", "N", "O", "S", "Z", "Z");
        $string = str_replace(' ', '-', $string);
        $string = str_replace($polskie_znaki, $bez_polskich_znakow, $string);
        $string = strtolower($string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }

}
