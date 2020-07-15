var places = require('places.js');
import L from 'leaflet'

var latlng = {
    lat: '45.493040',
    lng: '7.802840'
}

var placesAutocomplete = places({
    appId: 'plUKJGFB9TS3',
    apiKey: '8311a9eeb21c1dc5b519abf85c0854c6',
    container: document.querySelector('#search'),
}).configure({
    type: 'address',
    hitsPerPage: 10,
    aroundLatLng: lat + ',' + lng,
    aroundRadius: 20000
  });

placesAutocomplete.on('change', (e) => {
    e.suggestions
})

  placesAutocomplete.search().then(function(suggestions) {
    if (!suggestions[0]) {
      return;
    }
  
    // var name = suggestions[0].name;
    // var country = suggestions[0].country;
    // var formattedCity = locale_names[0] + ', ' + country;
  
    // var infoElt = document.querySelector("#reverse-city");
    // infoElt.value = formattedCity;

    console.log(suggestions);
  });