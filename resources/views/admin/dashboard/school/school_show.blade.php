@extends('layouts.admin.adminLayout')
@section('content')

    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">

                <h2 class="page-header">{{ $schools->school_name }}School Profile</h2>

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href=" {{ route('school.index')}} ">Manage schools </a> </li>
                        <li class="breadcrumb-item active"> School Profile </li>
                    </ol>

        </div>

        <div class="row" id="show-rounder">

                <div class="col-md-6 col-lg-6 col-sm-12" id="school-profile">

                    <img src="#" onerror="this.src='{{  asset('/upload/default_school1.jpg') }} '">

                    {{--asset(App\School_image::where('school_id','=',$schools->id)->first()->image)--}}

                <div class="col-md-12">
                <h3>{{ $schools->school_name }}
                  </h3>
                </div>

                <div class="col-md-12">

                <fieldset id='demo1' class="rating">

                    <input class="stars" class="star5" type="radio" id="star5" name="rating" value="5" />
                    <label class = "full" for="star5" title="Awesome - 5 stars"></label>

                    <input class="stars" class="star4" type="radio" id="star4" name="rating" value="4" />
                    <label class = "full" for="star4" title="Pretty good - 4 stars"></label>

                    <input class="stars" class="star3" type="radio" id="star3" name="rating" value="3" />
                    <label class = "full" for="star3" title="Meh - 3 stars"></label>

                    <input class="stars" class="star2" type="radio" id="star2" name="rating" value="2" />
                    <label class = "full"  for="star2" title="Kinda bad - 2 stars"></label>

                    <input class="stars" class="star1" type="radio" id="star1" name="rating" value="1" />
                    <label class = "full" for="star1" title="Sucks big time - 1 star"></label>

                    <input type="hidden" name="hidden_input" value="{{$schools->id }}" />

                </fieldset>
                </div>
                <div class="col-md-12">
                    <span class="info">
                    </span>
                </div>

            <div class="col-md-12">

                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal01">
                   ADD Review
                </button>

                <!-- Modal  for reviews -->
                <div class="modal fade" id="myModal01" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"> Review  </h4>
                            </div>

                            <form method="post" action="{{ route('rating_reviews.store') }}">
                                {{ csrf_field() }}
                            <div class="modal-body-reviews">

                                <input type="hidden" name="school_id" id="" value="{{$schools->id}}">
                                <textarea  id="reviews" name="reviews" rows="5" cols="65" placeholder="Write Something here">

                                    Write Something here
                                </textarea>
                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>

                            </form>
                        </div>
                    </div>
                </div>


            </div>

        </div>

            <div class="col-md-6" id="school-details">

                <h3> School deatils :</h3>

                <div class="col-md-4">
                    <h4>City  : </h4>
                </div>

                <div class="col-md-8">
                    <h4>
                        {{ $schools->locations->city  }}
                    </h4>
                </div>

                <div class="col-md-4">
                    <h4>State  :</h4>
                </div>

                <div class="col-md-8">
                    <h4>
                    {{ $schools->locations->state  }}
                    </h4>
                </div>

                <div class="col-md-4">
                    <h4>Country  : </h4>
                </div>

                <div class="col-md-8">
                    <h4>
                        {{ $schools->locations->country  }}
                    </h4>
                </div>

                <div class="col-md-4">
                    <h4>ZIP  : </h4>
                </div>

                <div class="col-md-8">
                    <h4>
                        {{ $schools->locations->zip }}
                    </h4>
                </div>

            </div>
        </div>

        </div>
    </div>
@endsection