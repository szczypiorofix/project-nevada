<?php

/*
 * The MIT License
 *
 * Copyright 2018 Piort Wróblewski.
 *
 */

namespace Models;

use Core\ModelClasses\DataModel;

/**
 * Description of JsonModel
 *
 * @author Piort Wróblewski
 */
class JsonModel extends DataModel {
    
    public function __construct() {
        
        $this->content = \Core\Registry::returnList();
    }
    
}
