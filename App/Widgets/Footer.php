<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Widgets;

use Core\ModelClasses\Widget;
use Core\Registry;

/**
 * This is class for footer-type widgets.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class Footer extends Widget {
    
    public function __construct() {
        Registry::add($this);
        $ver = PAGE_VERSION;
        $this->body =
<<<HTML
    <footer>
        <p>Wróblewski Piotr, 2018 <small>(ver. {$ver})</small></p>
    </footer>
HTML;
    }
    
}
