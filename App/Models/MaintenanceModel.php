<?php
/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Models;

use Core\ModelClasses\DataModel;

/**
 * This is model class for maintenance page.
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class MaintenanceModel extends DataModel {
   
    public function __construct() {
        $baseHref = BASE_HREF;
        $this->content =
<<<HTML
    <div class="bg"><img src="images/maintenance-bg.jpeg" alt="Background image" /></div>
    <div class="bg-main">
        <div class="logo-container">
            <a href="{$baseHref}"><img src="images/logo-min.png"></a>
        </div>
        <div id="google_translate_element"></div>
            
        <div class="divided-content">
            <div class="left-side">
                <div class="caption-container">
                    <span class="caption-big">Już wkrótce ...</span>
                    <span class="caption-small">Nowa wersja strony jest właśnie przygotowywana...</span>
                    <div class="caption-counter">
                        
                        <div class="counter-container">
                            <div class="counter-part">
                                <span id="counter-days"></span>
                            </div>
                            <span class="title">DNI</span>
                        </div>

                        <div class="counter-container">
                            <div class="counter-part">
                                <span id="counter-hours"></span>
                            </div>
                            <span class="title">GODZIN</span>
                        </div>

                        <div class="counter-container">
                            <div class="counter-part">
                                <span id="counter-minutes"></span>
                            </div>
                            <span class="title">MINUT</span>
                        </div>
                        
                        <div class="counter-container">
                            <div class="counter-part">
                                <span id="counter-seconds"></span>
                            </div>
                            <span class="title">SEKUND</span>
                        </div>

                    </div>
                </div>
                <div id="counter-end">
                    <div class="bg"></div>
                    <div class="launch-info">
                        <p>Odliczanie dobiegło końca!!!</p>
                        <p>Odśwież stronę</p>
                    </div>
                </div>
            </div>
            <div class="right-side">
                <div class="describe-container">
                    <p>Plany i pomysły: <small>(Trello)</small></p>
                </div>
                <div class="trello-feed">
                    <div id = "spinner" class="spinner">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                    <div id="trelloFeed"></div>
                </div>
            </div>  
        </div>
                
        <div class="subscribe-container">
            <button class="moreinfo-btn">WIĘCEJ INFORMACJI</button>         
            <button class="subscribe-btn">ZAPISZ SIĘ</button>
        </div>
        <!-- <div class="donate-main">
            <p>PayPal Sandbox</p>
            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="QNN53UP6TR9YC">
                <input type="image" src="https://www.sandbox.paypal.com/pl_PL/PL/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal – Płać wygodnie i bezpiecznie">
                <img alt="" border="0" src="https://www.sandbox.paypal.com/pl_PL/i/scr/pixel.gif" width="1" height="1">
            </form>
        </div>-->
                
        <div class="social-icons-container">
            <a href="https://github.com/szczypiorofix"><i class="fab fa-github"></i></a>
            <a href="https://www.facebook.com/szczypiorofix"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com/szczypiorofix"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
   
HTML;
    }

}
