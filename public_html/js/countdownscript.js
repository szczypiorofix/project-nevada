/* 
 * The MIT License
 *
 * Copyright 2018 Semiko.
 *
 */

var CountDownToDate = {
    isRunning: true,
    countDownDate: null,
    daysElement: null,
    hoursElement: null,
    minutesElement: null,
    secondsElement: null,
    counterEndElement: null,
    currentDate: null,
    distance: null,
    counterDate: {},
    counterInterval: null,
    checkDate: function() {
        let now = new Date().getTime();
        this.distance = this.countDownDate - now;
        if (this.distance <= 0) {
            this.stop();
            this.isRunning = false;
        }
    },
    updateDate: function() {
        this.counterDate.days = Math.floor(this.distance / (1000 * 60 * 60 * 24));
        this.counterDate.hours = Math.floor((this.distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        this.counterDate.minutes = Math.floor((this.distance % (1000 * 60 * 60)) / (1000 * 60));
        this.counterDate.seconds = Math.floor((this.distance % (1000 * 60)) / 1000);
        this.daysElement.innerHTML = this.distance < 0 ? "0" : this.counterDate.days;
        this.hoursElement.innerHTML = this.distance < 0 ? "0" : this.counterDate.hours;
        this.minutesElement.innerHTML = this.distance < 0 ? "0" : this.counterDate.minutes;
        this.secondsElement.innerHTML = this.distance < 0 ? "0" : this.counterDate.seconds;
    },
    start: function(d) {
        this.countDownDate = new Date(d.date).getTime();
        this.daysElement = document.getElementById(d.daysElement);
        this.hoursElement = document.getElementById(d.hoursElement);
        this.minutesElement = document.getElementById(d.minutesElement);
        this.secondsElement = document.getElementById(d.secondsElement);
        this.counterEndElement = document.getElementById(d.counterEndElement);
        this.checkDate();
        this.updateDate();
        let self = this;
        if (self.isRunning) {
            this.counterInterval = setInterval(function() {
                self.checkDate();
                self.updateDate();
            }, 1000);
        }
    },
    stop: function() {
        clearInterval(this.counterInterval);
        this.counterEndElement.style.display = "block";
    }
};

window.addEventListener("DOMContentLoaded", function() {
    CountDownToDate.start({
        "date": "Mar 13, 2018 23:53:01",
        "daysElement": "counter-days",
        "hoursElement": "counter-hours",
        "minutesElement": "counter-minutes",
        "secondsElement": "counter-seconds",
        "counterEndElement": "counter-end"
    });
});
