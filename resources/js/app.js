require('./bootstrap');
var places = require('places.js');

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

placesAutocomplete.on('change', function resultSelected(e) {
    document.querySelector('#address_2').value = e.suggestion.administrative || '';
    document.querySelector('#city').value = e.suggestion.city || '';
    document.querySelector('#zip_code').value = e.suggestion.postcode || '';
    document.querySelector('#geo_lat').value = e.suggestion.latlng['lat'] || '';
    document.querySelector('#geo_lng').value = e.suggestion.latlng['lng'] || '';
});
