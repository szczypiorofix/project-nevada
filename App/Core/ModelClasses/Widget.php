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

    
    /* ############### BODY ############### */
    /**
     * Returns body of widget.
     * @return string - body of widget
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * Set the body of widget.
     * @param string $body
     */
    public function setBody($body) {
        $this->body = $body;
    }

    /**
     * Add string to the body of widget.
     * @param string $body
     */
    public function addBody($body) {
        $this->body .= $body;
    }

    

    /* ############### CSS FILES ############### */
    /**
     * Add css file to load.
     * @param type $cssFile
     */
    public function addCSSFile($cssFile) {
        if (($cssFile !== '' || !is_null($cssFile)) && is_array($cssFile) ) {
            array_push($this->cssFiles, $cssFile);
        }
    }

    /**
     * Set css files array.
     * @param array $cssFile
     */
    public function setCSSFile($cssFile) {
        if (is_array($cssFile)) {
            $this->cssFiles = $cssFile;
        }
    }

    /**
     * Return array of css files as a list of `<link rel="stylesheet">` code.
     * @return string
     */
    public function getCSSFiles() {
        $cssF = "";
        foreach ($this->cssFiles as $key) {
            $cssF .= '<link rel="stylesheet" href="'.$key['path'].'?v='.PAGE_VERSION.'">';
        }
        return $cssF;
    }




    /* ############### CSS CODE ############### */
    /**
     * Returns css code.
     * @return type
     */
    public function getCss() {
        return $this->css;
    }

    /**
     * Set css code.
     * @param string $css
     */
    public function setCss($css) {
        $this->css = $css;
    }
    
    /**
     * Add css code.
     * @param string $css
     */
    public function addCss($css) {
        $this->css .= $css;
    }


    
    /* ############### JS FILES ############### */
    /**
     * Add string containing data about JavaScript file to array.
     * @param string $jsFile
     */
    public function addJSFile($jsFile) {
        if (($jsFile !== '' || !is_null($jsFile)) && is_array($jsFile) ) {
            array_push($this->jsFiles, $jsFile);
        }
    }

    /**
     * Set array of JavaScript files.
     * @param array $jsFiles
     */
    public function setJSFiles($jsFiles) {
        if (is_array($jsFiles)) {
            $this->jsFiles = $jsFiles;
        }
    }

    /**
     * Return array of JavaScript files.
     * @return array
     */
    public function getJSFiles() {
        return $this->jsFiles;
    }
    


    /* ############### JS HEAD CODE ############### */
    public function addJSHead($jsHead) {
        $this->jsHead .= $jsHead;
    }

    public function setJsHead($jsHead) {
        $this->jsHead = $jsHead;
    }

    public function getJSHead() {
        return $this->jsHead;
    }
    



    /* ############### JS CODE ############### */
    public function getJS() {
        return $this->js;
    }
    
    public function setJS($js) {
        $this->js = $js;
    }
    
    public function addJS($js) {
        $this->js .= $js;
    }



    /* ############### JS HEAD FILES ############### */
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

}
