<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Pages;

use Models\PostAllModel;

/**
 * Page that returns JSON data
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class PageJson extends \Core\ModelClasses\Page {
    
    private $db = null;
    
    public function defaultmethod($args) {
        
        try {
            $dbConnection = \Core\DBConnection::getInstance();
        } catch (\Core\FrameworkException $fex) {
            $fex->showError();
        }
        
        $postList = new PostAllModel($dbConnection);
        
        header('Content-Type: application/json');
        echo json_encode($postList->getContent());
        exit;
    }

}
