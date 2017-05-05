      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.

        var geocoder;
        function initMap() {
            
            initialize();

            /*var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 6
            });
            var infoWindow = new google.maps.InfoWindow({map: map});*/

            // Try HTML5 geolocation.
            if(navigator.geolocation){
                console.log('navigator');
                //navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;

                    codeLatLng(lat, lng);

                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    //console.log(position.address.postalCode);
                    /*infoWindow.setPosition(pos);
                    infoWindow.setContent('You are here');
                    map.setCenter(pos);*/
                }, function() {
                    // handleLocationError(true, infoWindow, map.getCenter());
                });
            }else{
                // Browser doesn't support Geolocation
                // handleLocationError(false, infoWindow, map.getCenter());
            }
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                                  'Error: The Geolocation service failed.' :
                                  'Error: Your browser doesn\'t support geolocation.');
        }

        function errorFunction(){
            console.log("Geocoder failed");
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
                                if (results[0].address_components[i].types[b] == "locality"){
                                    locality=results[0].address_components[i];
                                    break;
                                }
                                if (results[0].address_components[i].types[b] == "route"){
                                    route=results[0].address_components[i];
                                    break;
                                }
                            }
                        }


                        //results[0].geometry[i]
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
                            'zip':zip.long_name,
                            'latitude':lat,
                            'longitude':lng
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
                // dataType: "JSON",
                //processData:false,
                data: data,

                success: function(response){

                    console.log('success');

                    if(response==false){
                        console.log('empty: '+response);
                    }else{

                        
                        //console.log(JSON.stringify(response));
                        // console.log(JSON.parse(JSON.stringify(response)));

                        $('.nearBy_container').append("<h2>Nearby Schools</h2><h5>Explore the schools next to you</h5>");

                        var data=JSON.parse(JSON.stringify(response));
                        data.forEach(function(item,index){

                            // console.log('item'+item);
                            // console.log('index'+index);
                            
                            console.log(item);
                            $('.nearBy_container').append("<a class='nearBy_school' href='show_school/"+item.id+"'><div class='col-xs-12 col-sm-3 t_school'><img src="+(!item.image ? 'upload/def_school.png' : 'upload/'+item.image)+"><h5>"+item.school_name+"</h5></div>");
                            //console.log(item.id);


                        });
                        
                        // console.log(data['1'].id);

                    }
                    //console.log(response);
                    //alert(JSON.stringify(response));
                    //console.log(JSON.stringify(response));
                    // console.log('success:'+JSON.stringify(response));

                },

                error: function(response){
                    console.log('error: '+JSON.stringify(response));
                }

            });
        }