@extends('layouts.admin.adminLayout')
@section('content')

            <div class="page-wraper">
                 <div class=" conatiner-fluid">
                     <div class="row">

                         <h3 class="page-header"> Edit School Ratings and Reviews </h3>

                         <div class="pull-right">
                             <a href="{{ route('rating_reviews.index') }}" class="btn btn-success"> Back</a>
                         </div>
                     </div>


                     <div class="school-rating">

                         <div class="col-md-6">
                             <div class="col-md-6">
                                 {{--<img src="{{ asset(App\School_image::where('school_id','=',$school_rating->schools->id)->first()->image) }}" alt="{{asset('upload/def_school.png')}}" width="250px" height="200px">--}}
                             </div>

                             <h4>{{ $school_rating ->schools->school_name}}</h4>
                                 <h5>
                                 @for( $i=1;$i <= $school_rating->ratings; $i++)
                                     <i class="fa fa-star" aria-hidden="true"  style="color:blue;"></i>
                                 @endfor
                                 @for( $i=1;$i <= 5-$school_rating->ratings; $i++)

                                     <i class="fa fa-star-o" aria-hidden="true"></i>
                                 @endfor
                                 </h5>
                         </div>

             <div class="edit-rating">

                 <h3> Edit User ratings </h3>

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

                     <input type="hidden" name="hidden_input" value="{{$school_rating->schools->id }}" />

                 </fieldset>



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

                 <form method="post" action="{{ route('update_review',$school_rating->id)}}">
                     {{ csrf_field() }}
                     <div class="modal-body-reviews">

                         <input type="hidden" name="user_id" value="{{ $school_rating->users->id }}">
                         <input type="hidden" name="school_id"  value="{{$school_rating->schools->id}}">
                         <textarea  id="reviews" name="reviews" rows="5" cols="65"> {{ $school_rating->reviews }}
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

     </div>
</div>
@endsection