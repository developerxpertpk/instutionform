@extends('layouts.forumfinder_default')
@section('user_content')

<div class="container"><br/>
	<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default animated bounce">
                <div class="panel-heading">Create Forum</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"  enctype="multipart/form-data" action="{{url('/create_forums')}}">
                        {{ csrf_field() }}

                        <input type="hidden" name="school_id" value="{{ isset($school_id) ? $school_id : '' }}">

                        <div class="form-group{{ isset($error['title']) ? ' has-error' : '' }}">
                            <label for="title" class="col-md-2 control-label">Title</label>

                            <div class="col-md-7">
                                <input id="title" type="text" class="form-control" name="title" value="{{ isset($schooldata) ? $schooldata->school_name : old('title') }}" required autofocus>

                                @if (isset($error['title']))
                                    <span class="help-block">
                                        <strong>{{ $error['title'] }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ isset($error['description']) ? ' has-error' : '' }}">
                            <label for="description" class="col-md-2 control-label">Description</label>

                            <div class="col-md-9">
                                <textarea name="description" id="review_area" class="form-control" >{{ old('description') }}</textarea>
                            </div>
                            @if (isset($error['description']))
                                    <span class="help-block">
                                        <strong>{{ $error['description'] }}</strong>
                                    </span>
                            @endif
                        </div>

                        @if(isset($schools))

	                        <div class="form-group">
							  	<label for="sel1" class="col-md-2 control-label">Select School:</label>

							  	<div class="col-md-4">
							  		<select class="form-control" name="school_select_id" id="sel1">
							    		@foreach($schools as $school)
							    			<option value="{{$school->id}}">{{ $school->school_name }}</option>
							    		@endforeach
							  		</select>
							  	</div>
							</div>
						@endif


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

@if(isset($schooldata) && $schooldata->forums->count())
	<div class="container">
    </br>
		<div class="col-sm-12">
			<h2>Related Forums</h2>
            </br>
            </br>
            <table class="table table-striped table-responsive">
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
                    @foreach($schooldata->forums as $forum)
                        <tr class='clickable-row' href="{{url('/forum/show_forum/'.$forum->id)}}" style="cursor: pointer;" >
                            <td width="20%">{{$forum->title}}</td>
                            <td width="35%">{!! str_limit($forum->description, $limit = 100, $end = ' ~read more..') !!}</td>
                            <td width="15%">@if(count($forum->threads) == 1)1 post @elseif(!count($forum->threads)) No posts @else {{count($forum->threads)}} posts @endif</td>
                            <td width="15%">@if(count($forum->forum_likes)) {{count($forum->forum_likes->where('is_liked_disliked','1'))}} <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> {{count($forum->forum_likes->where('is_liked_disliked','0'))}} <i class="fa fa-thumbs-o-down" aria-hidden="true"></i> @else No votes yet @endif</td>
                            <td width="15%">{{$forum->created_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
		</div>
	</div>
@endif

@endsection