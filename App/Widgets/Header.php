<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Widgets;

use \Core\ModelClasses\Widget, Core\Registry;

/**
 * This is class for header-type widgets.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class Header extends Widget {
    
    public function __construct() {
        Registry::add($this);
    }
    
}
