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

            <div class=" row school-show show-rounder">

                <div class=" row school_profile col-md-6">

                    <div class="profile_image col-md-5">
                    @if(isset($profile_image))

                        @foreach($profile_image as $image)
                             <img src="{{asset('upload/schools/school'.'_'.$schools->id.'/images/profile_pic/current_dp/'.$image->image)}}" onerroronerror="this.src='{{asset('image/default_school.png')}}" width="100%">
                        @endforeach
                            {{--onerror="this.src='{{asset('image/default_school.png')}}'"--}}
                        @else
                        <img src="{{asset('image/default_school.png')}}"/>
                        @endif

                        <div class=" row col-md-12">

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
                        <span class="give_rate"> <strong> Rate school  </strong></h5>
                        </span>

                        <span class="info">
                        </span>
                        </div>
                     </div>

                    <div class="col-md-7">
                        <h3> <u> {{ $schools->school_name }} </u> </h3>
                    </div>
                </div>
                <div class="school_detail col-md-6">
                    <h4> <u> School location : </u>  </h4>
                    <h5> country :  {{ $schools->locations->country }}</h5>
                    <h5> State :  {{ $schools->locations->state }}</h5>
                    <h5> city :  {{ $schools->locations->city }}</h5>

                    <h4><u> Address : </u> </h4>
                    <h5> {{ $schools->school_address }}</h5>
                    <h4> <u> Zip Code : </u></h4>
                    <h5> {{ $schools->locations->zip }}</h5>
                </div>

                <div class="col-md-12">
                    <button type="button" class="btn btn-primery" data-toggle="modal" data-target="#myModal01">
                        Review
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

            <div class="row school_gallery show-rounder">

                    <div class="gallery col-md-12">

                        <div  class="row">

                        <h4 class="pull-left">Gallery Images</h4>
                        <h4 class="pull-right"> <a href=" {{ route('image.edit', $schools->id) }}" class="btn btn-primary"> Upload </a> </h4>
                        </div>

                        <div class="gallery-box">
                        @if(isset($gallery_images))
                            @if(count($gallery_images))
                         <div id="lightgallery">
                            @foreach($gallery_images as $image)
                                    <div class="col-lg-4 col-sm-4 col-xs-6">
                                        <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox">
                                            <img  class="thumbnail img-responsive" src="{{asset('upload/schools/school'.'_'.$schools->id.'/images/gallery/'.$image->image)}}" >
                                        </a>

                                        <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#delete{{ $image->id }}">
                                            Delete
                                        </button>

                                        <!-- Modal  for delete with id=01-->
                                        <div class="modal fade" id="delete{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Confirmation  </h4>
                                                    </div>

                                                    <div class="modal-body">
                                                        <h4> Do you want to delete {{$image->image}}  ? . </h4>
                                                    </div>

                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                                                        {!! Form::open(['method' => 'DELETE','route' => ['delete_image',$image->id,$schools->id ],'style'=>'display:inline','class'=>'delete']) !!}

                                                        {!! Form::submit('delete', ['class' => 'btn btn-success']) !!}
                                                        {!! Form::close() !!}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <img src="" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @else
                            <div> <h6>  No Image Uploaded  </h6></div>
                        @endif
                    @endif
                        {{--<h3> No Images </h3>--}}
                    </div>
                </div>
                </div>

          {{--div for documents--}}
            <div class="document show-rounder row">
                <div class="row">
                <h4 class="pull-left"> Documents </h4>
                <h4 class="pull-right">
                    <button class="btn btn-primary"> Upload </button>
                </h4>
                </div>
                @if(isset($documents))
                    @if(count($documents))
                        @foreach($documents as $document)
                                <div class="col-sm-2 school-pdf" >
                                    <div  id="pdf-image">
                                        <a href="{{asset('upload/schools/school_'.$schools->id.'/documents/'.$document->documents) }}" target="_blank">
                                            <img src="{{asset('image/pdf1.jpg') }}">
                                        </a>
                                    </div>

                                    <div id="pdf-title"> <h6> {{ $document->documents}} </h6>
                                    </div>
                                 </div>
                           {{--<iframe src="{{asset('upload/schools/school_'.$schools->id.'/documents/'.$document->documents) }}" frameborder="0" style="width:100%;min-height:640px;"></iframe>--}}
                        {{--{{ $document->documents}}--}}

                        @endforeach
                    @else
                        <div> <h6> No document Yet </h6> </div>
                    @endif
                @endif
            </div>
         </div>
        </div>
    </div>
@endsection