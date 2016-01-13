function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 6,
    center: {lat: -41, lng: 174}
  });

  var ctaLayer = new google.maps.KmlLayer({
    url: 'http://ericpait.com/te-araroa-trail-map.kmz',
    map: map,
    suppressInfoWindows: true
  });
}