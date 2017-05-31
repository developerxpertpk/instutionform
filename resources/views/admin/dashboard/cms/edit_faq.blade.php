@extends('layouts.admin.adminLayout')
@section('content')
    <div class="page-wraper">
        <div class="conatiner-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Frequently Asked Question
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('content.index') }}">Static Page</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('freq_ask_ques') }}">FAQ'Q</a></li>
                        <li class="breadcrumb-item active">FAQ's Edit </li>
                    </ol>
                </div>
            </div>

            {{-- div for edit Faq's--}}
            @if (count($errors))
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <!--   <li>{{ $error }}</li> -->
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{  $message }}</p>
                </div>
            @endif

            @if(isset($result))
            <div class="qusetion col-md-10 col-md-offset-1">
                <h3> Edit FAQ's  </h3>
                <form class="form-horizontal" role="form" method="post"  enctype="multipart/form-data" action="{{route('question_update',$result->id)}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-sm-4 col-md-2 col-lg-2 control-label"> <h4>Question* </h4> </label>
                        <div class="col-sm-8 col-md-8 ">
                            <textarea class="form-control" name="question"  required autofocus>{{ $result->question }}</textarea>

                            @if ($errors->has('question'))
                                <span class="help-block">
							<strong>{{ $errors->first('question') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 col-md-2 col-lg-2 control-label"> <h4> Answer *  </h4></label>
                        <div class="col-sm-8 col-md-8 ">
                            <textarea  class="form-control" name="answer" rows="50" required >{{ $result->answer }}</textarea>
                            @if ($errors->has('answer'))
                                <span class="help-block">
							<strong>{{ $errors->first('answer') }}</strong>
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
            @else
                <div> <h6> NO data </h6> </div>
        @endif
        </div>
    </div>
@endsection