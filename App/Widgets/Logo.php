<?php

namespace Widgets;

use \Models\Widget;

class Logo extends Widget {

    public function __construct() {}

    public function show() {
        return
<<<HTML
    {$this->getCSS()}
    <div class="logo-container">
        <img src="images/logo.png" alt="Wróblewski Piotr logo"/>
    </div>
HTML;
    }

}
