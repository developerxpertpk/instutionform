
$(document).ready(function() {

    initMap();

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 21.170240,lng: 72.831061},
            zoom: 4,
        });
        infoWindow = new google.maps.InfoWindow;

        // var marker = new google.maps.Marker({
        //     position:{lat: 21.170240,lng: 72.831061},
        //     map: map
        // });
    }

});

    function getLocation() {

        var zip = $('.zip').val();
        getAddressInfoByZip(zip);
        return false;
    }

    function response(obj) {
        console.log(obj);
    }

    function getAddressInfoByZip(zip) {
        //console.log(zip.length); return false;

        if (zip.length >= 5 && typeof google != 'undefined') {

            var addr = {};
            var lat = '';
            var lng = '';

            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({'address': zip}, function (results, status) {


                if (status == google.maps.GeocoderStatus.OK) {
                    if (results.length >= 1) {

                        for (var ii = 0; ii < results[0].address_components.length; ii++) {

                            var street_number = route = street = city = state = zipcode = country = formatted_address = '';
                            var types = results[0].address_components[ii].types.join(",");

                            if (types == "street_number") {
                                addr.street_number = results[0].address_components[ii].long_name;
                            }
                            if (types == "route" || types == "point_of_interest,establishment") {
                                addr.route = results[0].address_components[ii].long_name;
                            }
                            if (types == "sublocality,political" || types == "locality,political" || types == "neighborhood,political" || types == "administrative_area_level_3,political" || types == "administrative_area_level_2,political") {
                                addr.city = (city == '' || types == "locality,political") ? results[0].address_components[ii].long_name : city;

                            }
                            if (types == "administrative_area_level_1,political"|| types == "administrative_area_level_2,political") {
                                addr.state = results[0].address_components[ii].short_name;
                            }
                            if (types == "postal_code" || types == "postal_code_prefix,postal_code") {
                                addr.zipcode = results[0].address_components[ii].long_name;
                            }
                            if (types == "country,political") {
                                addr.country = results[0].address_components[ii].long_name;
                            }
                                console.log(results[0].address_components[ii]);
                            userlat = results[0].geometry.location.lat();
                            userlng = results[0].geometry.location.lng();
                        }

                        if(addr.city == null){
                            addr.city = addr.state;
                        }


                        $('#countryId').removeAttr('value');
                        $('#stateId').removeAttr('value');
                        $('#cityId').removeAttr('value');
                        $('#lat').removeAttr('value');
                        $('#long').removeAttr('value');
                        $('#countryId').val(addr.country);
                        $('#stateId').val(addr.state);
                        $('#cityId').val(addr.city);
                        $('#lat').val(userlat);
                        $('#long').val(userlng);

                        addr.success = true;
                        for (name in addr) {
                            console.log('### google maps api ### ' + name + ': ' + addr[name]);
                        }
                        console.log('Latitude: ' + userlat + ' Logitude: ' + userlng);
                        response(addr);


                        initMapper(userlat, userlng);
                    } else {
                        alert("Geocode was not successful for the following reason: " + status);
                    }
                } else {
                    response({success: false});
                }
            });
        } else {

            response({success: false});
        }
        return false;
    }

    function initMapper(userlat, userlng) {
        var latlng = {lat: userlat, lng: userlng}
        var map = new google.maps.Map(document.getElementById('map'), {
            center: latlng,
            zoom: 12
        });

        var marker = new google.maps.Marker({
            position: latlng,
            map: map
        });

        return false;
    }
