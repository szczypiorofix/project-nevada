<?php

/*
 * The MIT License
 *
 * Copyright 2018 Piotrek.
 *
 */

namespace Pages;

use Models\PostListModel, Core\Registry;

/**
 * Description of PageJson
 *
 * @author Piotr Wróblewski
 */
class PageJson extends \Core\ModelClasses\Page {
    
    private $db = null;
    
    public function defaultmethod($args) {
        
        try {
            $dbConnection = \Core\DBConnection::getInstance();
        } catch (\Core\FrameworkException $fex) {
            $fex->showError();
        }
        
        $this->db = $dbConnection->getDB();
        
        $postList = new PostListModel(PostListModel::TYPE_ID_SORT, $dbConnection, 0, 0);
        
        
        var_dump($postList->getContent());
        
        //header('Content-Type: application/json');
        //$je = json_encode($postList->getContent());
        
        //$jd = json_decode($je);
        //var_dump($jd);
        
        exit();
    }

}
