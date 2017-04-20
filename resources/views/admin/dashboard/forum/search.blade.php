@extends('layouts.admin.adminLayout')
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                         Reported forum Search Result

                    </h1>

                </div>
            </div>
            <!--/.row -->

        <div class="pull-right">
            <a href="{{ route('forum.index')}}"> <button class="btn btn-primery">Back
                </button></a>
        </div>
        <!-- Message -->
        <div class="message">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{  $message }}</p>
                </div>
            @endif
        </div>
    <!--/.Message -->
            <table class="table table-bordered">
                <tr> <h3> List </h3></tr>
                <tr><h1>
                        <th>ID</th>
                        <th>User Name </th>
                        <th>Forum Title</th>
                        <th>Reported Type </th>
                        <th>Reported Reason </th>
                        <th width="320px">Action</th></h1>
                </tr>

            @if(isset($search_data))
                @foreach($search_data as $data)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $data->users->fname }}</td>
                        <td>{{ $data->forums->title }}</td>
                        <td>{{ $data->reporting_type }}</td>
                        <td>{{ $data->reporting_reason }}</td>
                        <td>
        <!-- Button for  Delete-->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal01">
            Delete
        </button>

        <!-- Modal  for delete with id=01-->
        <div class="modal fade" id="myModal01" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="data">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Confirmation  </h4>
                    </div>

                    <div class="modal-body">
                        <h3> Do you want to delete {{$data->forums->title}}  ? . </h3>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>

                        {!! Form::open(['method' => 'DELETE','route'=>['destroy_reported',$data->id],'style'=>'display:inline','class'=>'delete']) !!}

                        {!! Form::submit('delete', ['class' => 'btn btn-success']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </td>

    </tr>
    @endforeach
    @endif

            </table>
        </div>
    </div>
@endsection