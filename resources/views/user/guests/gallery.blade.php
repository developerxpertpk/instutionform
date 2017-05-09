@extends('layouts.forumfinder_default')
@section('user_content')
    <!--gallery Portion-->
    <div class="container">
        <div class="row">
            <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="gallery-title">Gallery</h1>
            </div>
            <div align="center">
                <button class="btn btn-default filter-button" data-filter="all">All</button>
                <button class="btn btn-default filter-button" data-filter="hdpe">Top Schools</button>
                <button class="btn btn-default filter-button" data-filter="sprinkle">Featured Schools</button>
                <button class="btn btn-default filter-button" data-filter="spray">Popular Streams</button>
                <button class="btn btn-default filter-button" data-filter="irrigation">Trending Schools</button>
            </div>
            <br/>
            @if(isset($images))
                @if(count($images))
                    @foreach($images as $image)
                    <div class="gallery_product col-md-3 col-sm-4 col-xs-6 filter hdpe">
                        <div class="g_img">
                            @if($image->image_type == 1)
                                <img src="{{asset('upload/schools/school_'.$image->school_id.'/images/profile_pic/'.$image->image)}}"/>
                            @else
                                <img src="{{asset('upload/schools/school_'.$image->school_id.'/images/gallery/'.$image->image)}}"/>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                    <h2>No images yet</h2>
                @endif
            @else
                <script type="text/javascript">
                    window.location.href = '{{ url("/")}}';
                </script>
            @endif
            <!-- <div class="gallery_product col-md-3 col-sm-4 col-xs-6 filter hdpe">
                <div class="g_img">
                    <img src="image\school3.jpg"/>
                </div>
            </div>
            
            <div class="gallery_product col-md-3 col-sm-4 col-xs-6 filter hdpe">
                <div class="g_img">
                    <img  src="image\teach.png"/>
                </div>
            </div>
            
            <div class="gallery_product col-md-3 col-sm-4 col-xs-6 filter hdpe">
                <div class="g_img">
                    <img src="image\school1.jpg"/>
                </div>
            </div>
            
            <div class="gallery_product col-md-3 col-sm-4 col-xs-6 filter hdpe">
                <div class="g_img">
                    <img src="image\comb.png"/>
                </div>
            </div>
            <div class="gallery_product col-md-3 col-sm-4 col-xs-6 filter hdpe">
                <div class="g_img">
                    <img src="image\gfs.png"/>
                </div>
            </div>
            <div class="gallery_product col-md-3 col-sm-4 col-xs-6 filter hdpe">
                <div class="g_img">
                    <img src="image\army.png"/>
                </div>
            </div>
            <div class="gallery_product col-md-3 col-sm-4 col-xs-6 filter hdpe">
                <div class="g_img">
                    <img src="image\gg.png"/>
                </div>
            </div>
            <div class="gallery_product col-md-3 col-sm-4 col-xs-6 filter hdpe">
                <div class="g_img">
                    <img src="image\school2.jpg"/>
                </div>
            </div>
            <div class="gallery_product col-md-3 col-sm-4 col-xs-6 filter hdpe">
                <div class="g_img">
                    <img src="image\oakridge.png"/>
                </div>
            </div>
            <div class="gallery_product col-md-3 col-sm-4 col-xs-6 filter hdpe">
                <div class="g_img">
                    <img src="image\school4.png"/>
                </div>
            </div>
            <div class="gallery_product col-md-3 col-sm-4 col-xs-6 filter hdpe">
                <div class="g_img">
                    <img src="image\sps.png"/>
                </div>
                
            </div> -->
        </div>
    </div>
@endsection