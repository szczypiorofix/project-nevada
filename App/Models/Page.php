<?php

namespace Models;

abstract class Page {

    abstract protected function getHeader();

    abstract protected function getBody();

    abstract protected function getFooter();

    abstract protected function getCSS();

    abstract protected function getCSSFiles();

    abstract protected function getJS();

    abstract protected function getJSFiles();

}