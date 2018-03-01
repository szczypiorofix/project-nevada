<?php

namespace Pages;

use \Models\Page;

class HomePage extends Page {

    public function getHeader() {
        return
<<<HTML
        <title>My new website</title>
HTML;
    }
    
    public function getCSS() {
    }

    public function getCSSFiles() {
    }
    
    public function getBody() {
        return
<<<HTML
        <h2>BODY</h2>
HTML;
    }

    public function getFooter() {
        return
<<<HTML
        <h2>FOOTER</h2>
HTML;
    }

    public function getJS() {
    }

    public function getJSFiles() {
    }

}
