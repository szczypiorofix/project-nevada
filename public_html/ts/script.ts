/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 * 
 */

class SideNavbar {

    private static closed:boolean = true;

    private static e(el: string) {
        return document.getElementById(el);
    }

    static openNav() {
        this.closed = false;
        this.e("mySidenav").style.left = "0px";
        if (window.innerWidth > 650) {
            this.e("mainDiv").style.marginLeft = "260px";
        } else {
            this.e("mySidenav").style.left = "0px";
        }
        this.e("navbarLauncher").style.display = "none";
    }

    static closeNav() {
        if (!this.closed) {
            this.e("mySidenav").style.left = "-260px";
            this.e("mainDiv").style.marginLeft= "0";
            this.e("navbarLauncher").style.display = "block";
        }
        this.closed = true;
    }
}


// Smooth scroll to top
function goToTop() {
    (function smoothscroll(){
        var currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
        if (currentScroll > 0) {
             window.requestAnimationFrame(smoothscroll);
             window.scrollTo(0, currentScroll - (currentScroll/6));
        }
    })();
}


// Search input function
(function searchInput() {
    var si:HTMLInputElement = <HTMLInputElement>document.getElementById('search-input');
    var ss:HTMLElement = document.getElementById('search-submit');
    var sr:HTMLElement = document.getElementById('search-results');
    si.addEventListener('focusout', function(e) {
        sr.style.display = 'none';
    });
    si.addEventListener('input', function(event) {
        if (this.value.length >= 3) {
            sr.style.display = 'block';
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    let res = JSON.parse(this.response);
                    console.log(res);
                    sr.innerHTML = res;
                }
            };
            xmlhttp.open("GET", "lista/szukaj?q="+this.value, true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send();
        } else {
            sr.style.display = 'none';
        }
    }, true);
})();



window.addEventListener("DOMContentLoaded", function() {
    
    window.onclick = function(event) {
        if (event.target !== document.getElementById("navbarLauncher")) {
            SideNavbar.closeNav();
        }
    };

});
