@extends('layouts.forumfinder_default')
@section('user_content')


<div class="container">
	<h2>Forums</h2>
	<div class="col-sm-12 ">
		<span class="col-sm-4">
			<h4>Create a new Forum</h4>
		</span>
		<span class="col-sm-8">
			<a href="/create_forum"><button class="btn btn-success" >Create Forum</button></a>
		</span>
		<span class="col-sm-12 table-bordered margin_bottom">
			<h4>Some Existing Forums</h4>
			<div class="col-sm-12">
				<table class="table table-hover table-responsive table-striped">
					<!-- <caption>table title and/or explanatory text</caption> -->
					<thead>
						<tr>
							<th>Forums</th>
							<th>Description</th>
							<th>Threads</th>
							<th>Created At</th>
						</tr>
					</thead>
					<tbody>
						@foreach($forums as $forum)
		 						<tr class='clickable-row' href="/forum/show_forum/{{$forum->id}}" style="cursor: pointer;" >
		 							<td width="20%">{{$forum->title}}</td>
		 							<td width="50%">{!! $forum->description !!}</td>
		 							<td width="15%"></td>
		 							<td width="15%">{{$forum->created_at}}</td>
		 						</tr>
						@endforeach
					</tbody>
				</table>
				{{$forums->links()}}
				
			</div>
		</span>
	</div>
	<div class="col-sm-12">
		<div class="col-sm-5 table-bordered popular_threads">
			<h3>Some popular threads</h3>
			@if($popular_threads->first()->count() != '')
				<table class="table table-hover table-responsive table-striped">
					<!-- <caption>table title and/or explanatory text</caption> -->
					<tbody>
						@foreach($popular_threads as $threads)
		 						<tr class='clickable-row' href="/threads/show_thread/{{$threads->threads->id}}" style="cursor: pointer;" >
		 							<td width="30%">{{$threads->threads->title}}</td>
		 							<td width="55%">{{$threads->threads->description}}</td>
		 							<td width="15%">at {{$threads->threads->created_at}}</td>
		 						</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<p><strong>Sorry, No data found</strong></p>
			@endif
		</div>
		<div class="col-sm-5 pull-right table-bordered recent_threads">
			<h3>Recent threads</h3>
			@if($recent_threads->first()->count() != '')
				<table class="table table-hover table-responsive table-striped">
					<!-- <caption>table title and/or explanatory text</caption> -->
					<tbody>
						@foreach($recent_threads as $threads)
		 						<tr class='clickable-row' href="/threads/show_thread/{{$threads->id}}" style="cursor: pointer;" >
		 							<td width="30%">{{$threads->title}}</td>
		 							<td width="55%">{!! $threads->description !!}</td>
		 							<td width="15%">at {{$threads->created_at}}</td>
		 						</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<p><strong>Sorry, No data found</strong></p>
			@endif
		</div>
	</div>
	
</div>
@endsection