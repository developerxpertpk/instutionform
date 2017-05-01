@extends('layouts.forumfinder_default')
@section('user_content')

<div class="container"><br/>
	<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default animated bounce">
                <div class="panel-heading">Start a Discussion</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"  enctype="multipart/form-data" action="/create_thread">
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

@if(isset($schooldata) && $schooldata->forums->count())
	<div class="container">
		<div class="col-sm-10">
			<h2>Existing Forums</h2>
				@foreach($schooldata->forums as $data)
					{{$data->id}}
				@endforeach
		</div>
	</div>
@endif

@endsection