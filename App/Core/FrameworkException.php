<?php
/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Core;

/**
 * This is custom exception class.
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class FrameworkException extends \Exception {
    
    protected $title;
    protected $message;
    private $errorMessageDiv = '';
    
    public function __construct($title = "", $message = "", $code = 0, \Throwable $previous = NULL) {
        parent::__construct($message, $code, $previous);
        $this->title = $title;
        $this->message = $message;
        $this->errorMessageDiv = '<div style="border: 1px solid red; padding: 5px;">
        <h2 style="text-align: center;">Uuups, coś poszło nie tak jak powinno !!!</h2>
        <div>
            <h3>'.$this->title.'</h3>
            <p>Treść: '.$this->message.'</p>
            <p>Plik: '.parent::getFile().'</p>
            <p>Linia: '.parent::getLine().'</p>
            <p>Stack Trace: '.parent::getTraceAsString().'</p>
        </div>
    </div>';
    }
    
    public function showError() {
        echo $this->errorMessageDiv;
        exit();
    }

    public function getErrorMsg() {
        return $this->errorMessageDiv;
    }
}