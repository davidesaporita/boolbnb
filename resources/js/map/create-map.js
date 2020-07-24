var places = require('places.js');
import L from 'leaflet'

let lat =  document.querySelector('#geo_lat')
let lng =  document.querySelector('#geo_lng')
let zipCode = document.querySelector('#zip_code') 
let city = document.querySelector('#city')
let province = document.querySelector('#province')
let country = document.querySelector('#country')
let region = document.querySelector('#region')

var placesAutocomplete = places({
    appId: 'plUKJGFB9TS3',
    apiKey: '8311a9eeb21c1dc5b519abf85c0854c6',
    container: document.querySelector('#search'),
    templates: {
        value: function(suggestion) {
            return suggestion.name;
        }
    }
}).configure({
    type: 'address'
});

var map = L.map('create-map', {
    zoomControl: false,
    boxZoom: false,
    doubleClickZoom: false,
    dragging: false,
    keyboard: false,
    scrollWheelZoom: false
});

var osmLayer = new L.TileLayer( 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        minZoom: 1,
        maxZoom: 13,
        attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
    }
);

var markers = [];

map.setView(new L.LatLng( 0, 0), 1);
map.addLayer(osmLayer);


placesAutocomplete.on('suggestions', handleOnSuggestions);
placesAutocomplete.on('cursorchanged', handleOnCursorchanged);
placesAutocomplete.on('change', handleOnChange);
placesAutocomplete.on('clear', handleOnClear);

function handleOnSuggestions(e) {
    markers.forEach(removeMarker);
    markers = [];

    if (e.suggestions.length === 0) {
        map.setView(new L.LatLng(0, 0), 1);
        return;
    }

    e.suggestions.forEach(addMarker);
    findBestZoom();
}

function handleOnChange(e) {
    markers
    .forEach(function(marker, markerIndex) {
    if (markerIndex === e.suggestionIndex) {
        markers = [marker];
        marker.setOpacity(1);
        findBestZoom();
    } else {
        removeMarker(marker);
    }

    region.value = e.suggestion.administrative || '';
    country.value = e.suggestion.country || '';
    province.value = e.suggestion.county || '';
    city.value = e.suggestion.city || '';
    zipCode.value = e.suggestion.postcode || '';
    lat.value = e.suggestion.latlng['lat'] || '';
    lng.value = e.suggestion.latlng['lng'] || '';

    });
}

function handleOnClear() {
    map.setView(new L.LatLng(0, 0), 1);
    markers.forEach(removeMarker);
}

function handleOnCursorchanged(e) {
    markers
    .forEach(function(marker, markerIndex) {
        if (markerIndex === e.suggestionIndex) {
            marker.setOpacity(1);
            marker.setZIndexOffset(1000);
        } else {
            marker.setZIndexOffset(0);
            marker.setOpacity(0.5);
        }
    });
}

function addMarker(suggestion) {
    var marker = L.marker(suggestion.latlng, {opacity: .4});
    marker.addTo(map);
    markers.push(marker);
}

function removeMarker(marker) {
    map.removeLayer(marker);
}

function findBestZoom() {
    var featureGroup = L.featureGroup(markers);
    map.fitBounds(featureGroup.getBounds().pad(0.5), {animate: false});
}


/////////////////////////////////////////// FILE POND TEST ////////////////////////////////////////

// Connesione agli input
const featuredImgInputElement = document.querySelector( '#featured_img' );

// Ottimizzazione prograssiva del caricamento dei file in base al browser
const featuredImgPond = FilePond.create( featuredImgInputElement, {
    
    // OPZIONI
    maxFiles: 1,            // File massimi caricabili
    checkValidity: true     // Controllo del tipo di file

});

console.log('Name: ' + featuredImgPond.name);
console.log('Max file: ' + featuredImgPond.maxFiles);
console.log('Required: ' + featuredImgPond.required);

// Setting del server

FilePond.setOptions({
    server: 'http://127.0.0.1:8000/'
});