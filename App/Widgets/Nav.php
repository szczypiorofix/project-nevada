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
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Projects</a></li>
                        <li><a href="#">Download</a></li>
                        <li><a href="#">About me</a></li>
                        <li><a href="#"><i class="fas fa-cog"></i></a></li>
                    </ul>
                </nav>
            </div>
            <div id="app-4">
                <ol>
                    <li v-for="todo in todos">
                        {{ todo.text }}
                    </li>
                </ol>
            </div>
HTML;
        $this->addJS("var app4 = new Vue({
  el: '#app-4',
  data: {
    todos: [
      { text: 'Learn JavaScript' },
      { text: 'Learn Vue' },
      { text: 'Build something awesome' }
    ]
  }
})");
    }
}
