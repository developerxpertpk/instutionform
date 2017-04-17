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
                         <div class="pull-left">
                             <h3> School Name  :: {{ $school_rating ->schools->school_name}} </h3>
                             <h3> User name :: {{ $school_rating->users->fname.''.$school_rating->users->lname}}
                             <h3> Rating :: {{ $school_rating->ratings }}</h3>
                             <h3> Review :: {{ $school_rating->reviews }} </h3>
                         </div>

                         <div class="pull-right">
                             <div class="group-form">

                             </div>
                         </div>

                     </div>



                 </div>
            </div>

    @endsection