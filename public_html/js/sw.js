// var cacheName = "offlinerocks";

// self.addEventListener("install", function(event) {
//     event.waitUntil(
//         caches.open(cacheName).then(function(cache) {
//             return cache.addAll([
//                 "offline.html"
//             ]);
//         })
//     );
// });

// self.addEventListener("fetch", function(event) {
//     event.waitUntil(
//         caches.keys().then(function(names) {
//             Promise.all(
//                 names.filter(function(name) {
//                     return name !== cacheName;
//                 }).map(function(name) {
//                     return caches.delete(name);
//                 })
//             )
//         })
//     )
// });

// self.addEventListener("fetch", function(event) {
//     event.respondWith(
//         caches.open(cacheName).then(function(cache) {
//             return cache.match(event.request);
//         })
//     )
// });


self.addEventListener('install', function(event){
	console.log(event);
});

self.addEventListener('activate', function(event){
    console.log(event);
});

self.addEventListener('fetch', function(event){
    console.log('Fetch event');
    console.log(event.request.url);
    // return something for each interception
});