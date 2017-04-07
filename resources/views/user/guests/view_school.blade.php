@extends('layouts.forumfinder_default')
@section('user_content')


@if(isset($particular_school))

	@if(count($particular_school))

		@foreach($particular_school as $school)
			<div class="container-fluid">
				<div class="container">
					<div class="school_dp col-sm-5" style="background-image: url('{{asset('upload/def_school.png')}}');">
						@if( isset($school->school_images->image))
							@if(asset('upload/'.$school->school_images->image))
								<img src="{{asset('upload/'.$school->school_images->image)}}" alt="{{asset('upload/def_school.png')}}">
							@endif
						@else
							<img src="{{asset('upload/def_school.png')}}">
						@endif
					</div>
					<div class="heading_box col-sm-6">
						<span>
							<h3>{{$school->school_name}}</h3>
						</span>
					</div>
				</div>
				<div class="container school_main">
						@if(Auth::check())
							<!-- menu profile quick info -->
                            <div class="profile">
                                <div class="pro_pic">
                                    <img src="upload/{{Auth::user()->image}}" alt="..." class="img-circle profile_img">
                                </div>
                            </div>
                            <!-- /menu profile quick info -->
						@endif
						<div class="rating_box">
							<span id="5">☆</span><span id="4">☆</span><span id="3">☆</span><span id="2">☆</span><span id="1">☆</span>
						</div>
					</div>

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
									
								</div>
							</div>		
						</div>
					</div>



					
					<div class="col-md-8 col-sm-8 col-xs-12">
						<div class="x_panel tile fixed_height_320">
							<div class="x_title">
								<h3>Ratings & Reviews</h3>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								
								<div class="widget_summary">
									<div class="w_left w_25">
										<span>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
										</span>
									</div>
									<div class="w_center w_55">
										<div class="progress">
											<div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
												<span class="sr-only">60% Complete</span>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="widget_summary">
									<div class="w_left w_25">
										<span>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star-o" aria-hidden="true"></i>
										</span>
									</div>
									<div class="w_center w_55">
										<div class="progress">
											<div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
												<span class="sr-only">60% Complete</span>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="widget_summary">
									<div class="w_left w_25">
										<span>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star-o" aria-hidden="true"></i>
											<i class="fa fa-star-o" aria-hidden="true"></i>
										</span>
									</div>
									<div class="w_center w_55">
										<div class="progress">
											<div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
												<span class="sr-only">60% Complete</span>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="widget_summary">
									<div class="w_left w_25">
										<span>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star-o" aria-hidden="true"></i>
											<i class="fa fa-star-o" aria-hidden="true"></i>
											<i class="fa fa-star-o" aria-hidden="true"></i>
										</span>
									</div>
									<div class="w_center w_55">
										<div class="progress">
											<div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
												<span class="sr-only">60% Complete</span>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="widget_summary">
									<div class="w_left w_25">
										<span>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star-o" aria-hidden="true"></i>
											<i class="fa fa-star-o" aria-hidden="true"></i>
											<i class="fa fa-star-o" aria-hidden="true"></i>
											<i class="fa fa-star-o" aria-hidden="true"></i>
										</span>
									</div>
									<div class="w_center w_55">
										<div class="progress">
											<div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
												<span class="sr-only">60% Complete</span>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
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