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
                        <li><a href="javascript:void(0)" class="closebtn" onclick="SideNavbar.closeNav()"><i class="fas fa-times"></i></a></li>
                        <li><a href="{$baseHref}" class="scroll-btn">Strona główna</a></li>
                        <li><a href="#aboutMe" class="scroll-btn">O mnie</a></li>
                        <li><a href="#mySkills" class="scroll-btn">Umiejętności</a></li>
                        <li><a href="#whatIDo" id="whatIDoButton" class="scroll-btn">Co ja robię</a></li>
                        <li><a href="#numbers" class="scroll-btn">Liczby</a></li>
                        <li><a href="#portfolio" class="scroll-btn">Portfolio</a></li>
                        <li><a href="#news" class="scroll-btn">Informacje</a></li>
                        <li><a href="#contact" class="scroll-btn">Kontakt</a></li>
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
                    <span class="navbar-launcher" onclick="SideNavbar.openNav()"><i class="fas fa-bars" id="navbarLauncher"></i></span>
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
