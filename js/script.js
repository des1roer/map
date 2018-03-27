var mymap = L.map('mapid').setView([51.505, -0.09], 13);

var i = 0;
var poli = [];
arr.forEach(function (element) {
  poli[i] = L.polygon(
    element
  ).addTo(mymap)
    .on('click', onMapClick);
  i++;
});

// var polygon = L.polygon(
//   arr
// ).addTo(mymap)
//   .on('click', function (polygon) {
//     console.log(polygon)
//   })
//  .on('mouseover', onMapClick);

var popup = L.popup()
  .setLatLng([51.5, -0.09])
  .setContent("I am a standalone popup.")
  .openOn(mymap);

function poly(e) {

}

function onMapClick(e) {
  var layer = e.target;
  layer.setStyle({
    weight: 5,
    color: '#666',
    dashArray: '',
    fillOpacity: 0.7
  });
  
  // console.log(polygon)
  // console.log(e)
  // // event.target.style.color = '#0000FF';
  // // console.log($(event.target));
  // polygon.setStyle({fillColor: '#b9ff3a'});
  // $(event.target).fillStyle="#FF0000";
  // console.log(event.target.style.color = '#0000FF')
  //event.target.setStyle({fillColor: '#0000FF'});
  
  // alert("You clicked the map at " + e.latlng);
}

// mymap.on('click', onMapClick);