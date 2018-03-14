<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Widgets;

use Core\ModelClasses\Widget, Core\Registry;

/**
 * This is class for nav-type widgets.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class Nav extends Widget {
    
    public function __construct() {
        Registry::add($this);
        $this->body =
<<<HTML
            <div class="navbar-container">
                <nav>
                    <ul>
                        <li><a href="#">Strona główna</a></li>
                        <li><a href="#">Projekty</a></li>
                        <li><a href="#">Do pobrania</a></li>
                        <li><a href="#">O mnie</a></li>
                        <li><a href="#"><i class="fas fa-cog"></i></a></li>
                    </ul>
                </nav>
            </div>
            <!--<div id="app-4">
                <ol>
                    <li v-for="todo in todos">
                        {{ todo.text }}
                    </li>
                </ol>
            </div>-->
HTML;
//        $this->addJS("
//  var app4 = new Vue({
//  el: '#app-4',
//  data: {
//    todos: [
//      { text: 'Learn JavaScript' },
//      { text: 'Learn Vue' },
//      { text: 'Build something awesome' }
//    ]
//  }
//}); ");
    }
}
