@extends('layouts.forumfinder_default')
@section('user_content')

<div class="container">
	<h2>Discussions</h2>
	<div class="col-sm-12 center-block  google_adsense">
		<div class="col-sm-8 text-center table-bordered">
			<h3>Google Adsense</h3>
		</div>
	</div>
	<section class="col-sm-12">
		<div class="col-sm-12">
				<h3>Topic: {{$thread->title}}</h3>
		</div>

		<!-- QUESTION Thread -->
		<div class="question col-sm-12 padding_zero">	
			<div class="col-sm-12 question_head">
				<p class="margin_zero">{{$thread->users->fname." ".$thread->users->lname}}</p>
			</div>
			<div class="media col-sm-12 question_description padding_zero">
	  			<div class="media-left">
	    			<a href="#">
	    				<img class="media-object description_img" src="{{asset('upload/'.$thread->users->image)}}" alt="{{asset('images/user.png')}}">
	    			</a>
	  			</div>

	  			<div class="media-body thread_description">
	    			<h4 class="media-heading">{{$thread->title}}</h4>
	    			{!! $thread->description !!}
	  			</div>
	  			<div class="like_dislike_div col-sm-offset-2 pull-left">

	  				@if(Auth::check())

	  					@if(count($thread->thread_likes))

	  						@if( count($thread->thread_likes->where('user_id','=',Auth::id())->where('thread_id','=',$thread->id)->where('is_liked_disliked','=','1')) > 0)
			  					
			  					<i class="fa fa-thumbs-up clickable" id="thread_0_{{$thread->id}}" name="thread_like_dislike" content="{{$thread->id}}" value=1 data=1 aria-hidden="true"></i><span class="ld_count">{{count($thread->thread_likes) > 0 ? count($thread->thread_likes->where('is_liked_disliked','1')) : 0}}</span>  <i class="fa fa-thumbs-o-down flipped clickable" id="thread_1_{{$thread->id}}" value=0 name="thread_like_dislike" data=0 content="{{$thread->id}}" aria-hidden="true"></i><span class="ld_count">{{count($thread->thread_likes) > 0 ? count($thread->thread_likes->where('is_liked_disliked','0')) : 0}}</span>
			  					

			  				@elseif( count($thread->thread_likes->where('user_id','=',Auth::id())->where('thread_id','=',$thread->id)->where('is_liked_disliked','=','0')) > 0)
			  					
			  					<i class="fa fa-thumbs-o-up clickable" id="thread_0_{{$thread->
			  					id}}" name="thread_like_dislike" content="{{$thread->id}}" value=1 data=0 aria-hidden="true"></i><span class="ld_count">{{count($thread->thread_likes) > 0 ? count($thread->thread_likes->where('is_liked_disliked','1')) : 0}}</span>  <i class="fa fa-thumbs-down flipped clickable" id="thread_1_{{$thread->id}}" value=0 name="thread_like_dislike" data=1 content="{{$thread->id}}" aria-hidden="true"></i><span class="ld_count">{{count($thread->thread_likes) > 0 ? count($thread->thread_likes->where('is_liked_disliked','0')) : 0}}</span>
			  				
			  				@else
	  							
	  							<i class="fa fa-thumbs-o-up clickable" id="thread_0_{{$thread->id}}" name="thread_like_dislike" content="{{$thread->id}}" value=1 data=0 aria-hidden="true"></i><span class="ld_count">{{count($thread->thread_likes) > 0 ? count($thread->thread_likes->where('is_liked_disliked','1')) : 0}}</span><i class="fa fa-thumbs-o-down flipped clickable" id="thread_1_{{$thread->id}}" value=0 name="thread_like_dislike" data=0 content="{{$thread->id}}" aria-hidden="true"></i><span class="ld_count">{{count($thread->thread_likes) > 0 ? count($thread->thread_likes->where('is_liked_disliked','0')) : 0}}</span>

			  				@endif
	  					@else
	  						
	  						<i class="fa fa-thumbs-o-up clickable" id="thread_0_{{$thread->id}}" name="thread_like_dislike" content="{{$thread->id}}" value=1 data=0 aria-hidden="true"></i><span class="ld_count">{{count($thread->thread_likes) > 0 ? count($thread->thread_likes->where('is_liked_disliked','1')) : 0}}</span>  <i class="fa fa-thumbs-o-down flipped clickable" id="thread_1_{{$thread->id}}" value=0 name="thread_like_dislike" data=0 content="{{$thread->id}}" aria-hidden="true"></i><span class="ld_count">{{count($thread->thread_likes) > 0 ? count($thread->thread_likes->where('is_liked_disliked','0')) : 0}}</span>
	  					@endif
	  					</div>
	  					<div class="reported_flag col-sm-offset-11 pull-right">
	  					@if(count($thread->reported_threads) > 0 )

	  						@if(count($thread->reported_threads->where('user_id','=',Auth::id())->where('thread_id','=',$thread->id) ) > 0)
						    	<i class="fa fa-flag clickable" id="thread_2_{{$thread->id}}" name="thread_report" value="1" content="{{$thread->id}}"	 aria-hidden="true"></i>
						    	
						    @else
						    	<i class="fa fa-flag-o clickable" id="thread_2_{{$thread->id}}" name="thread_report" value="0" content="{{$thread->id}}"	 aria-hidden="true"></i>
						    @endif
					    @else
					    	<i class="fa fa-flag-o clickable" id="thread_2_{{$thread->id}}" name="thread_report" value="0" content="{{$thread->id}}"	 aria-hidden="true"></i>				    	
					    @endif
					    </div>

					    <!-- Modal For REPORT -->
						<div class="modal fade" id="report_thread" role="dialog">
							<div class="modal-dialog">
								
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">What is wrong with this post?</h4>
									</div>
									<div class="container">
										<div class="row">
									        <div class="col-md-10 ">
								                <div class="panel-body">
								                    <form id="report_form" class="form-horizontal" role="form" method="POST" action="#">
								                        {{ csrf_field() }}
								                        <input type="hidden" name="data" value="{{$thread->id}}">
								                        <input type="hidden" name="user" value="{{Auth::id()}}">
								                        <div class="form-group col-md-7">
								                        	<label class="col-md-12 padding_zero">Choose one of the following reasons:</label>                        
										                    <input name="report" type="radio" value="abuse" >
															<strong> Abuse </strong> 
										                    <input name="report" type="radio" value="spam" checked>
										                    <strong> Spam </strong>
										                    <input name="report" type="radio" value="other">
										                    <strong> Other </strong>
										                </div>

								                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-7">
								                        	<label class="col-md-12 padding_zero">Description</label>
								                            <div class="col-md-6 padding_zero">
								                                <textarea class="form-control" name="report_description"></textarea>

								                                @if ($errors->has('password'))
								                                    <span class="help-block">
								                                        <strong>{{ $errors->first('password') }}</strong>
								                                    </span>
								                                @endif
								                            </div>
								                        </div>
								                        <div class="form-group">
								                            <div class="col-md-8 col-md-offset-4">
								                                <button type="submit" class="btn btn-primary custom-btn">
								                                    Submit
								                                </button>
								                            </div>
								                        </div>
								                    </form>
								                </div>
									        </div>
									    </div>
									</div>
								</div>		
							</div>
						</div>
						<!-- End of the modal -->

	  				@else
	  					
	  					<i class="fa fa-thumbs-o-up clickable" id="thread_0_{{$thread->id}}" name="thread_like_dislike" content="{{$thread->id}}" value=1 data=0 aria-hidden="true"></i><span>{{count($thread->thread_likes) > 0 ? count($thread->thread_likes->where('is_liked_disliked','1')) : 0}}</span>  <i class="fa fa-thumbs-o-down flipped clickable" id="thread_1_{{$thread->id}}" value=0 name="thread_like_dislike" check=0 content="{{$thread->id}}" aria-hidden="true"></i><span>{{count($thread->thread_likes) > 0 ? count($thread->thread_likes->where('is_liked_disliked','0')) : 0}}</span>
  					</div>
		    		<div class="reported_flag col-sm-offset-11 pull-right">
		    			<i class="fa fa-flag-o clickable" id="thread_2_{{$thread->id}}" name="thread_report" value="0" content="{{$thread->id}}"	 aria-hidden="true"></i>
		    		</div>

		    		<!-- Modal For REPORT -->
					<div class="modal fade" id="report_thread" role="dialog">
						<div class="modal-dialog">
							
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">What is wrong with this post?</h4>
								</div>
								<div class="container">
									<div class="row">
								        <div class="col-md-10 ">
							                <div class="panel-body">
							                    <form id="report_form" class="form-horizontal" role="form" method="POST" action="#">
							                        {{ csrf_field() }}
							                        <input type="hidden" name="data" value="{{$thread->id}}">
							                        <div class="form-group col-md-7">
							                        	<label class="col-md-12 padding_zero">Choose one of the following reasons:</label>                        
									                    <input name="report" type="radio" value="abuse" >
														<strong> Abuse </strong> 
									                    <input name="report" type="radio" value="spam" checked>
									                    <strong> Spam </strong>
									                    <input name="report" type="radio" value="other">
									                    <strong> Other </strong>
									                </div>

							                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-7">
							                        	<label class="col-md-12 padding_zero">Description</label>
							                            <div class="col-md-6 padding_zero">
							                                <textarea class="form-control" name="report_description"></textarea>

							                                @if ($errors->has('password'))
							                                    <span class="help-block">
							                                        <strong>{{ $errors->first('password') }}</strong>
							                                    </span>
							                                @endif
							                            </div>
							                        </div>
							                        <div class="form-group">
							                            <div class="col-md-8 col-md-offset-4">
							                                <button type="submit"  class="btn btn-primary custom-btn">
							                                    Submit
							                                </button>
							                            </div>
							                        </div>
							                    </form>
							                </div>
								        </div>
								    </div>
								</div>
							</div>		
						</div>
					</div>
					<!-- End of the modal -->
	  				@endif
	    			
	    		
			</div>
			
		</div>
		<a href="/reply_post"><button class="btn btn-success pull-right" >reply to the post</button></a>
		<h3>Replies</h3>
		<!-- ANSWERS COMMENTS -->
		@foreach($thread->thread_comments as $comments)
		<div class="answer col-sm-12 padding_zero">
			<div class="col-sm-12 answer_head">
				<p class="margin_zero">reply by ~ {{$comments->users->fname." ".$comments->users->lname}}</p>
			</div>
			<div class="media col-sm-12 question_description padding_zero">
	  			<div class="media-left">
	    			<a href="#">
	    				<img class="media-object description_img" src="{{asset('upload/'.$comments->users->image)}}" alt="{{asset('images/user.png')}}">
	    			</a>
	  			</div>


	  			<div class="media-body thread_description">
	    			{{$comments->comment}}
	  			</div>
	  			<div class="like_dislike_div col-sm-offset-2 pull-left">

	  				@if(Auth::check())

	  					@if(count($comments->thread_comment_likes_dislikes))

	  						@if(count($comments->thread_comment_likes_dislikes->where('user_id','=',Auth::id())->where('thread_comment_id','=',$comments->id)->where('is_liked_disliked','=','1')) > 0)
			  					
			  					<i class="fa fa-thumbs-up clickable" id="comment_0_{{$comments->id}}"  name="comment_like_dislike" content="{{$comments->id}}" data=1 value=1 aria-hidden="true"></i><span>{{count($comments->thread_comment_likes_dislikes) > 0 ? count($comments->thread_comment_likes_dislikes->where('is_liked_disliked','1')) : 0}}</span>  <i class="fa fa-thumbs-o-down flipped clickable" class="fa fa-thumbs-o-down flipped clickable" id="comment_1_{{$comments->id}}" content="{{$comments->id}}" data=0 value=0 name="comment_like_dislike" aria-hidden="true"></i><span>{{count($comments->thread_comment_likes_dislikes) > 0 ? count($comments->thread_comment_likes_dislikes->where('is_liked_disliked','0')) : 0}}</span>
			  					

			  				@elseif( count($comments->thread_comment_likes_dislikes->where('user_id','=',Auth::id())->where('thread_comment_id','=',$comments->id)->where('is_liked_disliked','=','0')) > 0)
			  					
			  					<i class="fa fa-thumbs-o-up clickable" id="comment_0_{{$comments->id}}"  name="comment_like_dislike" content="{{$comments->id}}" data=0 value=1 aria-hidden="true"></i><span>{{count($comments->thread_comment_likes_dislikes) > 0 ? count($comments->thread_comment_likes_dislikes->where('is_liked_disliked','1')) : 0}}</span>  <i class="fa fa-thumbs-down flipped clickable" class="fa fa-thumbs-o-down flipped clickable" id="comment_1_{{$comments->id}}" content="{{$comments->id}}" data=1 value=0 name="comment_like_dislike" aria-hidden="true"></i></i><span>{{count($comments->thread_comment_likes_dislikes) > 0 ? count($comments->thread_comment_likes_dislikes->where('is_liked_disliked','0')) : 0}}</span>
			  				@else
			  					
			  					<i class="fa fa-thumbs-o-up clickable" id="comment_0_{{$comments->id}}"  name="comment_like_dislike" content="{{$comments->id}}" data=0 value=1 aria-hidden="true"></i><span>{{count($comments->thread_comment_likes_dislikes) > 0 ? count($comments->thread_comment_likes_dislikes->where('is_liked_disliked','1')) : 0}}</span>  <i class="fa fa-thumbs-o-down flipped clickable" class="fa fa-thumbs-o-down flipped clickable" id="comment_1_{{$comments->id}}" content="{{$comments->id}}" data=0 value=0 name="comment_like_dislike" aria-hidden="true"></i></i><span>{{count($comments->thread_comment_likes_dislikes) > 0 ? count($comments->thread_comment_likes_dislikes->where('is_liked_disliked','0')) : 0}}</span>
			  				@endif

	  					@else
	  						
	  						<i class="fa fa-thumbs-o-up clickable" id="comment_0_{{$comments->id}}"  name="comment_like_dislike" content="{{$comments->id}}" data=0 value=1 aria-hidden="true"></i><span>{{count($comments->thread_comment_likes_dislikes) > 0 ? count($comments->thread_comment_likes_dislikes->where('is_liked_disliked','1')) : 0}}</span>  <i class="fa fa-thumbs-o-down flipped clickable" class="fa fa-thumbs-o-down flipped clickable" id="comment_1_{{$comments->id}}" content="{{$comments->id}}" data=0 value=0 name="comment_like_dislike" aria-hidden="true"></i></i><span>{{count($comments->thread_comment_likes_dislikes) > 0 ? count($comments->thread_comment_likes_dislikes->where('is_liked_disliked','0')) : 0}}</span>
	  					@endif
	  				@else
	  					<i class="fa fa-thumbs-o-up clickable" id="comment_0_{{$comments->id}}"  name="comment_like_dislike" content="{{$comments->id}}" data=0 value=1 aria-hidden="true"></i><span>{{count($comments->thread_comment_likes_dislikes) > 0 ? count($comments->thread_comment_likes_dislikes->where('is_liked_disliked','1')) : 0}}</span>  <i class="fa fa-thumbs-o-down flipped clickable" class="fa fa-thumbs-o-down flipped clickable" id="comment_1_{{$comments->id}}" content="{{$comments->id}}" data=0 value=0 name="comment_like_dislike" aria-hidden="true"></i></i><span>{{count($comments->thread_comment_likes_dislikes) > 0 ? count($comments->thread_comment_likes_dislikes->where('is_liked_disliked','0')) : 0}}</span>
	  				@endif
	    		</div>
			</div>
		</div>
		@endforeach

		<h3>Post a reply</h3>
		<div class="col-sm-10 reply_form table-bordered">
			<form action="/threads/{{$thread->id}}/reply_submit" method="post" enctype="Multipart/form-data" accept-charset="utf-8">
				{{ csrf_field() }}
				<br>
				<div class="form-group">
					<label>Your Reply *</label>
					<textarea class="form-control" name="reply"></textarea>
				</div>
				@if(!Auth::check())
				<h4>Reply as:</h4>
				<div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }} padding_zero col-md-7">
                    <label for="fname">First Name</label>
                        <input id="fname" type="text" class="form-control" name="fname" value="{{ old('fname') }}" required autofocus>

                        @if ($errors->has('fname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fname') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }} padding_zero col-md-7">
                    <label for="lname">Last Name</label>
                        <input id="lname" type="text" class="form-control" name="lname" value="{{ old('lname') }}" required autofocus>

                        @if ($errors->has('lname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('lname') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} padding_zero col-md-7">
                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} padding_zero col-md-7">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

               <div class="form-group padding_zero col-md-7">
                    <label for="password-confirm">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="form-group padding_zero col-md-7">
                    <label for="gender">Gender:    </label>
                    <input name="gender" type="radio" value="M">
					<strong> Male </strong> 
                    <input name="gender" type="radio" value="F">
                    <strong> Female </strong>

                    @if ($errors->has('gender'))
                        <span class="help-block">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                    @endif
                </div>
				@endif
				<div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success pull-right" name="submit">
                            Post
                        </button>
                    </div>
                </div>
			</form>

			<!-- Modal For Login -->
			<div class="modal fade" id="edit_user" role="dialog">
				<div class="modal-dialog">
					
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Login First</h4><a class="non_user" href="{{ route('register') }}">not registered yet?</a>
						</div>
						<div class="confirm_login">
							<div class="row">
						        <div class="col-md-10 ">
					                <div class="panel-body">
					                @if(Session::has('failed'))
					                	<span class="alert-danger" >{{Session::get('failed')}}</span>
					                @endif
					                    <form class="form-horizontal" role="form" method="POST" action="{{route('review_login')}}">
					                        {{ csrf_field() }}

					                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

					                            <div class="col-md-6">
					                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

					                                @if ($errors->has('email'))
					                                    <span class="help-block">
					                                        <strong>{{ $errors->first('email') }}</strong>
					                                    </span>
					                                @endif
					                            </div>
					                        </div>

					                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					                            <label for="password" class="col-md-4 control-label">Password</label>

					                            <div class="col-md-6">
					                                <input id="password" type="password" class="form-control" name="password" required autofocus>

					                                @if ($errors->has('password'))
					                                    <span class="help-block">
					                                        <strong>{{ $errors->first('password') }}</strong>
					                                    </span>
					                                @endif
					                            </div>
					                        </div>
					                        <div class="form-group">
					                            <div class="col-md-8 col-md-offset-4">
					                                <button type="submit" class="btn btn-primary custom-btn">
					                                    Login
					                                </button>

					                                <a class="btn btn-link" href="{{ route('password.request') }}">
					                                    Forgot Password ?
					                                </a>
					                            </div>
					                        </div>
					                    </form>
					                </div>
						        </div>
						    </div>
						</div>
					</div>		
				</div>
			</div>
			<!-- End of the modal -->
		</div>
	</section>
</div>
@if(Session::has('failed'))
<script type="text/javascript">
	$(document).ready(function(){
		$("#edit_user").modal();
	});
</script>
@endif


@endsection