@extends ('layouts.admin.adminLayout')
@section('content')

	<div id="page-wrapper">
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
				Manage Schools & Institutes
				</h1>
				<ol class="breadcrumb">
					<li>
						<i class="fa fa-dashboard"></i>Dashboard
					</li>
					<li class="active">
						<i class="fa fa-anchor"></i> Schools
					</li>
				
				</ol>
			</div>
		</div>
		<!-- /.row -->


      <div class="pull-right">
      <button class="btn btn-primery" data-toggle="modal" data-target=".add">add School</button>
      </div>

</div>

<!--  Bootstrap Model  for add schools  -->
<!-- Large modal  Model data-target=".add"-->


<div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">  
          <div class="modal-header">

          <h4 class="modal-title" id="myModalLabel">Register</h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      </div>         
	<div class="container">
			
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


                      </form>
                    </div>
                 </div>
              </div>
    </div>
  </div>
</div>
</div>
 <!-- end of model0 (add model) -->
 </div>
 </div>

@endsection