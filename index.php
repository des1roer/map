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
        [-104.05, 48.99],
        [-97.22, 48.98],
        [-96.58, 45.94],
        [-104.03, 45.94],
        [-104.05, 48.99]
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
        [-109.05, 41.00],
        [-102.06, 40.99],
        [-102.03, 36.99],
        [-109.04, 36.99],
        [-109.05, 41.00]
      ]]
    }
  }];

  //define map
  var map = new L.map("map").setView([40.1, -100], 4);

  map.removeLayer('map')

  //set up layer events
  function zoomToFeature(evt) {
    fitBounds(evt.target.getBounds());
  }

  function fitBounds(bounds) {
    map.fitBounds(bounds);
  }

  function highlightFeature(evt) {
    var feature = evt.target;
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
    popUpFeature(feature, layer);
    layer.on({
      mouseover: highlightFeature,
      mouseout: resetHighlight,
      click: zoomToFeature
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