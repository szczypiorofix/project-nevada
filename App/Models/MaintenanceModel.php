<?php

/*
 * The MIT License
 *
 * Copyright 2018 Piotrek.
 *
 */

namespace Models;

use Core\ModelClasses\DataModel;

/**
 * This is model class for maintenance page.
 *
 * @author Piotr Wróblewski
 */
class MaintenanceModel extends DataModel {
   
    public function __construct() {
        $this->content =
<<<HTML
   <div class="information">
        <div class="logo"><img src="images/logo-min.png"/></div>
        <span class="title">PRZERWA TECHNICZNA</span>
        <span class="small-title">Nowa wersja strony jest w trakcie przygotowywania</span>
   </div>
   <div class="maintenance-maindiv">
        <img src="images/tech-support.jpg" />
   </div>
   
HTML;
        /*
         * <div class="cogwheel-container">
            <div class="cogwheel"> 
                <div class="shatter t1 cw"></div>
            </div>          
        </div>
         */
    }
}
