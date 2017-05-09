@extends('layouts.admin.adminLayout')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <h1 class="page-header">
                    School News
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item "><a href="{{ route('school_news.index') }}">School News</a></li>
                    <li class="breadcrumb-item active">Edit School/Insitutes News</li>
                </ol>
            </div>
            <!-- /.row  -->
            @if (count($errors))
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{  $message }}</p>
                </div>
            @endif

            <form class="form-horizontal" role="form" method="post" action="{{route('update_news',$school_news->id)}}"  enctype="multipart/form-data" >
                {{ csrf_field() }}

                <div class="form-group">
                    <label class="col-sm-6 col-md-6 col-lg-6 control-label"><h2> ----  News  ----- </h2>  </label>
                </div>

                <div class="form-group">
                    <label class="col-sm-6 col-md-2 col-lg-2 control-label"> News Title
                    </label>

                    <div class=" col-sm-8 col-md-8 ">
                        <input name="news_title"  class="form-control" value="{{ $school_news->news_title }}" required ></input>
                        @if ($errors->has('news_title'))
                            <span class="help-block">
							<strong>{{ $errors->first('news_title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-6 col-md-2 col-lg-2 control-label"> News Description
                    </label>

                    <div class=" col-sm-8 col-md-8 ">
                        <textarea  name="news_description"  id="newseditor"  required>
                            {{ $school_news->news_description }}
                        </textarea>

                        @if ($errors->has('news_description'))
                            <span class="help-block">
							<strong>{{ $errors->first('news_description') }}</strong>
						</span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-lg-8 col-md-offset-3 col-lg-offset-3">
                        <input type="submit"  class="btn btn-primery" />
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection