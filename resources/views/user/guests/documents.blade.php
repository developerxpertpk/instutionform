@extends('layouts.forumfinder_default')
@section('user_content')

<!--School Documents -->
	<div class="container padding_btm">
        <div class="row">
            <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="gallery-title">Documents</h1>
            </div>
            </br>
            @if(isset($documents))
                @if(count($documents))
                    @foreach($documents as $document)
                    <div class="gallery_product col-md-2 col-sm-4 col-xs-6 filter hdpe">
                        <div class="g_img">
                        	<a href="{{asset('upload/schools/school_'.$document->school_id.'/documents/'.$document->documents)}}" target="_blank"><img src="{{asset('image/pdf1.jpg') }}"/></a>
                        </div>
                        <div id="pdf-title">
                        	<h6>{{$document->documents}}</h6>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-sm-12 text-center">
                    	<span>{{$documents->links()}}</span>
                    </div>
                @else
                    <h2>No Documents yet</h2>
                @endif
            @else
                <script type="text/javascript">
                    window.location.href = '{{ url("/")}}';
                </script>
            @endif
        </div>
    </div>
@endsection