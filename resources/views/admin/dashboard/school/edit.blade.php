@extends('layouts.admin.adminLayout')
@section('content')

	<div id="page-wapper"> 
		<div class="container-fluid">
	  	   <div class="row">

	  	   		 <div class="col-lg-12"> 
	  	   		        <div>
						<h1 class="page-header">
						 Edit Schools</h1>
						</div>
	  	</div>
	</div>
<!-- end row -->

	   @if (count($errors))
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                  <!--   <li>{{ $error }}</li> -->
                  <?php echo $errors ;?>
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
				<form class="form-horizontal" role="form" method="post"  enctype="multipart/form-data" action="{{route('school.update1',$school->id)}}">
					{{ csrf_field() }}
					<h3 class="page-header"> School Details
					</h3>

					<div class="form-group">
						<label class="col-sm-6 col-md-4 col-lg-4 control-label">School Name* </label>
						<div class="col-sm-6 col-md-6 ">
							<input id="school_name" type="text" class="form-control" name="school_name" value="{{$school->school_name}}" placeholder="A B C *" required autofocus>
							@if ($errors->has('school_name'))
								<span class="help-block">
							<strong>{{ $errors->first('school_name') }}</strong>
						</span>
							@endif
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-6 col-md-4 col-lg-4 control-label">Address*
						</label>

						<div class=" col-sm-6 col-md-6 ">
							<textarea name="school_address" class="form-control" rows="4" required>{{$school->school_address}}</textarea>

							@if ($errors->has('address'))
								<span class="help-block">
							<strong>{{ $errors->first('address') }}</strong>
						</span>
							@endif
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-6 col-md-4 control-label- control-label">Zip Code* </label>
						<div class="col-lg-6 col-md-6">
							<input class="zip form-control " type="text" name="zip" value="{{$school->locations->zip}}"  required onblur="getLocation()"; return false;>
						</div>
					</div>



					<h3 class="page-header"> School location
					</h3>

					<div class="row col-lg-12 col-md-12">
						<div class="col-md-6 col-md-6">
							<div class="form-group">
								<div class="col-lg-4 col-md-4 col-md-offset-2 col-lg-offset-2">
									<input id="countryId" class="countries form-control" name="country" value ="{{$school->locations->country}}" placeholder="country *">
									</input>
									@if ($errors->has('country'))
										<span class="help-block">
								<strong>{{ $errors->first('country') }}</strong>
							</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-4 col-lg-4 col-lg-offset-2 col-md-offset-2">
									<input id="stateId" class="states form-control" name="state" value="{{$school->locations->state}}" placeholder="state *">
									</input>
								</div>
								@if ($errors->has('state'))
									<span class="help-block">
								<strong>{{ $errors->first('state') }}</strong>
							</span>
								@endif

							</div>

							<div class="form-group">
								<div class="col-lg-4 col-md-4 col-md-offset-2 col-lg-offset-2">
									<input id="cityId" class="cities form-control" name="city" value="{{$school->locations->city}}" placeholder="city *">

									</input>
									@if ($errors->has('city'))
										<span class="help-block">
								<strong>{{ $errors->first('city') }}</strong>
							</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-4 col-md-4 col-md-offset-2 col-lg-offset-2">
									<input id="lat" type="hidden" class="lat form-control" name="latitude" value=" " class="hidden" >
									</input>
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-4 col-md-4 col-md-offset-2 col-lg-offset-2">
									<input id="long"  type="hidden" class="long form-control" name="longitude" value=" " >
									</input>
								</div>
							</div>
						</div>

						<div class="col-md-6 col-lg-6 ">
							<div id="map">
							</div>
						</div>
					</div>
					<!-- code for images -->
					<h3 class="page-header"> Images
					</h3>
					<div class="form-group">
						<label for="images" class="col-sm-6 col-md-4 col-lg-4 control-label">
							<h4> </h4>
						</label>

						<div class="col-md-6">
							<input id="file_upload" type="file" name="image[]" multiple accept='image/*' >optional
							( Gallery images)
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
		<div>

    </div>
@endsection