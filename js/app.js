var map;
var src = '../assets/maps/full-trail.kml';

/**
 * Initializes the map and calls the function that creates polylines.
 */
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: new google.maps.LatLng(-41, 174),
    zoom: 6,
    mapTypeId: google.maps.MapTypeId.TERRAIN
  });
  loadKmlLayer(src, map);
}

/**
 * Adds a KMLLayer based on the URL passed. 
 */
function loadKmlLayer(src, map) {
  var kmlLayer = new google.maps.KmlLayer(src, {
    suppressInfoWindows: true,
    preserveViewport: false,
    map: map
  });
}
