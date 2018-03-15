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
    
    const GET_POSTS_PAGE_COUNTER = "
SELECT
   COUNT(`posts`.id) AS 'counter'
FROM `posts`";
   
    const GET_POSTS_PAGE = "
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
        $postsOnSite = 6;
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
        
        echo $this->input.' '.$this->inputPage;

        $this->type = $type;
        $db = $dbConnection->getDB();
        $this->error = true;
        $offset = ($this->inputPage) * $postsOnSite;
      
        // ############## POST ID SORT ####################### ///
        if ($this->type == self::TYPE_ID_SORT) {
             try {
                $query = $db->prepare(self::GET_POSTS_PAGE);
                $query->bindValue(':postsonsite', $postsOnSite, PDO::PARAM_INT);
                $query->bindValue(':offset', $offset, PDO::PARAM_INT);
                $query->execute();

                $getNumberQuery = $db->prepare(self::GET_POSTS_PAGE_COUNTER);
                $getNumberQuery->execute();
                $results = $getNumberQuery->fetch();
                $maxrecords = $results['counter'];
             }
             catch (FrameworkException $exc) {
                $this->error = true;
                $this->errorMsg = $exc->getMessage();
             }
             if ($query->rowCount() > 0) {
                $this->error = false;
             }
        }
    
        if (!$this->error) {
            $this->content['posts'] = $query->fetchAll();
            $this->content['maxrecords'] = $maxrecords;
            $this->content['postsonsite'] = $postsOnSite;
        }
    }
    
}
