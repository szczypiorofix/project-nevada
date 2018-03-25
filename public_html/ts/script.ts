/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 * 
 */

class SideNavbar {

    private static e(el: string) {
        return document.getElementById(el);
    }

    static openNav() {
        this.e("mySidenav").style.left = "0px";
        if (window.innerWidth > 650) {
            this.e("mainDiv").style.marginLeft = "250px";
        } else {
            this.e("mySidenav").style.left = "0px";
        }
        this.e("navbarLauncher").style.display = "none";
    }

    static closeNav() {
        this.e("mySidenav").style.left = "-250px";
        this.e("mainDiv").style.marginLeft= "0";
        this.e("navbarLauncher").style.display = "block";
    }
}

function goToTop() {
    (function smoothscroll(){
        var currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
        if (currentScroll > 0) {
             window.requestAnimationFrame(smoothscroll);
             window.scrollTo(0, currentScroll - (currentScroll/6));
        }
    })();
}


function smoothScrollToSections() {
    $(".scroll-btn").on('click', function(event) {
        if (this.hash !== "") {
          event.preventDefault();
          var hash = this.hash;
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 400, function() {
            window.location.hash = hash;
          });
        }
    });

    // function scrollTo(element, to, duration) {
    //     if (duration <= 0) return;
    //     var difference = to - element.scrollTop;
    //     var perTick = difference / duration * 10;
    
    //     setTimeout(function() {
    //         element.scrollTop = element.scrollTop + perTick;
    //         if (element.scrollTop === to) return;
    //         scrollTo(element, to, duration - 10);
    //     }, 10);
    // }

    // let buttonsRaw = document.getElementsByClassName("scroll-btn");
    // let buttons = [];
    // for (let i = 0; i < buttonsRaw.length; i++) {
    //     buttons[i] = buttonsRaw[i];
    // }

    // buttons.forEach(element => {
    //     element.addEventListener('click', function(event) {          

            
    //         scrollTo(document.documentElement, this.offsetTop, 600);


    //         //event.preventDefault();

    //     });
    // });
}




window.addEventListener("DOMContentLoaded", function() {

    smoothScrollToSections();

    window.onclick = function(event) {
        if (event.target !== document.getElementById("navbarLauncher")) {
            SideNavbar.closeNav();
        }
    };

});
