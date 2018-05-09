<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Pages;


use Core\ModelClasses\Page;
use Models\MaintenanceModel;

/**
 * This is a controller class for maintenance page.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class PageMaintenance extends Page {
    
    
    public function defaultmethod($args) {
        
        
        $maintenancePage = new MaintenanceModel();
        $pageContent = $maintenancePage->getContent();
        
        $this->addCSSFile(['name' => 'Maintenance CSS File', 'path' => 'css/maintenance.css']);
        $this->addJSFile(['name' => 'Countdown script', 'path' => 'js/maintenance.js', 'versioning' => true]);
        $this->addJSFile(['name' => 'Google Translate Script', 'path' => 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit', 'versioning' => false, 'async' => false]);
        $this->addJSFile(['name' => 'Google Translate Script Starter', 'path' => 'js/translate.js']);

        $metaData = new \Widgets\MetaData();

        $head = $metaData->getBody();

        $this->setHead($head);        
        $this->setBody($pageContent);
        
    }
    
}
