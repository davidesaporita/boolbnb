const Handlebars = require("handlebars");
import $ from 'jquery'

let reviewsContainer = $('#reviews-container');
let source           = $("#template-reviews-guest").html();
let template         = Handlebars.compile(source);
let first_name       = $("#first_name").val();
let last_name        = $("#last_name").val();
let apartment_id     = $("#apartment_id").val();
let title            = $("#title").val();
let body             = $("#body").html();
let urlReviewStore   = window.location.origin + '/reviews/store';

// Set ajax function

var data = {
    apartment_id,
    first_name,
    last_name,
    title,
    body
};

console.log(data);

$.ajax({
    url: urlReviewStore, 
    method: post,
    data: {
        apartment_id,
        first_name,
        last_name,
        title,
        body
    },
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

      let marker = L.marker([geoLat, geoLng], { icon: myIcon }).addTo(search);
      marker.bindPopup("<strong>" + title + "</strong>", {

      });

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