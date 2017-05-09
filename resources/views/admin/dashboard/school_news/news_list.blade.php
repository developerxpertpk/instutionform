@extends('layouts.admin.adminLayout')
@section('content')
    <div class="page-wraper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <h1 class="page-header">
                    School News
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item "> <a href="{{ route('school_news.index') }}"> Manage School </a></li>
                    <li class="breadcrumb-item active">Search Result</li>
                </ol>
            </div>
            <!--/.row -->
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{  $message }}</p>
                </div>
            @endif

            @if(count($errors))
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="list-news">

                <table class="table table-bordered">
                    <tr><h3>{{ $school_data->school_name }} School News List </h3></tr>

                    @if(isset($news_result))
                        @if(count($news_result))
                            <tr><h2>
                                    <th>ID</th>
                                    <th>News Title</th>
                                    <th>Detail News </th>
                                    <th>Status </th>
                                    <th width="320px">Action</th> </h2>
                            </tr>

                        @foreach ($news_result as $school_news)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $school_news->news_title}} </td>
                            <td> {!! str_limit($school_news->news_description, $limit = 20, $end = '{.....}') !!}  </td>
                            <td>

                                @if($school_news->status == 1)
                                    <label type="button" class="btn btn-success" >
                                        Active
                                    </label>
                                @endif
                                @if($school_news->status == 0)
                                    <label type="button" class="btn btn-danger" >
                                        InActive
                                    </label>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{ route('school_news.show',$school_news->id)}}"> Show </a>

                                <a class="btn btn-primary" href="{{ route('school_news.edit',$school_news->id)}}">  Edit  </a>

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
                                                <h3> Do you want to delete {{$school_news->news_title}} ? </h3>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                                                {!! Form::open(['method' => 'DELETE','route' => ['school_news.destroy', $school_news->id],'style'=>'display:inline','class'=>'delete']) !!}
                                                {!! Form::submit('delete', ['class' => 'btn btn-success']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- block/unblock button -->
                                <!-- check for unblock -->
                                @if($school_news->status ==1)
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#blc_ublc{{$school_news->id}}">
                                        Inactive
                                    </button>
                                @endif
                            <!-- check for block -->
                                @if($school_news->status == 0)
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#blc_ublc{{$school_news->id}}">
                                        Active
                                    </button>
                            @endif
                            <!-- Modal for block/unblock school -->
                                <div class="modal fade" id="blc_ublc{{$school_news->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel0"> Confirmation  </h4>
                                            </div>

                                            <div class="modal-body">
                                                @if($school_news->status ==1)
                                                    <h4> Do you want to block  {{$school_news->news_title}} ? </h4>
                                                @else
                                                    <h4> Do you want to unblock {{ $school_news->news_title}} ? </h4>
                                                @endif
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal"> cancel </button>

                                            {!! Form::open(['route' =>['school_news.status',$school_news->id],'method'=>'POST','class'=>'',]) !!}
                                            <!--   { !! Form::label('status') !! } -->
                                            @if( $school_news->status ==0)
                                                {!! Form::radio('status','1', true, ['class' => 'hidden name','value' =>1]) !!} <!-- unblock  -->

                                            @else( $school_news->status ==1)
                                                {!! Form::radio('status','0', true, ['class' => 'hidden name','value' => 0])!!}<!--  block -->
                                                @endif
                                                {!! Form::submit('yes', ['class' => 'btn btn-success']) !!}

                                                {!! Form::close() !!}

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td> <h4>  !!oops Sorry  NO News Added YET </h4> </td>
                        </tr>
                            <tr> <td>
                            Click Here TO add News
                                <a href="{{ route('school_news.create')}}"> <button class="btn btn-primery"> Add News </button>
                                    </a>
                    @endif
                        @endif
                </table>
            </div>
        </div>
    </div>
@endsection
