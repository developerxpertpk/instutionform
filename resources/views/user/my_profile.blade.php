@extends('layouts.app');
@section('content')
<div class="container">
	<div class="row">
		@if(Session::has('success'))
		<span>{{ Session::get('success') }}</span>
		@endif
		@if(Session::has('password_success'))
		<span>{{ Session::get('password_success') }}</span>
		@endif
		<div class="profile_view">
			<div class="profile_picture col-md-4">
				<img src="{{ asset('upload/'.Auth::user()->image) }}">
				<a href="change_user_dp">Change Profile picture</a>
			</div>
			<div class="profile_details col-md-8">
				<h1>{{ Auth::user()->fname }} {{ Auth::user()->lname }}</h1>
				<div class="form-group">
					<label for="fname" class="col-md-2 control-label">Email:</label>
					<p><strong>{{ Auth::user()->email }}</strong></p>
				</div>
				<div class="form-group">
					<label for="fname" class="col-md-2 control-label">Address:</label>
					<p><strong>{{ Auth::user()->address }}</strong></p>
				</div>

				<!-- <a href="/home/password_user"> -->
					<!-- Trigger the modal with a button -->
					<button type="submit" class="btn btn-primary" id="myBtn">
					Change Password
					</button>
				<!-- </a> -->
				<a href="/home/profile_edit">
					<button type="submit" class="btn btn-primary" name="submit">
					Edit Profile
					</button>
				</a>
				
				<!-- Modal For Change Password -->
				<div class="modal fade" id="change_password_user" role="dialog">
					<div class="modal-dialog">
						
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Modal Header</h4>
							</div>
							<div class="modal-body">
								<p>Some text in the modal.</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
						
					</div>
				</div>
				
			</div>
		</div>
		
		
	</div>
</div>
@endsection