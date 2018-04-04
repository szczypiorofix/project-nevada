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
 * This is class for aside-type widgets.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class Aside extends Widget {
    
    public function __construct() {
        
        Registry::add($this);
        
        $this->body = '<aside class="sidebar">
                <a class="twitter-timeline" data-lang="pl" data-height="800" href="https://twitter.com/szczypiorofix?ref_src=twsrc%5Etfw"></a>
            </aside>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            ';
    }
    
    
}
