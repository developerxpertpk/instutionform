@extends('layouts.admin.adminLayout')
@section('content')

	<div id="page-wrapper">
		<div class="container-fluid">
		<div class="row">
			<h1 class="page-header">
				School Register
			</h1>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
				<li class="breadcrumb-item "> <a href="{{ route('school.index') }}">Manage School</a></li>
				<li class="breadcrumb-item active">Edit School/Insitutes</li>
			</ol>
		</div>
		<!-- /.row  -->
		@if (count($errors))
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		@if ($message = Session::get('success'))
			<div class="alert alert-success">
				<p>{{  $message }}</p>
			</div>
		@endif

		<div id="school_box">
			<div class="school-header">
				<h1> <u>Register School & Institute </u></h1>
			</div>

			<form  class="form-horizontal" id="validate_form" role="form" method="post"   action="#" enctype="multipart/form-data">
				{{ csrf_field() }}
					<div class="school-detail">
						<h3>  <u>School Detail</u>
						</h3>
						<div class="form-group">
							<label class="col-sm-6 col-md-4 col-lg-4 control-label"> School Name* </label>
							<div class="col-sm-6 col-md-6 ">
								<input id="school_name" type="text" class="form-control" name="school_name" value="{{ $school->school_name }}">
								@if ($errors->has('school_name'))
								<span class="help-block error_message">
									<strong>{{ $errors->first('school_name') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-6 col-md-4 col-lg-4 control-label">Address*
							</label>
							<div class=" col-sm-6 col-md-6 ">
								<textarea name="school_address" class="form-control" rows="4">{{ $school->school_address }}</textarea>

								@if ($errors->has('address'))
									<span class="help-block error_message">
									<strong>{{ $errors->first('address') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-6 col-md-4 control-label- control-label">Zip Code* </label>
							<div class="col-lg-6 col-md-6">
								<input class="zip form-control " type="text" name="zip" value="{{ $school->locations->zip }}"  onblur="getLocation()"; return false;>
								<script>
                                    getLocation();
								</script>
								@if ($errors->has('zip'))
									<span class="help-block error_message">
							    		<strong>{{ $errors->first('zip') }}</strong>
									</span>
								@endif
							</div>
						</div>
					</div>

					<div class="school_location">
						<h3>  <u> School location </u>
						</h3>

						<div class="row col-lg-12 col-md-12">

							<div class="col-md-6 col-md-6">
								<div class="form-group">
									<label class="col-sm-12 col-md-8 col-lg-8 control-label "> country*</label>
									<div class="col-lg-6 col-md-6" id="location">
										<input id="countryId" class="countries form-control" name="country" value ="{{ $school->locations->country }}" placeholder="country *">
										</input>
										@if ($errors->has('country'))
											<span class="help-block error_message">
											<strong>{{ $errors->first('country') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-12 col-md-8 col-lg-8 control-label "> state* </label>
									<div class="col-md-6 col-lg-6" id="location">
										<input id="stateId" class="states form-control" name="state" value="{{ $school->locations->state }}" placeholder="state *">
										</input>
									</div>
									@if ($errors->has('state'))
										<span class="help-block error_message">
											<strong>{{ $errors->first('state') }}</strong>
										</span>
									@endif
								</div>

								<div class="form-group">
									<label class="col-sm-12 col-md-8 col-lg-8 control-label "> City * </label>
									<div class="col-lg-6 col-md-6" id="location">
										<input id="cityId" class="cities form-control" name="city" value="{{ $school->locations->city }}" placeholder="city *">
										</input>
										@if ($errors->has('city'))
											<span class="help-block error_message">
											<strong>{{ $errors->first('city') }}</strong>
										</span>
										@endif
									</div>
								</div>

								<div class="form-group">
									<div class="col-lg-4 col-md-4 col-md-offset-2 col-lg-offset-2" id="location">
										<input id="lat" type="hidden" class="lat form-control" name="latitude" value="{{ $school->locations->latitude }}" class="hidden" >
										</input>
									</div>
								</div>

								<div class="form-group">
									<div class="col-lg-4 col-md-4 col-md-offset-2 col-lg-offset-2" id="location">
										<input id="long"  type="hidden" class="long form-control" name="longitude" value=" {{ $school->locations->longitude }}" >
										</input>
									</div>
								</div>
							</div>

							<div class="col-md-6 col-lg-6  google-map">
								<div id="map">
								</div>
							</div>
						</div>
					</div>

				<div class="school-images">
				<h3>  <u> School Image & documents </u>
				</h3>

			<div class="form-group">
					<label class="col-sm-6 col-md-4 col-lg-4 control-label">
						Profile Pic
					</label>

						<div class="col-md-6">

						<input id="file_upload" class="images" type="file" name="profile" >optional(Profile Image)

						@if ($errors->has('file_up'))
							<span class="help-block error_message">
							<strong>{{ $errors->first('profile') }}</strong>
						</span>
						@endif

						{{--@if(isset($gallery_profile) )--}}
									{{--<div id="lightgallery">--}}

										{{--@foreach($gallery_profile as $image)--}}
											{{--<div class="col-lg-4 col-sm-4 col-xs-6">--}}

												{{--<a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox">--}}
													{{--<img  class="thumbnail img-responsive" src="{{asset('upload/schools/school'.'_'.$school->id.'/images/profile_pic/current_dp/'.$image->image)}}" >--}}
												{{--</a>--}}

												{{--<button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#delete{{ $image->id }}">--}}
													{{--Delete--}}
												{{--</button>--}}

												{{--<!-- Modal  for delete with id=01-->--}}
												{{--<div class="modal fade" id="delete{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
													{{--<div class="modal-dialog" role="document">--}}
														{{--<div class="modal-content">--}}

															{{--<div class="modal-header">--}}
																{{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
																{{--<h4 class="modal-title" id="myModalLabel">Confirmation  </h4>--}}
															{{--</div>--}}

															{{--<div class="modal-body">--}}
																{{--<h4> Do you want to delete {{$image->image}}  ? . </h4>--}}
															{{--</div>--}}

															{{--<div class="modal-footer">--}}

																{{--<button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>--}}
																{{--{!! Form::open(['method' => 'DELETE','route' => ['delete_image',$image->id,$school->id ],'style'=>'display:inline','class'=>'delete']) !!}--}}

																{{--{!! Form::submit('delete', ['class' => 'btn btn-success']) !!}--}}
																{{--{!! Form::close() !!}--}}

															{{--</div>--}}
														{{--</div>--}}
													{{--</div>--}}
												{{--</div>--}}
											{{--</div>--}}
										{{--@endforeach--}}
										{{--<div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">--}}
											{{--<div class="modal-dialog">--}}
												{{--<button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>--}}
												{{--<div class="modal-content">--}}
													{{--<div class="modal-body">--}}
														{{--<img src="" alt="" />--}}
													{{--</div>--}}
												{{--</div>--}}
											{{--</div>--}}
										{{--</div>--}}
									{{--</div>--}}
								{{--@endif--}}
			</div>
		</div>

		<div class="form-group">
				<label class="col-sm-6 col-md-4 col-lg-4 control-label">
				School gallery
				</label>

					<div class="col-md-6">

						<input id="file_upload" class="images" type="file" name="image[]" multiple > optional( Gallery images)

						@if ($errors->has('file_up'))
							<span class="help-block error_message">
								<strong>{{ $errors->first('image') }}</strong>
							</span>
						@endif

						{{--@if(isset($gallery_images))--}}
							{{--<div id="lightgallery">--}}
								{{--@foreach($gallery_images as $image)--}}
									{{--<div class="col-lg-4 col-sm-4 col-xs-6">--}}
										{{--<a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox">--}}
											{{--<img  class="thumbnail img-responsive" src="{{asset('upload/schools/school'.'_'.$school->id.'/images/gallery/'.$image->image)}}" >--}}
										{{--</a>--}}

										{{--<button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#delete{{ $image->id }}">--}}
											{{--Delete--}}
										{{--</button>--}}

										{{--<!-- Modal  for delete with id=01-->--}}
										{{--<div class="modal fade" id="delete{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
											{{--<div class="modal-dialog" role="document">--}}
												{{--<div class="modal-content">--}}

													{{--<div class="modal-header">--}}
														{{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
														{{--<h4 class="modal-title" id="myModalLabel">Confirmation  </h4>--}}
													{{--</div>--}}

													{{--<div class="modal-body">--}}
														{{--<h4> Do you want to delete {{$image->image}}  ? . </h4>--}}
													{{--</div>--}}

													{{--<div class="modal-footer">--}}

														{{--<button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>--}}
														{{--{!! Form::open(['method' => 'DELETE','route' => ['delete_image',$image->id,$school->id ],'style'=>'display:inline','class'=>'delete']) !!}--}}

														{{--{!! Form::submit('delete', ['class' => 'btn btn-success']) !!}--}}
														{{--{!! Form::close() !!}--}}

													{{--</div>--}}
												{{--</div>--}}
											{{--</div>--}}
										{{--</div>--}}
									{{--</div>--}}
								{{--@endforeach--}}
								{{--<div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">--}}
									{{--<div class="modal-dialog">--}}
										{{--<button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>--}}
										{{--<div class="modal-content">--}}
											{{--<div class="modal-body">--}}
												{{--<img src="" alt="" />--}}
											{{--</div>--}}
										{{--</div>--}}
									{{--</div>--}}
								{{--</div>--}}
							{{--</div>--}}
						{{--@endif--}}
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-6 col-md-4 col-lg-4 control-label"> Documents
				</label>
				<div class="col-md-6">
					<input  id="document_upload" class="document" type="file" name="document[]" multiple > optional Attach multiple file

					@if ($errors->has('document'))
						<span class="help-block error_message">
						<strong>{{ $errors->first('document') }}</strong>
					</span>
					@endif

					{{--@if($documents)--}}
					{{--@foreach($documents as $document)--}}
						{{--<div class="pdf">--}}
							{{--<a href="{{asset('upload/schools/school_'.$school->id.'/documents/'.$document->documents) }}" target="_blank"> <img src="{{asset('image/pdf_image.jpg') }}" width="100px" height="100px ">--}}
								{{--{{ $document->documents}} </a>--}}
						{{--</div>--}}
					{{--@endforeach--}}
					{{--@endif--}}
				</div>
			</div>
		</div>

					<div class="form-group">
						<div class=" col-md-offset-4 col-md-2">
							<button type="submit" class="btn btn-primary">
								Register
							</button>
						</div>
					</div>
			</form>
			</div>
		</div>
	</div>
@endsection