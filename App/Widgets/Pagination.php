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
        
        $leftLink = '"lista/'.$data['linkPrefix'].'/'.$data['type'].'/'.$curLeft.'"';
        $rightLink = '"lista/'.$data['linkPrefix'].'/'.$data['type'].'/'.$curRight.'"';
        
        if ($curLeft < 0) {
            $leftLink ='"javascript:void(0)" class="disabled"';
        }

        if ($curRight >= ceil($data['max'] / $data['postsonsite'])) {
            $rightLink ='"javascript:void(0)" class="disabled"';
        }
        $f = floor($data['max'] / $data['postsonsite']);
        $this->body = 
<<<HTML
    <div class="pagination-div">
         <a href={$leftLink}>NOWSZE</a>
         <a href={$rightLink}>STARSZE</a>
    </div>
HTML;
    }
}
