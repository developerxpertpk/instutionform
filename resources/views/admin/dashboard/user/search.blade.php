@extends('layouts.admin.adminLayout')
@section('content')

    <div class="page-wrapper">
        <div class="container-fluid">

        <div class="row">

            <div class="co-lg-12">
                    <h2 page-header> Search Result Found </h2>

                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }} ">Manage User </a></li>
                    <li class="breadcrumb-item active"> User Search</li>
                </ol>
            </div>
        </div>

	    @if ($message = Session::get('success'))
          <div class="alert alert-success">
            <p>{{ $message }}</p>
         </div>
        @endif

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

 <table class="table table-bordered">
     <tr> <h4> User List </h4> </tr>
        <tr>
            <th> Sr.NO </th>

            <th>Image</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Role</th>
            <th>status</th>
            <th width="280px">Action</th>
        </tr>


        @foreach ($users as $key => $user)
        
           @if($user->role->role == 'user') 
		        <td>{{ ++$i }}</td>
                <td><img src="{{ asset('/upload/'.$user->image) }}" width="100px" height="100px"></td>
		        <td>{{ $user->fname }}</td>
		        <td>{{ $user->lname }}</td>
		        <td>{{ $user->email }}</td>
		        <td>{{ $user->gender }}</td>
		        <td>{{ $user->address }}</td>
		        <td>{{ $user->role->role }}</td>
          		<td>{{ $user->status }}</td>
				<td>

                    <!-- Edit   button  -->
                    <a href="{{ route('user.edit' ,$user->id) }}" class="btn btn-success" > Edit </a>

                    <!-- show  button  -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target=".profile{{$user->fname}}">
                        Show
                    </button>

                    <!-- Model show  -->
                    <div class="modal fade profile{{$user->fname}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                    <h4 class="modal-title" id="myModalLabel"> {{$user->fname .$user->lname}}  Profile </h4>
                                </div>
                                <div class="modal-body">


                                    <div class="row user-show">

                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >

                                            <div class="form-group" id="user-img">
                                                <img src="{{asset('/upload')}}/{{ $user->image }}"  onerror="this.src='{{ asset('upload/default_user.jpg' )}}'" />
                                            </div>

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
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Button for  Delete-->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#mydelete{{$user->id}}">
                        Delete
                    </button>

                    <!-- Modal  for delete with id=01-->
                    <div class="modal fade" id="mydelete{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmation  </h4>
                                </div>

                                <div class="modal-body">
                                    <h4> Do you want to delete  {{$user->fname}} ? </h4>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                                    {!! Form::open(['method' => 'DELETE','route' => ['user.destroy', $user->id],'style'=>'display:inline','class'=>'delete']) !!}

                                    {!! Form::submit('delete', ['class' => 'btn btn-success']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- block/unblock button -->

                    <!-- block/unblock button -->
                    @if($user->status=='0')
                        <button type="button" class="btn btn-primery" data-toggle="modal" data-target="#blc_unblc{{$user->id}}">
                            Block
                        </button>
                    @endif

                    @if($user->status=='1')
                        <button type="button" class="btn btn-primery" data-toggle="modal" data-target="#blc_unblc{{$user->id}}">
                            UnBlock
                        </button>
                    @endif
                    <!-- Modal for block/unblock user -->
                    <div class="modal fade" id="blc_unblc{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel0"> Confirmation  </h4>
                                </div>

                                <div class="modal-body">
                                    @if($user->status=="0")
                                        <h4> Do you want to block  {{$user->fname}} ? </h4>
                                    @else
                                        <h4> Do you want to unblock {{ $user->fname}} ? </h4>
                                    @endif
                                </div>

                                <div class="modal-footer">
                                {!! Form::open(['route' =>['user.update1',$user->id],'method'=>'POST','class'=>'',]) !!}
                                <!--   { !! Form::label('status') !! } -->
                                @if($user->status == 1)
                                    {!! Form::radio('status', '0', true, ['class' => 'hidden name','value' => 0]) !!} <!-- unblock  -->

                                @else($user->status == 0)
                                    {!! Form::radio('status', '1', true, ['class' => 'hidden name','value' => 1]) !!}<!--  block -->
                                    @endif

                                    <button type="button" class="btn btn-default" data-dismiss="modal"> cancel </button>
                                    {!! Form::submit('yes', ['class' => 'btn btn-success']) !!}
                                    {!! Form::close() !!}

                                </div>
                            </div>
                        </div>
                    </div>

                </td>
         </tr>
   @endif
  @endforeach

  </table>

        </div>
        {!! $users->render() !!}
    </div>
@endsection
