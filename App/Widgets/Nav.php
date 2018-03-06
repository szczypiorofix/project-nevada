<?php

namespace Widgets;

use \Models\Widget;

class Nav extends Widget {
    
    public function __construct() {
        $this->body =
<<<HTML
            <div class="navbar-container">
                <nav>
                    <ul>
                        <li><a>Home</a></li>
                        <li><a>Projects</a></li>
                        <li><a>Download</a></li>
                        <li><a>About me</a></li>
                        <li><a><i class="fas fa-cog"></i></a></li>
                    </ul>
                </nav>
            </div>
HTML;
        
    }
}
