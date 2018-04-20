<?php
/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */


namespace Core\ModelClasses;

/**
 * This is an abstract class for obtaining data from MySQL Database.
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
abstract class DataModel {
    
    protected $content = null;
    
    public function getContent() {
        return $this->content;
    }
    
}
