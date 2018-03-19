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
        $baseHref = BASE_HREF;
        $this->body =
<<<HTML
            <div class="navbar-container">
                <nav id="mySidenav" class="sidenav">
                    <p class="title"><span>Menu</span></p>
                    <ul>
                        <li><a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fas fa-times"></i></a></li>
                        <li><a href="{$baseHref}">Strona główna</a></li>
                        <li><a href="#">Projekty</a></li>
                        <li><a href="#">Do pobrania</a></li>
                        <li><a href="#">O mnie</a></li>
                    </ul>
                    <div class="socialmedia-div">
                        <a href="http://facebook.com" target="_blank" title="Facebook" class="fab fa-facebook-f"></a>
                        <a href="http://twitter.com" target="_blank" title="Twitter" class="fab fa-twitter"></a>
                        <a href="http://slack.com" target="_blank" title="Slack" class="fab fa-slack"></a>
                        <a href="http://youtube.com" target="_blank" title="Youtube" class="fab fa-youtube"></a>
                        <a href="http://github.com" target="_blank" title="GitHub" class="fab fa-github"></a>
                        <!-- <a href="http://skype.com" target="_blank" title="Skype" class="fab fa-skype"></a> -->
                    </div>
                </nav>
                <div class="navbar-launcher-container">
                    <span class="navbar-launcher" onclick="openNav()"><i class="fas fa-bars" id="navbarLauncher"></i></span>
                </div>
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
