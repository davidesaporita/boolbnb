// Inizializzazione di Handlebars
const Handlebars = require("handlebars")
// Import Mappa + Place.js
var places = require('places.js');
import L from 'leaflet'
// jQuery
import $ from 'jquery'
// Variabilit
let search = $('#search');
// var url = window.location.protocol + '//' + window.location.host + 'api/search/query';

//--- Inizializzazione Algolia search ---//
var placesAutocomplete = places({
    appId: 'plUKJGFB9TS3',
    apiKey: '8311a9eeb21c1dc5b519abf85c0854c6',
    container: document.querySelector('#search'),
})



placesAutocomplete.on('change', (e) => {
  let searchResult = e.suggestion;
  let lat = searchResult.latlng['lat'];
  let lng = searchResult.latlng['lng'];
  console.log(lat)
  console.log(lng)
  let radius = 20;

  $.ajax({
    url: window.location.protocol + '//' + window.location.host + '/' + 'api/search/query',
    method: "GET",
    data: {
        geo_lat : lat,
        geo_lng : lng, 
        radius : radius
    },
  }).done(function(result) {

    console.log(result)

  }).fail(function() {
    console.log('Ajax Error')
  })

})




/*
// Test Funzionamento Handlebars Template
var container = $('#apartment-list')
var source = $("#template-card-home").html();
var template = Handlebars.compile(source);


var context = {
    image: "Immagine",
    altImage : "Alt dell Immagine",
    title: "Titolo", 
    apartmentID: 1,
    apartmentCity: "Città" ,
    apartmentRegion: "regione",
    apartmentProvince:"Provincia",
    apartmentDescription:"Descrizione"
};

var html = template(context);
container.append(html)*/
