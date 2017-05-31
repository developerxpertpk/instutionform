@extends('layouts.forumfinder_default')
@section('user_content')
<!-- banner and search portion  -->
<div class="container padding_zero crousel_container">
	<section class="search_banner">
		<div id="slidermy" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img src="image\school1.jpg" alt="First slide">
				</div>
				
				<div class="item">
					<img src="image\school3.jpg" alt="Second slide">
				</div>
				
				<div class="item">
					<img src="image\school2.jpg" alt="Second slide">
				</div>
				<div class="container">
					<div class="carousel-caption">
						<h1>Find the best schools</h1>
						
						<div class="pad-top-120">
							<p>How does schools works ?</p>
							<p><a class="btn btn-lg btn-primary" href="{{ url('/register') }}" role="button">Sign up today</a></p>
						</div>
					</div>
					
				</div>
			</div>
			
			<a class="left carousel-control" href="#slidermy" role="button" data-slide="prev">
				<span class="fa fa-chevron-left crousel_icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#slidermy" role="button" data-slide="next">
				<span class="fa fa-chevron-right crousel_icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
		<div class="search-container">
			<form class="form-horizontal" role="form" method="GET"  enctype="multipart/form-data" action="search_location">
        	{{ csrf_field() }}
			
				<div class="container search_control">
					<div class="col-xs-12 col-sm-4">
						<input type="text" class="form-control input-lg" name="location" placeholder="Search the location">
					</div>
					<div class="col-xs-12 col-sm-6">
						<input type="text" class="form-control input-lg" name="school_name" placeholder="Enter the name of school ">
					</div>
					<div class="col-xs-12 col-sm-2">
						<button type="submit" class="btn btn-success btn-lg">Search</button>
					</div>
					@if(Session::has('search_failed'))
						<div class="col-sm-12 text-center">
							<span class="src_err">{{ Session::get('search_failed') }}</span>
						</div>
					@endif
				</div>
			</form>	
		</div>
	</section>
</div>
	

@if(isset($schools_byName) || isset($schools_byLocation))
	<section class="search_results">
		<div class="container">
			<h2>Search Results</h2>
			<p>
				<strong>Showing results for:
					@if(isset($message_1) && isset($message_2))
						{{ $message_1." & ".$message_2 }}
					@elseif(isset($message_1))
						{{ $message_1 }}
					@elseif(isset($message_2))
						{{ $message_2 }}
					@endif
				</strong>
			</p>
			<table class="table table-striped table-hover">
				@if(isset($schools_byName))
					@if($schools_byName->count())
							<tbody>
								@foreach($schools_byName as $schools)
									<tr>
										<td>
											{{ $schools->school_name}}
										</td>
										<td>
											{{ $schools->locations->city.", ".$schools->locations->state.", ".$schools->locations->country}}
										</td>
										<td>
											<a href="{{url('/show_school/'.$schools->id)}}">
												<button type="submit" class="btn btn-primary  btn-xs">View</button>
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
					@else
						<?php $count=1; ?>	
					@endif		
				@endif
				@if(isset($schools_byLocation))
					@if($schools_byLocation->count())
						<tbody>
								@foreach($schools_byLocation as $schools)
									@if(count($schools->schools['school_name']))
										<tr>
											<td>
												{{ $schools->schools['school_name']}}
											</td>
											<td>
												{{ $schools->city.", ".$schools->state.", ".$schools->country}}
											</td>
											<td>
												<a href="{{url('/show_school/'.$schools->schools['id'])}}">
													<button type="submit" class="btn btn-primary  btn-xs">View</button>
												</a>
											</td>
										</tr>
									@endif
								@endforeach
							</tbody>
					@else
						<?php $count=1; ?>
					@endif
				@endif
			</table>
			@if(!empty($count))
				<h3>Sorry, School Not Found</h3>
			@endif
		</div>
	</section>
@endif

<!--Features portion-->
<section class="features">
	<div id="slider" class="carousel slide" data-ride="carousel">
		<div class="container">
			<h2>Featured School</h2>
			<span class="col-sm-12 text-center">(this section is for future use)</span>
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<div class="col-xs-12 col-sm-3 Main_features">
						<img src="{{asset('image\oakridge.png')}}">
						<h3 class="first-slide">Oakridge International....</h3>
						<h5>Chandigarh</h5>
						<p>This school is affiliated by Central Board of Education,provide all facilities to students.</p>
					</div>
					
					<div class="col-xs-12 col-sm-3 Main_features">
						<img src="image\school4.png">
						<h3 class="first-slide">Delhi Public School</h3>
						<h5>Srinagar</h5>
						<p>DPS is a co-educational senior secondary school in the Srinagar district of Jammu and Kashmir state, India. </p>
						
					</div>
					
					<div class="col-xs-12 col-sm-3 Main_features">
						<img src="image\sps.png">
						<h3 class="first-slide">Shivalik Public School</h3>
						<h5>Mohali</h5>
						<p>This is a Co-ed school with 378 students and scores a facility rating of 2.33 out of 5. </p>
					</div>
					
					<div class="col-xs-12 col-sm-3 Main_features">
						<img src="image\eicher.png">
						<h3 class="first-slide">Eicher School</h3>
						<h5>Sector 46, Faridabad</h5>
						<p>This is a Co-ed school with 378 students and scores a facility rating of 2.33 out of 5. </p>
					</div>
				</div>
				
				<div class="item">
					<div class="col-xs-12 col-sm-3 Main_features">
						<img src="image\little.png">
						<h3 class="first-slide">Little Angles High....</h3>
						<h5>Sonipat</h5>
						<p>This is a Co-ed school with 378 students and scores a facility rating of 2.33 out of 5. </p>
					</div>
					
					<div class="col-xs-12 col-sm-3 Main_features">
						<img src="image\army.png">
						<h3 class="first-slide">B.Z.S.F.S public....</h3>
						<h5>Fatehgarah Sahib,Punjab</h5>
						<p>The school is affiliated to Punjab School Education Board Under the 10+2 with all streams.</p>
					</div>
					
					<div class="col-xs-12 col-sm-3 Main_features">
						<img src="image\gfs.png">
						<h3 class="first-slide">Green Field School</h3>
						<h5>Mohali</h5>
						<p>The school is affiliated to Central Board of Secondary Education Under the 10+2.</p>
					</div>
					
					<div class="col-xs-12 col-sm-3 Main_features">
						<img src="image\comb.png">
						<h3 class="first-slide">Cambridge International....</h3>
						<h5>Amritsar,Punjab</h5>
						<p>This is a Co-ed school with 378 students and scores a facility rating of 2.33 out of 5. </p>
					</div>
				</div>
				<a class="left carousel-control" href="#slider" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#slider" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
	</div>
</section>

<section class="container-fluid tab_schools">
	<div class="texts text-center">
		<div class="container">
			<h2>Popular streams</h2>
			<h4>Select your preferred and explore stream dream</h4>
		</div>
	</div>
	<div class="container">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#Commerce" aria-controls="Commerce" role="tab" data-toggle="tab"> Commerce</a></li>
			<li role="presentation"><a href="#Medical" aria-controls="Medical" role="tab" data-toggle="tab">Medical</a></li>
			<li role="presentation"><a href="#Non-Medical" aria-controls="Non-Medical" role="tab" data-toggle="tab">Non-Medical</a></li>
			<li role="presentation"><a href="#Arts" aria-controls="Arts" role="tab" data-toggle="tab">Arts</a></li>
			
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="Commerce">
				<div class="col-xs-12 col-sm-3"><img  src="image/commerce.jpg"></div>
				<div class="heading col-xs-12 col-sm-9">
					<h3>Commerce stream is still a very popular choice among Indian
					students who have passed 10th standard. Briefly.</h3>
					<p>
						Commerce stream is still a very popular choice among Indian
						students who have passed 10th standard. Briefly, it seemed like Science stream and its popularity had tarnished the image
						of Commerce stream. It made it look like this stream was reserved for students who were not too bright.
						
					</p>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane " id="Medical">
				<div class="col-xs-12 col-sm-3"><img  src="image/Medical.jpg"></div>
				<div class="heading col-xs-12 col-sm-9">
					<h3>Medical stream is still a very popular choice among Indian
					students who have passed 10th standard.  </h3>
					<p>
						Medical stream is still a very popular choice among Indian
						students who have passed 10th standard. Briefly, it seemed like Science stream and its popularity had tarnished the image
						of Medical stream. It made it look like this stream was reserved for students who were not too bright.
						It made it look like this stream was reserved for students who were not too bright.
						
					</p>
				</div>
			</div>
			
			<div role="tabpanel" class="tab-pane" id="Non-Medical">
				<div class="col-xs-12 col-sm-3"><img  src="image/non.jpg"></div>
				<div class="heading col-xs-12 col-sm-9">
					<h3>Non-Medical stream is still a very popular choice among Indian
					students who have passed 10th standard.</h3>
					<p>
						Non-Medical stream is still a very popular choice among Indian
						students who have passed 10th standard. Briefly, it seemed like Science stream and its popularity had tarnished the image
						of Non-Medical stream. It made it look like this stream was reserved for students who were not too bright.
					</p>
				</div>
			</div>
			
			<div role="tabpanel" class="tab-pane" id="Arts">
				
				<div class="col-xs-12 col-sm-3"><img  src="image/arts.jpg"></div>
				<div class="heading col-xs-12 col-sm-9">
					<h3>Arts stream is still a very popular choice among Indian
					students who have passed 10th standard.</h3>
					
					<p>
						Arts stream is still a very popular choice among Indian
						students who have passed 10th standard. Briefly, it seemed like Science stream and its popularity had tarnished the image
						of Arts stream. It made it look like this stream was reserved for students who were not too bright.
					</p>
				</div>
			</div>
			
			
			
		</div>
	</section>
	
	<!--Trending Schools-->
	<section class="Trend_School">
		<div class="container">
			<h2>Trending Schools</h2>
			<h5>Explore the school that are currently popular</h5>
			@if(isset($popular_schools) && count($popular_schools))
				@foreach($popular_schools as $school)
					<a href="{{url('show_school/'.$school->schools->id)}}" title="{{$school->schools->school_name}}">
						<div class="col-xs-12 col-sm-3 t_school">
							<img src="@if(count($school->schools->school_images) && count($school->schools->school_images->where('image_type','=',1))) {{asset('upload/schools/school_'.$school->id.'/images/profile_pic/current_dp/'.$school->schools->school_images->where('image_type','=',1))}} @else {{asset('upload/def_school.png')}} @endif">
							<h5>{{$school->schools->school_name}}</h5>
						</div>
					</a>
				@endforeach
			@else
				<div class="alert alert-warning">
				  	<strong>Error!</strong> No data found.
				</div>
			@endif
			<!-- <div class="col-xs-12 col-sm-3 t_school">
				<img src="image\dpsschool.png">
				<h5>Delhi Public School,Srinagar</h5>
			</div>
			
			<div class="col-xs-12 col-sm-3 t_school">
				<img src="image\sps.png">
				<h5>Shivalik Public School,Srinagar</h5>
			</div>
			
			<div class="col-xs-12 col-sm-3 t_school">
				<img src="image\comb.png">
				<h5>Combridge international School,Srinagar</h5>
			</div>
			<div class="col-xs-12 col-sm-3 t_school">
				<img src="image\gfs.png">
				<h5>Green Field School,Srinagar</h5>
			</div>
			
			<div class="col-xs-12 col-sm-3 t_school">
				<img src="image\army.png">
				<h5>Army Publi School,Srinagar</h5>
			</div>
			<div class="col-xs-12 col-sm-3 t_school">
				<img src="image\school4.png">
				<h5>Combridge international School,Srinagar</h5>
			</div>
			<div class="col-xs-12 col-sm-3 t_school">
				<img src="image\eicher.png">
				<h5>Eicher School,Srinagar</h5>
			</div> -->
			
		</div>
	</section>

	<section class="Trend_School">
		<div class="container nearBy_container">
		</div>
	</section>
	
	<!--Guidance portion-->
	<section class="Guidance padding_btm">
		<div class="container">
			<h2>Guidance</h2>
			<span class="col-sm-12 text-center">(this section is for future use)</span>
			<div class="col-xs-12 col-sm-6 guide query">
				<div class="media">
					<div class="media-left">
						<a href="#">
							<img class="media-object" src="image\student2.png">
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Media heading <small>demo</small></h4>
						<p>This site provided me with latest information on schools.
							Regular reminders on important deadlines helped me stay on top of all my college and exam applications.
							<h6>Ritu Bhardwaj Teacher Shivalik Public School,Srinagar</h6>
						</p><button type="submit" class="btn btn-primary btn-xs">Read More</button>
					</div>
				</div>
				<div class="media">
					<div class="media-left">
						<a href="#">
							<img class="media-object" src="image\teach.png">
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Media heading <small>demo</small></h4>
						<p>This site provided me with latest information on colleges and exams.
							Regular reminders on important deadlines helped me stay on top of all my college and exam applications.
							<h6>Pawan Uppal Teacher Delhi Public School,Delhi</h6>
						</p>
						<button type="submit" class="btn btn-primary  btn-xs">Read More</button>
					</div>
				</div>
			</div>
			<!--form-->
			<div class="col-xs-12 col-sm-6 guide">
				<div class="media">
					<div class="media-left">
						<a href="#">
							<img class="media-object" src="image\gg.png">
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Media heading <small>demo</small></h4>
						<p>This site provided me with latest information on schools.
							Regular reminders on important deadlines helped me stay on top of all my college and exam applications.
							<h6>Simpy Dora Teacher Green Field School,Mohali</h6>
						</p><button type="submit" class="btn btn-primary  btn-xs">Read More</button>
					</div>
				</div>
				<div class="media">
					<div class="media-left">
						<a href="#">
							<img class="media-object" src="image\student1.png">
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading">Media heading <small>demo</small></h4>
						<p>This site provided me with latest information on colleges and exams.
							Regular reminders on important deadlines helped me stay on top of all my college and exam applications.
							<h6>Neha Thakur Teacher Army Public School,Mumbai</h6>
						</p>
						<button type="submit" class="btn btn-primary  btn-xs">Read More</button>
					</div>
				</div>
				
			</div>
		</div>
	</section>
</form>

<!-- - - - Location Scripts - - - -->

<!-- User location Access and retriving School results Dynamically Script -->
<!-- <script src="{{ asset('js/location_functioning.js') }}" type="text/javascript"></script> -->
<script type="text/javascript">
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
                        console.log("No results found");
                    }
                }else{
                    console.log("Geocoder failed due to: " + status);
                }
            });
        }

        function requestAjax(data){


            console.log(data);
            $.ajax({
                url: "{{url('map_data')}}",
                type: 'GET',
                // dataType: "JSON",
                //processData:false,
                data: data,

                success: function(response){

                    console.log('success');
                    console.log(response);

                    if(response==false){
                        console.log('empty: '+response);
                    }else{

                        
                        //console.log(JSON.stringify(response));
                        // console.log(JSON.parse(JSON.stringify(response)));

                        $('.nearBy_container').append("<h2>Nearby Schools</h2><h5>Explore the schools next to you</h5>");

                        // var data=JSON.parse(JSON.stringify(response));
                        var school_data = response.results;
                        var image_data = response.images;

                        	for(var i = 0; i < school_data.length; i++){
                        		// console.log(school_data.id);
	                            $('.nearBy_container').append("<a class='nearBy_school' href='show_school/"+school_data[i].school_id+"'><div class='col-xs-12 col-sm-3 t_school n_school'><img src="+(image_data[i] != null ? 'upload/schools/school_'+school_data[i].school_id+'/images/profile_pic/current_dp/'+image_data[i] : 'upload/def_school.png' )+"><h5>"+school_data[i].school_name+"</h5></div>");
	                            //console.log(school.id);
                        	}
                        
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
</script>
<!-- Map Script -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARw1SIiaQjUQyJuqwJXu1YRnNUX81DXYk&callback=initMap"></script>

<!-- - - - End of Scripts - - - -->
@endsection