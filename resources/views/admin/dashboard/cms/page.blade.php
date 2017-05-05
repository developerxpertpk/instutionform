
@extends('layouts.forumfinder_default')
@section('user_content')

	<div class="container">
		<div class="spacer20">
			<div class="col-md-9 text-left">
    			@foreach($particular_page as $page_data)
					<h1>{{$page_data->title}}</h1>
					{!! $page_data->content !!}
    			@endforeach
    		</div>
    		<div class="col-md-3 text-left">
			   	<!-- <h2>Quick Links</h2>
		   		<div class="btn-group btn-group-vertical btn-block">
	                <a href="#" class="btn btn-default">Apple</a>
	                <a href="#" class="btn btn-default">Samsung</a>
	                <a href="#" class="btn btn-default">Sony</a>
	                <a href="#" class="btn btn-default">Apple</a>
	                <a href="#" class="btn btn-default">Samsung</a>
	                <a href="#" class="btn btn-default">Sony</a>
	            </div>            
				<div class="well-sm"> 
					<img src="{{asset('image\logo.png')}}"/>
				</div> -->
	    	</div>
	    </div>
	</div>
@endsection