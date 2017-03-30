@extends('layouts.admin.adminLayout')

@section('content')

<div class="Page-wapper">
    <div class="container">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Change Password 
                        </h1>
                      
                    </div>
                </div>

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
<!-- 
    @if(Session::has('message'))
    <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif -->
 <!--  check if any error -->
    @if ($message = Session::get('success'))
      <div class="alert alert-success">
            <p>{{  $message }}</p>
      </div>
    @endif


<form id="form-change-password" role="form" method="POST" action="{{route('admin.postpwd')}}"  class="form-horizontal">

  <div class="col-md-9">

    <label for="current-password" class="col-sm-6 col-md-6 col-lg-6 control-label">Current Password</label>
    <div class="col-sm-6 col-md-6 col-lg-6">

        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

        <div  class="form-group {{ $errors->has('current-password') ? ' has-error' : '' }}"> 
           
            <input type="password" class="form-control" id="current-password" name="current-password" placeholder="Current Password" required autofocus>

               @if ($errors->has('current-password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('current-password') }}</strong>
                      </span>
                @endif
          </div>
      </div>


    <label for="password" class="col-sm-6 col-md-6 col-lg-6 control-label">New Password</label>
       <div class="col-sm-6 col-md-6 col-lg-6">
     

       <div  class="form-group {{ $errors->has('password') ? ' has-error' : '' }}"> 
        <input type="password" class="form-control" id="password" name="password" placeholder="New Password" required>

       @if ($errors->has('current-password'))
                <span class="help-block">
                    <strong>{{ $errors->first('current-password') }}</strong>
                </span>
          @endif
      </div>
  
    </div>

    <label for="password_confirmation" class="col-sm-6 col-md-6 col-lg-6 control-label">Re-enter Password</label>
    <div class="col-sm-6 col-md-6 col-lg-6">
  

      <div  class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password" required>

         @if ($errors->has('password_confirmation'))
          <span class="help-block">
              <strong>{{ $errors->first('password_confirmation') }}</strong>
          </span>
        @endif
      </div>
   </div>
  
  </div>

  <div class="form-group">
    <div class="col-sm-offset-5 col-sm-6 col-md-6 col-lg-6 ">
      <button type="submit" class="btn btn-primery">Submit</button>
    </div>
  </div>
  
      </form>
    </div>
  </div>
</div>

@endsection