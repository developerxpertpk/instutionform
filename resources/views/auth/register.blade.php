@extends('layouts.forumfinder_default')
@section('user_content')
<div class="row1 ">
    <div class="form-horizontal_row1">
        <form class="form-horizontal" role="form" method="POST"  enctype="multipart/form-data" action="{{ route('user.register') }}">
            <div class="container-fluid">
                <h4 class="register">Registration</h4>
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('fname') ? ' has-error' : '' }}">
                    <label for="fname" class="col-sm-4 control-label">First Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="{{ old('fname') }}" required autofocus>
                        @if ($errors->has('fname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('lname') ? ' has-error' : '' }}">
                    <label for="lname" class="col-sm-4 control-label">Last Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="{{ old('lname') }}" required autofocus>
                        @if ($errors->has('lname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('lname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-sm-4 control-label">E-mail</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-sm-4 control-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required autofocus>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password_confirmation" class="col-sm-4 control-label">Confirm Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required autofocus>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                    <label for="gender" class="col-sm-4 control-label">Gender</label>
                    <div class="col-sm-8">

                        <strong> Male </strong>
                        <input name="gender" type="radio" value="M">
                        <strong> Female </strong>
                        <input name="gender" type="radio" value="F">
                        
                        @if ($errors->has('gender'))
                        <span class="help-block">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address" class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="address" rows="3" placeholder="Address" required autofocus>{{ old('address') }}</textarea>
                        @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                    <label for="image" class="col-sm-4 control-label">Upload Image</label>
                    <div class="col-sm-8">
                        <input type="file" name="image" id="image">
                        @if ($errors->has('image'))
                            <span class="help-block">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-success btn-lg">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


            <!--
            <br/>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default animated bounce">
                            <div class="panel-heading"> Register </div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST"  enctype="multipart/form-data" action="{{ route('user.register') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                                        <label for="fname" class="col-md-4 control-label">First Name</label>
                                        <div class="col-md-6">
                                            <input id="fname" type="text" class="form-control" name="fname" value="{{ old('fname') }}" required autofocus>
                                            @if ($errors->has('fname'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('fname') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
                                        <label for="lname" class="col-md-4 control-label">Last Name</label>
                                        <div class="col-md-6">
                                            <input id="lname" type="text" class="form-control" name="lname" value="{{ old('lname') }}" required autofocus>
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
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">Password</label>
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control" name="password" required>
                                            @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="gender" class="col-md-4 control-label">Gender</label>
                                        <div class="col-md-6"> <strong> Male </strong>
                                            <input name="gender" type="radio" value="M">
                                            <strong> Female </strong>
                                            <input name="gender" type="radio" value="F">
                                            @if ($errors->has('gender'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="image" class="col-md-4 control-label">Image</label>
                                        <div class="col-md-6">
                                            <input id="image" type="file"  name="image" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="col-md-4 control-label">Address</label>
                                        <div class="col-md-6">
                                            <textarea name="address" id="review_area" class="form-control" placeholder="vill city " required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary" name="submit">
                                            Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            @endsection