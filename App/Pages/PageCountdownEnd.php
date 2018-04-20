<?php

/*
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */

namespace Pages;

use Core\ModelClasses\Page;

/**
 * This is error 404 Page
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class PageCountdownEnd extends Page {

    public function __toString() {
        return get_class($this);
    }

    public function defaultmethod($args) {
        if (\Core\Config::set("MAINTENANCE", "0")) {
            echo 'OK';
        } else {
            echo 'ERROR!';
        }
        exit;
    }
}
