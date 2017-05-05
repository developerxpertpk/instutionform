@extends('layouts.admin.adminLayout')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">
                        Manage User
                    </h2>

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Manage User</a></li>
                        <li class="breadcrumb-item active"> Edit User </li>
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

            <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-lg-8 col-md-offset-2" id="edit-user">

                <div class="panel-heading"> </div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"  enctype="multipart/form-data" action="{{ route('user.updateuser' ,$user->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                            <label for="fname" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control" name="fname" value="{{ $user->fname }}" required autofocus>

                                @if ($errors->has('fname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="lname" class="col-md-4 control-label"> Last Name </label>

                            <div class="col-md-6">
                                <input id="lname" type="text" class="form-control" name="lname" value="{{ $user->lname }}" required autofocus>

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
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

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

                                <input name="gender" type="radio" value="M"  {{ $user->gender == 'M' ? 'checked' : '' }}/>

                                <strong> Female </strong>
                                <input name="gender" type="radio" value="F" {{ $user->gender == 'F' ? 'checked' : '' }} />

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
                                <input id="image" type="file"  name="image">
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <textarea name="address" class="form-control" value="" required> {{ $user->address }}</textarea>
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