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
            this.e("mainDiv").style.marginLeft = "250px";
        }
        else {
            this.e("mySidenav").style.left = "0px";
        }
        this.e("navbarLauncher").style.display = "none";
    };
    SideNavbar.closeNav = function () {
        this.e("mySidenav").style.left = "-250px";
        this.e("mainDiv").style.marginLeft = "0";
        this.e("navbarLauncher").style.display = "block";
    };
    return SideNavbar;
}());


function showGoogleMaps() {
    if (typeof google === 'object' && typeof google.maps === 'object') {
        // 52.160161, 21.022213
        var myLatLng = {lat: 52.160161, lng: 21.022213};
        var map = new google.maps.Map(document.getElementById('googlemapscontainer'), {
            zoom: 11,
            center: myLatLng
        });
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Piotr Wróblewski'
        });
    } else {
        console.log('Uuups coś poszło nie tak ...');
    }
}


function goToTop() {
    (function smoothscroll() {
        var currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
        if (currentScroll > 0) {
            window.requestAnimationFrame(smoothscroll);
            window.scrollTo(0, currentScroll - (currentScroll / 6));
        }
    })();
}


function smoothScrollToSections() {
    $(".scroll-btn").on('click', function (event) {
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 500, function () {
                window.location.hash = hash;
            });
        }
    });
}


window.addEventListener("DOMContentLoaded", function () {
    smoothScrollToSections();
    window.onclick = function (event) {
        if (event.target !== document.getElementById("navbarLauncher")) {
            SideNavbar.closeNav();
        }
    };
});
//# sourceMappingURL=script.js.map