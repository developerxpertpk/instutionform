@extends('layouts.admin.adminLayout')
@section('content')
   <div class="page-wraper">
        <div class="conatiner-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Manage Schools & Institutes  / Search Result

                    </h1>

                </div>
            </div>
            <!--/.row -->

            <h2 class="page-header"> Result found </h2>
            <div class="pull-right">
                <a href="{{ route('school.index')}}"> <button class="btn btn-primery">Back
                    </button></a>
            </div>

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
                    <tr>
                        <h1>
                            <th>ID</th>
                            <th>NAME </th>
                            <th>ZIP</th>
                            <th>CITY </th>
                            <th>STATE</th>
                            <th>COUNTRY</th>
                            <th>STATUS</th>
                            <th width="320px">Action</th>
                        </h1>
                    </tr>

                    @if(isset($schools))
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

                                <a href="{{ route('school.show' ,$school->id )}}" class="btn btn-success" > Show </a>

                                <a class="btn btn-primary" href="{{ route('school.edit',$school->id)}}">  Edit  </a>

                                <!-- Button for  Delete-->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $school->id }}">
                                    Delete
                                </button>

                                <!-- Modal  for delete with id=01-->
                                <div class="modal fade" id="delete{{ $school->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Confirmation  </h4>
                                            </div>

                                            <div class="modal-body">
                                                <h3> Do you want to delete {{$school->school_name}} ? </h3>
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
                                    <button type="button" class="btn btn-primery" data-toggle="modal" data-target="#blc_ublc{{$school->id}}">
                                        Block
                                    </button>
                                @endif
                            <!-- check for block -->
                                @if($school->status=='1')
                                    <button type="button" class="btn btn-primery" data-toggle="modal" data-target="#blc_ublc{{$school->id}}">
                                        UnBlock
                                    </button>
                            @endif
                            <!-- Modal for block/unblock school -->

                            <div class="modal fade" id="blc_ublc{{$school->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel0"> Confirmation  </h4>
                                            </div>

                                            <div class="modal-body">
                                                @if($school->status=="0")
                                                    <h4> Do you want to block  {{$school->school_name}} ? </h4>
                                                @else
                                                    <h4> Do you want to unblock {{ $school->school_name}} ? </h4>
                                                @endif
                                            </div>

                                            <div class="modal-footer">

                                            <button type="button" class="btn btn-default" data-dismiss="modal"> cancel </button>

                                            {!! Form::open(['route' =>['school.status',$school->id],'method'=>'POST','class'=>'',]) !!}
                                            <!--   { !! Form::label('status') !! } -->
                                            @if($school->status == 1)
                                                {!! Form::radio('status', '0', true, ['class' => 'hidden name','value' => 0]) !!} <!-- unblock  -->

                                            @else($school->status == 0)
                                                {!! Form::radio('status', '1', true, ['class' => 'hidden name','value' => 1]) !!}<!--  block -->
                                                @endif

                                                {!! Form::close() !!}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @else
                        @foreach ($locations as $school)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $school->schools->school_name }}</td>
                                <td>{{ $school['zip'] }} </td>
                                <td>{{ $school['city'] }} </td>
                                <td>{{ $school['state']}} </td>
                                <td>{{ $school['country']}} </td>
                                <td>{{ $school->schools->status }}</td>
                                <td>
                                    <!-- show  button  -->
                                    <a href="{{ route('school.show' ,$school->id )}}" class="btn btn-success" > Show </a>

                                    <a class="btn btn-primary" href="{{ route('school.edit',$school->id)}}">  Edit  </a>

                                    <!-- Button for  Delete-->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $school->id }}">
                                        Delete
                                    </button>

                                    <!-- Modal  for delete with id=01-->
                                    <div class="modal fade" id="delete{{ $school->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Confirmation  </h4>
                                                </div>

                                                <div class="modal-body">
                                                    <h3> Do you want to delete {{$school->id}} ? </h3>
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
                                        <button type="button" class="btn btn-primery" data-toggle="modal" data-target="#blc_ublc{{$school->id}}">
                                            Block
                                        </button>
                                    @endif
                                <!-- check for block -->
                                    @if($school->status=='1')
                                        <button type="button" class="btn btn-primery" data-toggle="modal" data-target="#blc_ublc{{$school->id}}">
                                            UnBlock
                                        </button>
                                @endif
                                <!-- Modal for block/unblock school -->
                                    <div class="modal fade" id="blc_ublc{{$school->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel0"> Confirmation  </h4>
                                                </div>

                                                <div class="modal-body">
                                                    @if($school->status=="0")
                                                        <h4> Do you want to block  {{$school->school_name}} ? </h4>
                                                    @else
                                                        <h4> Do you want to unblock {{ $school->school_name}} ? </h4>
                                                    @endif
                                                </div>

                                                <div class="modal-footer">

                                                    <button type="button" class="btn btn-default" data-dismiss="modal"> cancel </button>

                                                {!! Form::open(['route' =>['school.status',$school->id],'method'=>'POST','class'=>'',]) !!}
                                                <!--   { !! Form::label('status') !! } -->
                                                @if($school->status == 1)
                                                    {!! Form::radio('status', '0', true, ['class' => 'hidden name','value' => 0]) !!} <!-- unblock  -->

                                                @else($school->status == 0)
                                                    {!! Form::radio('status', '1', true, ['class' => 'hidden name','value' => 1]) !!}<!--  block -->
                                                    @endif

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