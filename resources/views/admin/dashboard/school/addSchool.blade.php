@extends('layouts.admin.admin_layout')
@section('content')

	<div class="container">
			<h2> Register</h2>
    <div class="row">

        <div class="col-md-8">

                <div class="panel-heading"> <h4>  </h4></div>
                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="post"  enctype="multipart/form-data" action="{{route('school.store')}}">
                        {{ csrf_field() }}

                        <div class="form-group">
					<label class="col-md-2 control-label"></label>
					<h3 class="col-md-4"> School Details</h3>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">School Name</label>
					<div class="col-md-6">
						<input id="school_name" type="text" class="form-control" name="school_name" value="{{ old('school_name') }}" required>
						@if ($errors->has('school_name'))
							<span class="help-block">
								<strong>{{ $errors->first('school_name') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">Address
					</label>
					<div class="col-md-6">
						<textarea name="school_address" class="form-control" rows="4" required></textarea>  
						@if ($errors->has('address'))
							<span class="help-block">
								<strong>{{ $errors->first('address') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group">
					<label for="file_upload" class="col-md-4 control-label">Image
					</label>
					<div class="col-md-6">
						<input id="file_upload" type="file" name="image" multiple>optional
						@if ($errors->has('file_up'))
							<span class="help-block">
								<strong>{{ $errors->first('file_up') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label"></label>
					<h3 class="col-md-4">Location</h3>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Select Country:</label>
					<div class="col-lg-3">
						<input  type="text" id="countryId" class="countries form-control" name="country">
							
				
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
						<input id="stateId" class="states form-control" name="state">
						
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
						<input id="cityId" class="cities form-control" name="city">
					
						@if ($errors->has('city'))
							<span class="help-block">
								<strong>{{ $errors->first('city') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
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