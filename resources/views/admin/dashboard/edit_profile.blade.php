        @extends('layouts.admin.adminLayout')
        @section('content')
        <div id="page-wrapper">
        <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
        <div class="col-lg-12">
        <h2 class="page-header">
            Admin Edit Detail
        </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active"><i></i> Edit Admin </li>
        </ol>
        </div>
        </div>
        <!--  check if any error -->
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
        <p>{{  $message }}</p>
        </div>
        @endif
        {{-- dIV FOR ERRORS--}}
        @if (count($errors) > 0)
        <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
        @endif

        <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-lg-8 col-md-offset-2" id="edit_admin_profile">

        <div class="edit_body">
        <div class="col-md-8 col-md-offset-3">
                <div class="col-md-8 col-md-offset-1 ">
                    <h3><strong> Edit Detail </strong> </h3>
                </div>
                <div class="col-md-12 edit_admin_profile">
                     <img src="{{ asset('upload/users/user_'.Auth::user()->id.'/images/profile_pic/current_dp/'.Auth::user()->image) }}">
                </div>

        </div>

         <form class="form-horizontal" role="form" method="POST"  enctype="multipart/form-data" action="{{ route('user.updateuser' ,Auth::user()->id) }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="image" class="col-md-4 control-label">Change Profile</label>
                <div class="col-md-6">
                    <input id="image" type="file"  name="image">
                </div>
            </div>

            <div class="form-group">
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

            <div class="form-group">
                <label for="lname" class="col-md-4 control-label"> Last Name </label>

                <div class="col-md-6">
                    <input id="lname" type="text" class="form-control" name="lname" value="{{ Auth::user()->lname }}" required autofocus>

                    @if ($errors->has('lname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
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

            <div class="form-group">
                <label for="gender" class="col-md-4 control-label">Gender</label>
                <div class="col-md-6" >
                    <strong> Male </strong>
                    <input name="gender" type="radio" value="M"  {{ Auth::user()->gender == 'M' ? 'checked' : '' }}/>
                    <strong> Female </strong>
                    <input name="gender" type="radio" value="F" {{ Auth::user()->gender == 'F' ? 'checked' : '' }} />
                    @if ($errors->has('gender'))
                        <span class="help-block">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <label for="address" class="col-md-4 control-label">Address</label>
                <div class="col-md-6">
                    <textarea name="address" class="form-control" value="" required>{{ Auth::user()->address }}</textarea>
                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
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
        @endsection