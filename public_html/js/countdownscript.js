/* 
 * The MIT License
 *
 * Copyright 2018 Semiko.
 *
 */

var countDownDate = new Date("Sep 5, 2018 15:37:25").getTime();
var x = setInterval(function() {
    var now = new Date().getTime();
    var distance = countDownDate - now;

    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("counter-days").innerHTML = days;
    document.getElementById("counter-hours").innerHTML = hours;
    document.getElementById("counter-minutes").innerHTML = minutes;
    document.getElementById("counter-seconds").innerHTML = seconds;

    if (distance < 0) {
      clearInterval(x);
      document.getElementById("counter-days").innerHTML = "EXPIRED";
    }
}, 1000);
