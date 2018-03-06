<?php

namespace Widgets;

use \Models\Widget;

class Logo extends Widget {

    public function __construct() {
        $baseHref = BASE_HREF;
        $this->body =
<<<HTML
    {$this->getCSS()}
    <div class="logo-container">
        <a href="{$baseHref}"><img src="images/logo-min.png" alt="Wróblewski Piotr logo"/></a>
    </div>
HTML;
    }


}
