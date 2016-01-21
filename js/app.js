var rootURL = 'http://www.ericpait.com/clients/nz-map/';

var styles = [
  {
    featureType: "water",
    stylers: [
      { color: '#B6CCE5' }
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
  		{ saturation: -60 }
  	]
  },
  {
  	featureType: "road",
  	stylers: [
  		{ color: "#dddddd" }
  	]
  },
  {
  	featureType: "administrative.province",
  	stylers: [
  		{ color: "#dddddd" }
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
  var styledMap = new google.maps.StyledMapType(styles,
    {name: "Styled Map"});

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 7,
    center: {lat: -39.480183, lng: 175.042876},
    streetViewControl: false,
    mapTypeControl: false,
    mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
    },
    zoomControlOptions: {
        position: google.maps.ControlPosition.LEFT_CENTER
    }
  });

  var ctaLayer = new google.maps.KmlLayer({
    url: rootURL + 'assets/maps/whanganui-gray.kmz',
    suppressInfoWindows: true,
    preserveViewport: true,
    map: map
  });

  map.setOptions({styles: styles});
  map.mapTypes.set('map_style', styledMap);
  map.setMapTypeId('map_style');
}
