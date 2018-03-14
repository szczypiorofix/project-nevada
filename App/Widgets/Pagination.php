<?php

/*
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */

namespace Widgets;

use Core\ModelClasses\Widget;

/**
 * Description of Pagination
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class Pagination extends Widget {
    
    public function __construct($leftLink, $rightLink) {
        $this->body = 
<<<HTML
    <div class="pagination-div">
         <a href="{$leftLink}">STARSZE</a>
         <a href="{$rightLink}">NOWSZE</a>
    </div>
HTML;
    }
}
