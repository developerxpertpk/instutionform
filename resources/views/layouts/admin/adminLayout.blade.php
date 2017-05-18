<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title> Admin dashboard </title>
    <!-- addes juery -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <!--  Location.js-->
    <script  type="text/javascript" src="{{ asset('js/location.js')}}"></script>
    <!-- added google map api script and key -->
    <script language="javascript" src="https://maps.google.com/maps/api/js?&key=AIzaSyBPnarv312BM-0LEDilopAMkE1gw0RUVns"async defer></script>
    <!-- added google map api script and key -->
    <script src="{{asset('js/validate.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/additional-methods.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.js')}}"></script>
    {{--<script src="{{asset('js/ajax_rating.js') }}"></script>--}}
    {{--<script src="{{asset('js/ajax_edit_rating.js') }}"></script>--}}
    <script src="{{ asset('js/jquery-validation.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    {{-- added css--}}
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    {{--<!-- Morris Charts CSS -->--}}
    {{--<link href="{{ asset('css/plugins/morris.css') }}" rel="stylesheet">--}}
    <!-- Custom Fonts -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <script>
        window.Laravel ={!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>


    <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
    <script  type="text/javascript">
        tinymce.init({
            selector: '#mytextarea',
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table contextmenu directionality emoticons template paste textcolor'
            ],

        });
        </script>

        <script  type="text/javascript">
        tinymce.init({
            selector: '#newseditor',
            plugins: 'code'
        });
        </script>
 
</head>
<body>
 <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation </span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('admin.dashboard')}}"> Admin </a>

            </div>
            <div></div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">

                <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('upload/users/user_'.Auth::user()->id.'/images/profile_pic/current_dp/'.Auth::user()->image)}}" onerror="this.src='{{asset('image/user.png')}}'" width="30px" height="30px">

                        {{  Auth::user()->fname." ".Auth::user()->lname }}<b class="caret"></b></a>

                    <ul class="dropdown-menu">
                        <li>
                           <a href=" {{ route('admin.profile') }}"> <i class="fa fa-fw fa-user fa-x3"></i> Profile</a>
                        </li>

                        <li>
                            <a href= "{{ route('admin.changepwd') }}" ><i class="fa fa-fw fa-gear"></i> Change Password</a>
                        </li>
                        <li>
                            <a href="{{ route('edit_profile')}}"> <i class="fa fa-pencil" aria-hidden="true"></i>Edit Account</a>
                        </li>

                        <li class="divider">logout</li>
                        <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"> <i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href=" {{ route('admin.dashboard') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <!-- users data -->
                     <li>
                        <a href="{{ route('user.index')}}"><i class="fa fa-fw fa-user"></i> Users </a>
                    </li>

                    <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#school"><i class="fa fa-fw fa-arrows-v" ></i> Manage School <class="fa fa-fw fa-caret-down"></i> </a>
                        <ul id="school" class="collapse">
                        <li>
                            <a href="{{route('school.index')}}"> <i class="fa fa-university" aria-hidden="true"></i> School</a>
                        </li>
                            <li>
                                <a href="{{route('school_news.index')}}"> <i class="fa fa-newspaper-o" aria-hidden="true"></i> News </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#cms"><i class="fa fa-arrow-down" aria-hidden="true"></i>Content Management </a>
                        <ul id="cms" class="collapse">

                            <li>
                                <a href="{{route('content.index')}}"> <i class="fa fa-file-text-o" aria-hidden="true"></i> Static Content</a>
                            </li>
                            <li>
                                <a href="{{ route('freq_ask_ques')}}"> <i class="fa fa-quora" aria-hidden="true"></i> FAQ's</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{route('rating_reviews.index')}}"><i class="fa fa-star-half-o" aria-hidden="true"></i> Rating & Reviews </a>
                    </li>

                    <li>
                        <a href="{{ route('forum.index')}}"><i class="fa fa-comments" aria-hidden="true"></i> Forum </a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <div id="page-wrapper">

            <div class="container-fluid">
                @yield('content')
            </div>
        <!-- /#page-wrapper -->
      </div>

 </div>
</body>
</html>