
@extends('layouts.admin.adminLayout')
@section('content')

<div id="page-wrapper">
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
        Manage users
        </h1>
        <ol class="breadcrumb">
          <li>
            <i class="fa fa-dashboard"></i>Dashboard
          </li>
          <li class="active">
            <i class="fa fa-anchor"></i> users
          </li>
            <li class="active">
            <i class="fa fa-anchor"></i> List
            </li>
        
        </ol>
      </div>
    </div>



  <div class="col-lg-12 margin-tb">

        <div class="pull-left">
            <a class="btn btn-success" href="{{ route('user.create') }}" > Add
            </a>
        </div>

        <div class="pull-right user-search">
                  
                {!! Form::open(['method' => 'GET', 'url' => '/search'] ) !!}
                {!! Form::text('search', null, ['class="form-control search-box" ','placeholder' =>'Enter any name or email']) !!}

                {!! Form::submit('search', ['class' => 'btn btn-primery']) !!}

                {!! Form::close() !!}
        </div>
  </div>
</>

 <!--  check if any error -->
    @if ($message = Session::get('success'))
      <div class="alert alert-success">
            <p>{{  $message }}</p>
      </div>
    @endif

  <div class="user-list">
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
        <th width="320px">Action</th>
      </tr>

    @foreach ($users as $key => $user)
      @if($user->role->role == 'user')
        <tr>
          <td>{{ ++$i }}</td>
          <td>{{ $user->fname }}</td>
          <td>{{ $user->lname }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->gender }}</td>
          <td>{{ $user->image }}</td>
          <td>{{ $user->address }}</td>
          <td>{{ $user->role->role }}</td>
          <td>{{ $user->status }}</td>
          <td>


        <!-- Button for  Delete-->
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal01">
              Delete
          </button>

        <!-- Modal  for delete with id=01-->
        <div class="modal fade" id="myModal01" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirmation  </h4>
              </div>

            <div class="modal-body">
             <h3> Do you want to delete {{$user->fname}} ? </h3>
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
      @if($user->status=='0')
        <button type="button" class="btn btn-primery" data-toggle="modal" data-target="#myModal001">
            Block
        </button>
      @endif

      @if($user->status=='1')
        <button type="button" class="btn btn-primery" data-toggle="modal" data-target="#myModal001">
          UnBlock
        </button>
      @endif
    <!-- Modal for block/unblock user -->
    <div class="modal fade" id="myModal001" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel0"> Confirmation  </h4>
          </div>

        <div class="modal-body">
          @if($user->status=="0")
            <h3> Do you want to block{{$user->fname}} ? </h3>
          @else
            <h3> Do you want to Unblock {{ $user->fname}} ? </h3>
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