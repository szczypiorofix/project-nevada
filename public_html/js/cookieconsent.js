/*
 * MIT License
 *
 * Copyright (c) 2018 Piotr Wróblewski
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 *
 */
var CookieConsent = /** @class */ (function () {
    function CookieConsent() {
    }
    CookieConsent.prototype.e = function (el) {
        return document.getElementById(el);
    };
    CookieConsent.prototype.disableNotification = function () {
        var d = new Date();
        d.setTime(d.getTime() + (this.expireDays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = "wpcookieconsent=1;" + expires + ";path=/";
    };
    CookieConsent.prototype.check = function () {
        var decodedCookie = decodeURIComponent(document.cookie);
        var cookieObject;
        var ca = decodedCookie.split(';');
        //for (let i = 0; i < ca.length; i++) {
        //cookieObject.ca[i] = 'dupa';
        //let s = ca[i].split("=");
        //}
        console.log(cookieObject);
    };
    return CookieConsent;
}());
var cookieConsent = new CookieConsent();
cookieConsent.check();
//cookieConsent.disableNotification();
//# sourceMappingURL=cookieconsent.js.map