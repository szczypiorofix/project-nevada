/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 * 
 */


function openNav() {
    document.getElementById("mySidenav").style.left = "0px";
    document.getElementById("mainDiv").style.marginLeft = "250px";
    document.getElementById("navbarLauncher").style.display = "none";
}

function closeNav() {
    document.getElementById("mySidenav").style.left = "-250px";
    document.getElementById("mainDiv").style.marginLeft= "0";
    document.getElementById("navbarLauncher").style.display = "block";
}


window.addEventListener("DOMContentLoaded", function() {
   console.log('Scripts loaded!');
   window.onclick = function(event) {
        //console.log(event.target);
        if (event.target !== document.getElementById("navbarLauncher")) {
            closeNav();
        }
    };
});
