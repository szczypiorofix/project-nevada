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
class PostAllModel extends DataModel {
    
    private $input = null;
    private $inputPage = null;

    const GET_ALL_POSTS = 'SELECT * FROM `posts`';
    const GET_ALL_TAGS = 'SELECT * FROM `tags`';
    const GET_ALL_CATEGORIES = 'SELECT * FROM `categories`';
    const GET_ALL_POST_CATEGORIES = 'SELECT * FROM `post_categories`';
    const GET_ALL_POST_TAGS = 'SELECT * FROM `post_tags`';
    
    
    function __construct($dbConnection) {
        
        $dbConnection['error'] = true;
        
        // ############## POST ID SORT ####################### ///
        try {
            $queryPosts = $dbConnection['db']->prepare(self::GET_ALL_POSTS);
            $queryPosts->execute();

            $queryTags = $dbConnection['db']->prepare(self::GET_ALL_TAGS);
            $queryTags->execute();

            $queryCategories = $dbConnection['db']->prepare(self::GET_ALL_CATEGORIES);
            $queryCategories->execute();

            $queryPostCategories = $dbConnection['db']->prepare(self::GET_ALL_POST_CATEGORIES);
            $queryPostCategories->execute();

            $queryPostTags = $dbConnection['db']->prepare(self::GET_ALL_POST_TAGS);
            $queryPostTags->execute();
        }
        catch (FrameworkException $exc) {
            $dbConnection['error'] = true;
            $dbConnection['errorMsg'] = $exc->getMessage();
        }
        if ($queryPosts->rowCount() > 0) {
            $dbConnection['error'] = false;
        }
        
        // RETURN RESULTS
        if (!$dbConnection['error']) {
            $this->content['posts'] = $queryPosts->fetchAll();
            $this->content['tags'] = $queryTags->fetchAll();
            $this->content['categories'] = $queryCategories->fetchAll();
            $this->content['post_categories'] = $queryPostCategories->fetchAll();
            $this->content['post_tags'] = $queryPostTags->fetchAll();
        }
    }
    
}
