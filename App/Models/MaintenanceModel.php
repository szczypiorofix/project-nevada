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
   <div class="fsvideo-container">
        <video autoplay muted loop id="fullVideo">
            <source src="video/typing.mp4" type="video/mp4">
            Your browser does not support HTML5 video.
        </video>
    </div>
    <div class="bg-main">
        <div class="logo-container">
            <img src="images/logo-min.png">
        </div>
        <div class="caption-container">
            <span class="caption-big">Coming soon</span>
            <div class="caption-counter">
                <div class="counter-part">
                    <span id="counter-days"></span>
                </div>
                <div class="counter-part">
                    <span id="counter-hours"></span>
                </div>
                <div class="counter-part">
                    <span id="counter-minutes"></span>
                </div>
                <div class="counter-part">
                    <span id="counter-seconds"></span>
                </div>
            </div>
        </div>
        <div class="social-icons-container">
            <a href="#"><i class="fab fa-github"></i></a>
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
   
HTML;
    }
}
