@extends ('layouts.admin.adminLayout')
@section('content')


<div id="page-wrapper">
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
				Manage Schools & Institutes
				</h1>

			</div>
        </div>
		<!--/.row -->


	    <a href="{{ route('school.create')}}"> <button class="btn btn-primery"> Add School
        </button></a>
    <div class="pull-right">

        {!! Form::open(['method' => 'GET', 'route' => 'school_search'] ) !!}
        {!! Form::text('search', null, ['class="form-control search-box" ','placeholder' =>'Enter any name or email']) !!}

        {!! Form::submit('search', ['class' => 'btn btn-primery']) !!}

        {!! Form::close() !!}


    </div>
 <!-- end of model0 (add model) -->

 <!-- container to show detail of schools -->
    <div class="message">
  @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{  $message }}</p>
        </div>
    @endif
    </div>

<div class="list-school">
    <table class="table table-bordered">

        <tr><h3> School List </h3></tr>

        <tr><h2>
            <th>ID</th>
            <th>NAME </th>
            <th>ZIP</th>
            <th>CITY </th>
            <th>STATE</th>
            <th>COUNTRY</th>
            <th>STATUS</th>
            <th width="320px">Action</th></h2>
        </tr>
    @foreach ($schools as $key => $school)
    		<tr>
		        <td>{{ ++$i }}</td>
		        <td>{{ $school->school_name }}</td>
                <td>{{ $school->locations->zip }} </td>
		        <td>{{ $school->locations->city }} </td>
		        <td>{{ $school->locations->state}} </td>
		        <td>{{ $school->locations->country}} </td>
            	<td>{{ $school->status }}</td>
		        <td>

                    <!-- show  button  -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target=".profile{{$school->id}}">Show</button>

                    <!-- Model show  -->
                    <div class="modal fade profile{{$school->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                    <h4 class="modal-title" id="myModalLabel">{{$school->school_name}} Profile </h4>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-lg-12 margin-tb">
                                            <div class="pull-left">
                                                <h2> {{$school->school_name}} Profile</h2>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row user-show">

                                        <div class="col-xs-6 col-sm-6 col-md-6" id="user-img">
                                            <div class="form-group">
                                                <img src="{{asset('/upload/schools')}}/{{ $school->school_name.$school->id }}" width="250px" height="250px">
                                            </div>
                                            <strong>{{ $school->school_name }}</strong>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>School Name:</strong>
                                                {{$school->school_name}}
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>Loaction details:</strong>
                                                <strong>Zip</strong>
                                                {{ $school->locations->zip }}
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>City:</strong>
                                                {{ $school->locations->city }}
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>Address:</strong>
                                                {{ $school->locations->state }}
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>Country:</strong>
                                                {{ $school->locations->country}}
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>Status:</strong>
                                                {{ $school->status}}
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

                     {{-- button for edit--}}
                    <a class="btn btn-primary" href="{{ route('school.edit',$school->id)}}">  Edit  </a>

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
             <h3> Do you want to delete {{$school->school_name}}  ? . </h3>
            </div>

            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                  {!! Form::open(['method' => 'DELETE','route' => ['school.destroy', $school->id],'style'=>'display:inline','class'=>'delete']) !!}

                  {!! Form::submit('delete', ['class' => 'btn btn-success']) !!}
                  {!! Form::close() !!}
            </div>
          </div>
        </div>
       </div>

                <!-- block/unblock button -->
                    <!-- check for unblock -->
                @if($school->status=='0')
                    <button type="button" class="btn btn-primery" data-toggle="modal" data-target="#myModal001">
                        Block
                    </button>
                @endif
                <!-- check for block -->
                @if($school->status=='1')
                    <button type="button" class="btn btn-primery" data-toggle="modal" data-target="#myModal001">
                        UnBlock
                    </button>
                @endif
                <!-- Modal for block/unblock school -->
                <div class="modal fade" id="myModal001" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel0"> Confirmation  </h4>
                                </div>

                                <div class="modal-body">
                                    @if($school->status=="0")
                                        <h3> Do you want to block{{$school->school_name}} ? </h3>
                                    @else
                                        <h3> Do you want to Unblock {{ $school->school_name}} ? </h3>
                                    @endif
                                </div>

                                <div class="modal-footer">
                                {!! Form::open(['route' =>['school.status',$school->id],'method'=>'POST','class'=>'',]) !!}
                                <!--   { !! Form::label('status') !! } -->
                                @if($school->status == 1)
                                    {!! Form::radio('status', '0', true, ['class' => 'hidden name','value' => 0]) !!} <!-- unblock  -->

                                @else($school->status == 0)
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
	@endforeach

			</table>
        </div>
 	</div>
 </div>


@endsection