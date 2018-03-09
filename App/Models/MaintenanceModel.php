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
    <div class="bg"></div>
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
            <div class="caption-titles">
                <span class="title">DAYS</span>
                <span class="title">HOURS</span>
                <span class="title">MINUTES</span>
                <span class="title">SECONDS</span>
            </div>
        </div>
        <div id="counter-end">
            <p>HOORAY !!!</p>
        </div>
        <div class="describe-container">
              <p>Something big is coming...</p>
        </div>
        <!--<div class="trello-feed">
            <p>Some trello information</p>
            <p>Curabitur magna fringilla condimentum, pulvinar mollis, metus. Vestibulum euismod non, sagittis sed, elementum vitae, bibendum tellus, eleifend quam nec tellus. Cras enim metus vitae erat sed felis non dui. Vivamus faucibus orci luctus congue, velit adipiscing elit. Pellentesque nunc. Phasellus lorem velit tristique commodo. Suspendisse elit tincidunt quis, interdum consectetuer tellus non neque vel urna luctus et netus et magnis dis parturient montes, nascetur ridiculus mus. Mauris auctor libero ipsum ullamcorper pellentesque. Nullam pharetra sem, posuere cubilia Curae, Quisque lobortis, mi at quam in sem. Cras ut ligula. Lorem ipsum dolor ac lacus. Sed sollicitudin eget, condimentum velit. In sodales.</p>
        </div>-->
        <div class="social-icons-container">
            <a href="#"><i class="fab fa-github"></i></a>
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
   
HTML;
    }
}
