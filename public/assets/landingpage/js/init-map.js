var map;
var warungDelisaCoordinate = [0.2551085101855161, 111.7803947581801];
var initialZoom = 17;
var maxZoom = 19;

function createTileLayer(url, subdomains = null) {
  let attr = { maxZoom };
  if (subdomains != null) {
    attr.subdomains = subdomains;
  }
  return L.tileLayer(url, attr);
}

function createMarker(coordinates, iconUrl, draggable = false) {
  var icon = L.icon({
    iconUrl: iconUrl,
    iconSize: [25, 25]
  });
  return L.marker(coordinates, { icon: icon, draggable: draggable });
}

function initMap(id, formLat, formLng, textJarak) {
  // Layer peta
  var osm = createTileLayer(
    "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
  );
  var esriLayer = createTileLayer(
    "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}"
  );
  var dark = createTileLayer(
    "https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png",
    "abcd"
  );
  var googleStreets = createTileLayer(
    "http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}",
    ["mt0", "mt1", "mt2", "mt3"]
  );
  var googleSat = createTileLayer(
    "http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}",
    ["mt0", "mt1", "mt2", "mt3"]
  );

  // Marker
  var markerOrigin = createMarker(
    warungDelisaCoordinate,
    "assets/landingpage/libs/leaflet/images/red_marker.png",
    false
  );
  var markerDestination = createMarker(
    warungDelisaCoordinate,
    "assets/landingpage/libs/leaflet/images/black_marker.png",
    true
  );

  // Control layer peta
  var baseMaps = {
    "Google Street Map": googleStreets,
    "Google Satellite Map": googleSat,
    "Open Street Map": osm,
    "Esri Map": esriLayer,
    "Dark Map": dark
  };
  // Control Scale peta
  var scale = L.control.scale({ position: "bottomright" });
  // Route Control
  var control = L.Routing.control({
    waypoints: [
      L.latLng(warungDelisaCoordinate), // Marker Origin
      L.latLng(warungDelisaCoordinate) // Marker Destination (awalnya sama dengan Origin)
    ],
    routeWhileDragging: true,
    fitSelectedRoutes: false,
    createMarker: function(i, wp, nWps) {
      if (i === 0) {
        // Marker Origin
        return markerOrigin;
      }
    }
  });
  // Define map
  map = L.map(id).setView(warungDelisaCoordinate, initialZoom);
  markerOrigin.addTo(map);
  markerDestination.addTo(map);
  googleStreets.addTo(map);
  L.control.layers(baseMaps).addTo(map);
  scale.addTo(map);
  control.addTo(map);
  // Event
  map.on("click", function(event) {
    var clickedLatLng = event.latlng;
    markerDestination.setLatLng(clickedLatLng);
    control.setWaypoints([
      L.latLng(warungDelisaCoordinate), // Marker Origin
      clickedLatLng // Marker Destination yang baru
    ]);
    // Perbarui input lat dan lng dengan nilai yang baru
    formLat.value = clickedLatLng.lat.toFixed(6);
    formLng.value = clickedLatLng.lng.toFixed(6);
  });

  markerDestination.on("dragend", function(event) {
    var newPosition = event.target.getLatLng();
    markerDestination.setLatLng(newPosition);
    control.setWaypoints([
      L.latLng(warungDelisaCoordinate), // Marker Origin
      newPosition // Marker Destination yang baru
    ]);
    formLat.value = newPosition.lat.toFixed(6); // Simpan lat
    formLng.value = newPosition.lng.toFixed(6); // Simpan lng
  });

  control.on("routeselected", function(e) {
    var route = e.route;
    var distance = route.summary.totalDistance; // Jarak dalam meter
    // var distanceInKm = (distance / 1000).toFixed(2); // Jarak dalam kilometer dengan 2 desimal

    // Lakukan sesuatu dengan nilai jarak, misalnya, tampilkan di elemen HTML
    textJarak.innerHTML = distance + " meter dari jarak Warung Sayur D'Lisa";
  });
}

function toggleFullscreen(map) {
  var elem = document.getElementById(map);
  if (!document.fullscreenElement) {
    elem.requestFullscreen().catch(err => {
      alert(`Error attempting to enable fullscreen mode: ${err.message}`);
    });
  } else {
    document.exitFullscreen();
  }
}