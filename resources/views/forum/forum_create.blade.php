@extends('layouts.forumfinder_default')
@section('user_content')

<div class="container"><br/>
	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default animated bounce">
                <div class="panel-heading"> Create Forum </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"  enctype="multipart/form-data" action="{{ route('user.register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-3 control-label">Title</label>

                            <div class="col-md-8">
                                <input id="title" type="text" class="form-control" name="title" value="{{ isset($schooldata) ? $schooldata->school_name : '' }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-3 control-label">Description</label>

                            <div class="col-md-8">
                                <textarea name="description" id="review_area" class="form-control" placeholder="" required></textarea>
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
@if(isset($schooldata))

@endif

@endsection