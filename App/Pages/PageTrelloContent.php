<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Pages;

use Core\ModelClasses\Page, Models\TrelloDataModel;

/**
 * PageTrelloContent - returns data for AJAX requests (Show data from Trello board)
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class PageTrelloContent extends Page {

    public function defaultmethod($args) {
        $trelloDataModel = new TrelloDataModel();
        echo $trelloDataModel->getContent();        
        exit();
    }

}
