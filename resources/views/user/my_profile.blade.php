@extends('layouts.forumfinder_default')

@section('user_content')
<div class="container">
	<br/>
	<div class="row">
		@if(Session::has('success'))
		<span>{{ Session::get('success') }}</span>
		@endif

		@if(Session::has('password_success'))
		<span>{{ Session::get('password_success') }}</span>
		@endif

		@if($errors->all())

			@if($errors->has('confirm_password') || $errors->has('cnf_pwd') || $errors->has('password_failed') || $errors->has('old_password') || $errors->has('new_password'))
				<script>
					$(document).ready(function(){
                    	$('#change_password_user').modal();
					});
				</script>		
			@elseif($errors->has('image'))
				<script>
					$(document).ready(function(){
						$('#change_dp_model').modal();
					});
				</script>
			@else
				<script type="text/javascript">
					$(document).ready(function(){
						$('#edit_user').modal();
					});
				</script>
			@endif
		@endif
			
		<div class="profile_view">
			<div class="profile_picture col-md-4">
				@if( !empty(Auth::user()->image) && File::exists('upload/users/user'.'_'.Auth::id().'/images/profile_pic/current_dp/'.Auth::user()->image) )
					<img src="{{ asset('upload/users/user'.'_'.Auth::id().'/images/profile_pic/current_dp/'.Auth::user()->image) }}">		
				@else
					<img src="{{ asset('images/user.png') }}">	
				@endif
				<a href="javascript:;" id="change_dp"><p>Change Profile picture</p></a>
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
				
				<button type="submit" class="btn btn-primary" id="my_editBtn">
				Edit Profile
				</button>
				
				<!-- Modal For Change Password -->
				<div class="modal fade" id="change_password_user" role="dialog">
					<div class="modal-dialog">
						
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Change Password</h4>
							</div>
							<form class="form-horizontal" id="change_password" role="form" method="POST"  enctype="multipart/form-data" action="{{url('home/password_user')}}">
								<div class="modal-body">

									{{ csrf_field() }}
									<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
										@if($errors->has('password_failed'))
										<span>{{ $errors->first('password_failed') }}</span>
										@endif
										<label for="password" class="col-md-4 control-label">
											Old Password
										</label>
										<div class="col-md-6">
											<input id="password" type="password" class="form-control" name="old_password" required>
											@if ($errors->has('old_password'))
											<span class="help-block">
												<strong>{{ $errors->first('old_password') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
										<label for="password" class="col-md-4 control-label">
											New Password
										</label>
										<div class="col-md-6">
											<input id="password" type="password" class="form-control" name="new_password" required>
											@if ($errors->has('new_password'))
											<span class="help-block">
												<strong>{{ $errors->first('new_password') }}</strong>
											</span>
											@endif
										</div>
									</div>
									<div class="form-group">
										<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
										<div class="col-md-6">
											<input id="password-confirm" type="password" class="form-control" name="confirm_password" required>
											@if ($errors->has('confirm_password'))
											<span class="help-block">
												<strong>{{ $errors->first('confirm_password') }}</strong>
											</span>
											@endif
											@if ($errors->has('cnf_pwd'))
											<span class="help-block">
												<strong>{{ $errors->first('cnf_pwd') }}</strong>
											</span>
											@endif
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary" data-dismiss="modal">Close
									</button>
									<button onclick="form_submit()" type="submit" class="btn btn-primary">
									Submit
									</button>
								</div>
							</form>
						</div>
						
					</div>
				</div>

				<!-- Modal For Profile Editor -->
				<div class="modal fade" id="edit_user" role="dialog">
					<div class="modal-dialog">
						
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Profile Editor</h4>
							</div>
							<form class="form-horizontal" role="form" id="profile_editor" method="POST"  enctype="multipart/form-data" action="{{url('home/profile_edit')}}">
								<div class="modal-body">
								
			                        {{ csrf_field() }}

			                        <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
			                            <label for="fname" class="col-md-4 control-label">First Name</label>

			                            <div class="col-md-6">
			                                <input id="fname" type="text" class="form-control" name="fname" value="{{ Auth::user()->fname }}" required autofocus>

			                                @if ($errors->has('fname'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('fname') }}</strong>
			                                    </span>
			                                @endif
			                            </div>
			                        </div>

			                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			                            <label for="lname" class="col-md-4 control-label">Last Name</label>

			                            <div class="col-md-6">
			                                <input id="lname" type="text" class="form-control" name="lname" value="{{ Auth::user()->lname }}" required autofocus>

			                                @if ($errors->has('lname'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('lname') }}</strong>
			                                    </span>
			                                @endif
			                            </div>
			                        </div>

			                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

			                            <div class="col-md-6">
			                                <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>

			                                @if ($errors->has('email'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('email') }}</strong>
			                                    </span>
			                                @endif
			                            </div>
			                        </div>
			                         <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
			                            <label for="address" class="col-md-4 control-label">Address</label>

			                            <div class="col-md-6">
			                                <textarea name="address" class="form-control" placeholder="vill city " rows="4" required>{{ Auth::user()->address }}</textarea>
			                                @if ($errors->has('address'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('address') }}</strong>
			                                    </span>
			                                @endif
			                            </div>
			                        </div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary" data-dismiss="modal">Close
									</button>
									<button onclick="form_edit()" type="submit" class="btn btn-primary" >
									Submit
									</button>
								</div>
							</form>
						</div>		
					</div>
				</div>

				<!-- Modal For Change Image -->
				<div class="modal fade" id="change_dp_model" role="dialog">
					<div class="modal-dialog">
						
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Choose an image</h4>
							</div>
							<form class="form-horizontal" id="change_password" role="form" method="POST"  enctype="multipart/form-data" action="{{url('home/change_dp_user')}}">
								
								<div class="modal-body">

									{{ csrf_field() }}
									<div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
			                            <label for="image" class="col-md-4 control-label"></label>

			                            <div class="col-md-6">
			                                <input id="image" type="file"  name="image" required>
			                                @if ($errors->has('image'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('image') }}</strong>
			                                    </span>
			                                @endif
			                            </div>
			                        </div>

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary" data-dismiss="modal">Close
									</button>
									<button onclick="form_submit()" type="submit" class="btn btn-primary">
									Submit
									</button>
								</div>
							</form>
						</div>
						
					</div>
				</div>

			</div>
		</div>
		
		
	</div>
</div>
@endsection