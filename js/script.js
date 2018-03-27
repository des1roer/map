var mymap = L.map('mapid').setView([51.505, -0.09], 13);

var polygon = L.polygon([
  [51.509, -0.08],
  [51.503, -0.06],
  [51.51, -0.047]
]).addTo(mymap)
  .on('click', onMapClick)
  .on('mouseover', onMapClick);

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
  // event.target.style.color = '#0000FF';
  // console.log($(event.target));
  polygon.setStyle({fillColor: '#0000FF'});
  // $(event.target).fillStyle="#FF0000";
  // console.log(event.target.style.color = '#0000FF')
  //event.target.setStyle({fillColor: '#0000FF'});
  
  // alert("You clicked the map at " + e.latlng);
}

// mymap.on('click', onMapClick);