/*
 * MIT License
 *
 * Copyright (c) 2018 Piotr Wróblewski
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 *
 */
var SideNavbar = /** @class */ (function () {
    function SideNavbar() {
    }
    SideNavbar.e = function (el) {
        return document.getElementById(el);
    };
    SideNavbar.openNav = function () {
        this.e("mySidenav").style.left = "0px";
        this.e("mainDiv").style.marginLeft = "250px";
        this.e("navbarLauncher").style.display = "none";
    };
    SideNavbar.closeNav = function () {
        this.e("mySidenav").style.left = "-250px";
        this.e("mainDiv").style.marginLeft = "0";
        this.e("navbarLauncher").style.display = "block";
    };
    return SideNavbar;
}());
window.addEventListener("DOMContentLoaded", function () {
    window.onclick = function (event) {
        if (event.target !== document.getElementById("navbarLauncher")) {
            SideNavbar.closeNav();
        }
    };
});
//# sourceMappingURL=script.js.map