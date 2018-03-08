<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Pages;


use Core\ModelClasses\Page, Models\MaintenanceModel;

/**
 * This is a controller class for maintenance page.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class PageMaintenance extends Page {
    
    
    public function defaultmethod($args) {
        
        
        $maintenancePage = new MaintenanceModel();
        $pageContent = $maintenancePage->getContent();
        
        $this->addCSSFile(['name' => 'MaintenanceCSSFile', 'path' => 'css/maintenance.css']);
        $this->addJSFile(['name' => 'MainScript', 'path' => 'js/script.js']);
        $this->addJSFile(['name' => 'Vue.JS', 'path' => 'https://cdn.jsdelivr.net/npm/vue']);
        
        
        $metaData = new \Widgets\MetaData();

        $head = $metaData->getBody();

        $this->setHead($head);        
        $this->setBody($pageContent);
        
    }
    
}
