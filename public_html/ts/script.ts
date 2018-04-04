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


class SearchField {

    private static isOpened: boolean = false;

    private static e(el: string) {
        return document.getElementById(el);
    }

    static open() {        
        this.isOpened = !this.isOpened;
        if (this.isOpened) this.e("input-text-field").className = "search-field open";
        else this.e("input-text-field").className = "search-field close";
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



window.addEventListener("DOMContentLoaded", function() {

    window.onclick = function(event) {
        if (event.target !== document.getElementById("navbarLauncher")) {
            SideNavbar.closeNav();
        }
    };

});
