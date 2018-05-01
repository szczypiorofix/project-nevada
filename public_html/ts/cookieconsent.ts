/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 * 
 */

class CookieConsent {

    private expireDays:number;

    constructor() {}

    private e(el: string) {
        return document.getElementById(el);
    }

    public disableNotification() {
        let d = new Date();
        d.setTime(d.getTime() + (this.expireDays * 24 * 60 * 60 * 1000));
        let expires = "expires="+d.toUTCString();
        document.cookie = "wpcookieconsent=1;"+expires+";path=/";
    }

    public check() {
        var decodedCookie = decodeURIComponent(document.cookie);
        
        var cookieObject:Object;

        var ca = decodedCookie.split(';');
        //for (let i = 0; i < ca.length; i++) {
            
            //cookieObject.ca[i] = 'dupa';
            
            //let s = ca[i].split("=");
            
        //}

        console.log(cookieObject);
    }

}

var cookieConsent = new CookieConsent();
cookieConsent.check();
//cookieConsent.disableNotification();
