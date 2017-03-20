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

     <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation  </h4>
                  </div>
                  <div class="modal-body">
                   <h3> user profile {{$user->fname}} ? </h3>
                  </div>
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





                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                  </div>
                </div>
              </div>
            </div>

    	
@endsection
