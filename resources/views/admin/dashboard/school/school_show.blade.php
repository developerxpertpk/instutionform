@extends('layouts.admin.adminLayout')
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <h4 class="page-header">{{ $schools->school_name }}  Profile</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href=" {{ route('school.index')}} ">Manage schools </a> </li>
                        <li class="breadcrumb-item active"> School Profile </li>
                    </ol>
             </div>
            <div class="profile_view">
                <div class="col-md-4">
                    <div class="school-img col-md-12">
                        @if(isset($profile_image) && count($profile_image))
                            @foreach($profile_image as $image)
                                <img src="{{asset('upload/schools/school'.'_'.$schools->id.'/images/profile_pic/current_dp/'.$image->image)}}" onerror="this.src='{{asset('image/default_school.png')}}'" width="100%" height="150px">
                            @endforeach
                        @else
                            <img src="{{asset('image/default_school.png')}}" width="100%" height="150px"/>
                        @endif
                    </div>

                    <div class="update-review">

                        <div class="col-md-8 col-md-offset-4">
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

                        <div class="col-md-8 col-md-offset-4">
                            <span class="give_rate"> <strong> Rate This school  </strong></h5> </span>

                            <span class="info">
                            </span>
                        </div>

                        <div class="col-md-8 col-md-offset-4">
                            <button type="button" class="btn btn-primery" data-toggle="modal" data-target="#myModal01">
                             Add Review
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
                </div>

                <div class="col-md-8">
                    <div class="information">
                        <h4>   School Name  :  {{ $schools->school_name }} </h4>
                        <h4>   School Address  :  {{ $schools->school_address }} </h4>
                        <h4>   Country : {{ $schools->locations->country }}</h4>
                        <h4>   State : {{ $schools->locations->state }}</h4>
                        <h4>   city: {{ $schools->locations->city }} </h4>
                        <h4>   Zip : {{ $schools->locations->zip }} </h4>
                </div>
            </div>
        </div>
            <div class="school-gallary">
                <h4 class="page-header" > Gallery </h4>
                <div class="gallery-box">
                    @if(isset($gallery_images))
                        @if(count($gallery_images))
                            <div id="lightgallery">
                                @foreach($gallery_images as $image)
                                    <div class="col-lg-3 col-sm-4 col-xs-6">
                                        <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox">
                                            <img  class="thumbnail img-responsive" src="{{asset('upload/schools/school'.'_'.$schools->id.'/images/gallery/'.$image->image)}}" >
                                        </a>
                                        <button type="button" class="btn-primary"  data-toggle="modal" data-target="#delete{{ $image->id }}">
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
                                                        {!! Form::open(['method' => 'DELETE','route' => ['delete_image',$image->id],'style'=>'display:inline','class'=>'delete']) !!}

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
                                    <div> <h6>  No Image Uploaded  </h6> </div>
                                @endif
                                @endif
                        </div>
                </div>
            </div>

            <div class="school-documents">
                <h4 class="page-header"> Documents  </h4>

                <div class="documents">
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
                        @endforeach
                        @else
                        <div> <h6> No document Yet </h6> </div>
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </div>
    <script src="{{asset('js/ajax_rating.js') }}"></script>
    {{-- end of new code--}}
@endsection
