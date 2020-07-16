// Inizializzazione di Handlebars
const Handlebars = require("handlebars")
// Import Mappa + Place.js
var places = require('places.js');
import L from 'leaflet'
// jQuery
import $ from 'jquery'

//--- Inizializzazione Algolia search ---//
var placesAutocomplete = places({
    appId: 'plUKJGFB9TS3',
    apiKey: '8311a9eeb21c1dc5b519abf85c0854c6',
    container: document.querySelector('#search'),
})

// Test Funzionamento Handlebars Template
var apartmentContainer = $('#apartment-list')
var source = $("#template-card-home").html();
var template = Handlebars.compile(source);

let url = window.location.protocol + '//' + window.location.host + '/' +'api/search/query';
let radius = 20;

// Ricerca dalla home in search
const urlParams = new URLSearchParams(window.location.search);

let latUrl = getParameterByName('geo_lat')
let lngUrl = getParameterByName('geo_lng')

$.ajax({
  url,
  method: "GET",
  data: {
      geo_lat : latUrl,
      geo_lng : lngUrl, 
      radius : radius
  },
}).done(function(result) {

  if ( result.length === 0 ) {
    console.log('Non vi sono appartamenti in zona');
  }

  console.log(result)
  
  for ( let key in result ) {
      
    let res = result[key];
    
    let pathImg =                res['featured_img'];
    let altImage =               res['title'];
    let title =                  res['title'];
    let apartmentID =            res['id'];
    let apartmentCity =          res['city'];
    let apartmentRegion =        res['region'];
    let apartmentProvince =      res['province'];
    let apartmentDescription =   res['description'];
    let distance =               res['distance'];

    
    var apartment = {

      image: pathImg = pathImg.includes("://") ? pathImg : "http://127.0.0.1:8000/storage/" + pathImg,
      altImage,
      title, 
      apartmentID,
      apartmentCity,
      apartmentRegion,
      apartmentProvince,
      apartmentDescription,
      distance
    
    };
    
    var html = template(apartment);
    apartmentContainer.append(html)
  }

  

}).fail(function() {

  console.log('Ajax Request Error')

})

// Ricerca nella pagina search
placesAutocomplete.on('change', (e) => {

  let searchResult = e.suggestion;
  let lat = searchResult.latlng['lat'];
  let lng = searchResult.latlng['lng'];

  apartmentContainer.html(" ");

  $.ajax({
    url,
    method: "GET",
    data: {
        geo_lat : lat,
        geo_lng : lng, 
        radius : radius
    },
  }).done(function(result) {

    if ( result.length === 0 ) {
      console.log('Non vi sono appartamenti in zona');
    }

    console.log(result)
    
    for ( let key in result ) {
        
      let res = result[key];
      
      let pathImg =                res['featured_img'];
      let altImage =               res['title'];
      let title =                  res['title'];
      let apartmentID =            res['id'];
      let apartmentCity =          res['city'];
      let apartmentRegion =        res['region'];
      let apartmentProvince =      res['province'];
      let apartmentDescription =   res['description'];
      let distance =               res['distance'];

      
      var apartment = {

        image: pathImg = pathImg.includes("://") ? pathImg : "http://127.0.0.1:8000/storage/" + pathImg,
        altImage,
        title, 
        apartmentID,
        apartmentCity,
        apartmentRegion,
        apartmentProvince,
        apartmentDescription,
        distance
      
      };
      
      var html = template(apartment);
      apartmentContainer.append(html)
    }

  }).fail(function() {

    console.log('Ajax Request Error')

  })

})

function getParameterByName(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, '\\$&');
  var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
      results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, ' '));
}
