
{{-- test page--}}
<!-- <!DOCTYPE html>
<html>
  <head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 6
            });
            var infoWindow = new google.maps.InfoWindow({map: map});

            // Try HTML5 geolocation.
            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    console.log(pos);
                    /*infoWindow.setPosition(pos);
                    infoWindow.setContent('Location found.');
                    map.setCenter(pos);
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());*/
                });
            }else{
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                                  'Error: The Geolocation service failed.' :
                                  'Error: Your browser doesn\'t support geolocation.');
        }
    </script> -->
    <!-- <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARw1SIiaQjUQyJuqwJXu1YRnNUX81DXYk&callback=initMap">
    </script> -->
  <!--</body>
</html> -->

<!-- MAIN -->


<!DOCTYPE html> 
<html> 
<head> 
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/> 
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
    <title>Reverse Geocoding and geocoding</title>
    <style>
        /* Always set the map height explicitly to define the size of the div
        * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .map_div{
            width:500px;
            height:600px;
            margin-left: 100px;
            margin-top: 30px;
            border:2px solid #000;
        }
    </style> 
    <script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.

        var geocoder;
        function initMap() {
            
            initialize();

            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 6
            });
            var infoWindow = new google.maps.InfoWindow({map: map});

            // Try HTML5 geolocation.
            if(navigator.geolocation){
                console.log('navigator');
                //navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;

                    /*test code*/


                    var point = new google.maps.LatLng(lat, lng);
                    new google.maps.Geocoder().geocode({'latLng': point}, function (res,status) {
                        var zip = res[0].formatted_address.match(/,\s\w{2}\s(\d{5})/);
                        console.log(zip); 
                    });

                    /*test code*/

                    codeLatLng(lat, lng);

                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    //console.log(position.address.postalCode);
                    infoWindow.setPosition(pos);
                    infoWindow.setContent('You are here');
                    map.setCenter(pos);
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            }else{
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                                  'Error: The Geolocation service failed.' :
                                  'Error: Your browser doesn\'t support geolocation.');
        }
    </script>

    <!--Map Script -->
    
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARw1SIiaQjUQyJuqwJXu1YRnNUX81DXYk&callback=initMap">
    </script>
    <!-- Map Script Close-->

    <!--Reverse geocoder linked with geolocation -->
    <script type="text/javascript"> 

        function errorFunction(){
            alert("Geocoder failed");
        }

        function initialize() {
            console.log('initialize');
            geocoder = new google.maps.Geocoder();
        }

        function codeLatLng(lat, lng){
            console.log('here');

            var latlng = new google.maps.LatLng(lat, lng);
            geocoder.geocode({'latLng': latlng}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    console.log(results)
                    if (results[1]) {
                        //formatted address
                        //alert(results[0].formatted_address)
                        //find country name
                        for (var i=0; i<results[0].address_components.length; i++) {
                            for (var b=0;b<results[0].address_components[i].types.length;b++) {

                                //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                                //console.log(results[0].address_components[i])
                                if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                                    //this is the object you are looking for
                                    state= results[0].address_components[i];
                                    break;
                                }
                                if (results[0].address_components[i].types[b] == "postal_code"){
                                    zip=results[0].address_components[i];
                                    break;
                                }
                                if (results[0].address_components[i].types[b] == "administrative_area_level_2"){
                                    city=results[0].address_components[i];
                                    break;
                                }
                                if (results[0].address_components[i].types[b] == "country"){
                                    country=results[0].address_components[i];
                                    break;
                                }
                            }
                        }


                        
                        // //city data
                        // alert(city.short_name + " " + city.long_name);
                        // //zipcode
                        // alert(zip.long_name);
                        // //state
                        // alert(state.long_name);
                        var location_data= {
                            'city': city.long_name,
                            'state':state.long_name,
                            'country':country.long_name,
                            'zip':zip.long_name
                        };

                        requestAjax(location_data);
                    }else{
                        alert("No results found");
                    }
                }else{
                    alert("Geocoder failed due to: " + status);
                }
            });
        }

        function requestAjax(data){
            console.log(data);
            $.ajax({
                url: 'map_data',
                type: 'GET',
                //dataType: "json",
                data: data,

                success: function(response){
                    console.log('success: '+response['response']);

                },

                error: function(response){
                    console.log('error: '+response['response']);
                }

            });
        }


    </script> 
    <!-- Reverse geocoder linked with geolocation closed -->
    
</head>

<body> 
    <div class="map_div">
        <div id="map"></div>  
        <div id="location"></div>  
    </div>
    
    
</body> 
</html>  


<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->


<!-- <!DOCTYPE html>
<html>
  <head>
    <title>Place searches</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var map;
      var infowindow;

      function initMap() {
        var pyrmont = {lat: -33.867, lng: 151.195};


        map = new google.maps.Map(document.getElementById('map'), {
          center: pyrmont,
          zoom: 15
        });

        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
          location: pyrmont,
          radius: 500,
          type: ['store']
        }, callback);
      }

      function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
            console.log(results[i]);
          }
        }
      }

      function createMarker(place) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          infowindow.open(map, this);
        });
      }
    </script>
  </head>
  <body>
    <div id="map"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARw1SIiaQjUQyJuqwJXu1YRnNUX81DXYk&libraries=places&callback=initMap" async defer></script>
  </body>
</html>





if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
       var lat = position.coords.latitude;
       var long = position.coords.longitude;

       var point = new google.maps.LatLng(lat, long);
       new google.maps.Geocoder().geocode({'latLng': point}, function (res,    status) {
                    var zip = res[0].formatted_address.match(/,\s\w{2}\s(\d{5})/);
         $("#location").val(zip);          
  });
 });
 }