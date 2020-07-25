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
let source             = $("#template-card-home").html();
let template           = Handlebars.compile(source);
let url                = window.location.protocol + '//' + window.location.host + '/' +'api/search/query';
let urlParams          = new URLSearchParams(window.location.search);
let latUrl             = getParameterByName('geo_lat');
let lngUrl             = getParameterByName('geo_lng');
let nameUrl            = getParameterByName('name');
let addressUrl         = getParameterByName('address');
let search             = L.map('search-map', {
                            zoomControl: false,
                            boxZoom: false,
                            doubleClickZoom: false,
                            dragging: false,
                            keyboard: false,
                            scrollWheelZoom: false
}).setView([latUrl, lngUrl], 15);
let searchMobile            = L.map('search-map-mobile', {
                            zoomControl: false,
                            boxZoom: false,
                            doubleClickZoom: false,
                            dragging: false,
                            keyboard: false,
                            scrollWheelZoom: false
}).setView([latUrl, lngUrl], 15);

let wifi           = document.querySelector('#wifi');
let posto_macchina = document.querySelector('#posto_macchina');
let piscina        = document.querySelector('#piscina');
let portineria     = document.querySelector('#portineria');
let sauna          = document.querySelector('#sauna');
let vista_mare     = document.querySelector('#vista_mare');
let slider         = document.querySelector("#myRange");
let output         = document.querySelector("#show-km");
let minRooms       = document.querySelector('#rooms_number_min');
let minBeds        = document.querySelector('#beds_number_min');
let searchButton   = document.querySelector('#button-search');
let dataHome       =  {
  geo_lat : latUrl,
  geo_lng : lngUrl, 
  radius : radius 
};

let searchResultName = document.querySelector('#searchResultName');

document.querySelector('#search').value = addressUrl;

searchResultName.innerHTML = nameUrl; 

var myIcon = L.icon({
  iconUrl: 'img/mymarker.png',
  iconSize: [38, 50],
  iconAnchor: [22, 49],
  popupAnchor: [-3, -75],
});
let radius;
output.innerHTML = slider.value;
radius = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
  radius = this.value;
}

ajaxCall( url, 'GET', dataHome, template) 

placesAutocomplete.on('change', (e) => {
  
  let searchResult = e.suggestion;
  let lat          = searchResult.latlng['lat'];
  let lng          = searchResult.latlng['lng'];
  let cityResult   = searchResult.name;
  console.log(searchResult.name);
  search.setView([ lat, lng], 14);
  searchMobile.setView([ lat, lng], 14);
  apartmentContainer.html('');
  
  document.querySelector('#searchResultName').innerHTML
  searchResultName.innerHTML = cityResult;

  wifi.value           = checkedService(wifi)           ? 1 : 0;
  posto_macchina.value = checkedService(posto_macchina) ? 1 : 0;
  piscina.value        = checkedService(piscina)        ? 1 : 0;
  portineria.value     = checkedService(portineria)     ? 1 : 0;
  sauna.value          = checkedService(sauna)          ? 1 : 0;
  vista_mare.value     = checkedService(vista_mare)     ? 1 : 0;

  let dataSearch =  {
    geo_lat          : lat,
    geo_lng          : lng, 
    radius           : radius,
    wifi             : wifi.value,
    posto_macchina   : posto_macchina.value,
    piscina          : piscina.value,
    portineria       : portineria.value,
    sauna            : sauna.value,
    vista_mare       : vista_mare.value,
    rooms_number_min : minRooms.value,
    beds_number_min  : minBeds.value
  } 

  ajaxCall(url, 'GET', dataSearch, template) 

  searchButton.addEventListener('click', () => {
    
    apartmentContainer.html('');

    wifi.value           = checkedService(wifi)           ? 1 : 0;
    posto_macchina.value = checkedService(posto_macchina) ? 1 : 0;
    piscina.value        = checkedService(piscina)        ? 1 : 0;
    portineria.value     = checkedService(portineria)     ? 1 : 0;
    sauna.value          = checkedService(sauna)          ? 1 : 0;
    vista_mare.value     = checkedService(vista_mare)     ? 1 : 0;
    
    let dataFilter = {

      geo_lat          : lat,
      geo_lng          : lng, 
      radius           : radius,
      wifi             : wifi.value,
      posto_macchina   : posto_macchina.value,
      piscina          : piscina.value,
      portineria       : portineria.value,
      sauna            : sauna.value,
      vista_mare       : vista_mare.value,
      rooms_number_min : minRooms.value,
      beds_number_min  : minBeds.value
      
    }

    ajaxCall( url, 'GET', dataFilter, template) 
 
  })
})

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiY2FybWlsZW50aXNjbyIsImEiOiJja2NjNnRmYjcwMXMyMnlwdXg0ZDYxM3JwIn0.Zg-CS3Rc5Krle5GllL7reQ', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      maxZoom: 18,
      id: 'mapbox/streets-v11',
      tileSize: 512,
      zoomOffset: -1,
      accessToken: 'your.mapbox.access.token'
}).addTo(search);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiY2FybWlsZW50aXNjbyIsImEiOiJja2NjNnRmYjcwMXMyMnlwdXg0ZDYxM3JwIn0.Zg-CS3Rc5Krle5GllL7reQ', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      maxZoom: 18,
      id: 'mapbox/streets-v11',
      tileSize: 512,
      zoomOffset: -1,
      accessToken: 'your.mapbox.access.token'
}).addTo(searchMobile);

//---------- Function

function getParameterByName(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, '\\$&');
  var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
      results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

function checkedService( service ) {
  return service.checked; 
}

function ajaxCall(urlRecived, methodRecived, dataRecived, template) {

  $.ajax({
    url: urlRecived,
    method: methodRecived,
    data: dataRecived,
  }).done(function(result) {
    
    if ( result.length === 0 ) {
      console.log('Non vi sono appartamenti in zona');
      apartmentContainer.append( '<h1> Non vi sono appartamenti in zona </h1>' )
    }
  
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
      let sponsored =              res['sponsor_plans'].length > 0 ? 'Sponsorizzato' : null;
      let services =               res['services'];
      
      
      

      let marker = L.marker([geoLat, geoLng], { icon: myIcon }).addTo(search);
      let markerMobile = L.marker([geoLat, geoLng], { icon: myIcon }).addTo(searchMobile);
      marker.bindPopup("<strong>" + title + "</strong>", {});

      
      var apartment = {
  
        image: pathImg = pathImg.includes("://") ? pathImg : "http://127.0.0.1:8000/storage/" + pathImg,
        altImage,
        title, 
        apartmentID,
        apartmentCity,
        apartmentRegion,
        apartmentProvince,
        apartmentDescription,
        distance,
        sponsored,
      };
      
      var html = template(apartment);
      apartmentContainer.append(html)
    }
  
  
  }).fail(function() {
  
    console.log('Ajax Request Error')
  
  })
  

}


