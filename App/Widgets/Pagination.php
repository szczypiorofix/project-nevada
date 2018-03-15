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
    
    public function __construct($data) {
        $curLeft = intval($data['current'])-1;
        $curRight = intval($data['current'])+1;
        
        $leftLink = '"'.$data['linkPrefix'].'/'.$curLeft.'"';
        $rightLink = '"'.$data['linkPrefix'].'/'.$curRight.'"';
        
        if ($curLeft < 0) {
            $leftLink .=' style="pointer-events:none;"';
        }
        
        $this->body = 
<<<HTML
    <div class="pagination-div">
         <a href={$leftLink}>NOWSZE</a>
         <a href={$rightLink}>STARSZE</a>
    </div>
HTML;
    }
}
