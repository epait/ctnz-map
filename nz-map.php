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

            #map { height: 1000px; }

            .popoverWrapper {
                width: 350px;
                height: 400px;

                background: #ffffff;
                /*box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);*/
            }

            .custom-iw {
                width: 350px !important;
                height: 400px !important;
            }

            .gm-style-iw {
               width: 350px !important;
               top: 0 !important;
               left: 0 !important;
               background-color: #fff;
               box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
               /*border: 1px solid rgba(72, 181, 233, 0.6);*/
               /*border-radius: 2px 2px 0 0;*/
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

        <?php query_posts('posts_per_page=5&cat=1'); ?>
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <?php
              $myExcerpt = get_the_excerpt();
              $tags = array("<p>", "</p>");
              $myExcerpt = str_replace($tags, "", $myExcerpt);
              // echo $myExcerpt;

              $post_thumbnail_id = get_post_thumbnail_id($post->ID);
              $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
              // echo $post_thumbnail_url;
            ?>
            <?php echo '<script>' ?>
            <?php echo 'console.log("' , $post_thumbnail_url , '"); ' ?>
            <?php echo 'console.log("' , the_title() , '"); ' ?> 
            <?php echo 'console.log("' , $myExcerpt , '");' ?>
            <?php echo 'console.log(" ");' ?>
            <?php echo '</script>' ?>    
        <?php endwhile; ?>
        <?php endif; ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script>
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

            var regions = [
                {
                    region: "Northland",
                    lat: -35.312818, 
                    lng: 174.120425
                },
                {
                    region: "Auckland",
                    lat: -36.661662, 
                    lng: 174.729893
                },
                {
                    region: "Waikato/King Country",
                    lat: -38.342415, 
                    lng: 175.180517
                },
                {
                    region: "Whanganui",
                    lat: -39.480183,
                    lng: 175.042876,
                },
                {
                    region: "Manawatu",
                    lat: -40.347577, 
                    lng: 175.661774
                },
                {
                    region: "Wellington",
                    lat: -40.877625, 
                    lng: 175.132276
                },
                {
                    region: "Nelson/Marlborough",
                    lat: -41.158708, 
                    lng: 174.811306
                },
                {
                    region: "Canterbury",
                    lat: -43.318859, 
                    lng: 171.385248
                },
                {
                    region: "Otago",
                    lat: -44.672289, 
                    lng: 169.010526
                },
                {
                    region: "Southland",
                    lat: -45.54547200000001, 
                    lng: 167.935174
                }
            ];

            var stories = [
                {
                    heading: "In the storm",
                    excerpt: "Over the past week we’ve trekked some 200ks (120 miles). Eric and I started out 40ks behind the crew after the holiday and had to hustle to catch up. Most of time we had great weather, it was why we were able to make such good time. Being that it’s an island, the weather in New Zealand is almost always changing. You expect that any given day it’s going to be rainy, cloudy and/or brutally sunny. But occasionally like on our 6th day into this last stretch of the trail we find ourselves in the middle of a storm.",
                    tnail: "http://comforttheory.staging.wpengine.com/wp-content/uploads/2016/01/storm.jpg",
                    lat: -35.312818, 
                    lng: 174.120425
                },
                {
                    heading: "What a Year",
                    excerpt: "The last week of 2015 was symbolic of what the entire year was for me. Full of new experiences in new places. My 2015 adventure started when I moved to Australia on January 14th. I spent 7 months there traveling and working. Then I moved back to the States for September and October to see family, friends, and begin working for Comfort Theory. In November I moved to New Zealand to begin this crazy adventure. Here is a look at how our last week of 2015 went.",
                    tnail: "http://comforttheory.staging.wpengine.com/wp-content/uploads/2016/01/whatayear.jpg",
                    lat: -36.661662, 
                    lng: 174.729893
                },
                {
                    heading: "Another Christmas in New Zealand",
                    excerpt: "Doesn’t seem like too long ago that my cousin Erik, whom I had previously met 3 times, invited me to come stay with him and his family in New Zealand. At the time I was couch surfing in the small town of Moerzeke, Belgium trying to recover from a fever and terrible throat infection. In my recovery slumber I decided to take the jump and buy a ticket to New Zealand. I arrived just before Christmas and had my first holidays away from my family.",
                    tnail: "http://comforttheory.staging.wpengine.com/wp-content/uploads/2016/01/image-1.jpg",
                    lat: -38.342415, 
                    lng: 175.180517
                },
                {
                    heading: "My Te Araroa Anthem (So Far)",
                    excerpt: "It’s a familiar holiday in an unfamiliar hemisphere, and I take a long look around me. Four guys that were previously friends, or even just merely acquaintances, have become my family. I’m surrounded by my dream country, the island adventureland that used to scream my name every time I twirled a globe or unrolled a world atlas, magnetiziing me to it’s ocean-encompassed existence. The lush forest is behind me, roaring sea beside me, and a world of possibility in front of me among this group of former 9to5-ers gone fearless explorers.",
                    tnail: "http://comforttheory.staging.wpengine.com/wp-content/uploads/2015/12/image-2.jpg",
                    lat: -39.480183,
                    lng: 175.042876,
                },
                {
                    heading: "Team Becoming Family",
                    excerpt: "Month 1 is done. And what an incredible month it was. As I sit here in a pub at the base of Mt. Eden in Aukland, NZ sipping on a cold cider I am trying to wrap my brain around the world wind of adventure that just took place. Aukland is where this crazy New Zealand trip began, and here I am 600 kilometers later right back where it all started. I am 15 pounds lighter, full of facial hair, and unmeasurably more self confident in my physical and mental endurance. If I left Seattle walking south I would have passed Bend, Oregon 50 miles ago. ",
                    tnail: "http://comforttheory.staging.wpengine.com/wp-content/uploads/2015/12/img-1.jpg",
                    lat: -40.347577, 
                    lng: 175.661774
                },
                {
                    heading: "No Rules",
                    excerpt: "What the hell is a thru-hike? I’ve lost count of how many times I’ve been asked that question, or been given the puzzled head tilt and eyebrow scrunch that begs the question in a glorious nonverbal fashion. The more I’ve been asked this question, the more I start asking myself if I really do know the answer.",
                    tnail: "http://comforttheory.staging.wpengine.com/wp-content/uploads/2015/12/image-5-1.jpg",
                    lat: -40.877625, 
                    lng: 175.132276
                },
                {
                    heading: "The Beginning",
                    excerpt: "Two years ago I sat at my computer in San Diego, hungry for adventure. I had just gotten off the phone with one of my best friends, Filipe DeAndrade, who would later become my co-founder of Comfort Theory. Fil wouldn’t stop talking about his latest thru-hike on the Appalachian Trail. He spoke of personal discovery, transformation, and a mental, physical, and spiritual tipping point that he had reached out on the trail. He spoke of the boundaries he pushed, the fearless humans he connected with, and the new mindset he approached life with after his journey.",
                    tnail: "http://comforttheory.staging.wpengine.com/wp-content/uploads/2015/11/NZ_Header-3.jpg",
                    lat: -41.158708, 
                    lng: 174.811306
                },
                {
                    heading: "Ups & Downs",
                    excerpt: "90 Mile beach was a crazy way to start my career as a hiker. 5 straight days of beach walking with scarce fresh water sources and grueling sun exposure. When we finished stage one our team concluded that we in fact did not like “long walks on the beach.” We spent a day surfing in Ahipara and then headed in to Herekino Forest ready for some new scenery…and the challenge of bush walking.",
                    tnail: "http://comforttheory.staging.wpengine.com/wp-content/uploads/2015/12/image-6.jpg",
                    lat: -43.318859, 
                    lng: 171.385248
                },
                {
                    heading: "Muddy Nirvana",
                    excerpt: "\“Every single day something amazing happens.\” We’re in KeriKeri, our second resupply. The coffee is strong, but the memories are stronger. In just 5 days New Zealand has made its mark on our souls. We all knew this trip would be something truly extraordinary, but no one expected such monumental experiences to happen this quickly. Each day we witness the magic of this country that is quickly becoming our home.",
                    tnail: "http://comforttheory.staging.wpengine.com/wp-content/uploads/2015/11/image-4.jpg",
                    lat: -44.672289, 
                    lng: 169.010526
                },
                {
                    heading: "The Never Ending Beach",
                    excerpt: "We did it. The first stretch of the Te Araroa (pernounced Tee-Ah-Ray-Roh-Rah) gives a sublime first impression- the sweeping views as you make it past the famous lighthouse at Cape Reinga, walking down a jagged staircase that lines the bluff to reveal a sweeping ocean…",
                    tnail: "http://comforttheory.staging.wpengine.com/wp-content/uploads/2015/11/image-3.jpg",
                    lat: -45.54547200000001, 
                    lng: 167.935174
                }
            ];

            function initMap() {
              var styledMap = new google.maps.StyledMapType(styles,
                {name: "Styled Map"});

              var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 7,
                center: {lat: -39.480183, lng: 175.042876},
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
                url: rootURL + 'assets/maps/whanganui-map.kmz',
                suppressInfoWindows: true,
                preserveViewport: true,
                map: map
              });

              map.setOptions({styles: styles});
              map.mapTypes.set('map_style', styledMap);
              map.setMapTypeId('map_style');

              // generate markers
              var markerImage = {
                url: rootURL + "assets/img/ct-pin.png",
                size: new google.maps.Size(128,128),
                origin: new google.maps.Point(0,0),
                anchor: new google.maps.Point(23,45),
                scaledSize: new google.maps.Size(45,45)
              };

              var infowindow = new google.maps.InfoWindow({
                 content: ' '
              });

              for (i = 0; i < stories.length; i++) {
                myLatLng = new google.maps.LatLng(stories[i].lat,stories[i].lng);
                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    icon: markerImage
                });

                createInfoWindow(map, marker, infowindow, stories[i].heading, stories[i].excerpt, stories[i].tnail);
              }
            }

            function createInfoWindow(map, marker, infowindow, heading, excerpt, tnail) {
                var contentString = '<div class="popoverWrapper" id="' + heading.split(' ').join('-') + '">' +
                    '<div class="popoverTnail"><img src="' + tnail + '"></div>' +
                    '<div class="popoverHeading">' + heading + '</div>' +
                    '<div class="popoverExcerpt">' + excerpt.substring(0,250) + '...</div>' +
                    '<div class="popoverReadMore"><a href="">Read More</a></div>' +
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
                   iwOuter.parent().parent().css({left: '-260px'});

                   // Moves the infowindow down.
                   iwOuter.parent().parent().css({top: '240px'});

                   // Hides arrow
                   iwBackground.children(':nth-child(3)').hide();
                   iwBackground.children(':nth-child(1)').hide();

                   // Moves the infowindow down.
                   // iwOuter.parent().parent().css({top: '225px'});

                   var iwCloseBtn = iwOuter.next();

                   // hide close button
                   iwCloseBtn.hide();
                });
            }

        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCriEDkNLiJZ-qElr5g5jStu9wZylajHe8&callback=initMap" async defer></script>
    </body>
</html>