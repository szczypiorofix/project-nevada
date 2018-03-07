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
 * This is class for logo-type widgets.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class Logo extends Widget {

    public function __construct() {
        Registry::add($this);
        
        $baseHref = BASE_HREF;
        $this->body =
<<<HTML
    <div class="logo-container">
        <a href="{$baseHref}"><img src="images/logo-min.png" alt="Wróblewski Piotr logo"/></a>
    </div>
HTML;
    }


}
