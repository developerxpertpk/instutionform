@extends ('layouts.admin.adminLayout')
@section('content')
 <div class="page-wrapper">
     <div class="container-fluid">
         <div class="row">
             <h2 class="header">
                 <i class="fa fa-comments fa x5" aria-hidden="true"></i>  Forum
             </h2>
             <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                 <li class="breadcrumb-item active"> <i class="fa fa-comments fa x5" aria-hidden="true"></i> Forum</li>
             </ol>
         </div>

         <div class="row">
               {{-- code for search bar--}}
             <div class="pull-right">
                 <form method="get" action="{{ route('search.fourm.submit') }}"  >
                     <select name="search" class="form-control search-box">
                        <option> <h3> Search Reported forum </h3></option>
                         <option value="abuse"> Abuse</option>
                         <option value="span"> Span </option>
                         <option value="other"> Other </option>
                     </select>
                     <input type="submit" class="btn btn-success" />
                 </form>

             </div>
         </div>


         <div class="message">
             @if ($message = Session::get('success'))
                 <div class="alert alert-success">
                     <p>{{  $message }}</p>
                 </div>
             @endif
         </div>

         <div class="forum-data">
                 <table class="table table-bordered">
                     <tr> <h4> Forum List </h4></tr>
                     <tr>
                         <td>ID </td>
                         <td> Uesr Name  </td>
                         <td> School Name  </td>
                         <td> Title </td>
                         <td width="320px">  Action </td>
                     </tr>
         @if(isset($forum_data) && $forum_data->count())
             @foreach( $forum_data as $data)
                         <tr>
                             <td>{{ ++$i }} </td>
                             <td> {{ $data->users->fname }} </td>
                             <td> {{ $data->schools->school_name }}  </td>
                             <td> {{ $data->title }}</td>
                             <td>

             <a href="{{route('forum.show',$data->id)}}" class="btn btn-success"> View </a>
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
                             <h3> Do you want to delete {{$data->title}}  ? . </h3>
                         </div>

                         <div class="modal-footer">
                             <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                             {!! Form::open(['method' => 'DELETE','route' => ['forum.destroy', $data->id],'style'=>'display:inline','class'=>'delete']) !!}

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
 </div>
@endsection
