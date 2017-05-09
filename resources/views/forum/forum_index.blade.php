@extends('layouts.forumfinder_default')
@section('user_content')

<div class="container">
	<div class="bs-example" data-example-id="striped-table">
	    <table class="table table-striped table-responsive">
	        <h2>Forums</h2>
	        <thead>
	            <tr>
	                <th>Forum</th>
	                <th>Description</th>
	                <th>Posts</th>
	                <th>Votes</th>
	                <th>Created At</th>
	            </tr>
	        </thead>
	        <tbody>
	        @if(count($forums))
	        	@foreach($forums as $forum)
					<tr class='clickable-row' href="/forum/show_forum/{{$forum->id}}" style="cursor: pointer;" >
						<td width="20%">{{$forum->title}}</td>
						<td width="35%">{!! str_limit($forum->description, $limit = 100, $end = ' ~read more..') !!}</td>
						<td width="15%">@if(count($forum->threads) == 1)1 post @elseif(!count($forum->threads)) No posts @else {{count($forum->threads)}} posts @endif</td>
						<td width="15%">@if(count($forum->forum_likes)) {{count($forum->forum_likes->where('is_liked_disliked','1'))}} <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> {{count($forum->forum_likes->where('is_liked_disliked','0'))}} <i class="fa fa-thumbs-o-down" aria-hidden="true"></i> @else No votes yet @endif</td>
						<td width="15%">{{$forum->created_at}}</td>
					</tr>
				@endforeach
			@else
				<h3>No Record</h3>
			@endif
	        </tbody>
	    </table>
	    {{$forums->links()}}
	    <div class="col-xs-12 text-right">
	        <a href="/create_forum">
	        	<button type="submit" class="btn btn-success btn-sm">Create Forum</button>
	        </a>
	    </div>
	</div>
</div>
    
    
<!--Some Popular Threads-->
<section class="container-fluid tab_schools">
	<div class="texts text-center">
	    <div class="container">
	        <h2>Posts</h2>
	    </div>
	</div>
	<div class="container">
	    <!-- Nav tabs -->
	    <ul class="nav nav-tabs text_center" role="tablist">
	        <li role="presentation" class="active">
	            <a href="#popular_thread" aria-controls="popular_thread" role="tab" data-toggle="tab">Popular Posts</a>
	        </li>
	        <li role="presentation">
	            <a href="#recent_threads" aria-controls="recent_threads" role="tab" data-toggle="tab">Recent Posts</a>
	        </li>
	    </ul>

	    <div class="tab-content">
	        <div role="tabpanel" class="tab-pane active" id="popular_thread">
	            <div class="bs-example" data-example-id="striped-table">
	                <table class="table table-striped">
	                    <h3>Some Popular Posts</h3>
	                    <tbody>
	                    	@if(count($popular_threads))
		                    	@foreach($popular_threads as $threads)

		                    		<tr class='clickable-row' href="/threads/show_thread/{{$threads->threads->id}}" style="cursor: pointer;" >
			 							<td width="30%">{{$threads->threads->title}}</td>
			 							<td width="40%">{!! str_limit($threads->threads->description, $limit = 100, $end = ' ~read more..') !!}</td>
			 							<td width="15%">@if(count($threads->threads['thread_comments'])) {{count($threads->threads['thread_comments'])}} replies @else no replies yet @endif</td>
			 							<td width="15%">@if(count($threads->threads['thread_likes'])) {{count($threads->threads['thread_likes']->where('is_liked_disliked','1'))}} <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> {{count($threads->threads['thread_likes']->where('is_liked_disliked','0'))}} <i class="fa fa-thumbs-o-down" aria-hidden="true"></i> @else No votes yet @endif</td>
			 						</tr>
		                        @endforeach
		                    @else
		                    	<h3>No Record</h3>
		                    @endif
	                    </tbody>
	                </table>
	            </div>
	        </div>
               
	        <div role="tabpanel" class="tab-pane " id="recent_threads">
	            <div class="bs-example" data-example-id="striped-table">
	                <table class="table table-striped table-responsive">
	                    <h3>Recent Posts</h3>
                        <tbody>
	                        @if(count($recent_threads))
			                    @foreach($recent_threads as $threads)
			 						<tr class='clickable-row' href="/threads/show_thread/{{$threads->id}}" style="cursor: pointer;" >
			 							<td width="30%">{{$threads->title}}</td>
			 							<td width="40%">{!! str_limit($threads->description, $limit = 50, $end = ' ~read more..') !!}</td>
			 							<td width="15%">@if(count($threads->thread_comments)) {{count($threads->thread_comments)}} replies @else no replies yet @endif</td>
			 							<td width="15%">@if(count($threads->thread_likes)) {{count($threads->thread_likes->where('is_liked_disliked','1'))}} <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> {{count($threads->thread_likes->where('is_liked_disliked','0'))}} <i class="fa fa-thumbs-o-down" aria-hidden="true"></i> @else No votes yet @endif</td>
			 						</tr>
								@endforeach
		                    @else
		                    	<h3>No Record</h3>
		                    @endif
                        </tbody>
	                </table>            
	            </div>
	        </div>
	    </div>
    </div>
</section>

@endsection