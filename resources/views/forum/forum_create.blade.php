@extends('layouts.forumfinder_default')
@section('user_content')

<div class="container"><br/>
	<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default animated bounce">
                <div class="panel-heading">Create Forum</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"  enctype="multipart/form-data" action="/create_forums">
                        {{ csrf_field() }}

                        <input type="hidden" name="school_id" value="{{ isset($school_id) ? $school_id : '' }}">

                        <div class="form-group{{ isset($error['title']) ? ' has-error' : '' }}">
                            <label for="title" class="col-md-2 control-label">Title</label>

                            <div class="col-md-7">
                                <input id="title" type="text" class="form-control" name="title" value="{{ isset($schooldata) ? $schooldata->school_name : '' }}" required autofocus>

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
                                <textarea name="description" id="review_area" class="form-control" placeholder="" required></textarea>
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
		<div class="col-sm-10">
			<h2>Related Forums</h2>
				@foreach($schooldata->forums as $data)
					{{$data->title}}
				@endforeach
		</div>
	</div>
@endif

@endsection