
@extends('layouts.admin.adminLayout')
@section('content')
    <div class="page-wraper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Static Pages
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('content') }}">Static Page</a></li>
                        <li class="breadcrumb-item active">Add Page </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <form class="form-horizontal" role="form" method="post"  enctype="multipart/form-data" action="{{route('page.submit')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-sm-4 col-md-2 col-lg-2 control-label">Content Type* </label>
                        <div class="col-sm-8 col-md-8 ">

                            <select class="form-control" name="content_type">
                                <option >
                                @if($result->content_type ='static')
                                <option value="static" selected>Static</option>
                                @endif
                                @if($result->content_type ='error-page')
                                <option value="error-page" selected>Error Page</option>
                                @endif
                                @if($result->content_type ='error-page')
                                <option value="other" selected>other</option>
                                @endif
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
                            <input type="text"  id="title" name="title"  class="form-control">

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
                            <input type="text" id="slug" name="slug" class="form-control" required>

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
                    </div>
                </form>

            </div>

        </div>
    </div>
    {{-- script for slug--}}
    <script>
        $(document).ready(function(){
            $("#title").keyup(function(){
                var Text = $(this).val();
                Text = Text.toLowerCase();
                Text = Text.replace(/ /g,"-");
                Text = Text.replace(/[^a-zA-Z0-9\.]+/g,"-");
                Text = Text.replace(/\.+/g, "-");
                $("#slug").val(Text);
            });
        });
    </script>
@endsection
