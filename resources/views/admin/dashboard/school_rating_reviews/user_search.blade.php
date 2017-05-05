@extends('layouts.admin.adminLayout')
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">

            <div class="row">

                <h3 class="page-header">  School Raings and reviews List
                </h3>

                <div class="row">
                <div class="pull-right">
                    <a href="{{ route('rating_reviews.index') }}" class="btn btn-primary"> Back </a>
                </div>
                </div>

                <div class="rating-list">
                    <table class="table table-bordered">

                        @if(isset($school_data))
                            @foreach($school_data as $data)
                        <tr>

                            <h4> {{ $data->schools->school_name }} Rating & Reviews Results </h4>
                        </tr>

                        <tr>
                            <td> ID </td>
                            <td> User Name </td>
                            <td> Rating </td>
                            <td> Reviews </td>
                            <td style=" width = 250px ">Action</td>
                        </tr>


                                <tr>
                                <td> {{ ++$i  }} </td>
                                <td> {{ $data->users->fname }} </td>
                                <td>
                                    @for( $i=1;$i <= $data->ratings; $i++)
                                        <i class="fa fa-star" aria-hidden="true"  style="color:blue;"></i>
                                    @endfor
                                    @for( $i=1;$i <= 5-$data->ratings; $i++)

                                        <i class="fa fa-star-o" aria-hidden="true"></i>

                                    @endfor


                                </td>
                                <td>{{ $data->reviews }} </td>
                                <td>

                                    <a href="{{ route('rating_reviews.edit',$data->schools->id) }}" class="btn btn-success"> Edit </a>
                                    <!-- Button for  Delete-->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#my{{ $data->id }}">
                                        Delete
                                    </button>

                                    <!-- Modal  for delete with id=01-->
                                    <div class="modal fade" id="my{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Confirmation  </h4>
                                                </div>

                                                <div class="modal-body">
                                                    <h3> Do you want to delete {{ $data->schools->school_name}} ratings and reviews ? </h3>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                                                    {!! Form::open(['method' => 'DELETE','route' => ['rating_reviews.destroy', $data->id],'style'=>'display:inline','class'=>'delete']) !!}

                                                    {!! Form::submit('delete', ['class' => 'btn btn-success']) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                                </tr>

                            @endforeach
                            @else
                                <tr>  No Data found </tr>
                            @endif




            </div>
        </div>
    </div>
    @endsection