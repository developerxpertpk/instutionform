@extends('layouts.admin.adminLayout')
@section('content')
    <div class="page-wraper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">
                        Add New News
                    </h2>
                </div>
            </div>
            <!--/.row -->

            <div class="pull-right">
                <a href="{{ route('school_news.index')}}"> <button class="btn btn-primery"> Back
                </button></a>
            </div>

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

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{  $message }}</p>
            </div>
        @endif

            <form class="form-horizontal" role="form" method="post" action="{{route('school_news.store')}}"  enctype="multipart/form-data" >
                {{ csrf_field() }}

                <div class="form-group">
                    <label class="col-sm-6 col-md-6 col-lg-6 control-label"><h2> ----  News  ----- </h2>  </label>
                </div>

                <div class="form-group">

                    <div class="ui-widget" >

                        <label class="col-sm-6 col-md-2 col-lg-2 control-label" for="school_name" >School Name: </label>
                        <div class=" col-sm-8 col-md-8 ">

                        <input id="auto" name="school_name" class="form-control">
                    </div>
                </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-6 col-md-2 col-lg-2 control-label"> News Title
                    </label>

                    <div class=" col-sm-8 col-md-8 ">
                        <input name="news_title"  class="form-control" required></input>

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
                        <textarea name="news_description" class="form-control" rows="4" required></textarea>

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
            {{--<script>--}}

                {{--$( "#auto" ).autocomplete({--}}
                {{--source: "{{URL('search_school')}}",--}}
                {{--minLength: 0,--}}
                {{--autofocus:true,--}}
                {{--select:function(e,ui){--}}
                    {{--console.log('selected');--}}
                {{--}--}}
                {{--});--}}
            {{--</script>--}}
        </div>
    </div>


@endsection
