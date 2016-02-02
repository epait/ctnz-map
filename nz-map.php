<?php
/**
 * Template Name: New Zealand Map
 */
?>

<!doctype html>
<html clang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Comfort Theory - Te Araroa Trail</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style type="text/css" media="screen">
            @import url(https://fonts.googleapis.com/css?family=Poppins);
            @import url(https://fonts.googleapis.com/css?family=Open+Sans);

            html, body { height: 100%; margin: 0; padding: 0; font-family: "Open Sans";}

            #map { height: 750px; }

            .popoverWrapper {
                width: 350px;
                height: 400px;

                background: #ffffff;
            }

            .custom-iw {
                width: 350px !important;
                height: 350px !important;
            }

            .gm-style-iw {
               width: 350px !important;
               height: 350px !important;
               top: 0 !important;
               left: 0 !important;
               background-color: #fff;
               box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
            }

            .popoverTnail {
                height: 200px;
            }

            .popoverTnail img {
                width: 100%;
                height: 100%;
            }

            .popoverHeading {
                padding: 15px 15px 0 15px;

                font-size: 18px;
                font-weight: bold;
                font-family: "Poppins";
            }

            .popoverExcerpt {
                padding: 10px 15px 15px 15px;

                font-size: 13px;
            }

            .popoverReadMore {
                padding: 0 0 15px 15px;
                font-size: 13px;
            }    
        </style>
    </head>
    <body>
        <div id="map"></div>
        <div id="map-mobile"></div>

        <!-- convert team location to usable js -->
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php echo '<script> var regionIndex = ', the_field('team_location'), ';</script>' ?>
            <?php endwhile; ?>
        <?php endif; ?>

        <!-- query posts and create a js object of all data to be used by google maps -->
        <?php query_posts('posts_per_page=5&cat=39'); ?>
        <?php if (have_posts()) : ?>
            <?php echo '<script> var stories = ['?>
            <?php while (have_posts()) : the_post(); ?>
                <!-- get data required from each post -->
                <?php
                  $myExcerpt = get_the_excerpt();
                  $tags = array("<p>", "</p>");
                  $myExcerpt = str_replace($tags, "", $myExcerpt);

                  $post_thumbnail_id = get_post_thumbnail_id($post->ID);
                  $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                ?>
                <!-- JS object template -->
                <?php echo '{' ?>
                <?php echo 'tnail: "', $post_thumbnail_url, '",' ?>
                <?php echo 'heading: "', the_title(), '",' ?> 
                <?php echo 'excerpt: "', $myExcerpt, '",' ?>
                <?php echo 'lat: ', the_field('latitude'), ',' ?>
                <?php echo 'lng: ', the_field('longitude'), ',' ?>
                <?php echo 'url: "', the_permalink(), '"' ?>
                <?php echo '},' ?>
            <?php endwhile; ?>
            <?php echo ']; </script>' ?>  
        <?php endif; ?>

        <!-- grab theme uri to auto-generate root url for assets -->
        <?php $themeURI = get_template_directory_uri (); ?>
        <?php echo '<script> var themeURL = "', $themeURI, '"; </script>' ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script>
            // root url for assets
            var rootURL = themeURL + '-child/';

            // map styles
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

            // regions for recentering the map and changing route file to track progress
            var regions = [
                {
                    region: "Northland",
                    mapFile: "northland.kmz",
                    mobileMap: "",
                    lat: -35.312818, 
                    lng: 174.120425
                },
                {
                    region: "Auckland",
                    mapFile: "auckland.kmz",
                    mobileMap: "auckland.png",
                    lat: -36.661662, 
                    lng: 174.729893
                },
                {
                    region: "Waikato/King Country",
                    mapFile: "waikato.kmz",
                    mobileMap: "waikato.png",
                    lat: -38.342415, 
                    lng: 175.180517
                },
                {
                    region: "Whanganui",
                    mapFile: "whanganui.kmz",
                    mobileMap: "whanganui.png",
                    lat: -39.480183,
                    lng: 175.042876,
                },
                {
                    region: "Manawatu",
                    mapFile: "manawatu.kmz",
                    mobileMap: "manawatu.png",
                    lat: -40.347577, 
                    lng: 175.661774
                },
                {
                    region: "Wellington",
                    mapFile: "wellington.kmz",
                    mobileMap: "wellington.png",
                    lat: -40.877625, 
                    lng: 175.132276
                },
                {
                    region: "Nelson/Marlborough",
                    mapFile: "nelson.kmz",
                    mobileMap: "nelson.png",
                    lat: -41.158708, 
                    lng: 174.811306
                },
                {
                    region: "Canterbury",
                    mapFile: "canterbury.kmz",
                    mobileMap: "canterbury.png",
                    lat: -43.318859, 
                    lng: 171.385248
                },
                {
                    region: "Otago",
                    mapFile: "otago.kmz",
                    mobileMap: "otago.png",
                    lat: -44.672289, 
                    lng: 169.010526
                },
                {
                    region: "Southland",
                    mapFile: "southland.kmz",
                    mobileMap: "southland.png",
                    lat: -45.54547200000001, 
                    lng: 167.935174
                }
            ];

            

            function initMap() {
              var styledMap = new google.maps.StyledMapType(styles,
                {name: "Styled Map"});

              var currentLat = regions[regionIndex].lat;
              var currentLng = regions[regionIndex].lng;

              var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8,
                center: {lat: currentLat, lng: currentLng},
                scrollwheel: false,
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
                url: rootURL + '/kmz/' + regions[regionIndex].mapFile,
                suppressInfoWindows: true,
                preserveViewport: true,
                map: map
              });

              map.setOptions({styles: styles});
              map.mapTypes.set('map_style', styledMap);
              map.setMapTypeId('map_style');

              // generate markers
              var markerImage = {
                url: rootURL + "ct-pin.png",
                size: new google.maps.Size(128,128),
                origin: new google.maps.Point(0,0),
                anchor: new google.maps.Point(23,45),
                scaledSize: new google.maps.Size(45,45)
              };

              // create info window instance
              var infowindow = new google.maps.InfoWindow({
                 content: ' '
              });

              // create markers for each story
              for (i = 0; i < stories.length; i++) {
                myLatLng = new google.maps.LatLng(stories[i].lat,stories[i].lng);
                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    icon: markerImage
                });

                createInfoWindow(map, marker, infowindow, stories[i].heading, stories[i].excerpt, stories[i].tnail, stories[i].url);
              }

              initMobileMap('map-mobile');
            }

            function initMobileMap(container) {
              $('#' + container).append("<img id='map-mobile-img' src='" + rootURL + 'mobile-maps/' + regions[regionIndex].mobileMap + "'>");
            }

            function createInfoWindow(map, marker, infowindow, heading, excerpt, tnail, url) {
                var contentString = '<div class="popoverWrapper" id="' + heading.split(' ').join('-') + '">' +
                    '<div class="popoverTnail"><img src="' + tnail + '"></div>' +
                    '<div class="popoverHeading">' + heading + '</div>' +
                    '<div class="popoverExcerpt">' + excerpt.substring(0,100) + '...</div>' +
                    '<div class="popoverReadMore"><a href="' + url + '" target="_blank">Read More</a></div>' +
                    '</div>'    

                marker.addListener('mouseover', function() {
                    infowindow.setContent(contentString);
                    infowindow.open(map, marker);
                });

                // marker.addListener('mouseout', function() {
                //     infowindow.close(map, marker);
                // });

                /*
                 * The google.maps.event.addListener() event waits for
                 * the creation of the infowindow HTML structure 'domready'
                 * and before the opening of the infowindow defined styles
                 * are applied.
                 */
                google.maps.event.addListener(infowindow, 'domready', function() {

                   // Reference to the DIV which receives the contents of the infowindow using jQuery
                   var iwOuter = $('.gm-style-iw');

                   iwOuter.parent().addClass('custom-iw');

                   /* The DIV we want to change is above the .gm-style-iw DIV.
                    * So, we use jQuery and create a iwBackground variable,
                    * and took advantage of the existing reference to .gm-style-iw for the previous DIV with .prev().
                    */
                   var iwBackground = iwOuter.prev();

                   // Remove the background shadow DIV
                   iwBackground.children(':nth-child(2)').css({'display' : 'none'});

                   // Remove the white background DIV
                   iwBackground.children(':nth-child(4)').css({'display' : 'none'});

                   // Moves the infowindow to the right.
                   iwOuter.parent().parent().css({left: '-250px'});

                   // Moves the infowindow down.
                   iwOuter.parent().parent().css({top: '200px'});

                   // Hides arrow
                   iwBackground.children(':nth-child(3)').hide();
                   iwBackground.children(':nth-child(1)').hide();


                   var iwCloseBtn = iwOuter.next();

                   // style close button
                   iwCloseBtn.css({
                       'width' : '20px',
                       'height' : '20px',
                       'border-radius' : '10px',
                       'background-color' : 'white' 
                   });
                   iwCloseBtn.children(':nth-child(1)').css('margin', '3.3px');
                });
            }

        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCriEDkNLiJZ-qElr5g5jStu9wZylajHe8&callback=initMap" async defer></script>
    </body>
</html>