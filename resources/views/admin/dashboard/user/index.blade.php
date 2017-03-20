@extends('layouts.admin.adminLayout')

@section('content')

 <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>User</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{route('user.create')}}"> Create New User</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Image</th>
            <th>Address</th>
            <th>Role</th>
            <th>status</th>
            <th width="280px">Action</th>
        </tr>

    @foreach ($users as $key => $user)

    	@if($user->role->role == 'user')
    		<tr>
		        <td>{{ ++$i }}</td>
		        <td>{{ $user->fname }}</td>
		        <td>{{ $user->lname }}</td>
		        <td>{{ $user->email }}</td>
		        <td>{{ $user->gender }}s</td>
		        <td>{{ $user->image }}</td>
		        <td>{{ $user->address }}</td>
		        <td>{{ $user->role->role }}</td>
            <td>{{ $user->activity }}</td>
		        <td>
		            <a class="btn btn-info" href= "{{ route('user.show',$user->id) }}"> Show </a>
                @if($user->status=='0')
                 <a class="btn btn-info" href= "{{ route('user.edit',$user->id) }}"> Block </a>
                 @endif

                  @if($user->status=='1')
                 <a class="btn btn-info" href= "{{ route('user.edit',$user->id) }}"> Unblock </a>
                 @endif
<!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
              Delete
            </button>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">  </h4>
                  </div>
                  <div class="modal-body">
                   <h1> Do you want to delete {{$user->fname}} ?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                   {!! Form::open(['method' => 'DELETE','route' => ['user.destroy', $user->id],'style'=>'display:inline','class'=>'delete']) !!}

                    {!! Form::submit('Yes', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>

 <!-- block  button -->


		        </td>
    </tr>
                 @endif
                @endforeach
            </table>

    {!! $users->render() !!}

@endsection


