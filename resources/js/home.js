var places = require('places.js');
import L from 'leaflet'

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
    
});
