@extends('layouts.forumfinder_default')
@section('user_content')

<div class="container ">
	<h2>Forum</h2>
	<h1 class="center-block text-center">{{ $forum->title }}</h1>

	<div class="container table-bordered">
	<br/>
		<h1 class="padding_zero margin_zero">Description</h1>
		{!! $forum->description !!}
		<br/>
		<div class="like_dislike_div_forum pull-left">

			@if(Auth::check())

				@if(count($forum->forum_likes))
					
					@if( count($forum->forum_likes->where('user_id','=',Auth::id())->where('forum_id','=',$forum->id)->where('is_liked_disliked','=','1')) > 0)
  						
  						<i class="fa fa-thumbs-up clickables" id="forum_0_{{$forum->id}}" name="forum_like_dislike" content="{{$forum->id}}" value=1 data=1 aria-hidden="true"></i><span class="ld_count">{{count($forum->forum_likes) > 0 ? count($forum->forum_likes->where('is_liked_disliked','1')) : 0}}</span>  <i class="fa fa-thumbs-o-down flipped clickables" id="forum_1_{{$forum->id}}" value=0 name="forum_like_dislike" data=0 content="{{$forum->id}}" aria-hidden="true"></i><span class="ld_count">{{count($forum->forum_likes) > 0 ? count($forum->forum_likes->where('is_liked_disliked','0')) : 0}}</span>
  					

  					@elseif( count($forum->forum_likes->where('user_id','=',Auth::id())->where('forum_id','=',$forum->id)->where('is_liked_disliked','=','0')) > 0)
  						
  						<i class="fa fa-thumbs-o-up clickables" id="forum_0_{{$forum->id}}" name="forum_like_dislike" content="{{$forum->id}}" value=1 data=0 aria-hidden="true"></i><span class="ld_count">{{count($forum->forum_likes) > 0 ? count($forum->forum_likes->where('is_liked_disliked','1')) : 0}}</span>  <i class="fa fa-thumbs-down flipped clickables" id="forum_1_{{$forum->id}}" value=0 name="forum_like_dislike" data=1 content="{{$forum->id}}" aria-hidden="true"></i><span class="ld_count">{{count($forum->forum_likes) > 0 ? count($forum->forum_likes->where('is_liked_disliked','0')) : 0}}</span>
  				
  					@else
						
						<i class="fa fa-thumbs-o-up clickables" id="forum_0_{{$forum->id}}" name="forum_like_dislike" content="{{$forum->id}}" value=1 data=0 aria-hidden="true"></i><span class="ld_count">{{count($forum->forum_likes) > 0 ? count($forum->forum_likes->where('is_liked_disliked','1')) : 0}}</span><i class="fa fa-thumbs-o-down flipped clickables" id="forum_1_{{$forum->id}}" value=0 name="forum_like_dislike" data=0 content="{{$forum->id}}" aria-hidden="true"></i><span class="ld_count">{{count($forum->forum_likes) > 0 ? count($forum->forum_likes->where('is_liked_disliked','0')) : 0}}</span>

  					@endif
				@else
					
					<i class="fa fa-thumbs-o-up clickables" id="forum_0_{{$forum->id}}" name="forum_like_dislike" content="{{$forum->id}}" value=1 data=0 aria-hidden="true"></i><span class="ld_count">{{count($forum->forum_likes) > 0 ? count($forum->forum_likes->where('is_liked_disliked','1')) : 0}}</span>  <i class="fa fa-thumbs-o-down flipped clickables" id="forum_1_{{$forum->id}}" value=0 name="forum_like_dislike" data=0 content="{{$forum->id}}" aria-hidden="true"></i><span class="ld_count">{{count($forum->forum_likes) > 0 ? count($forum->forum_likes->where('is_liked_disliked','0')) : 0}}</span>
				@endif
				</div>
				<div class="reported_flag_forum col-sm-offset-5 pull-right">
				@if(count($forum->reported_forum) > 0 )

					@if(count($forum->reported_forum->where('user_id','=',Auth::id())->where('forum_id','=',$forum->id) ) > 0)
			    	<i class="fa fa-flag clickables" id="forum_2_{{$forum->id}}" name="forum_report" value="1" content="{{$forum->id}}"	 aria-hidden="true"></i>
			    	
			    @else
			    	<i class="fa fa-flag-o clickables" id="forum_2_{{$forum->id}}" name="forum_report" value="0" content="{{$forum->id}}"	 aria-hidden="true"></i>
			    @endif
		    @else
		    	<i class="fa fa-flag-o clickables" id="forum_2_{{$forum->id}}" name="forum_report" value="0" content="{{$forum->id}}"	 aria-hidden="true"></i>				    	
		    @endif
		    </div>

		    <!-- Modal For REPORT -->
			<div class="modal fade" id="report_forum" role="dialog">
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
					                        <input type="hidden" name="data" value="{{$forum->id}}">
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
				
				<i class="fa fa-thumbs-o-up clickables" id="forum_0_{{$forum->id}}" name="forum_like_dislike" content="{{$forum->id}}" value=1 data=0 aria-hidden="true"></i><span>{{count($forum->forum_likes) > 0 ? count($forum->forum_likes->where('is_liked_disliked','1')) : 0}}</span>  <i class="fa fa-thumbs-o-down flipped clickables" id="forum_1_{{$forum->id}}" value=0 name="forum_like_dislike" check=0 content="{{$forum->id}}" aria-hidden="true"></i><span>{{count($forum->forum_likes) > 0 ? count($forum->forum_likes->where('is_liked_disliked','0')) : 0}}</span>
			</div>
			<div class="reported_flag_forum col-sm-offset-5 pull-right">
				<i class="fa fa-flag-o clickables" id="forum_2_{{$forum->id}}" name="forum_report" value="0" content="{{$forum->id}}"	 aria-hidden="true"></i>
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
					                        <input type="hidden" name="data" value="{{$forum->id}}">
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
	   
		<br/>
	</div>
	<div class="container">
	</br>
		<a href="/create_thread/{{$forum->id}}"><button class="btn btn-success" >Start a Discussion</button></a>
	</div>
	</br>
	<div class="col-sm-12 padding_zero">
		<div class="col-sm-10 table-bordered">
		<h3>Some Recent Discussions</h3>
			<table class="table table-hover table-responsive table-striped" style="cursor: pointer;">
				@foreach($forum->threads as $threads)
					<tr class='clickable-row' href="/threads/show_thread/{{$threads->id}}">
						<td width="70%">{{$threads->title}}</td>
						<td width="30%">{{ count($threads->thread_comments) != 0 ? count($threads->thread_comments) : 0}} replies</td>
					</tr>
				@endforeach
			</table>
		</div>
		<div class="col-sm-2 table-bordered">
			<h4>Google Adsense</h4>
		</div>
	</div>
	
</div>
@if(Session::has('failed'))
<script type="text/javascript">
	$(document).ready(function(){
		$("#edit_user").modal();
	});
</script>
@endif

@endsection