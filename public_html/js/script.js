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
        this.closed = false;
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
        if (!this.closed) {
            this.e("mySidenav").style.left = "-260px";
            this.e("mainDiv").style.marginLeft = "0";
            this.e("navbarLauncher").style.display = "block";
        }
        this.closed = true;
    }
}
SideNavbar.closed = true;
// Smooth scroll to top
function goToTop() {
    (function smoothscroll() {
        var currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
        if (currentScroll > 0) {
            window.requestAnimationFrame(smoothscroll);
            window.scrollTo(0, currentScroll - (currentScroll / 6));
        }
    })();
}
// Search input function
function searchInput(bhref) {
    var si = document.getElementById('search-input');
    var ss = document.getElementById('search-submit');
    var sr = document.getElementById('search-results');
    si.addEventListener('focusout', function (e) {
        setTimeout(function () {
            sr.style.display = 'none';
        }, 100);
    });
    si.addEventListener('input', function (event) {
        if (this.value.length >= 3) {
            sr.style.display = 'flex';
            sr.style.flexDirection = 'column';
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    let res = JSON.parse(this.response);
                    sr.innerHTML = '';
                    if (res !== null) {
                        //console.log(res);
                        let el, elText;
                        for (let i = 0; i < res.posts.length; i++) {
                            el = document.createElement('a');
                            elText = document.createTextNode(res.posts[i].title);
                            el.href = bhref + 'post/' + res.posts[i].url;
                            el.appendChild(elText);
                            sr.appendChild(el);
                        }
                    }
                    else {
                        let el, elText;
                        el = document.createElement('p');
                        elText = document.createTextNode('Niczego nie znaleziono...');
                        el.appendChild(elText);
                        sr.appendChild(el);
                    }
                }
            };
            xmlhttp.open("GET", "lista/szukaj?q=" + this.value, true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send();
        }
        else {
            sr.style.display = 'none';
        }
    }, true);
}
function showNotification(n) {
    let notificationsPanel = document.getElementById("notificationsPanel");
    let notificationsContent = document.getElementById("notificationsContent");
    notificationsContent.innerHTML = n;
    notificationsPanel.className = "show";
    setTimeout(function () {
        notificationsPanel.className = notificationsPanel.className.replace("show", "");
    }, 3000);
}
window.addEventListener("DOMContentLoaded", function () {
    //console.log(navigator.language);
    if (window.navigator.language != 'pl-PL') {
    }
    window.onclick = function (event) {
        if (event.target !== document.getElementById("navbarLauncher")) {
            SideNavbar.closeNav();
        }
    };
});
//# sourceMappingURL=script.js.map