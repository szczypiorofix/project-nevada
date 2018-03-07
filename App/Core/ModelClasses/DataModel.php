<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core\ModelClasses;

/**
 * Description of DataModel
 *
 * @author Szczypiorofix
 */
abstract class DataModel {
    
    protected $content;
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
