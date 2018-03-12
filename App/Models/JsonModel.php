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
 * Return JSON data from database.
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class JsonModel extends DataModel {
    
    public function __construct() {
        
        $this->content = \Core\Registry::returnList();
    }
    
}
