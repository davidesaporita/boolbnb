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
var container = $('#apartment-list')
var source = $("#template-card-home").html();
var template = Handlebars.compile(source);

let url = window.location.protocol + '//' + window.location.host + '/' +'api/search/query';
let radius = 20;

// var slider = document.querySelector("#slider");
// let radius = document.querySelector("#slider-output");
// output.innerHTML = slider.value; 

// slider.oninput = function() {
//   output.innerHTML = this.value;
// }


placesAutocomplete.on('change', (e) => {

  let searchResult = e.suggestion;
  let lat = searchResult.latlng['lat'];
  let lng = searchResult.latlng['lng'];
  console.log(lat)
  console.log(lng)
  

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
      container.append(html)
    }

    

  }).fail(function() {

    console.log('Ajax Request Error')

  })

})


function imgUrl(pathImg) {

  

  console.log(pathImg)

  // if ( !pathImg.includes("http://") ) {
    
  //   return "http://127.0.0.1:8000/storage/" + pathImg;
    
  // } else {

  //   return pathImg;

  // }


}
