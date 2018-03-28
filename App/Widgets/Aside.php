<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Widgets;

use \Core\ModelClasses\Widget;

/**
 * This is class for aside-type widgets.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class Aside extends Widget {
    
    public function __construct() {
        $this->body = '<aside class="sidebar"><p>SIDE BAR...</p></aside>';
    }
}
