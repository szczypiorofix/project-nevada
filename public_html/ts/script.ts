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
            this.e("mainDiv").style.marginLeft = "260px";
        } else {
            this.e("mySidenav").style.left = "0px";
        }
        this.e("navbarLauncher").style.display = "none";
    }

    static closeNav() {
        this.e("mySidenav").style.left = "-260px";
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

(function welcome() {
    let logo:string = 'MMMMMMMMMMMMMO  OMMMMMMMMMMMMM\n'
                     +'MMMMMMMMMMO        OMMMMMMMMMM\n'
                     +'MMMMMMMMO     OO     OMMMMMMMM\n'
                     +'MMMMMMO     OOOOOO     OMMMMMM\n'
                     +'MMMMO     OOOOOOOOOO     OMMMM\n'
                     +'MMMMO     OOOOOOOOOO     OMMMM\n'
                     +'MMMMMMO     OOOOOO     OMMMMMM\n'
                     +'MMMMMMMMO     OO     OMMMMMMMM\n'
                     +'MMMMMMMMMMO        OMMMMMMMMMM\n'
                     +'MMMMMMMMMMMMMO  OMMMMMMMMMMMMM\n';
    console.log(logo);
})();


window.addEventListener("DOMContentLoaded", function() {

    window.onclick = function(event) {
        if (event.target !== document.getElementById("navbarLauncher")) {
            SideNavbar.closeNav();
        }
    };

});
