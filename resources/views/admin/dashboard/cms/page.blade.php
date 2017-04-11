
@extends('layouts.forumfinder_default')
@section('user_content')


    @foreach($page as $page_data)
    	<section class="search_results">
			<div class="container">
				<h1>{{$page_data->title}}</h1>
				{!! $page_data->content !!}
			</div>
		</section>
    @endforeach
@endsection