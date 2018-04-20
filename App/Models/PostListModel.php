<?php
/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Models;

use Core\ModelClasses\DataModel;
use Core\FrameworkException;
use PDO;

/**
 * This is model class for list of posts.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class PostListModel extends DataModel {
    
    const GET_ALL_POSTS = -1;
    const TYPE_ID_SORT = 1;
    const TYPE_CATEGORY_SORT = 2;
    const TYPE_TAGS_SORT = 3;
    const TYPE_SEARCH_SORT = 4;
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
    
    const GET_CATEGORIES_PAGE = "
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
WHERE
	`categories`.name = :catname
GROUP BY
	`posts`.id
ORDER BY
   `posts`.id
DESC
LIMIT
   :postsonsite
OFFSET
   :offset";
    
    const GET_TAG_PAGE = "
SELECT
   `subquery`.*
FROM
   (
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
   ) AS subquery
WHERE
   `subquery`.tagi LIKE :tagname
GROUP BY
   `subquery`.id
ORDER BY
   `subquery`.id
DESC
LIMIT
   :postsonsite
OFFSET
   :offset";

   const GET_SEARCH_PAGE_COUNTER = '
SELECT
   COUNT(`posts`.id) AS "counter"
FROM
  `posts`
WHERE
  MATCH (`title`, `content`)
AGAINST
  (:searchname IN BOOLEAN MODE)
';

   const GET_SEARCH_PAGE = '
SELECT
   `posts`.*, `categories`.*, `post_categories`.*, GROUP_CONCAT(`categories`.`name`) AS `kategorie`
FROM
   `posts`
LEFT JOIN
   `post_categories`
ON
   `posts`.id = `post_categories`.postid	
LEFT JOIN
   `categories`
ON
   `post_categories`.categoryid = `categories`.id
WHERE
   MATCH (`title`, `content`)
AGAINST
   (:searchname IN BOOLEAN MODE)
GROUP BY
   `posts`.id
ORDER BY
   `posts`.id
DESC
LIMIT
    :postsonsite
OFFSET
    :offset
   ';
    
    function __construct($type, $dbConnection, $input, $inputPage, $postsToDisplay = 6) {
        $maxrecords = -1;
        $postsOnSite = $postsToDisplay;
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
        
        //echo $this->input.' '.$this->inputPage;
        
        $this->type = $type;
        $db = $dbConnection->getDB();
        $this->error = true;
        
        //if ($this->type !== self::TYPE_SEARCH_SORT) {
            $offset = ($this->inputPage) * $postsOnSite;
        //}
        
        try {
            $getNumberQuery = $db->prepare(self::GET_POSTS_PAGE_COUNTER);
            $getNumberQuery->execute();
            $results = $getNumberQuery->fetch();
            $maxrecords = $results['counter'];
            
            if ($postsOnSite === -1) {
                $postsOnSite = $maxrecords;
            }
        }
        catch (FrameworkException $exc) {
            $this->error = true;
            $this->errorMsg = $exc->getMessage();
        }
        
        // ############## POST ID SORT ####################### ///
        if ($this->type === self::TYPE_ID_SORT) {
             try {
                $query = $db->prepare(self::GET_POSTS_PAGE);
                $query->bindValue(':postsonsite', $postsOnSite, PDO::PARAM_INT);
                $query->bindValue(':offset', $offset, PDO::PARAM_INT);
                $query->execute();
             }
             catch (FrameworkException $exc) {
                $this->error = true;
                $this->errorMsg = $exc->getMessage();
             }
             if ($query->rowCount() > 0) {
                $this->error = false;
             }
        }
        
        // ############## POST CATEGORY SORT ####################### ///
        if ($this->type === self::TYPE_CATEGORY_SORT) {
             try {
                $query = $db->prepare(self::GET_CATEGORIES_PAGE);
                $query->bindValue(':catname', $input, PDO::PARAM_STR);
                $query->bindValue(':postsonsite', $postsOnSite, PDO::PARAM_INT);
                $query->bindValue(':offset', $offset, PDO::PARAM_INT);
                $query->execute();
             }
             catch (FrameworkException $exc) {
                $this->error = true;
                $this->errorMsg = $exc->getMessage();
             }
             if ($query->rowCount() > 0) {
                $this->error = false;
             }
        }
        
        // ############## POST TAGS SORT ####################### ///
        if ($this->type === self::TYPE_TAGS_SORT) {
            try {
                $query = $db->prepare(self::GET_TAG_PAGE);
                $query->bindValue(':tagname', '%'.$input.'%', PDO::PARAM_STR);
                $query->bindValue(':postsonsite', $postsOnSite, PDO::PARAM_INT);
                $query->bindValue(':offset', $offset, PDO::PARAM_INT);
                $query->execute();
            }
            catch (FrameworkException $exc) {
                $this->error = true;
                $this->errorMsg = $exc->getMessage();
            }
            if ($query->rowCount() > 0) {
                $this->error = false;
            }
        }

        // ############## POST SEARCH SORT ####################### ///
        if ($this->type === self::TYPE_SEARCH_SORT) {
            try {
                $query = $db->prepare(self::GET_SEARCH_PAGE);
                $query->bindValue(':searchname', '%'.$input.'%', PDO::PARAM_STR);
                $query->bindValue(':postsonsite', $postsOnSite, PDO::PARAM_INT);
                $query->bindValue(':offset', $offset, PDO::PARAM_INT);
                $query->execute();

                $querySearchAll = $db->prepare(self::GET_SEARCH_PAGE_COUNTER);
                $querySearchAll->bindValue(':searchname', '%'.$input.'%', PDO::PARAM_STR);
                $querySearchAll->execute();
                $maxrecords = $querySearchAll->fetch()['counter'];
            }
            catch (FrameworkException $exc) {
                $this->error = true;
                $this->errorMsg = $exc->getMessage();
            }
            if ($query->rowCount() > 0) {
                $this->error = false;
            }
        }
    
        // RETURN RESULTS
        if (!$this->error) {
            $this->content['posts'] = $query->fetchAll();
            $this->content['maxrecords'] = $maxrecords;
            $this->content['postsonsite'] = $postsOnSite;
        }
    }
    
}
