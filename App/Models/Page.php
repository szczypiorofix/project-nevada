<?php

namespace Models;

abstract class Page {

    protected $header = "";
    protected $cssFiles = [];
    protected $css = "";
    protected $body = "";
    protected $footer = "";
    protected $jsFiles = [];
    protected $js = "";
    protected $pageVersion = "1.00.000";

    /*  CSS FILES  */
    public function addCSSFile($cssFile) {
        if (($cssFile !== '' || !is_null($cssFile)) && is_array($cssFile) ) {
            array_push($this->cssFiles, $cssFile);
        }
    }

    public function getCSSFiles() {
        $cssF = "";
        foreach ($this->cssFiles as $key) {
            $cssF .= '<link rel="stylesheet" href="'.$key['path'].'?v='.$this->pageVersion.'">';
        }
        return $cssF;
    }


    /*  JS FILES  */
    public function addJSFile($jsFile) {
        if (($jsFile !== '' || !is_null($jsFile)) && is_array($jsFile) ) {
            array_push($this->jsFiles, $jsFile);
        }
    }

    public function getJSFiles() {
        $jsF = "";
        foreach ($this->jsFiles as $key) {
            $jsF .= '<script src="'.$key['path'].'?v='.$this->pageVersion.'"></script>';
        }
        return $jsF;
    }
    
    public function getHeader() {
        return $this->header;
    }

    public function getCss() {
        return $this->css;
    }

    public function getBody() {
        return $this->body;
    }

    public function getFooter() {
        return $this->footer;
    }

    public function getJs() {
        return $this->js;
    }

    public function getPageVersion() {
        return $this->pageVersion;
    }

    public function setHeader($header) {
        $this->header = $header;
    }

    public function setCss($css) {
        $this->css = $css;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function setFooter($footer) {
        $this->footer = $footer;
    }

    public function setJs($js) {
        $this->js = $js;
    }

    public function setPageVersion($pageVersion) {
        $this->pageVersion = $pageVersion;
    }

}