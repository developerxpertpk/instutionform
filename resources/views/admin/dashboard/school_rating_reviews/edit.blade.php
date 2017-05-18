@extends('layouts.admin.adminLayout')
@section('content')
    <div class="page-wraper">
         <div class="conatiner-fluid">
             <div class="row">
                 <h2 class="page-header">
                     <i class="fa fa-star fa-1x"> Rating & Reviews</i>
                 </h2>
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                     <li class="breadcrumb-item"><a href="{{route('rating_reviews.index') }}"> Rating & Review </a></li>
                     <li class="breadcrumb-item active"> <i class="fa fa-pencil" aria-hidden="true"></i>Edit </li>
                 </ol>
             </div>

             {{-- script for ajax--}}


         <div class="row school-show show-rounder">
             <div class="row school_profile col-md-6">
                 <div class="profile_image col-md-5">
                     @if(isset($school_rating) && count($school_rating))
                         @foreach($school_rating->schools['school_images']->where('image_type','=',1) as $images)
                         <img src="{{asset('upload/schools/school_'.$school_rating->school_id.'/images/profile_pic/current_dp/'.$images->image)}}" onerror="this.src='{{asset('image/default_school.png')}}'">
                        @endforeach
                     @else
                        <img src="{{asset('image/default_school.png')}}"/>
                     @endif
                 </div>

                 <div class="col-md-7 school_detail">
                     <h4> School Name : </h4>
                     <h5>  {{ $school_rating->schools->school_name }}  </h5>
                     <h4> country :</h4>
                     <h5> {{ $school_rating->schools['locations']->country }} </h5>
                     <h4> State :</h4>
                     <h5> {{ $school_rating->schools['locations']->state }} </h5>
                     <h4> City : </h4>
                     <h5> {{ $school_rating->schools['locations']->city }} </h5>
                 </div>
              </div>

         <div class="row school_profile col-md-6">

             <div class="profile_image col-md-5">
                 @if(isset($school_rating) && count($school_rating))
                     <img src="{{asset('upload/users/user_'.$school_rating->users->id.'/images/profile_pic/current_dp/'.$school_rating->users->image)}}" onerror="this.src='{{asset('image/user.png')}}'">
                 @else
                     <img src="{{asset('image/user.png')}}"/>
                 @endif
             </div>

             <div class="col-md-7 school_detail">
                 <h4> User Name :</h4>
                 <h5>  {{ $school_rating->users->fname.' ' .$school_rating->users->fname }}  </h5>
                 <h4> Email :</h4>
                 <h5> {{ $school_rating->users->email }}</h5>
                 <h4>Gender : </h4>
                 <h5>
                     @if($school_rating->users->gender == 'F')
                        Female
                     @else
                         Male
                     @endif
                 </h5>
                 <h4> Role : </h4>
                 <h5> {{ $school_rating->users['role']->description }} </h5>
                 <h4> Address : </h4>
                 <h5> {{ $school_rating->users->address }} </h5>
             </div>
         </div>

        <div class="school-rating row">
            <div class="col-sm-8 col-sm-offset-4">
                <strong><i class="fa fa-star" aria-hidden="true"></i> School  Rating </strong>

                <div class="edit-rating">

                     <fieldset id='demo1' class="rating" class="edit-ratings">
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

                         <input type="hidden" name="hidden_input"  value="{{$school_rating->schools->id }}" />
                         <input type="hidden" name="hidden_input-user"  value="{{$school_rating->users->id }}" />
                     </fieldset>
                 </div>

                 <span class="info"></span>
                 <span class="info_edit"></span>
                 <button type="button" id="reset" class="btn btn-primary"> Reset </button>

            </div>

            <div class="col-md-8 col-md-offset-4">
                <form method ="post" action ="{{ route('update_review',$school_rating->id)}}">
                {{ csrf_field() }}

                    <label> <i class="fa fa-pencil" aria-hidden="true"></i> Edit Review</label>

                    <input type="hidden" name="user_id" value="{{ $school_rating->users->id }}">
                    <input type="hidden" name="school_id"  value="{{$school_rating->schools->id}}">

                    <div class="form-group">
                    <textarea  id="reviews" name="reviews" rows="5" cols="50">{{ $school_rating->reviews }}</textarea>
                    </div>

                    <div class="form-group">
                        {{--<buttton type="submit" class="btn btn-primary"> Submit </buttton>--}}
                        <input type="submit" value="submit"/>
                    </div>
                </form>
            </div>

        </div>
     </div>
    </div>
</div>
    {{-- ajax script --}}
    <script src="{{asset('js/ajax_edit_rating.js') }}"></script>
@endsection