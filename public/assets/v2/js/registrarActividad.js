$('document').ready(function(){
 var height = $(window).height();
 $("#register-map").css('height', height/1.2);
 function inicializarMap(latitud, longitud){
  if(latitud != null && longitud != null){
   $('#latitud').val(latitud);
   $('#longitud').val(longitud);
  }else{
   latitud = 6.25304;
   longitud = -75.56457;
  }
  var myIcon = L.icon({
   iconUrl: '/assets/v2/images/categories/icon-otra.svg',
   iconSize: [40, 40],
   iconAnchor: [22, 10]
  });

  var map = L.map('register-map', {
   center: [latitud, longitud],
   zoom: 12,
   fullscreenControl: true,
   fullscreenControlOptions: {
    position: 'topleft'
   }
  });
  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
   attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);

  var punto = L.marker([latitud, longitud], {
   icon: myIcon,
   draggable: false
  }).addTo(map);

  map.on('contextmenu', function(e) {
   console.log(e.latlng);
   punto.setLatLng(e.latlng);
   var latLng = punto.getLatLng();
   var lat = latLng.lat;
   var long = latLng.lng;
   console.log(lat);
   console.log(long);
   $('#latitud').val(lat);
   $('#longitud').val(long);
  });

  map.on('dblclick', function(e) {
   console.log(e.latlng);
   punto.setLatLng(e.latlng);
   var latLng = punto.getLatLng();
   var lat = latLng.lat;
   var long = latLng.lng;
   console.log(lat);
   console.log(long);
   $('#latitud').val(lat);
   $('#longitud').val(long);
  });
 }

function getPosition(position){
 var lat = position.coords.latitude;
 var long = position.coords.longitude;
inicializarMap(lat, long);
}
function error(msg){
alert("Ha ocurrido un error al obtener la ubicacion, deberas establecerla manualmente");
 inicializarMap(null, null);
}

 if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(getPosition, error);
 }else{
  error('not supported');
 }
 

});
