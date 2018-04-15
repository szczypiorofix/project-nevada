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
    protected $type;
    protected $error;
    protected $errorMsg;
    
    public function getContent() {
        return $this->content;
    }
    
    public function isError() {
        return $this->error;
    }
    
    public function getErrorMsg() {
        return $this->errorMsg;
    }
}
