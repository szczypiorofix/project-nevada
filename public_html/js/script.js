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
        if (window.innerWidth > 650) {
            this.e("mainDiv").style.marginLeft = "260px";
        }
        else {
            this.e("mySidenav").style.left = "0px";
        }
        this.e("navbarLauncher").style.display = "none";
    };
    SideNavbar.closeNav = function () {
        this.e("mySidenav").style.left = "-260px";
        this.e("mainDiv").style.marginLeft = "0";
        this.e("navbarLauncher").style.display = "block";
    };
    return SideNavbar;
}());
var SearchField = /** @class */ (function () {
    function SearchField() {
    }
    SearchField.e = function (el) {
        return document.getElementById(el);
    };
    SearchField.open = function () {
        this.isOpened = !this.isOpened;
        if (this.isOpened)
            this.e("input-text-field").className = "search-field open";
        else
            this.e("input-text-field").className = "search-field close";
    };
    SearchField.isOpened = false;
    return SearchField;
}());
function goToTop() {
    (function smoothscroll() {
        var currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
        if (currentScroll > 0) {
            window.requestAnimationFrame(smoothscroll);
            window.scrollTo(0, currentScroll - (currentScroll / 6));
        }
    })();
}
window.addEventListener("DOMContentLoaded", function () {
    window.onclick = function (event) {
        if (event.target !== document.getElementById("navbarLauncher")) {
            SideNavbar.closeNav();
        }
    };
});
//# sourceMappingURL=script.js.map