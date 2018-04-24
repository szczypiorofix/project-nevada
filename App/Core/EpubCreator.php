<?php
/*
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */

namespace Core;

use PDO;

/**
 * This is epub files creator class.
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class EpubCreator {

    private $file = null;
    private $targetFile = null;
    private $errorMsg = '';
    private $error = false;
    private $filename = null;

    private function __construct() {}
    private function __clone() {}

    
    public static function create() {

    }    
    
    /*
    FILE STRUCTURE:

    myBook/
    META-INF/
        container.xml
    mimetype
    content.opf
    toc.ncx
    style.css
    cover.jpg
    home.xhtml
    chapter1.xhtml
    ...
    chapterN.xhtml
    index.xhtml
    */
}
