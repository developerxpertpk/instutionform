@extends('layouts.admin.adminLayout')
@section('content')

    <div class="page-wraper">
        <div class="container-fluid">
            <div class="row">
                <h2 class="page-header"> Add Question </h2>


            <div class="pull-right">
                <a class="btn btn-danger" href="{{ route('freq_ask_ques') }}"> BACK  </a>
            </div>
        </div>

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

            <div class="qusetion col-md-10 col-md-offset-1">
                <h3> Ask Question and add answer :->  </h3>

                <form class="form-horizontal" role="form" method="post"  enctype="multipart/form-data" action="{{route('question_submit')}}">
                    {{ csrf_field() }}


                    <div class="form-group">
                        <label class="col-sm-4 col-md-2 col-lg-2 control-label"> <h4>Question* </h4> </label>
                        <div class="col-sm-8 col-md-8 ">
                            <textarea class="form-control" name="question" required autofocus>
                            </textarea>

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
                            <textarea  class="form-control" name="answer" required >
                            </textarea>
                            @if ($errors->has('answer'))
                                <span class="help-block">
							<strong>{{ $errors->first('answer') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">

                            <div class="col-md-8 col-lg-8 col-md-offset-3 col-lg-offset-3">
                                <input type="submit"  class="btn btn-primery"> </input>
                            </div>
                    </div>

                </form>

            </div>

        </div>
    </div>

@endsection
