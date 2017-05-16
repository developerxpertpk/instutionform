@extends('layouts.forumfinder_default')
@section('user_content')
    <!--gallery Portion-->
    <div class="container padding_btm">
        <div class="row">
            <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="gallery-title">Gallery</h1>
            </div>
            <br/>

            @if(isset($images))
                @if(count($images))
                    @foreach($images as $image)
                        <div class="gallery_product col-md-3 col-sm-4 col-xs-6 filter hdpe">
                            @if($image->image_type == 1)
                                <div id="myImg" class="unique_image gallery_product col-md-3 col-sm-4 col-xs-6 filter hdpe" style="background-image: url('{{asset('upload/schools/school_'.$image->school_id.'/images/profile_pic/'.$image->image)}}');background-size: cover;background-position:center;width: 100%;">
                                </div>
                            @else
                                <div id="myImg" class="unique_image gallery_product col-md-3 col-sm-4 col-xs-6 filter hdpe" style="background-image: url('{{asset('upload/schools/school_'.$image->school_id.'/images/gallery/'.$image->image)}}');background-size: cover;background-position:center;width: 100%;">       
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <!-- The Modal -->
                    <div id="myModal2" class="modal_custom">

                        <!-- The Close Button -->
                        <span class="close" onclick="document.getElementById('myModal2').style.display='none'">&times;</span>

                        <!-- Modal Content (The Image) -->
                        <img class="modal_content" id="img01">

                        <!-- Modal Caption (Image Text) -->
                        <div id="caption"></div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $('.unique_image').click(function(){
                                var src=$(this).css('background-image');
                                src=src.replace('url("','').replace('")','');

                                $('#myModal2').css("display","block");
                                $('#img01').attr('src',src);
                                $('#caption').html('Full View');
                            });
                            $('.close').click(function(){
                                $('#myModal2').css("display","none");
                            });
                        });
                    </script>
                @else
                    <h2>No images yet</h2>
                @endif
            @else
                <script type="text/javascript">
                    window.location.href = '{{ url("/")}}';
                </script>
            @endif
            
        </div>
    </div>
    
@endsection