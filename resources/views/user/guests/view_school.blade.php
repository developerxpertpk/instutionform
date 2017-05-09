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
						<div class="col-sm-12 padding_zero">
							<div class="col-sm-6 ">
								<a href="{{$school->id}}/gallery" ><input type="submit" class="btn btn-success btn-sm" value="Gallery"></a>
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
							<a href="/create_forum/{{$school->id}}"><button class="btn btn-success" style="float:right;">Create Forum</button></a>
						@else
							<h3>Login to post your review</h3>
							<!-- <span class="col-sm-10"> -->
								<a href="#" id="review_login_link">login..</a>
								<a href="{{route('register')}}">Not a user?</a>
								<a href="/create_forum/{{$school->id}}"><button class="btn btn-success" style="float:right;">Create Forum</button></a>
							<!-- </span> -->
						@endif
						
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
			
		
@else
	<script type="text/javascript">
		window.location.href = '{{ url("/")}}';
	</script>
@endif
@endsection