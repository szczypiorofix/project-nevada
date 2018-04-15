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
class CategoriesListModel extends DataModel {
    
        const GET_CATEGORIES = "
SELECT
    `categories`.*,
COUNT(`post_categories`.`postid`) AS `post_count`
FROM
    `post_categories`
LEFT JOIN
    `categories` ON `post_categories`.`categoryid` = `categories`.`id`
GROUP BY
    `categories`.`id`
ORDER BY
    `name`
";
    
    function __construct($dbConnection) {
        
        $db = $dbConnection->getDB();
        $this->error = true;
        
        try {
           $query = $db->prepare(self::GET_CATEGORIES);
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
            $this->content = $query->fetchAll();
        }
    }
}
