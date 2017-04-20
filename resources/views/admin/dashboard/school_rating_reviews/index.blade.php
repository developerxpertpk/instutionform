@extends('layouts.admin.adminLayout')
@section('content')
    <div class="page-wraper">
        <div class="conatiner-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Manage Rating & Reviews
                    </h1>

                <div class="pull-left">

                </div>

                <div class="pull-right">
                    {!! Form::open(['method' => 'GET', 'route' => 'rating_search'] ) !!}
                    {!! Form::text('search', null, ['class="form-control search-box" ','placeholder' =>'Enter any name or email']) !!}
                    {!! Form::submit('search', ['class' => 'btn btn-primery']) !!}
                    {!! Form::close() !!}

                </div>
                </div>
            </div>

            <div class="message">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{  $message }}</p>
                    </div>
                @endif
            </div>


            <div class="Ratings-list">
                <table class="table table-bordered">
                    <tr>  <h3>Ratings and Review List
                        </h3>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>School Name</th>
                        <th>Ratings</th>
                        <th>Reviews</th>
                        <th width="320px">Action</th>
                    </tr>

                    @foreach($schools_rating as $rating)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $rating->users->fname }}</td>
                            <td> {{ $rating->schools->school_name }}</td>
                            <td>
                                @for( $i=1;$i <= $rating->ratings; $i++)
                                    <i class="fa fa-star" aria-hidden="true"  style="color:blue;"></i>
                                @endfor
                                @for( $i=1;$i <= 5-$rating->ratings; $i++)

                                    <i class="fa fa-star-o" aria-hidden="true"></i>

                                @endfor
                            </td>
                            <td>{{ $rating->reviews}} </td>
                            <td>

                                <a href="{{ route('rating_reviews.edit',$rating->id) }}" class="btn btn-success"> Edit </a>
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
                                                <h3> Do you want to delete {{ $rating->schools->school_name}} ratings and reviews ? </h3>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                                                {!! Form::open(['method' => 'DELETE','route' => ['rating_reviews.destroy', $rating->id],'style'=>'display:inline','class'=>'delete']) !!}

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