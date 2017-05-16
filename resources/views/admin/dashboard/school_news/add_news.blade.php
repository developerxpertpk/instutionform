@extends('layouts.admin.adminLayout')
@section('content')
    <div class="page-wraper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                    <h2 class="page-header">
                        Add New News
                    </h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{ route('school_news.index') }}">School News</a></li>
                        <li class="breadcrumb-item active">Add School News </li>
                    </ol>

            </div>
            <!--/.row -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{  $message }}</p>
            </div>
        @endif

        @if(count($errors))
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <form class="form-horizontal" role="form" method="post" action="{{route('school_news.store')}}"  enctype="multipart/form-data" >
                {{ csrf_field() }}

                <div class="form-group">
                    <label class="col-sm-6 col-md-6 col-lg-6 control-label"><h2> ----  News  ----- </h2>  </label>
                </div>

                <div class="form-group">
                    <div class="ui-widget">

                        <label for="school_name" class="col-sm-6 col-md-2 col-lg-2 control-label" > School Name </label>

                        <div class="col-sm-8 col-md-8">

                        <input id="schoolTest"  name="school_name" class="form-control" placeholder="please enter at least two characters" required />

                            <input type="hidden" id="school_id" name="school_id" />


                            @if ($errors->has('news_title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('news_title') }}</strong>
                                </span>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 col-md-2 col-lg-2 control-label"> News Title
                    </label>

                    <div class=" col-sm-8 col-md-8 ">
                        <input type="text" name="news_title"  class="form-control" required></input>

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
                        <textarea name="news_description" id="newseditor"  class="form-control" required>
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
            {{-- autocomplete function script send post request to the source using word term in jquery string--}}
            <script>
                $( function(){
                    $("#schoolTest").autocomplete({
                        source: "/school_news/get_school_data",
                        minLength:2,
//                      appendTo: "#school_id"
                        select: function( event, ui){
                           //console.log(event);
                            console.log('here');
                            console.log(ui.item.label);
                            console.log(ui.item.label);
                            console.log(ui.item.value);
                            $("#schoolTest").val(ui.item.label);
                            $('#school_id').val(ui.item.value);
                            $("#schoolTest").val(ui.item.label);
//                            $('#school_id').attr("value", item.value );
                            return false;
                        }
                    });
                });
            </script>
        </div>
    </div>



@endsection
