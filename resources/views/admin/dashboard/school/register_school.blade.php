@extends('layouts.admin.adminLayout')
@section('content')
<div id="page-wrapper">
	<div class="container-fluid">
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
				School Register
				</h1>
			</div>
		</div>
		<!-- /.row -->
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
		<div class=conatiner>
			<form class="form-horizontal" role="form" method="post"  enctype="multipart/form-data" action="{{route('school.store')}}">
				{{ csrf_field() }}
				<h3 class="page-header"> School Details
				</h3>
				<div class="form-group">
					<label class="col-sm-6 col-md-4 col-lg-4 control-label">School Name </label>
					<div class="col-sm-6 col-md-6 ">
						<input id="school_name" type="text" class="form-control" name="school_name" placeholder="A B C *" required autofocus>
						@if ($errors->has('school_name'))
						<span class="help-block">
							<strong>{{ $errors->first('school_name') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 col-md-4 col-lg-4 control-label">Address
					</label>
					<div class=" col-sm-6 col-md-6 ">
						<textarea name="school_address" class="form-control" rows="4" required></textarea>
						@if ($errors->has('address'))
						<span class="help-block">
							<strong>{{ $errors->first('address') }}</strong>
						</span>
						@endif
					</div>
				</div>
				
				<h3 class="page-header"> School location
				</h3>

				<div class="form-group">
					<label class="col-md-4 control-label">Select Country:</label>
					<div class="col-lg-3">
						<select id="countryId" class="countries form-control" name="country">
							
							<option value="">Select Country</option>
						</select>
						@if ($errors->has('country'))
							<span class="help-block">
								<strong>{{ $errors->first('country') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Select State:</label>
					<div class="col-lg-3">
						<select id="stateId" class="states form-control" name="state">
							<option value="">Select State</option>
						</select>
						@if ($errors->has('state'))
							<span class="help-block">
								<strong>{{ $errors->first('state') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Select City:</label>
					<div class="col-lg-3">
						<select id="cityId" class="cities form-control" name="city">
							<option value="">Select City</option>
						</select>
						@if ($errors->has('city'))
							<span class="help-block">
								<strong>{{ $errors->first('city') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<!-- code for images -->
				<h3 class="page-header"> Images
				</h3>
				<div class="form-group">
					<label for="file_upload" class="col-sm-6 col-md-4 col-lg-4 control-label">
					</label>
					<div class="col-md-6">
						<input id="file_upload" type="file" name="image[]" multiple accept='image/*' >optional
						( Attach multiple images)
						@if ($errors->has('file_up'))
						<span class="help-block">
							<strong>{{ $errors->first('image') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<!-- code for upload multiple files  -->
				<h3 class="page-header"> Documents
				</h3>
				<div class="form-group">
					<label for="Documents" class="col-sm-6 col-md-4 col-lg-4 control-label">
						<h4> </h4>
					</label>
					<div class="col-md-6">
						<input  id="document_upload" type="file" name="document[]" multiple >( Attach multiple file)
						@if ($errors->has('document'))
						<span class="help-block">
							<strong>{{ $errors->first('document') }}</strong>
						</span>
						@endif
					</div>
				</div>

				<div class="form-group">
					<div class=" col-md-offset-10 col-md-2">
						<button type="submit" class="btn btn-primary">
						Register
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
@endsection