<?php
/*
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */

namespace Models;

use Core\ModelClasses\DataModel;
use Core\FrameworkException;


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
        
        
        try {
           $query = $dbConnection['db']->prepare(self::GET_CATEGORIES);
           $query->execute();
        }
        catch (FrameworkException $exc) {
           $dbConnection['error'] = true;
           $dbConnection['errorMsg'] = $exc->getMessage();
        }
        if ($query->rowCount() > 0) {
           $dbConnection['error'] = false;
        }

        if (!$dbConnection['error']) {
            $this->content = $query->fetchAll();
        }
    }
}
