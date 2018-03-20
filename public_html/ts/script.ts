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
        this.e("mainDiv").style.marginLeft = "250px";
        this.e("navbarLauncher").style.display = "none";
    }

    static closeNav() {
        this.e("mySidenav").style.left = "-250px";
        this.e("mainDiv").style.marginLeft= "0";
        this.e("navbarLauncher").style.display = "block";
    }
}


window.addEventListener("DOMContentLoaded", function() {
   window.onclick = function(event) {
        if (event.target !== document.getElementById("navbarLauncher")) {
            SideNavbar.closeNav();
        }
    };
});
