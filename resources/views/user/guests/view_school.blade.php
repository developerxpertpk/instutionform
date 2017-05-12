@extends('layouts.forumfinder_default')
@section('user_content')


@if(isset($particular_school))
	@if(count($particular_school))
		@foreach($particular_school as $school)
			<br/>
			<!-- Facebook Preview Tags -->
			<meta property="og:url"           content="{{Request::url()}}" />
	        <meta property="og:type"          content="website" />
	        <meta property="og:title"         content="{{$school->school_name}}" />
	        <meta property="og:description"   content="Here, you can find best schools and courses for your carrer" />
	        <meta property="og:description"   content="Here, you can find best schools and courses for your carrer" /><!-- 
	        <meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" /> -->
	        <!-- /Facebook Preview Tags Close -->

	        <!-- twitter preview tags -->
	        <link rel="canonical" href="{{ Request::url() }}">
	        <!-- /twitter preview tags -->
			<div class="container-fluid">
				<div class="container">
					<?php $count=0;  ?>
						@if(count($school->school_images))
							@foreach($school->school_images as $images)
								@if($images->image_type == 1)
									<div class="school_dp col-sm-5 padding_zero" style="height:250px;background-image: url('{{asset('upload/schools/school_'.$images->school_id.'/images/profile_pic/current_dp/'.$images->image)}}');background-size:cover; ">

	        							<meta property="og:image"         content="{{asset('upload/schools/school_'.$images->school_id.'/images/profile_pic/current_dp/'.$images->image)}}" />
	        						</div>
									<?php $count++; ?>
								@endif
								@if($count > 0)
									@break
								@endif
							@endforeach
							@if($count == 0)
								<div class="school_dp col-sm-5"  style="height:250px;background-image: url('{{asset('upload/def_school.png')}}');background-size:cover;">
									<meta property="og:image"         content="{{asset('upload/def_school.png')}}" />
								</div>
							@endif
						@else
							<div class="school_dp col-sm-5" style="height:250px;background-image: url('{{asset('upload/def_school.png')}}');background-size:cover;">
								<meta property="og:image"         content="{{asset('upload/def_school.png')}}" />
							</div>
						@endif 
					<div class="heading_box col-sm-6">
						<span class="col-sm-12">
							<h3>{{$school->school_name}}</h3>
							<h6>{{$school->locations->city}}, {{$school->locations->state}}, {{$school->locations->country}}</h6>

						</span>
						<div class="avg_rating_box col-sm-12">
							@if(isset($avg_rating))
								@if($avg_rating == 1)
									<span>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star-o" aria-hidden="true"></i>
										<i class="fa fa-star-o" aria-hidden="true"></i>
										<i class="fa fa-star-o" aria-hidden="true"></i>
										<i class="fa fa-star-o" aria-hidden="true"></i>
									</span>
								@endif
								@if($avg_rating == 2)
									<span>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star-o" aria-hidden="true"></i>
										<i class="fa fa-star-o" aria-hidden="true"></i>
										<i class="fa fa-star-o" aria-hidden="true"></i>
									</span>
								@endif
								@if($avg_rating == 3)
									<span>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star-o" aria-hidden="true"></i>
										<i class="fa fa-star-o" aria-hidden="true"></i>
									</span>
								@endif
								@if($avg_rating == 4)
									<span>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star-o" aria-hidden="true"></i>
									</span>
								@endif
								@if($avg_rating == 5)
									<span>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
									</span>
								@endif
							@else
								<p>No ratings yet</p>
							@endif
						</div>
						<span class="col-sm-12">
							
							@if(Auth::check() && isset($school->bookmarked_schools) && count($school->bookmarked_schools->where('user_id',Auth::id())))
								<i class="fa fa-bookmark bookmark_icon_glow" title="{{$school->id}}" id="bookmark_icon" aria-hidden="true"></i>
							@else
								<i class="fa fa-bookmark bookmark_class" title="{{$school->id}}" id="bookmark_icon" aria-hidden="true"></i>
							@endif
						</span>
						<div class="col-sm-12 padding_zero">
							<span class="col-sm-2">
								<div class="fb-share-button" data-href="www.google.com" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>
							</span>
							<span class="col-sm-2">
								<a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="large">Tweet</a>
							</span>
							<span class="col-sm-2">
								<a href="#" class="share_via_email"><img src="{{asset('image/mail.png')}}" width="32" height="32"></a>
							</span>
						</div>
						<div class="col-sm-12 padding_zero upper_margin">
							<div class="col-sm-3 ">
								<a href="{{$school->id}}/gallery" ><input type="submit" class="btn btn-success btn-sm" style="width:92px;" value="Gallery"></a>
							</div>
							<div class="col-sm-3 padding_zero">
								<a href="{{$school->id}}/documents" ><input type="submit" class="btn btn-danger " style="width:95px;" value="Documents"></a>
							</div>
						</div>

					</div>
				</div>

				<br/>
				<br/>

				<div class="container school_main">
					@if(Auth::check())
						<!-- menu profile quick info -->
                        <div class="profile_circle center-block">
                            <div class="profile_dp">
                            	@if( !empty(Auth::user()->image) )
                                	<img src="{{asset('upload/'.Auth::user()->image)}}" alt="..." class="user_image">
                                @else
                                	<img src="{{asset('upload/user.png')}}" class="user_image">
                                @endif
                            </div>
                        </div>
                        <!-- /menu profile quick info -->
					@endif
                    <div class="rating_box col-sm-12">
                    	<div id='demo3' class="col-sm-offset-3 col-sm-4 rating">
                    		<input type="hidden" name="hidden_input" value="{{$school->id}}" />

	                        <input class="stars" type="radio" id="star53" name="rating" value="5" />
	                        <label class = "full" for="star53" title="Awesome - 5 stars"></label>
	                        
	                        <input class="stars" type="radio" id="star4half3" name="rating" value="4.5" />
	                        <label class="half" for="star4half3" title="Pretty good - 4.5 stars"></label>
	                        
	                        <input class="stars" type="radio" id="star43" name="rating" value="4" />
	                        <label class = "full" for="star43" title="Pretty good - 4 stars"></label>
	                        
	                        <input class="stars" type="radio" id="star3half3" name="rating" value="3.5" />
	                        <label class="half" for="star3half3" title="Meh - 3.5 stars"></label>
	                        
	                        <input class="stars" type="radio" id="star33" name="rating" value="3" />
	                        <label class = "full" for="star33" title="Meh - 3 stars"></label>
	                        
	                        <input class="stars" type="radio" id="star2half3" name="rating" value="2.5" />
	                        <label class="half" for="star2half3" title="Kinda bad - 2.5 stars"></label>
	                        
	                        <input class="stars" type="radio" id="star23" name="rating" value="2" />
	                        <label class = "full" for="star23" title="Kinda bad - 2 stars"></label>
	                        
	                        <input class="stars" type="radio" id="star1half3" name="rating" value="1.5" />
	                        <label class="half" for="star1half3" title="Meh - 1.5 stars"></label>
	                        
	                        <input class="stars" type="radio" id="star13" name="rating" value="1" />
	                        <label class = "full" for="star13" title="Sucks big time - 1 star"></label>
	                        
	                        <input class="stars" type="radio" id="starhalf3" name="rating" value="0.5" />
	                        <label class="half" for="starhalf3" title="Sucks big time - 0.5 stars"></label>

	                        <input class="hidden" type="radio" id="starzero3" name="rating" value="" />
	                        <label class="hidden" style="{display: none;}" for="starzero3" ></label>

	                    </div>
                    </div>
				</div>

				@if(Session::has('failed') || Session::has('send_failed'))
					<script type="text/javascript">
						$(document).ready(function(){
							$("#edit_user").modal();
						});
					</script>
				@endif

				<!-- Modal For Login -->
				<div class="modal fade" id="edit_user" role="dialog">
					<div class="modal-dialog">
						
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Login First</h4><a class="non_user" href="{{ route('register') }}">not registered yet?</a>
							</div>
							<div class="confirm_login">
								<div class="row">
							        <div class="col-md-10 ">
						                <div class="panel-body">
						                @if(Session::has('failed'))
						                	<span class="alert-danger" >{{Session::get('failed')}}</span>
						                @endif
						                    <form class="form-horizontal" role="form" method="POST" action="{{route('review_login')}}">
						                        {{ csrf_field() }}

						                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

						                            <div class="col-md-6">
						                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

						                                @if ($errors->has('email'))
						                                    <span class="help-block">
						                                        <strong>{{ $errors->first('email') }}</strong>
						                                    </span>
						                                @endif
						                            </div>
						                        </div>

						                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						                            <label for="password" class="col-md-4 control-label">Password</label>

						                            <div class="col-md-6">
						                                <input id="password" type="password" class="form-control" name="password" required autofocus>

						                                @if ($errors->has('password'))
						                                    <span class="help-block">
						                                        <strong>{{ $errors->first('password') }}</strong>
						                                    </span>
						                                @endif
						                            </div>
						                        </div>
						                        <div class="form-group">
						                            <div class="col-md-8 col-md-offset-4">
						                                <button type="submit" class="btn btn-primary custom-btn">
						                                    Login
						                                </button>

						                                <a class="btn btn-link" href="{{ route('password.request') }}">
						                                    Forgot Password ?
						                                </a>
						                            </div>
						                        </div>
						                    </form>
						                </div>
							        </div>
							    </div>
							</div>
						</div>		
					</div>
				</div>

				<!-- Modal For Mail -->
				<div class="modal fade" id="mail_model" role="dialog">
					<div class="modal-dialog">
						
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Share via email</h4>
							</div>
							<div class="confirm_login">
								<div class="row">
							        <div class="col-md-10 ">
						                <div class="panel-body">
						                @if(Session::has('send_failed'))
						                	<span class="alert-danger" >{{Session::get('send_failed')}}</span>
						                @endif
						                    <form class="form-horizontal" role="form" method="POST" action="/share_via_email">
						                        {{ csrf_field() }}

						                        <input type="hidden" name="url" value="{{Request::url()}}">

						                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

						                            <div class="col-md-6">
						                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

						                                @if ($errors->has('email'))
						                                    <span class="help-block">
						                                        <strong>{{ $errors->first('email') }}</strong>
						                                    </span>
						                                @endif
						                            </div>
						                        </div>

						                        
						                        <div class="form-group">
						                            <div class="col-md-8 col-md-offset-4">
						                                <button type="submit" class="btn btn-primary custom-btn">
						                                    Send
						                                </button>
						                            </div>
						                        </div>
						                    </form>
						                </div>
							        </div>
							    </div>
							</div>
						</div>		
					</div>
				</div>

				<div class="container">
					<div class="col-sm-9">
					<h1>Reviews</h1>
						@foreach( $school->school_ratings as $ratings )
							@if( count($ratings->reviews) )
								<div class="media">
								  	<div class="media-left media-middle ">
								    	<a href="#">
								      		<img class="media-object table-bordered" src="{{asset('upload/'.$ratings->users->image)}}" alt="...">
								    	</a>
								  	</div>
								  	<div class="media-body ">
								    	<h4 class="media-heading">{{$ratings->users->fname}} {{$ratings->users->lname}}</h4>
								    	{!! $ratings->reviews !!}
								  	</div>
								</div>
							@endif
						@endforeach
						@if(Auth::check())
							<h3>Post a review</h3>
						@else
							<h3>Login to post your review</h3>
							<!-- <span class="col-sm-10"> -->
								<a href="#" id="review_login_link">login..</a>
								<a href="{{route('register')}}">Not a user?</a>
							<!-- </span> -->
						@endif
						<a href="{{url('/create_forum/'.$school->id)}}"><button class="btn btn-success" style="float:right;">Create Forum</button></a>
						
						<div class="form-horizontal review_form">
						@if(Session::has('failed'))
		                	<span class="alert-danger" >{{Session::get('failed')}}</span>
		                @endif
		                @if(Session::has('Login'))
		                	<span class="alert-warning" >{{Session::get('Login')}}</span>
		                @endif
							<form action="{{route('post_review')}}" method="post" accept-charset="utf-8" enctype="Multipart/form-data">
							{{csrf_field()}}
								<div class="form-group">
									<textarea id="review_area" class="form-control" name="review" placeholder="Write a review. . ." rows="8"></textarea>	
								</div>
								<div class="form-group">
									<input type="submit" class="btn btn-success" value="Post">
								</div>
							</form>
						</div>
							

					</div>
					<div class="col-sm-2 table-bordered">
						<h4>Google Adsense</h4>
					</div>
				</div>
			</div>
		@endforeach
	@else
		No records Found
	@endif
	<script>
	    window.fbAsyncInit = function() {
	        FB.init({
	            appId      : '201788563656236',
	            xfbml      : true,
	            version    : 'v2.8'
	        });
	        FB.AppEvents.logPageView();
	    };
	</script>
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));


        window.twttr = (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {};
            if (d.getElementById(id)) return t;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js, fjs);

            t._e = [];
            t.ready = function(f) {
            t._e.push(f);
            };

          return t;
        }
        (document, "script", "twitter-wjs"));
    </script>
	<script>
        // create social networking pop-ups
        (function() {
            // link selector and pop-up window size
            var Config = {
                Link: "a.share",
                Width: 500,
                Height: 500
            };

            // add handler links
            var slink = document.querySelectorAll(Config.Link);
            for (var a = 0; a < slink.length; a++) {
                slink[a].onclick = PopupHandler;
            }

            // create popup
            function PopupHandler(e) {

                e = (e ? e : window.event);
                var t = (e.target ? e.target : e.srcElement);

                // popup position
                var
                    px = Math.floor(((screen.availWidth || 1024) - Config.Width) / 2),
                    py = Math.floor(((screen.availHeight || 700) - Config.Height) / 2);

                // open popup
                var popup = window.open(t.href, "social", 
                    "width="+Config.Width+",height="+Config.Height+
                    ",left="+px+",top="+py+
                    ",location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1");
                if (popup) {
                    popup.focus();
                    if (e.preventDefault) e.preventDefault();
                    e.returnValue = false;
                }

                return !!popup;
            }

        }());
    </script>
    <script type="text/javascript">
    	$(document).ready(function(){

		    var school_id=$('input[name=hidden_input]').val();
		    console.log(school_id);

		    $.ajaxSetup({
		        headers: {
		            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
		        }
		    });
		    $.ajax({
		        url:"{{url('/check_rate')}}",
		        type:'POST',
		        //datatype:'json',
		        // processData:false,
		        data:{
		                'school_id':school_id,
		            },

		        success: function(response){
		            console.log('check rate success: '+response);

		            if(response == false || response == 'not exist'){
		                $('.school_main').append("<h5 class='rating_heading'>Rate this school</h5>");

		            }else{
		                var i=1;
		                var j=response.ratings;
		                // console.log(j);

		                rate(j);
		                // $("input[class='stars']").unbind( "click" );
		                $('.school_main').append("<h5>Thanks For your ratings</h5>");
		            }
		        },
		        error:function(response){
		            console.log('error check rate: '+response);
		        }
		    });





		    $("#demo3 .stars").click(function () {

		        var rating=$(this).attr('value');
		        
		        var school_id=$('input[name=hidden_input]').val();

		        var label = $("label[for='" + $(this).attr('id') + "']");

		        $.ajax({
		            url:'check_login',
		            type:'GET',
		            data:{'test':'test'},

		            success: function(response){


		                if(response == false){
		                    // $(this).attr("unchecked");
		                    $('#starzero3').prop('checked', true);
		                    edit_user();
		                }
		                /*else if(isNaN(response)){
		                    
		                }*/
		                else{
		                    rating_store(school_id,rating);
		                }

		            },

		            error: function(response){
		                console.log('error in check login: '+response);
		            }
		        });
		        
		    });






		    function rating_store(school_id,rating){
		        console.log(school_id);
		        console.log(rating);

		        $.ajax({

		            url:"{{url('/rate_school')}}",
		            type:'POST',
		            data:{
		                "school_id":school_id,
		                "rating":rating,
		            },

		            success: function(response){

		                console.log(response.ratings);

		                if(response == true){
		                    console.log('rating successfull');
		                    $( ".rating_heading" ).replaceWith( "<h5>Thanks For your ratings</h5>" );
		                    rate(response.ratings);

		                }else{
		                    console.log('Already Rated');
		                    rate(response.ratings);
		                }

		            },

		            error: function(response){

		                console.log('error: '+response);
		            }

		        });
		    }




		    window.edit_user = function(){
		        $("#edit_user").modal();
		    }



		    function rate(value){
		        console.log(value);
		        $("input[value='"+value+"']").prop('checked', true);
		    }





		    /*Bookmark functionality*/
		    $('#bookmark_icon').click(function(){
		        var school_id=$(this).attr('title');
		        // alert(school_id);

		        $.ajax({
		            url:"{{url('/check_bookmark')}}",
		            type:'POST',
		            data:{
		                'school_id':school_id,
		            },

		            success: function(response){
		                console.log('success check_bookmark: '+response);

		                if(response == false){
		                    console.log('You are not Logged in');
		                    edit_user();
		                }else if(response == 500){
		                    console.log('You have been blocked');
		                }else{
		                    console.log(response);
		                    $('#bookmark_icon').toggleClass('bookmark_class');
		                    $('#bookmark_icon').toggleClass('bookmark_icon_glow');
		                }
		            },
		            error: function(response){
		                console.log('error check_bookmark: '+response);
		            }
		        });
		    });

		    /*for user bookmarks*/
		    /*for Styling*/
		    $('.delete_user_bookmark').hover(function(){
		      $(this).attr('class','fa fa-trash delete_user_bookmark');
		      $(this).css('font-size','25px');
		    },function(){
		      $(this).attr('class','fa fa-trash-o delete_user_bookmark');
		      $(this).css('font-size','20px');
		    });

		    /*for deletion*/
		    $('.delete_user_bookmark').click(function(){
		      var bookmark_id=$(this).attr('id');
		      var school_name=$(this).parent().prev().prev().prev().prev().html();
		      var row_id=$(this).parent().parent().attr('id');

		      var confrm = confirm('Do you really want to delete this bookmark? ('+school_name+')');
		      
		      if(confrm == true){
		        console.log('here');
		        $.ajax({
		          url:"{{url('/bookmark_school_delete')}}",
		          method:'POST',
		          data:{
		            'bookmark_id':bookmark_id,
		          },

		          success:function(response){
		            if(response == 404){
		              console.log('doesnot exists');
		            }else{
		              console.log(true);
		              $('#'+row_id).hide();
		            }
		          },
		          error:function(response){
		            console.log('error: '+response);
		          }
		        })
		      }
		    });
		});
    </script>
    <!-- <script src="{{asset('js/ajax_functioning.js')}}" type="text/javascript"></script> -->
		
@else
	<script type="text/javascript">
		window.location.href = '{{ url("/")}}';
	</script>
@endif
@endsection