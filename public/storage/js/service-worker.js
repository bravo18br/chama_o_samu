// const CACHE_NAME = 'chama-osamu-cache-v1';

// self.addEventListener('install', event => {
//     const urlsToCacheElement = document.getElementById('idUrlsToCache');
//     const urlsToCache = JSON.parse(urlsToCacheElement.value);
//     console.log(urlsToCache)
//     event.waitUntil(
//         caches.open(CACHE_NAME)
//             .then(cache => {
//                 return cache.addAll(urlsToCache);
//             })
//     );
// });

// self.addEventListener('fetch', event => {
//     event.respondWith(
//         caches.match(event.request)
//             .then(response => {
//                 if (response) {
//                     return response;
//                 }
//                 return fetch(event.request);
//             })
//     );
// });
