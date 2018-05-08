/*
 * MIT License
 *
 * Copyright (c) 2018 Piotr Wróblewski
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 *
 */
class SideNavbar {
    static e(el) {
        return document.getElementById(el);
    }
    static openNav() {
        this.e("mySidenav").style.left = "0px";
        if (window.innerWidth > 650) {
            this.e("mainDiv").style.marginLeft = "260px";
        }
        else {
            this.e("mySidenav").style.left = "0px";
        }
        this.e("navbarLauncher").style.display = "none";
    }
    static closeNav() {
        this.e("mySidenav").style.left = "-260px";
        this.e("mainDiv").style.marginLeft = "0";
        this.e("navbarLauncher").style.display = "block";
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
(function welcome() {
    let logo = 'MMMMMMMMMMMMMO  OMMMMMMMMMMMMM\n'
        + 'MMMMMMMMMMO        OMMMMMMMMMM\n'
        + 'MMMMMMMMO     OO     OMMMMMMMM\n'
        + 'MMMMMMO     OOOOOO     OMMMMMM\n'
        + 'MMMMO     OOOOOOOOOO     OMMMM\n'
        + 'MMMMO     OOOOOOOOOO     OMMMM\n'
        + 'MMMMMMO     OOOOOO     OMMMMMM\n'
        + 'MMMMMMMMO     OO     OMMMMMMMM\n'
        + 'MMMMMMMMMMO        OMMMMMMMMMM\n'
        + 'MMMMMMMMMMMMMO  OMMMMMMMMMMMMM\n';
    console.log(logo);
})();


(function searchInput() {
    var si = document.getElementById('search-input');
    var ss = document.getElementById('search-submit');
    var sr = document.getElementById('search-results');
    ss.onclick = function(event) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                console.log(this.response);
                sr.innerHTML = this.response;
            }
        };
        xmlhttp.open("GET", "lista/szukaj?q="+si.value, true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send();
    }
})();


window.addEventListener("DOMContentLoaded", function () {
    window.onclick = function (event) {
        if (event.target !== document.getElementById("navbarLauncher")) {
            SideNavbar.closeNav();
        }
    };
});
//# sourceMappingURL=script.js.map