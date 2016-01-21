var rootURL = 'http://www.ericpait.com/clients/nz-map/';

var styles = [
  {
    featureType: "water",
    stylers: [
      { color: '#BAE8F5' }
    ]
  },
  {
  	featureType: "landscape",
  	stylers: [
  		{ color: "#f2f2f2" }
  	]
  },
  {
  	featureType: "poi",
  	stylers: [
  		{ color: "#f2f2f2" }
  	]
  },
  {
  	featureType: "road",
  	stylers: [
  		{ color: "#cccccc" }
  	]
  },
  {
    featureType: "road",
    elementType: "labels",
    stylers: [
      { visibility: "off" }
    ]
  },
  {
    featureType: "administrative.neighborhood",
    elementType: "labels",
    stylers: [
      { visibility: "off" }
    ]
  }
];

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 6,
    center: {lat: -41, lng: 174}
  });
  console.log('map loaded');

  var ctaLayer = new google.maps.KmlLayer({
    url: rootURL + 'assets/maps/whanganui.kmz',
    suppressInfoWindows: true,
    map: map
  });
  console.log('kml loaded');

  map.setOptions({styles: styles});
  console.log('map styles loaded');
}
