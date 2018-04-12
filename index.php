<!DOCTYPE html>
<html>
<head>
    <title>Leaflet</title>
    <!--    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css"/>-->
    <!--    <script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script>-->

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>
</head>
<body>
<div style="height:500px" id="map"></div>

<script type='text/javascript'>
  var map = L.map('map', {
    center: [0, 0],
    zoom: 17
  });
  var states = [];
  // [{
  //   "type": "Feature",
  //   "properties": {
  //     "party": "Republican",
  //     'atata': 'dsfsdds'
  //   },
  //   "geometry": {
  //     "type": "Polygon",
  //     "coordinates": [[
  //       [10, 20],
  //       [10, 30],
  //       [30, 30],
  //       [30, 20],
  //     ]]
  //   }
  // }];
  var highlightStyle = {
    weight: 3,
    color: '#3B555C',
    dashArray: '',
    fillOpacity: 0.6
  };

  function getTile(i) {
    var len = 0.001;
    return {
      "type": "Feature",
      "properties": {
        "party": "Democrat",
        'atata': 'dsfsd'
      },
      "geometry": {
        "type": "Polygon",
        "coordinates": [[
          [i * len, i * len].reverse(),
          [i * len + len, i * len].reverse(),
          [i * len + len, i * len + 2 * (len)].reverse(),
          [i * len, i * len + 2 * (len)].reverse(),
        ]]
      }
    };
  }

  function highlightFeature(evt) {
    var feature = evt.target;
    console.log(evt.latlng);
    feature.setStyle(highlightStyle);
    if (!L.Browser.ie && !L.Browser.opera) {
      feature.bringToFront();
    }
  }

  //set up the feature iteration
  var onEachFeature = function (feature, layer) {
    // popUpFeature(feature, layer);
    layer.on({
      click: onMapClick,
      mousemove: highlightFeature
    });
  }

  function onMapClick(e) {

    states[states.length] = getTile(states.length);
    console.log(states)
    map.eachLayer(function (layer) {
      map.removeLayer(layer);
    });

    L.geoJson(states, {
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
    }).addTo(map)

    // alert("You clicked the map at " + e.latlng);
  }

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

  map.on('click', function (e) {
    onMapClick(e);
  });

</script>
</body>
</html>