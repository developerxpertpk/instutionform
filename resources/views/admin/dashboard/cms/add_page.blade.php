
@extends('layouts.admin.adminLayout')
@section('content')

    <div class="page-wraper">
        <div class="container-fluid">

            <div class="row">
                <h2 class="page-header"> Content Manager </h2>

            </div>

            <div class="row">
                <form class="form-horizontal" role="form" method="post"  enctype="multipart/form-data" action="{{route('page.submit')}}">
                    {{ csrf_field() }}


                    <div class="form-group">
                        <label class="col-sm-4 col-md-2 col-lg-2 control-label">Content Type* </label>
                        <div class="col-sm-8 col-md-8 ">
                            <select class="form-control" name="content_type">
                                <option value="content">Content</option>
                                <option value="error_page">Error Page</option>
                            </select>
                             @if ($errors->has('school_name'))
                                <span class="help-block">
							<strong>{{ $errors->first('school_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6 col-md-2 col-lg-2 control-label">Title * </label>
                        <div class="col-sm-6 col-md-8 col-lg-8 ">
                            <input type="text" name="title" class="form-control">

                            @if ($errors->has('title'))
                                <span class="help-block">
							<strong>{{ $errors->first('school_name') }}</strong>
						</span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-6 col-md-2 col-lg-2 control-label">Slug * </label>
                        <div class="col-sm-6 col-md-8 col-lg-8 ">
                            <input type="text" name="slug" class="form-control" required>

                            @if ($errors->has('slug'))
                                <span class="help-block">
							<strong>{{ $errors->first('school_name') }}</strong>
						</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6 col-md-2 col-lg-2 control-label">Content * </label>
                        <div class="col-sm-6 col-md-8 col-lg-8 ">
                            <textarea   id="mytextarea" name="content" class="form-control" required>
                            </textarea>
                            @if ($errors->has('slug'))
                                <span class="help-block">
							<strong>{{ $errors->first('school_name') }}</strong>
						</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6 col-md-2 col-lg-2 control-label"></label>
                        <div class="col-md-6">
                        <input type="submit"  class="btn btn-primery"> </input>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
