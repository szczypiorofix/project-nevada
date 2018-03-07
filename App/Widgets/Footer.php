<?php

namespace Widgets;

use \Core\ModelClasses\Widget;

class Footer extends Widget {
    
    public function __construct() {
        $this->body =
<<<HTML
    <footer><p>Wróblewski Piotr, 2018</p><footer>
HTML;
    }
    
}
