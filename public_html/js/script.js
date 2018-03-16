/* 
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */


function openNav() {
    document.getElementById("mySidenav").style.left = "0px";
    document.getElementById("mainDiv").style.marginLeft = "250px";
    document.getElementById("navbarLauncher").style.visibility = "hidden";
}

function closeNav() {
    document.getElementById("mySidenav").style.left = "-250px";
    document.getElementById("mainDiv").style.marginLeft= "0";
    document.getElementById("navbarLauncher").style.visibility = "visible";
}
    


window.addEventListener("DOMContentLoaded", function() {
   console.log('Scripts loaded!'); 
});
