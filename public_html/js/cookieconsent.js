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
    static check(a) {
        if (!this.getCookie('wpcookieconsent=1')) {
            let divEl = document.createElement('div');
            divEl.className = "cookieconsent";
            let divElSpan = document.createElement('span');
            let readMoreLink = document.createElement('a');
            let readMoreLinkText = document.createTextNode(a.readMoreText);
            readMoreLink.appendChild(readMoreLinkText);
            readMoreLink.href = a.readMoreUrl;
            readMoreLink.target = "_blank";
            let divElText = document.createTextNode(a.title);
            divElSpan.appendChild(divElText);
            divElSpan.appendChild(readMoreLink);
            let divElButton = document.createElement('button');
            let divElButtonText = document.createTextNode(a.buttonText);
            let css = '.cookieconsent {display:flex;flex-direction:row;justify-content:space-between;position:fixed;bottom:0;left:0;color:' + a.textColor + ';background-color:' + a.backgroundColor + ';width:100%;z-index:101; }'
                + '.cookieconsent span {margin: 10px;height: auto;}'
                + '.cookieconsent button {background-color:' + a.buttonBackgroundColor + ';color:' + a.buttonTextColor + ';border:none;border-radius:2px;margin:10px;padding: 10px 20px; } '
                + '.cookieconsent button:hover {cursor:pointer;} '
                + '.cookieconsent span a {margin-left: 10px;color:' + a.textColor + '}';
            let style = document.createElement('style');
            style.appendChild(document.createTextNode(css));
            divEl.appendChild(style);
            divElButton.appendChild(divElButtonText);
            var self = this;
            divElButton.onclick = function () {
                /* Domena bez http/https !!! */
                /* Wykrywanie czy to localhost */
                let l = window.location.href;
                let domena = 'wroblewskipiotr.pl';
                if (l.startsWith('http://localhost/')) {
                    domena = 'localhost';
                }
                self.createCookie("wpcookieconsent", "1", 1, "/", domena);
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
CookieConsent.check({
    title: 'Z ciasteczkami na razie jeszcze nic nie robię ale muszę o nich informować :)',
    backgroundColor: '#333333',
    textColor: '#eeeeee',
    buttonText: 'Zrozumiałem!',
    buttonBackgroundColor: '#ff0d5f',
    buttonTextColor: '#eeeeee',
    readMoreText: 'Dowiedz się więcej',
    readMoreUrl: 'https://www.google.pl'
});
//# sourceMappingURL=cookieconsent.js.map