<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Widgets;

use Core\ModelClasses\Widget, Core\Registry;

/**
 * This is class for footer-type widgets.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class Footer extends Widget {
    
    public function __construct() {
        Registry::add($this);
        $this->body =
<<<HTML
    <footer><p>Wróblewski Piotr, 2018</p></footer>
HTML;
    }
    
}
