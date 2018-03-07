<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Models;

use Core\ModelClasses\DataModel, Core\FrameworkException, PDO, PDOException;

/**
 * This is model class for list of posts.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class PostListModel extends DataModel {
    
    const TYPE_ID_SORT = 1;
    private $input = null;
    private $inputPage = null;
    
       private $GET_POSTS_PAGE_COUNTER = "
SELECT
   COUNT(`posts`.id) AS 'counter'
FROM `posts`";
   
   private $GET_POSTS_PAGE = "
SELECT
   `posts`.*, `categories`.name AS 'kategorie', GROUP_CONCAT(`tags`.name) AS 'tagi'
FROM
   `posts`
LEFT JOIN
	`post_categories`
ON
	`post_categories`.postid = `posts`.id
LEFT JOIN
	`categories`
ON
	`categories`.id = `post_categories`.categoryid
LEFT JOIN
	`post_tags`
ON
	`post_tags`.postid = `posts`.id
LEFT JOIN
	`tags`
ON
	`tags`.id = `post_tags`.tagid
GROUP BY
	`posts`.id
ORDER BY
   `posts`.id
DESC
LIMIT
   :postsonsite
OFFSET
   :offset";
    
    function __construct($type, $dbConnection, $input, $inputPage) {
      $maxrecords = -1;
      $postsOnSite = 5;
      $this->input = $input;
      $this->inputPage = $inputPage;
      if (empty($inputPage)) {
            if (empty($input)) {
                $this->input = 0;
            }
            //$this->inputPage = $this->input;
      }
      else {
          $this->inputPage = $inputPage;
      }
      
      $this->type = $type;
      $db = $dbConnection->getDB();
      $this->error = true;
      $offset = ($this->inputPage) * $postsOnSite;
      
    // ############## POST ID SORT ####################### ///
    if ($this->type == self::TYPE_ID_SORT) {
         try {
            $query = $db->prepare($this->GET_POSTS_PAGE);
            $query->bindValue(':postsonsite', $postsOnSite, PDO::PARAM_INT);
            $query->bindValue(':offset', $offset, PDO::PARAM_INT);
            $query->execute();
            
            $getNumberQuery = $db->prepare($this->GET_POSTS_PAGE_COUNTER);
            $getNumberQuery->execute();
            $results = $getNumberQuery->fetch();
            $maxrecords = $results['counter'];
         }
         catch (PDOException $exc) {
            $this->error = true;
            //$this->errorMsg = \core\database\DBError::getMessage($exc->getMessage(), $exc->getFile(), $exc->getLine());
            $this->errorMsg = $exc->getMessage();
         }
         if ($query->rowCount() > 0) {
            $this->error = false;
         }
    }
    
    if (!$this->error) {
        while($row = $query->fetch()) {
            
            // DEFAULT IMAGE FILE
            $imageFile = DIR_UPLOADS_IMAGES."default.jpg";            
            if (file_exists(DIR_UPLOADS_IMAGES.$row['image']) && !is_dir(DIR_UPLOADS_IMAGES.$row['image'])) {
                $imageFile = DIR_UPLOADS_IMAGES.$row['image'];
            }
            
//            $this->content .=
//                  '<section class="well">
//                     <h1><a href="post/'.$row['url'].'">'.$row['title'].'</a><small> '.$row['short_title'].'</small></h1>
//                  <div>
//                     <i class="far fa-folder-open"></i>
//                     
//                     <i class="far fa-bookmark"></i>
//
//                  </div>
//                  <hr>
//                  <img class="img-responsive wrapper" src="'.$imageFile.'" alt="'.$row['image_description'].'">
//                  <br />
//                  <div>
//                     <h4>'.$row['abstract'].'</h4>
//                  </div>
//                  <a class="btn btn-primary" href="post/'.$row['url'].'">Read more
//                     <i class="fas fa-chevron-right"></i>
//                  </a>
//               </section>';
            
            $this->content .=
<<<HTML
                    <section class="post-card">
                        <h1><a href="post/{$row['url']}">{$row['title']}</a><small> {$row['short_title']}</small></h1>
                        <img class="img-responsive" src="{$imageFile}" alt="{$row['image_description']}">
                        <div>
                            <p>{$row['abstract']}</p>
                        </div>
                        <a class="btn btn-primary" href="post/{$row['url']}"><i class="fas fa-chevron-right"></i> Read more</a>
                    </section>
HTML;
        }
    }
 }
    
}
