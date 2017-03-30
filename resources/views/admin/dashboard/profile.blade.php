
@extends ('layouts.admin.adminLayout')

@section('content')

<div class="container fluid">
	<div class="container"> 
	     <H2><strong> Admin Profile </strong></H2>

		<div class="row">

    	<div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                
               <img src="{{asset('/upload')}}/{{ Auth::user()->image }}" width="300px" height="250px">

            </div>
             <strong> Admin Pic</strong>
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
                    {{ Auth::user()->status}}
            </div>
        </div>
      
      </div>
          <h1> *********************************************************************************** </h1>
      </div>
      </div>

@endsection
