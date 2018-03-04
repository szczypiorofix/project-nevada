<?php

namespace Pages;

use \Models\Page;

class HomePage extends Page {

    private $viewFile = "index.html";

    public function show() {
        include_once DIR_VIEWS.$this->viewFile;
    }
}
