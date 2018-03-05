<?php

namespace Models;

abstract class Widget {

    protected $cssFiles = [];
    protected $css = "";
    protected $body = "";
    protected $jsFiles = [];
    protected $js = "";
    protected $jsHeaderFiles = [];
    protected $jsHeader = "";


    /* ABSTRACT FUNCTION "SHOW" */
    abstract public function show();


    

    /*  CSS FILES  */
    public function addCSSFile($cssFile) {
        if (($cssFile !== '' || !is_null($cssFile)) && is_array($cssFile) ) {
            array_push($this->cssFiles, $cssFile);
        }
    }

    public function setCSSFile($cssFile) {
        if (is_array($cssFile)) {
            $this->cssFiles = $cssFile;
        }
    }

    public function getCSSFiles() {
        $cssF = "";
        foreach ($this->cssFiles as $key) {
            $cssF .= '<link rel="stylesheet" href="'.$key['path'].'?v='.PAGE_VERSION.'">';
        }
        return $cssF;
    }
    
    public function getCss() {
        return '<style>'.$this->css.'</style>';
    }

    public function setCss($css) {
        $this->css = $css;
    }
    
    public function addCss($css) {
        $this->css .= $css;
    }

    
    

    /*  BODY JS FILES  */
    public function addJSFile($jsFile) {
        if (($jsFile !== '' || !is_null($jsFile)) && is_array($jsFile) ) {
            array_push($this->jsFiles, $jsFile);
        }
    }

    public function setJSFiles($jsFiles) {
        if (is_array($jsFiles)) {
            $this->jsFiles = $jsFiles;
        }
    }

    public function getJSFiles() {
        $jsF = "";
        foreach ($this->jsFiles as $key) {
            $jsF .= '<script src="'.$key['path'].'?v='.PAGE_VERSION.'"></script>';
        }
        return $jsF;
    }

    public function addJSHeaderFile($jsHeaderFile) {
        if (($jsHeaderFile !== '' || !is_null($jsHeaderFile)) && is_array($jsHeaderFile) ) {
            array_push($this->jsHeaderFiles, $jsHeaderFile);
        }
    }

    public function setJSHeaderFiles($jsHeaderFiles) {
        if (is_array($jsHeaderFiles)) {
            $this->jsHeaderFiles = $jsHeaderFiles;
        }
    }

    public function getJSHeaderFiles() {
        $jsF = "";
        foreach ($this->jsHeaderFiles as $key) {
            $jsF .= '<script src="'.$key['path'].'?v='.PAGE_VERSION.'"></script>';
        }
        return $jsF;
    }
    
    
    
    /* OTHER */
    public function getBody() {
        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function addBody($body) {
        $this->body .= $body;
    }
    
}