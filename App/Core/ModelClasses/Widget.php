<?php
/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Core\ModelClasses;

/**
 * This is an abstract class for all widget-type content.
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */

abstract class Widget {

    protected $cssFiles = [];
    protected $css = "";
    protected $body = "";
    protected $jsFiles = [];
    protected $js = "";
    protected $jsHeadFiles = [];
    protected $jsHead = "";

    
    /* OVERRIDE toString() METHOD */
    public function __toString() {
        return get_class($this);
    }
    
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
        return $this->css;
    }

    public function setCss($css) {
        $this->css = $css;
    }
    
    public function addCss($css) {
        $this->css .= $css;
    }

    /*  JS FILES  */
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
        return $this->jsFiles;
    }
    
    public function getJSHead() {
        return $this->jsHead;
    }
    
    public function getJS() {
        return $this->js;
    }
    
    public function setJS($js) {
        $this->js = $js;
    }
    
    public function addJS($js) {
        $this->js .= $js;
    }

    public function addJSHeadFile($jsHeaderFile) {
        if (($jsHeaderFile !== '' || !is_null($jsHeaderFile)) && is_array($jsHeaderFile) ) {
            array_push($this->jsHeadFiles, $jsHeaderFile);
        }
    }

    public function setJSHeadFiles($jsHeaderFiles) {
        if (is_array($jsHeaderFiles)) {
            $this->jsHeadFiles = $jsHeaderFiles;
        }
    }

    public function getJSHeadFiles() {
        return $this->jsHeadFiles;
    }
    
    public function addJSHead($jsHead) {
        $this->jsHead .= $jsHead;
    }

    public function setJsHead($jsHead) {
        $this->jsHead = $jsHead;
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
