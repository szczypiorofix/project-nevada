<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Widgets;

use \Core\ModelClasses\Widget, Core\Registry, Models\CategoriesListModel, Models\TagsListModel;

/**
 * This is class for aside-type widgets.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class Aside extends Widget {
    
    public function __construct($dbConnection) {
        
        Registry::add($this);
        
        $categoriesListModel = new CategoriesListModel($dbConnection);
        $categoriesListContent = "";
        foreach($categoriesListModel->getContent() as $row) {
            $categoriesListContent .= '<li><a href="#">'.$row['name'].' ( '.$row['post_count'].' )</a></li>';
        }

        $tagsListModel = new TagsListModel($dbConnection);
        $tagsListContent = "";
        foreach($tagsListModel->getContent() as $row) {
            $tagsListContent .= '<li><a href="#">'.$row['name'].' ( '.$row['post_count'].' )</a></li>';
        }
        
        $this->body = 
<<<HTML
        <aside class="sidebar">
            <div class="search-form-container">
                <form method="GET" class="search-form">
                    <input class="search-input" type="text" name="search-input" id="search-input">
                    <button class="search-submit-button"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="categories-list-container">
                <h3>Kategorie:</h3>
                <ul>{$categoriesListContent}</ul>
            </div>
            <div class="tags-list-container">
                <h3>Tagi:</h3>
                <ul>{$tagsListContent}</ul>
            </div>
            <a class="twitter-timeline" data-lang="pl" data-height="800" href="https://twitter.com/szczypiorofix?ref_src=twsrc%5Etfw"></a>
        </aside>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
HTML;
            ;
    }
    
    
}
