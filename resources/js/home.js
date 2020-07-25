var places = require('places.js');
import $ from 'jquery'


//--- Inizializzazione Algolia search ---//
var placesAutocomplete = places({
    appId: 'plUKJGFB9TS3',
    apiKey: '8311a9eeb21c1dc5b519abf85c0854c6',
    container: document.querySelector('#search'),
})

// Refefrence
let lat  = document.querySelector('#geo_lat');
let lng  = document.querySelector('#geo_lng');
let city = document.querySelector('#city');

placesAutocomplete.on('change', (e) => {

    let searchResult = e.suggestion;
    
    lat.value  = searchResult.latlng['lat'];
    lng.value  = searchResult.latlng['lng'];
    city.value = searchResult.city;

})