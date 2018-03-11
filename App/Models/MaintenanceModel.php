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
        
//        $curl = curl_init();
//        $headers = array( 
//            "POST HTTP/1.0", 
//            "Content-type: application/vnd.github.inertia-preview+json;charset=\"utf-8\"", 
//            "Accept: application/vnd.github.inertia-preview+json", 
//            "Cache-Control: no-cache", 
//            "Pragma: no-cache"
//        ); 
//        curl_setopt_array($curl, array(
//            CURLOPT_RETURNTRANSFER => 1,
//            CURLOPT_URL => 'https://api.github.com/repos/szczypiorofix/project-nevada',
//            CURLOPT_HTTPHEADER => $headers,
//            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
//        ));
//        $server_output = curl_exec($curl);
//        curl_close($curl);
//        echo $server_output;
//        exit();
        
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
        <div id="google_translate_element"></div>
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
            <p>IT'S ON !!!</p>
        </div>
        <div class="describe-container">
              <p>Something big is coming...</p>
        </div>
                
        <div class="github-feed">
            <p>Some Github information:</p>
            <p id="githubFeed"></p>
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
