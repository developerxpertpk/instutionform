@extends('layouts.admin.adminLayout')
@section('content')

    <div class="page-wrapper">


        <div class="container-fluid">
            <div class="row">
                <h3 class="page-header">{{ $schools->school_name }}School Profile</h3>
                <div class="pull-right">
                    <a href="{{ route('school.index') }}" class="btn btn-primary"> BACK </a>
                </div>
            </div>

        <div class="row" id="show-rounder">
            <div class="col-md-6">
                <h3>{{ $schools->school_name }}
                  </h3>
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

                    <form action="{{ route() }}">
                         <textarea placeholder="add your reviews">

                         </textarea>
                    </form>

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