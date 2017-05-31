@extends('layouts.forumfinder_default')
@section('user_content')

<script src="{{asset('js/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<div class="row2" style="background:rgba(0, 0, 0, 0) url('{{asset('image/hands.jpg')}}') no-repeat scroll 0 0 / cover ;">
    <div class="container">
        <div class="form-horizontal_row2">
            <form class="form-horizontal" role="form" method="POST"  enctype="multipart/form-data" action="{{url('/create_thread')}}">

                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{isset($forum_id) ? $forum_id : ''}}">
                
                <h4 class="discuss">Start a Discussion</h4>
                
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="col-sm-4 control-label">Title</label>
                    <div class="col-sm-8">
                        <input id="title" type="text" class="form-control" name="title" value="" required autofocus>
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="col-sm-4 control-label">Description</label>
                    <div class="col-sm-8">
                        <textarea name="description" id="review_area" class="form-control" placeholder=""></textarea>
                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
              
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-success btn-lg">Submit</button>  
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
     CKEDITOR.replace('review_area');

     
</script>

<!-- 
<div class="container"><br/>
	<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default animated bounce">
                <div class="panel-heading">Start a Discussion</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"  enctype="multipart/form-data" action="{{url('/create_thread')}}">
                        {{ csrf_field() }}

                        <input type="hidden" name="id" value="{{isset($forum_id) ? $forum_id : ''}}">

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-2 control-label">Title</label>

                            <div class="col-md-7">
                                <input id="title" type="text" class="form-control" name="title" value="" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-2 control-label">Description</label>

                            <div class="col-md-9">
                                <textarea name="description" id="review_area" class="form-control" placeholder=""></textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-3">
                                <button type="submit" class="btn btn-primary" name="submit">
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

@if(isset($schooldata) && count($schooldata->forums))
	<div class="container">
		<div class="col-sm-10">
            <table class="table table-striped table-responsive">
    			<h2>Existing Forums</h2>
				@foreach($schooldata->forums as $forum)
                    <tr class='clickable-row' href="{{url('/forum/show_forum/'.$forum->id)}}" style="cursor: pointer;" >
                        <td width="20%">{{$forum->title}}</td>
                        <td width="35%">{!! str_limit($forum->description, $limit = 100, $end = ' ~read more..') !!}</td>
                        <td width="15%">@if(count($forum->threads) == 1)1 post @elseif(!count($forum->threads)) No posts @else {{count($forum->threads)}} posts @endif</td>
                        <td width="15%">@if(count($forum->forum_likes)) {{count($forum->forum_likes->where('is_liked_disliked','1'))}} <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> {{count($forum->forum_likes->where('is_liked_disliked','0'))}} <i class="fa fa-thumbs-o-down" aria-hidden="true"></i> @else No votes yet @endif</td>
                        <td width="15%">{{$forum->created_at}}</td>
                    </tr>
				@endforeach
            </table>
		</div>
	</div>
@endif -->

@endsection