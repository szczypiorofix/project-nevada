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
 * This is class for article-type widgets.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class CTAButton extends Widget {
    
    public function __construct() {
        Registry::add($this);
        
        $this->body =
<<<HTML
    <div class="ctabutton-container">
        <a href="javascript:void(0)" onclick="goToTop()"><i class="fas fa-chevron-up"></i></a>
    </div>
HTML;
    }

}
