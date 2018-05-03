/*
 * MIT License
 *
 * Copyright (c) 2018 Piotr Wróblewski
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 *
 */
class CookieConsent {
    constructor() { }
    static e(el) {
        return document.getElementById(el);
    }
    static createCookie(name, value, expires, path, domain) {
        var cookie = name + "=" + escape(value) + ";";
        if (expires) {
            if (expires instanceof Date) {
                if (isNaN(expires.getTime()))
                    expires = new Date();
            }
            else
                expires = new Date(new Date().getTime() + parseInt(expires) * 1000 * 60 * 60 * 24);
            cookie += "expires=" + expires.toGMTString() + ";";
        }
        if (path)
            cookie += "path=" + path + ";";
        if (domain)
            cookie += "domain=" + domain + ";";
        document.cookie = cookie;
    }
    static getCookie(name) {
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split('; ');
        for (let i = 0; i < ca.length; i++) {
            if (ca[i] == name) {
                return true;
            }
        }
        return false;
    }
    static check() {
        if (!this.getCookie('wpcookieconsent=1')) {
            let divEl = document.createElement('div');
            divEl.className = "cookieconsent";
            let divElSpan = document.createElement('span');
            let divElText = document.createTextNode('Powiadomienie o ciasteczkach');
            divElSpan.appendChild(divElText);
            let divElButton = document.createElement('button');
            let divElButtonText = document.createTextNode('Rozumiem');
            let css = '.cookieconsent {display:flex;flex-direction:row;justify-content:space-between;position:fixed;bottom:0;left:0;color:#eeeeee;background-color:#333333;width:100%;z-index:101;padding:10px 15px; }'
                + '.cookieconsent button {background-color:#ff0d5f;color:#eeeeee;padding:6px 10px;border:none;border-radius:2px;} '
                + '.cookieconsent button:hover {cursor:pointer; background-color: #ef0e4f} ';
            let style = document.createElement('style');
            style.appendChild(document.createTextNode(css));
            divEl.appendChild(style);
            divElButton.appendChild(divElButtonText);
            var self = this;
            divElButton.onclick = function () {
                self.createCookie("wpcookieconsent", "1", 1, "/", "wroblewskipiotr.pl");
                divEl.style.display = 'none';
            };
            divEl.appendChild(divElSpan);
            divEl.appendChild(divElButton);
            document.body.appendChild(divEl);
        }
    }
    static deleteCookie(name, path, domain) {
        if (this.getCookie(name))
            this.createCookie(name, "", -1, path, domain);
    }
}
CookieConsent.check();
//# sourceMappingURL=cookieconsent.js.map