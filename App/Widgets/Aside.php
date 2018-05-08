<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Widgets;

use Core\ModelClasses\Widget;
use Core\Registry;
use Models\CategoriesListModel;
use Models\TagsListModel;

/**
 * This is class for aside-type widgets.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class Aside extends Widget {
    
    private $categoriesResults = null;
    private $tagsResults = null;

    public function __construct($dbConnection) {
        
        Registry::add($this);
        
        $categoriesListModel = new CategoriesListModel($dbConnection);
        $categoriesListContent = "";
        $this->categoriesResults = $categoriesListModel->getContent();
        
        if (!is_null($this->categoriesResults)) {
            foreach($this->categoriesResults as $row) {
                $categoriesListContent .= '<li><a href="lista/kategoria/'.strtolower($row['name']).'"><span class="title">'.$row['name'].'</span><span class="post-count">'.$row['post_count'].'</span></a></li>';
            }
        }

        $tagsListModel = new TagsListModel($dbConnection);
        $tagsListContent = "";
        $this->tagsResults = $tagsListModel->getContent();
        if (!is_null($this->tagsResults)) {
            $maxTags = 0;
            for ($i = 0; $i < count($this->tagsResults); $i++) {
                $maxTags = max($maxTags, $this->tagsResults[$i]['post_count']);
            }
            
            foreach($this->tagsResults as $row) {
                $c = '';
                if ($row['post_count'] <= $maxTags) {
                    $c = 'biggest';
                }
                if ($row['post_count'] <= ($maxTags * 0.75)) {
                    $c = 'big';
                }
                if ($row['post_count'] <= ($maxTags * 0.5)) {
                    $c = 'medium';
                }
                if ($row['post_count'] <= ($maxTags * 0.25)) {
                    $c = 'small';
                }
                $tagsListContent .= '<a class="cloudtag '. $c .'" href="lista/tag/'.strtolower($row['name']).'"><span class="title">'.$row['name'].'</span><span class="post-count">'.$row['post_count'].'</span></a>';
            }
        }
        
        
        $this->body = 
<<<HTML
        <aside class="sidebar">
            <div class="categories-list-container">
                <h3>Kategorie:</h3>
                <ul>{$categoriesListContent}</ul>
            </div>
            <div class="tags-list-container">
                <h3>Tagi:</h3>
                <div class="tags">{$tagsListContent}</div>
            </div>
            <a class="twitter-timeline" data-lang="pl" data-height="800" href="https://twitter.com/szczypiorofix?ref_src=twsrc%5Etfw"></a>
        </aside>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
HTML;
    }

    public function getCategoriesResults() {
        return $this->categoriesResults;
    }

    public function getTagsResults() {
        return $this->tagsResults;
    }
}
