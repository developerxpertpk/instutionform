@extends('layouts.forumfinder_default')
@section('user_content')

<div class="container">
	<h2>Forum</h2>
	<h1 class="center-block text-center">{{ $forum->title }}</h1>

	<div class="container">
		<strong>Description</strong>{!! $forum->description !!}
		<a href="/create_thread"><button class="btn btn-success" >Start a Discussion</button></a>
	</div>
	<div class="col-sm-10">
		
	</div>
	<div class="col-sm-2 table-bordered">
		<h4>Google Adsense</h4>
	</div>
</div>

@endsection