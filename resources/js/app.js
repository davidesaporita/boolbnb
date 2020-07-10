require('./bootstrap');
var places = require('places.js');

var placesAutocomplete = places({
    appId: '9QSPY7L0O0',
    apiKey: 'd25a64af1d653a0ab3b7267cecad4728',
    container: document.querySelector('#search')
});