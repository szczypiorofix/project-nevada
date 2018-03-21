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
 * This is class for article-type widgets.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class CTAButton extends Widget {
    
    public function __construct() {
        Registry::add($this);
        
        $baseHref = BASE_HREF;
        $this->body =
<<<HTML
    <div class="ctabutton-container">
        <a href="#">UP!</a>
    </div>
HTML;
    }

}
