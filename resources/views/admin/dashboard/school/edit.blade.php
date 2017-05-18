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
		<div id="school_box" class="container">
			<div class="school-header">
				<h1><u>Register School & Institute</u></h1>
			</div>

			<form class="form-horizontal" id="validate_form" method="post" action="{{ url('admin/school/update/'.$school->id) }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				<input type="hidden" name="school_id" value="{{$school->id}}">

				<div class="school-detail col-sm-12">
					<h3><u>School Detail</u></h3>

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
						<label class="col-sm-6 col-md-4 col-lg-4 control-label">Address*</label>
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

				<div class="school_location col-sm-12">
					<h3><u>School location</u></h3>
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

				<div class="school-images col-sm-12">

					<h3><u>School Image & documents</u></h3>
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
						</div>
					</div>
					@if(isset($gallery_profile) && count($gallery_profile))
							<div class="row col-md-offset-4">
							@foreach($gallery_profile as $image)
								<div class="col-md-3">
									<div class="school_image_update">

									<img src="{{asset('upload/schools/school_'.$school->id.'/images/profile_pic/current_dp/'.$image->image)}}"/>
									<button type="button" class="custom_buttom"  data-toggle="modal" data-target="#delete{{ $image->id }}">
										Delete
									</button>
									</div>
								</div>
							@endforeach
							</div>
					@endif
				</div>
				{{-- div for gallery images--}}
				<div class="school-images col-sm-12">
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
					</div>
				</div>

				@if(isset($gallery_images)&& count($gallery_images))
					<div class="row col-md-offset-4">
					@foreach($gallery_images as $image)
						<div class="col-md-3">
							<div class="school_image_update">
							<img src="{{asset('upload/schools/school_'.$school->id.'/images/gallery/'.$image->image)}}"/>
							<button type="button" class="custom_buttom"  data-toggle="modal" data-target="#delete{{ $image->id }}">
								Delete
							</button>
						</div>
					</div>
					@endforeach
					</div>
				@endif
				</div>

				<div class="school-images col-sm-12">

				<div class="form-group">
					<label class="col-sm-6 col-md-4 col-lg-4 control-label">
						Documents
					</label>
					<div class="col-md-6">
						<input  id="document_upload" class="document" type="file" name="document[]" multiple > optional Attach multiple file
						@if ($errors->has('document'))
							<span class="help-block error_message">
								<strong>{{ $errors->first('document') }}</strong>
							</span>
						@endif
					</div>
				</div>

				@if(isset($documents) && count($documents))
					<div class="row col-md-offset-4">
						@foreach($documents as $document)
								<div class="col-sm-3  " >
									<div class="school_image_update">
										<a href="{{asset('upload/schools/school_'.$school->id.'/documents/'.$document->documents) }}" target="_blank">
											<img src="{{asset('image/pdf1.jpg') }}">
										</a>
										<div id="pdf-title"> <h6> {{ $document->documents }} </h6>
										</div>
										<button type="button" class="custom_buttom"  data-toggle="modal" data-target="#document{{ $document->id }}">
											Delete
										</button>
							 	</div>
							</div>
						@endforeach
					</div>
				@endif
				</div>


				<div class="form-group">
					<button type="submit" id="edit_register" class="col-md-offset-4 col-md-2 btn btn-primary">
						Register
					</button>
				</div>
			</form>

			{{-- model for delete school profile--}}
			@if(isset($gallery_profile) && count($gallery_profile))
				@foreach($gallery_profile as $image)
					<div class="modal fade" tabindex="-1" role="dialog" id="delete{{$image->id}}">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title"> Confirmation </h4>
								</div>
								<div class="modal-body">
									<p> Do you want to delete current profile pic ?</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									{!! Form::open(['method' =>'DELETE','route' => ['delete_image',$image->id],'style'=>'display:inline','class'=>'delete']) !!}
									{!! Form::submit('delete', ['class' => 'btn btn-success']) !!}
									{!! Form::close() !!}
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
				@endforeach
			@endif

			{{-- model for galery images--}}
			@if(isset($gallery_images) && count($gallery_images))
				@foreach($gallery_images as $image)
					<div class="modal fade" tabindex="-1" role="dialog" id="delete{{$image->id}}">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title"> Confirmation </h4>
								</div>
								<div class="modal-body">
									<p> Do you want to delete Pic ?</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									{!! Form::open(['method' =>'DELETE','route' => ['delete_image',$image->id],'style'=>'display:inline','class'=>'delete']) !!}
									{!! Form::submit('delete', ['class' => 'btn btn-success']) !!}
									{!! Form::close() !!}
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
				@endforeach
			@endif

			{{-- model for galery images--}}
			@if(isset($documents) && count($documents))
				@foreach($documents as $document)
					<div class="modal fade" tabindex="-1" role="dialog" id="document{{$document->id}}">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title"> Confirmation </h4>
								</div>
								<div class="modal-body">
									<p> Do you want to delete Document ?</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									{!! Form::open(['method' =>'DELETE','route' => ['delete_document',$document->id],'style'=>'display:inline','class'=>'delete']) !!}
									{!! Form::submit('delete', ['class' => 'btn btn-success']) !!}
									{!! Form::close() !!}
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
				@endforeach
			@endif
		</div>
	</div>

	<script>
        $(document).ready(function (){
            function map() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: 21.170240,lng: 72.831061},
                    zoom: 4,
                });
            }
            map();
        });
	</script>
</div>
@endsection
