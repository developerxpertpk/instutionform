@extends('layouts.forumfinder_default')
@section('user_content')


@if(isset($particular_school))
	@if(count($particular_school))
		@foreach($particular_school as $school)
		<br/>
		<!-- Facebook Preview Tags -->
		<meta property="og:url"           content="http://www.your-domain.com/your-page.html" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="{{$school->school_name}}" />
        <!-- <meta property="og:description"   content="Your description" /> -->
        <!-- <meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" /> -->
        <!-- Facebook Preview Tags Close -->

		<meta name="_token" content="{{ csrf_token() }}">
			<div class="container-fluid">
				<div class="container">
					<div class="school_dp col-sm-5" style="background-image: url('{{asset('upload/def_school.png')}}');">
						@if( isset($school->school_images->image))
							@if(asset('upload/'.$school->school_images->image))
								<img src="{{asset('upload/'.$school->school_images->image)}}" alt="{{asset('upload/def_school.png')}}">

								<meta property="og:image" content="{{asset('upload/'.$school->school_images->image)}}" />
							@endif
						@else
							<img src="{{asset('upload/def_school.png')}}">
						@endif
						<!-- <img src="{{asset('image/bookmark.png')}}" class="bookmark_logo"> -->
					</div>
					<div class="heading_box col-sm-6">
						<span>
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
						<div >
							<a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}&display=popup" class="col-sm-4"> share this </a>
							<span class="col-sm-12">
								<i class="fa fa-bookmark bookmark_class" title="{{$school->id}}" id="bookmark_icon" aria-hidden="true"></i>
							</span>
						</div>
						<span>
							<img src="" alt="">
						</span>
					</div>
				</div>
				<div class="container school_main">
						@if(Auth::check())
							<!-- menu profile quick info -->
	                        <div class="profile_circle center-block">
	                            <div class="profile_dp">
	                                <img src="upload/{{Auth::user()->image}}" alt="..." class="img-circle profile_img">
	                            </div>
	                        </div>
	                        <!-- /menu profile quick info -->
						@endif
				
                    <div class="rating_box col-sm-12">
                    	<fieldset id='demo3' class="rating">
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

	                    </fieldset>
                    </div>
	                    
				</div>

				@if(Session::has('failed'))
					<script type="text/javascript">
						$(document).ready(function(){
							$("#edit_user").modal();
						});
					</script>
				@endif

					<!-- Modal For Profile Editor -->
					<div class="modal fade" id="edit_user" role="dialog">
						<div class="modal-dialog">
							
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Login to give reviews</h4><a class="non_user" href="{{ route('register') }}">not registered yet?</a>
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


				<div class="container review_container">
					<div class="col-sm-9">
					<h1>Reviews</h1>
						@foreach( $school->school_ratings as $ratings )
							@if( count($ratings->reviews) )
								<div class="media">
								  	<div class="media-left media-middle">
								    	<a href="#">
								      		<img class="media-object" src="..." alt="...">
								    	</a>
								  	</div>
								  	<div class="media-body">
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
							<a href="#" id="review_login_link">login..</a>
							<a href="{{route('register')}}">Not a user?</a>
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
					<div class="col-sm-3">
						<h3>Google Adsense</h3>
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