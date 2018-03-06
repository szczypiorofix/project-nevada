<?php

namespace Widgets;

use \Models\Widget;

class Logo extends Widget {

    public function __construct() {
        $this->body =
<<<HTML
    {$this->getCSS()}
    <div class="logo-container">
        <img src="images/logo-min.png" alt="Wróblewski Piotr logo"/>
    </div>
HTML;
    }


}
