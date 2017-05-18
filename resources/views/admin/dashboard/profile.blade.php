
@extends ('layouts.admin.adminLayout')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">
                    Admin Profile
                </h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active"><i></i>Profile </li>
                </ol>
            </div>
        </div>

		<div class="row">
    	<div class="col-xs-6 col-sm-6 col-md-6">
            <div class="col-md-6 admin-profile ">
               <img src="{{asset('upload/users/user_'.Auth::user()->id.'/images/profile_pic/current_dp/'.Auth::user()->image)}}" onerror="this.src='{{asset('image/user.png')}}'">
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Username:</strong>
                {{ Auth::user()->fname." ".Auth::user()->lname}}
            </div>
        </div>

         <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Email:</strong>
                {{ Auth::user()->email }}
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Gender:</strong>
                {{ Auth::user()->gender }}
            </div>
        </div>

         <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Address:</strong>
                {{ Auth::user()->address }}
            </div>
        </div>

         <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Role:</strong>
                        {{ Auth::user()->role->role}}
                </div>
        </div>

         <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Status:</strong>
                    @if(Auth::user()->status==1)
                    <button class="btn btn-success"> Active </button>
                    @else
                    <button class="btn btn-danger"> Inactive </button>
                    @endif
            </div>
        </div>
      </div>
      </div>
      </div>

@endsection
