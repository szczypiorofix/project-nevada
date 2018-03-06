<?php

namespace Widgets;

use \Models\Widget;

class Footer extends Widget {
    
    public function __construct() {
        $this->body = '<p>Wróblewski Piotr, 2018</p>';
    }
    
}
