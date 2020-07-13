require('./bootstrap');

var places = require('places.js');
import L from 'leaflet'

(function() {
 
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

    var map = L.map('mapid', {
        scrollWheelZoom: true,
        zoomControl: false
    });

    var osmLayer = new L.TileLayer( 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            minZoom: 1,
            maxZoom: 13,
            attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
        }
    );

    var markers = [];

    map.setView(new L.LatLng(0, 0), 1);
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

        console.log(e.suggestion);

        document.querySelector('#region').value = e.suggestion.administrative || '';
        document.querySelector('#country').value = e.suggestion.country || '';
        document.querySelector('#province').value = e.suggestion.county || '';
        document.querySelector('#city').value = e.suggestion.city || '';
        document.querySelector('#zip_code').value = e.suggestion.postcode || '';
        document.querySelector('#geo_lat').value = e.suggestion.latlng['lat'] || '';
        document.querySelector('#geo_lng').value = e.suggestion.latlng['lng'] || '';

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
})();