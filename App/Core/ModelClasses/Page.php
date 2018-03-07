<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Core\ModelClasses;

/**
 * This is an abstract class for all page-type content.
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
abstract class Page {

    protected $head = "";
    protected $cssFiles = [];
    protected $css = "";
    protected $jsHeadFiles = [];
    protected $jsHead = "";
    protected $jsFiles = [];
    protected $js = "";
    protected $body = "";
    protected $footer = "";
    
    

    /* ABSTRACT FUNCTION "SHOW" */
    abstract public function show();
    /* ABSTRACT DEFAULT METHOD */
    abstract public function defaultmethod($args);
    
    
    
    /* FUNCTION WHICH INTEGRATES CSS STYLE FROM ALL WIDGETS */
    public function integrateCSS() {
        foreach(\Core\Registry::returnList() as $el) {
            $this->css .= $el->getCSS();
        }
    }
    
    /* FUNCTION WHICH INTEGRATES CSS STYLE FROM ALL WIDGETS */
    public function integrateJS() {
        foreach(\Core\Registry::returnList() as $el) {
            $this->js .= $el->getJS();
            $this->jsHead .= $el->getJSHead();
            foreach ($el->getJSFiles() as $jsFile) {
                $this->jsFiles[] = $jsFile;
            }
            foreach ($el->getJSHeadFiles() as $jsHeadFile) {
                $this->jsHeadFiles[] = $jsHeadFile;
            }
        }
    }
    

    /* OVERRIDE toString() METHOD */
    public function __toString() {
        return get_class($this);
    }

    


    /*  CSS FILES  */
    public function getCss() {
        return "<style>".$this->css."</style>";
    }
    
    public function setCss($css) {
        $this->css = $css;
    }
    
    public function addCss($css) {
        $this->css .= $css;
    }
    
    public function addCssFile($cssFile) {
        if (($cssFile !== '' || !is_null($cssFile)) && is_array($cssFile) ) {
            array_push($this->cssFiles, $cssFile);
        }
    }

    public function setCssFiles($cssFiles) {
        if (is_array($cssFiles)) {
            $this->cssFiles = $cssFiles;
        }
    }

    public function getCssFiles() {
        $cssF = "";
        foreach ($this->cssFiles as $key) {
            $cssF .= '<link rel="stylesheet" type="text/css" href="'.$key['path'].'?v='.PAGE_VERSION.'">';
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
            $jsF .= '<script src="'.$key['path'].'?v='.PAGE_VERSION.'"></script>';
        }
        return $jsF;
    }

    public function setJSFiles($jsFiles) {
        if (is_array($jsFiles)) {
            $this->jsFiles = $jsFiles;
        }
    }
    
    public function addJSHeadFile($jsHeadFile) {
        if (($jsHeadFile !== '' || !is_null($jsHeadFile)) && is_array($jsHeadFile) ) {
            array_push($this->jsHeadFiles, $jsHeadFile);
        }
    }
    
    public function setJSHeadFiles($jsHeadFiles) {
        if (is_array($jsHeadFiles)) {
            $this->jsHeadFiles = $jsHeadFiles;
        }
    }

    public function getJSHeadFiles() {
        $jsF = "";
        foreach ($this->jsHeadFiles as $key) {
            $jsF .= '<script src="'.$key['path'].'?v='.PAGE_VERSION.'"></script>';
        }
        return $jsF;
    }
    
    public function setJs($js) {
        $this->js = $js;
    }

    public function addJS($js) {
        $this->js .= $js;
    }
    
    public function getJs() {
        return '<script>'.$this->js.'</script>';
    }

    public function setJSHead($jsHead) {
        $this->jsHead = $jsHead;
    }

    public function getJSHead() {
        return '<script>'.$this->jsHead.'</script>';
    }
    
    public function addJSHead($jsHead) {
        $this->jsHead .= $jsHead;
    }
    


    /* OTHER */
    public function getHead() {
        return $this->head;
    }

    public function getBody() {
        return $this->body;
    }

    public function getFooter() {
        return $this->footer;
    }

    public function setHead($head) {
        $this->head = $head;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function setFooter($footer) {
        $this->footer = $footer;
    }
    
}