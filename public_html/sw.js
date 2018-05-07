importScripts('js/cache-polyfill.js');

var CACHE_VERSION = 'app-v1.3';
var CACHE_FILES = [
    '/',
    'images/logo.png',
    'images/avatar.png',
    'images/gm-fallback.png',
    'images/code.jpeg',
    'images/bg-main3.jpeg',
    'uploads/images/default.jpg',
    'uploads/images/code.jpeg',
    'uploads/images/codegenerator1.png',
    'uploads/images/kanciarz1.png',
    'images/portfolio/kanciarz1.png',
    'images/portfolio/tequilaplatformer1.png',
    'images/portfolio/spaceinvaders1.png',
    'images/portfolio/furyroad1.png',

    'webfonts/fa-regular-400.woff2',
    'webfonts/fa-regular-400.woff',
    'webfonts/fa-regular-400.ttf',

    'webfonts/Lato-Regular.ttf',
    'webfonts/Raleway-Light.ttf',

    'css/normalize.min.css',
    'css/fa-regular.min.css',
    'css/fontawesome-all.min.css',
    'css/style.css',

    'icons/manifest.json',

    'js/script.js',
    'js/jquery/jquery-1.12.4.min.js',
    'js/external.js',
    'js/showdown/showdown.min.js',
    'js/translate.js',
    'js/worker.js',
    'js/markdown.js',
    'js/cookieconsent.js',

    'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit',
    'https://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad1f6633ca8b854',
    'https://www.google.com/recaptcha/api.js',
];


self.addEventListener('install', function (event) {
    event.waitUntil(
        caches.open(CACHE_VERSION)
            .then(function (cache) {
                console.log('Opened cache');
                return cache.addAll(CACHE_FILES);
            })
    );
});

self.addEventListener('activate', function (event) {
    event.waitUntil(
        caches.keys().then(function(keys){
            return Promise.all(keys.map(function(key, i){
                if(key !== CACHE_VERSION){
                    return caches.delete(keys[i]);
                }
            }))
        })
    )
});

self.addEventListener('fetch', function (event) {
    event.respondWith(
        caches.match(event.request).then(function(res){
            if(res){
                return res;
            }
            requestBackend(event);
        })
    )
});

function requestBackend(event){
    var url = event.request.clone();
    return fetch(url).then(function(res){
        //if not a valid response send the error
        if(!res || res.status !== 200 || res.type !== 'basic'){
            return res;
        }

        var response = res.clone();

        caches.open(CACHE_VERSION).then(function(cache){
            cache.put(event.request, response);
        });

        return res;
    })
}