var mymap = L.map('mapid').setView([51.505, -0.09], 13);

var polygon = L.polygon([
  [51.509, -0.08],
  [51.503, -0.06],
  [51.51, -0.047]
]).addTo(mymap).on('click', onMapClick);

var polygon2 = L.polygon([
  [51.509, -0.2],
  [51.503, -0.06],
  [51.51, -0.047],
  [50.51, -0.047]
]).addTo(mymap);

var popup = L.popup()
  .setLatLng([51.5, -0.09])
  .setContent("I am a standalone popup.")
  .openOn(mymap);

function onMapClick(e) {
  alert("You clicked the map at " + e.latlng);
}

// mymap.on('click', onMapClick);