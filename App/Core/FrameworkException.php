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
    
    public function __construct(string $title = "", string $message = "", int $code = 0, \Throwable $previous = NULL) {
        parent::__construct($message, $code, $previous);
        $this->title = $title;
        $this->message = $message;
    }
    
    public function showError() {
        echo
        '<div>
            <h2 style="text-align: center;">Uuups, coś poszło nie tak jak powinno !!!</h2>
            <div>
                <h3>'.$this->title.'</h3>
                <p>Treść: '.$this->message.'</p>
                <p>Plik: '.parent::getFile().'</p>
                <p>Linia: '.parent::getLine().'</p>
                <p>Stack Trace: '.parent::getTraceAsString().'</p>
            </div>
        </div>';
        exit();
    }
}