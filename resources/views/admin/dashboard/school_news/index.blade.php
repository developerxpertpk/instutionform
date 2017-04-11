@extends('layouts.admin.adminLayout')
@section('content')
     <div class="page-wraper">
         <div class="container-fluid">

             <!-- Page Heading -->
             <div class="row">
                 <div class="col-lg-12">
                     <h1 class="page-header">
                         News Related to Schools
                     </h1>

                 </div>
             </div>
             <!--/.row -->

             <a href="{{ route('school_news.create')}}"> <button class="btn btn-primery"> Add News
                 </button></a>
             <div class="pull-right">

                 {!! Form::open(['method' => 'GET', 'route' => 'school_search'] ) !!}
                 {!! Form::text('search', null, ['class="form-control search-box" ','placeholder' =>'Enter any name or email']) !!}

                 {!! Form::submit('search', ['class' => 'btn btn-primery']) !!}

                 {!! Form::close() !!}


             </div>

             @if (count($errors))
                 <div class="alert alert-danger">
                     <strong>Whoops!</strong> There were some problems with your input.<br><br>
                     <ul>
                         @foreach ($errors->all() as $error)
                             <li>{{ $error }}</li>
                         @endforeach
                     </ul>
                 </div>
             @endif

             @if ($message = Session::get('success'))
                 <div class="alert alert-success">
                     <p>{{  $message }}</p>
                 </div>
             @endif

             <div class="list-news">
                 <table class="table table-bordered">
                     <tr><h3> Schoo News List </h3></tr>
                     <tr><h2>
                             <th>ID</th>
                             <th>School Name </th>
                             <th>News Title</th>
                             <th>Detail News </th>
                             <th>Status </th>
                             <th width="320px">Action</th> </h2>
                     </tr>
                     @foreach ($news as $school_news)
                         <tr>
                             <td>{{ ++$i }}</td>
                             <td>{{ $school_news->schools->school_name }}</td>
                             <td>{{ $school_news->news_title}} </td>
                             <td>{{ $school_news->news_description}} </td>
                             <td>{{ $school_news->status }}</td>
                             <td>
                                 <button type="button" class="btn btn-success" >Show</button>
                                 <a class="btn btn-primary" href="#">  Edit  </a>

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




                             </td>
                         </tr>
                    @endforeach
                 </table>
             </div>
             </div>
     </div>

@endsection
