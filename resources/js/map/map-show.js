
import L from 'leaflet'

let lat = document.querySelector('#lat').value
let lng = document.querySelector('#lng').value

let showMap = L.map('show-map', {
    zoomControl: false,
    boxZoom: false,
    doubleClickZoom: false,
    dragging: false,
    keyboard: false,
    scrollWheelZoom: false
}).setView([lat, lng], 13);

let marker = L.marker([lat, lng]).addTo(showMap);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiY2FybWlsZW50aXNjbyIsImEiOiJja2NjNnRmYjcwMXMyMnlwdXg0ZDYxM3JwIn0.Zg-CS3Rc5Krle5GllL7reQ', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'your.mapbox.access.token'
}).addTo(showMap);