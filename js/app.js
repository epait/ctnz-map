function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 6,
    center: {lat: -41, lng: 174}
  });
  console.log('map loaded');

  var ctaLayer = new google.maps.KmlLayer({
    url: 'http://www.ericpait.com/clients/nz-map/assets/maps/full-trail.kmz',
    suppressInfoWindows: true,
    map: map
  });
  console.log('kml loaded');
}
