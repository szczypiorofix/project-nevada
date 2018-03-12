/* 
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */

function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}

window.addEventListener("DOMContentLoaded", function() {
   console.log('Scripts loaded!'); 
});
