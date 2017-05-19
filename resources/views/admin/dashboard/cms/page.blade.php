
@extends('layouts.forumfinder_default')
@section('user_content')
	<style type="text/css">
		body{
			background: #eee;
		}	
	</style>

	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<div class="row">
				<div class="div_static col-lg-12 col-md-12 col-sm-12 col-xs-12">
					@foreach($particular_page as $page_data)
						<h1>{{$page_data->title}}</h1>
						<div class="text_static">{!! $page_data->content !!}</div>
    				@endforeach
    				<br/>
				</div>
				<!-- <div class="text">
					<p>In publishing and graphic design, lorem ipsum is a filler text
						commonly used to demonstrate the graphic elements of a document or
						visual presentation. Replacing meaningful content with placeholder
						text allows designers to design the form of the content before
					content itself produced.</p>
					
					
					
					<p>In publishing and graphic design, lorem ipsum is a filler text
						commonly used to demonstrate the graphic elements of a document or
						visual presentation. Replacing meaningful content with placeholder
						In publishing and graphic design,commonly used to demonstrate the
						visual presentation. A replacing meaningful content with placeholder
						text allows designers to design the form of the content before
					content itself produced.</p>
					
					
					<p>In publishing and graphic design, lorem ipsum is a filler text
						commonly used to demonstrate the graphic elements of a document or
						visual presentation. Replacing meaningful content with placeholder
						text allows designers to design the form of the content before
					content itself produced.</p>
				</div>
				
				<br/>-->
					
			</div>
		</div>
	</div>
	<!-- <div class="container">
		<div class="spacer20">
			<div class="col-md-9 text-left">
    			@foreach($particular_page as $page_data)
					<h1>{{$page_data->title}}</h1>
					{!! $page_data->content !!}
    			@endforeach
    		</div>
    		<div class="col-md-3 text-left">
			   	<h2>Quick Links</h2>
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
				</div>
	    	</div>
	    </div>
	</div> -->
@endsection