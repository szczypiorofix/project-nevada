<?php

/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */

namespace Widgets;

use \Core\ModelClasses\Widget, Core\Registry;

/**
 * This is class for aside-type widgets.
 *
* @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class Aside extends Widget {
    
    public function __construct() {
        
        Registry::add($this);
        
        $this->body = '<aside class="sidebar">
            <p>SIDE BAR...</p>
            <div class="panel panel-default">
                <a class="twitter-timeline" href="https://twitter.com/szczypiorofix" data-width="450" data-height="600">
                    Tweets by @Szczypiorofix
                </a>
                <!--  TWITTER FOLLOW BUTTON -->
                <div style="padding: 5px;">
                    <a class="twitter-follow-button" href="https://twitter.com/szczypiorofix">Follow @Szczypiorofix</a>
                </div>
            </div>
        </aside>';
        
        
        $twitterJS = '$(document).ready(function(){	
	window.twttr = (function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0],
   	t = window.twttr || {};
	if (d.getElementById(id)) return t;
 		js = d.createElement(s);
 		js.id = id;
 		js.src = "https://platform.twitter.com/widgets.js";
 		fjs.parentNode.insertBefore(js, fjs);

 		t._e = [];
 		t.ready = function(f) {
   		t._e.push(f);
	};
	return t;
	}(document, "script", "twitter-wjs"));
});';
        $this->addJS($twitterJS);
    }
    
    
}
