<!DOCTYPE html>
<html>
<head>
    <title>Leaflet</title>
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css"/>
    <script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script>
</head>
<body>
<div style="height:500px" id="map"></div>

<script type='text/javascript'>

  //set up styles & data

  var highlightStyle = {
    weight: 3,
    color: '#3B555C',
    dashArray: '',
    fillOpacity: 0.6
  }

  var states = [{
    "type": "Feature",
    "properties": {
      "party": "Republican",
      'atata': 'dsfsdds'
    },
    "geometry": {
      "type": "Polygon",
      "coordinates": [[
        [10, 20],
        [10, 30],
        [30, 30],
        [30, 20],
      ]]
    }
  }, {
    "type": "Feature",
    "properties": {
      "party": "Democrat",
      'atata': 'dsfsd'
    },
    "geometry": {
      "type": "Polygon",
      "coordinates": [[
        [0, 10],
        [0, 20],
        [20, 20],
        [20, 10],
      ]]
    }
  }];

  //define map
  var map = new L.map("map").setView([0, 0], 4);

  map.removeLayer('map')

  //set up layer events
  function zoomToFeature(evt) {
    fitBounds(evt.target.getBounds());
  }

  function fitBounds(bounds) {
    map.fitBounds(bounds);
  }
  function onMapClick(e) {
    alert("You clicked the map at " + e.latlng);
  }
  function onMapClick2(e) {
    console.log(e.latlng)
  }

  function highlightFeature(evt) {
    var feature = evt.target;
    console.log(evt.latlng);
    feature.setStyle(highlightStyle);
    if (!L.Browser.ie && !L.Browser.opera) {
      feature.bringToFront();
    }
  }

  function resetHighlight(evt) {
    statesLayer.resetStyle(evt.target);
  }

  function popUpFeature(feature, layer) {
    var popupText = "Yo, I'm a <b>" + feature.properties.party + "</b> y'all!<br>";
    layer.bindPopup(popupText);
  }

  //set up the feature iteration
  var onEachFeature = function (feature, layer) {
    // popUpFeature(feature, layer);
    layer.on({
      mouseover: highlightFeature,
      mouseout: resetHighlight,
      click: onMapClick,
      mousemove: onMapClick2,
    });
  }

  //add the stae layer
  statesLayer = L.geoJson(states, {
    style: function (feature) {
      console.log(feature.properties.atata)
      switch (feature.properties.party) {
        case 'Republican':
          return {color: "#ff0000"};
        case 'Democrat':
          return {color: "#0000ff"};
      }
    },
    onEachFeature: onEachFeature,
  }).addTo(map);

</script>
</body>
</html>