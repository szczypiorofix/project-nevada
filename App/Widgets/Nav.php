<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Widgets;

use Core\ModelClasses\Widget;
use Core\Registry;

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
                        <li><a href="{$baseHref}#aboutMe" class="scroll-btn">O mnie</a></li>
                        <li><a href="{$baseHref}#mySkills" class="scroll-btn">Umiejętności</a></li>
                        <li><a href="{$baseHref}#whatIDo" class="scroll-btn">Co ja robię</a></li>
                        <li><a href="{$baseHref}#numbers" class="scroll-btn">Liczby</a></li>
                        <li><a href="{$baseHref}#portfolio" class="scroll-btn">Portfolio</a></li>
                        <li><a href="{$baseHref}#news" class="scroll-btn">Informacje</a></li>
                        <li><a href="{$baseHref}#contact" class="scroll-btn">Kontakt</a></li>
                    </ul>
                    <div class="socialmedia-div">
                        <a href="https://www.facebook.com/szczypiorofix/" target="_blank" title="Facebook" class="fab fa-facebook-f"></a>
                        <a href="https://twitter.com/szczypiorofix/" target="_blank" title="Twitter" class="fab fa-twitter"></a>
                        <a href="https://slack.com" target="_blank" title="Slack" class="fab fa-slack"></a>
                        <a href="https://www.youtube.com/user/szczypiorofixable/" target="_blank" title="Youtube" class="fab fa-youtube"></a>
                        <a href="https://github.com/szczypiorofix/" target="_blank" title="GitHub" class="fab fa-github"></a>
                    </div>
                </nav>
                <div class="navbar-launcher-container">
                    <span class="navbar-launcher" onclick="SideNavbar.openNav()"><i class="fas fa-bars" id="navbarLauncher"></i></span>
                    <div id="google_translate_element"></div>
                </div>
                <div class="search-form-container">
                    <div class="search-form">
                        <input class="search-input" type="text" id="search-input">
                        <i class="fas fa-search"></i>
                    </div>
                    <div id="search-results"></div>
                </div>
            </div>
HTML;
    }
}
