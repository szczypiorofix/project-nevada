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
class TagsListModel extends DataModel {
    
    
        const GET_TAGS = "
SELECT
    `tags`.*,
COUNT(`post_tags`.`postid`) AS `post_count`
FROM
    `post_tags`
LEFT JOIN
    `tags` ON `post_tags`.`tagid` = `tags`.`id`
GROUP BY
    `tags`.`id`
ORDER BY
    `name`
";
    
    function __construct($dbConnection) {
        
        try {
           $query = $dbConnection['db']->prepare(self::GET_TAGS);
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
