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
				<a href="#">Change Profile picture</a>
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
				<a href="/home/password_user">
					<button type="submit" class="btn btn-primary" name="submit">
                    	Change Password
                	</button>
				</a>
				<a href="/home/profile_edit">
					<button type="submit" class="btn btn-primary" name="submit">
                    	Edit Profile
                	</button>
				</a>
			</div>
		</div>
		
		
	</div>
</div>
@endsection