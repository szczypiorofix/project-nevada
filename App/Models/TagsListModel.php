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
        
        $db = $dbConnection->getDB();
        $this->error = true;
        
        try {
           $query = $db->prepare(self::GET_TAGS);
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
