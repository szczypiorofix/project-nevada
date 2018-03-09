<?php

/*
 * The MIT License
 *
 * Copyright 2018 Piotrek.
 *
 */

namespace Pages;

/**
 * Description of PageJson
 *
 * @author Piotr Wróblewski
 */
class PageJson extends \Core\ModelClasses\Page {
    
    
    public function defaultmethod($args) {
        $data = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

}
