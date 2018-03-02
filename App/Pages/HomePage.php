<?php

namespace Pages;

use \Models\Page;

class HomePage extends Page {

    public function getHeader() {
        return $this->header;
    }
    

    public function getCSS() {
        return $this->css;
    }
    

    public function getBody() {
        return $this->body;
    }


    public function getFooter() {
        return $this->footer;
    }

    
    public function getJS() {
        return $this->js;
    }


}
