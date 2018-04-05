/*
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 * 
 */


function googleTranslateElementInit() {
    // $.ajax({ 
    //     url: "http://ajaxhttpheaders.appspot.com", 
    //     dataType: 'jsonp', 
    //     success: function(headers) {
    //         language = headers['Accept-Language'];
    //         console.log(language);
    //     }
    // });
    // pl-PL,pl;q=0.9,en-US;q=0.8,en;q=0.7


    //var language = window.navigator.userLanguage || window.navigator.language;
    //console.log(language);
    //language = 'en-US'

    
    new google.translate.TranslateElement({pageLanguage: 'pl'}, 'google_translate_element');
    
};