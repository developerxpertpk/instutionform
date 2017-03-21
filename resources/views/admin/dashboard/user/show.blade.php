@extends('layouts.admin.adminLayout')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> {{ $user->fname ." ".$user->lname}} Profile</h2>
            </div>

            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('user.index')}}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">

    	<div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                
               <img src="{{asset('/upload')}}/{{ $user->image }}" width="300px" height="250px">

            </div>
             <strong>IMAGE</strong>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Username:</strong>
                {{ $user->fname." ".$user->lname}}
            </div>
        </div>

         <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $user->email }}
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Gender:</strong>
                {{ $user->gender }}
            </div>
        </div>

         <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Address:</strong>
                {{ $user->address }}
            </div>
        </div>

         <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Role:</strong>
                {{ $user->role->role}}
            </div>
        </div>

         <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Status:</strong>
                {{ $user->status}}
            </div>
        </div>

    </div>

@endsection
