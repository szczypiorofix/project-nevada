<?php

namespace Pages;

use \Models\Page;

class HomePage extends Page {

    const HOME_PAGE_VIEW_FILE = "index.html";

    public function show() {
        include_once DIR_VIEWS.self::HOME_PAGE_VIEW_FILE;
    }
}
