const Handlebars = require("handlebars")
var places = require('places.js');
import L from 'leaflet'
import $ from 'jquery'
var placesAutocomplete = places({
    appId: 'plUKJGFB9TS3',
    apiKey: '8311a9eeb21c1dc5b519abf85c0854c6',
    container: document.querySelector('#search'),
})

let apartmentContainer = $('#apartment-list')
let source = $("#template-card-home").html();
let template = Handlebars.compile(source);
let url = window.location.protocol + '//' + window.location.host + '/' +'api/search/query';
let radius = 20;
let urlParams = new URLSearchParams(window.location.search);
let latUrl = getParameterByName('geo_lat')
let lngUrl = getParameterByName('geo_lng')
let search = L.map('search-map', {
                  zoomControl: false,
                  boxZoom: false,
                  doubleClickZoom: false,
                  dragging: false,
                  keyboard: false,
                  scrollWheelZoom: false
              }).setView([latUrl, lngUrl], 14);


////////////////////////////////////////////////////////////////

let wifi = document.querySelector('#wifi');



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
    let geoLat =                 res['geo_lat'];
    let geoLng =                 res['geo_lng'];
    
    let marker = L.marker([geoLat, geoLng]).addTo(search);
    
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

placesAutocomplete.on('change', (e) => {
  let searchResult = e.suggestion;
  let lat = searchResult.latlng['lat'];
  let lng = searchResult.latlng['lng'];
  
  search.setView([ lat, lng], 14);
  apartmentContainer.html(" ");

  console.log( checkedService(wifi))

  if ( checkedService(wifi) ) {
    wifi.value = 1;
  } else {
    wifi.value = 0;
  }

  $.ajax({
    url,
    method: "GET",
    data: {
        geo_lat : lat,
        geo_lng : lng, 
        radius : radius,
        wifi
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
      let geoLat =                 res['geo_lat'];
      let geoLng =                 res['geo_lng'];

      let marker = L.marker([geoLat, geoLng]).addTo(search);
      
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

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiY2FybWlsZW50aXNjbyIsImEiOiJja2NjNnRmYjcwMXMyMnlwdXg0ZDYxM3JwIn0.Zg-CS3Rc5Krle5GllL7reQ', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      maxZoom: 18,
      id: 'mapbox/streets-v11',
      tileSize: 512,
      zoomOffset: -1,
      accessToken: 'your.mapbox.access.token'
}).addTo(search);

function checkedService( service ) {
  return service.checked; 
}