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
    Stylesheet.css
    BookCover.jpg
    HomePage.xhtml
    Chapter1.xhtml
    ...
    ChapterN.xhtml
    Index.xhtml
    */
}
