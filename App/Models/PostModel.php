<?php
/*
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */

namespace Models;

use Core\ModelClasses\DataModel, Core\FrameworkException, PDO, PDOException;

/**
 * Description of PostModel
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class PostModel extends DataModel {
    
        const GET_POSTS = "
SELECT
    `posts`.*, GROUP_CONCAT(`tags`.`name`) AS `tagi`, `categories`.`name` AS 'kategorie'
FROM
    `posts`, `categories`, `post_categories`, `tags`, `post_tags`
WHERE
    `url`=:url
	 AND `post_categories`.postid = `posts`.id 
	 AND `post_categories`.categoryid = `categories`.id
	 AND `post_tags`.postid = `posts`.id
	 AND `post_tags`.tagid = `tags`.id
GROUP BY
    `posts`.`id`";
    
    function __construct($dbConnection, $input) {
        
        $db = $dbConnection->getDB();
        $this->error = true;
        
        try {
           $query = $db->prepare(self::GET_POSTS);
           $query->bindValue(':url', $input, PDO::PARAM_STR);
           $query->execute();
        }
        catch (FrameworkException $exc) {
           $this->error = true;
           $this->errorMsg = $exc->getMessage();
        }
        if ($query->rowCount() > 0) {
           $this->error = false;
        }

        if (!$this->error) {
            $this->content = $query->fetch();
        }
    }
    
}
